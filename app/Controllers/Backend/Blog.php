<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;
use CodeIgniter\API\ResponseTrait;


class Blog extends LoggedController
{
    use ResponseTrait;

    public function __construct(){
        parent::__construct();

        helper(['form']);

    }
    public function index(){
        $status = trim(isset($_GET['status']) ? $_GET['status'] : '');

        $types = [
            "all" => ['0','1'],
            "publish" => ['1'],
            "draft" => ['0'],
            "trash" => ['-1']
        ];

      

        $where = $types["all"];

        if(!empty($status) && $types[$status]){
            $where = $types[$status];
        }


        $blogModel = new \App\Models\BlogModel();
        $blogCModel = new \App\Models\BlogCategoryJoinModel();
        $list = $blogModel->getBlogWithUser($where,$this->request->getVar('q'));

        foreach($list as &$item){
            $item['kategoriler'] = $blogCModel->getCategories($item['blogid']);
        }

     

        $statics = [];

        foreach($types as $type => $values){
            $statics[$type] = $blogModel->whereIn("publish",$values)->countAllResults();
        }


        return view("back/blog/index",["title" => "Yazılarım","list" => $list,"statics" => $statics]);
    }
    public function insert_blog(){

        $blogCategoryModel = new \App\Models\BlogCategoryModel();

        $category = $blogCategoryModel->where("status","1")->findAll();


        return view("back/blog/insert_blog",["title" => "Blog Ekle","category"=> $category]);
    }

    public function insert_blog_post(){

   

        $data = [];

        $data["title"] = $this->request->getPost('title');

        if(empty($data["title"])){

            session()->setFlashData("fail","Başlık alanını doldurunuz.");
            return view("back/blog/insert_blog",["title" => "Yazı Ekle"]);
        }


        helper('site');

        $data["content"] = $this->request->getPost('content');
        $data["publish"] = $this->request->getPost('publish');
        $data["userid"] = session()->get('loggedUser');
        $data["slug"] = create_slug($data['title']);


        $blogModel = new \App\Models\BlogModel();


        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {
            $newName = $fimg->getRandomName();
            $fimg->move(FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'blog', $newName);
            $data['image'] = $newName;
        }



        if($blogModel->save($data)){


            $joinModel = new \App\Models\BlogCategoryJoinModel();
            $list = $this->request->getPost('kategori');


            $insertId = $blogModel->getInsertID();

            if(empty($list) || count($list) == 0){
                $joinModel->save([
                    "blogid" => $insertId,
                    "categoryid" => 1
                ]);
            }else{
                foreach($list as $id){
                    $joinModel->save([
                        "blogid" => $insertId,
                        "categoryid" => $id
                    ]);
                }
            }
            session()->setFlashData("success","Başarılı şekilde kaydedildi.");

            //$servicesModel->getInsertID()
            return redirect()->to("dashboard/blog")->withInput();


        }else{
            session()->setFlashData("fail","Kayıt oluşturulamadı.");
            return view("back/event/insert_service",["title" => "Yazı Ekle"]);
        }

       
    }

    public function insert_blog_edit($id){
        $blogModel = new \App\Models\BlogModel();
      
        $find =$blogModel->find($id);

        if(!$find){
            return redirect()->back()->with("fail","Böyle bir kayıt bulunamadı.[edit]");
        }
        $blogCategoryModel = new \App\Models\BlogCategoryModel();
        $blogCategoryJoinModel = new \App\Models\BlogCategoryJoinModel();

        $category = $blogCategoryModel->findAll();

        $selectedCategory = $blogCategoryJoinModel->getList($id);

        $list = array_column($selectedCategory,'categoryid');

        foreach($category as &$c){
            $c['secili'] = in_array($c['id'],$list);
        }
 
        return view("back/blog/edit_blog",["title" => "Yazı Düzenle","blog" => $find,"category" => $category]);
    }

    public function insert_blog_edit_post($id){

        $blogModel = new \App\Models\BlogModel();

        $data =$blogModel->find($id);

        if(!$data){
            return redirect()->back()->with("fail","Böyle bir kayıt bulunamadı.[edit.replaced]");
        }

        helper('site');

        $data['title'] = $this->request->getPost('title');
        $data["content"] = $this->request->getPost('content');
        $data["publish"] = $this->request->getPost('publish');
        $data["userid"] = session()->get('loggedUser');
        $data["slug"] = create_slug($data['title']);


        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {
            $newName = $fimg->getRandomName();
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'blog';
            $fimg->move($path, $newName);


            if(!empty($data['image']) && file_exists($path.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($path.DIRECTORY_SEPARATOR.$data['image']);
            }

            $data['image'] = $newName;
        }

        if($blogModel->save($data)){

            $joinModel = new \App\Models\BlogCategoryJoinModel();

            $joinModel->deleteBlogCategories($id);

            $list = $this->request->getPost('kategori');

            if(empty($list) || count($list) == 0){
                $joinModel->save([
                    "blogid" => $data['id'],
                    "categoryid" => 1
                ]);
            }else{
                foreach($list as $id){
                    $joinModel->save([
                        "blogid" => $data['id'],
                        "categoryid" => $id
                    ]);
                }
            }


            if($data['publish'] == 0){
                session()->setFlashData("info","Taslak olarak kaydedildi.");
            }else{
                session()->setFlashData("success","Başarılı şekilde yayımlandı. <a href=''>linke git</a>");
            }

            return redirect()->back()->withInput();


        }else{
            session()->setFlashData("fail","Kayıt oluşturulamadı.");
            return view("back/event/edit_event",["title" => "Blog Düzenle"]);
        }

    }

    public function insert_blog_trash($id){

        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }

        $blogModel = new \App\Models\BlogModel();

        $find = $blogModel->find($id);
        if(!$find){
            return redirect()->back()->with("fail","Belirtilen yazı bulunamadı.");
        }

        $find['publish'] = -1;

        if($blogModel->save($find)){
            return redirect()->back()->with("info","Çöp kutusuna taşındı.");
        }else{
            return redirect()->back()->with("fail","Belirtilen blog silinemedi");
        }

    }


    public function insert_blog_delete($id){
        $eventsModel = new \App\Models\BlogModel();

        $data = $eventsModel->find($id);
        if(!$data){
            return redirect()->back()->with("fail","Belirtilen hizmet bulunamadı");
        }

    

        if($eventsModel->delete($data)){

            // resmi sil
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'blog';

            if(!empty($data['image']) && file_exists($path.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($path.DIRECTORY_SEPARATOR.$data['image']);
            }

            $JoinModel = new \App\Models\BlogCategoryJoinModel();

            $JoinModel->deleteBlogCategories($data['id']);

            return redirect()->back()->with("success","Başarılı şekilde kaldırıldı.");
        }else{
            return redirect()->back()->with("fail","Belirtilen yazı silinemedi");
        }

    }

    public function insert_blog_imgdelete($id){
       
        $BlogModel = new \App\Models\BlogModel();

        $data = $BlogModel->find($id);
        if(!$data){
            return redirect()->back()->with("fail","Belirtilen yazı bulunamadı");
        }
        $link = $data['image'];
        $data['image'] = null;
        if($BlogModel->save($data)){

             // resmi sil
             $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'blog';

             if(!empty($link) && file_exists($path.DIRECTORY_SEPARATOR.$link)){
                 unlink($path.DIRECTORY_SEPARATOR.$link);
             }

             return redirect()->back();

        }else{
            return redirect()->back()->with("fail","Resim silinemedi.");
        }



    }


    public function categories(){
        $kategoriModel = new \App\Models\BlogCategoryModel();
        $categories = $kategoriModel->CategoryWithBlogCount();

        return view('back/blog/categories',["title" => "Kategorileri Düzenle","list" => $categories]);
    }

    public function add_category(){

        $kategori = $this->request->getPost('category');

        if(empty($kategori)){
            return redirect()->to("/dashboard/blog/kategoriler")->with("fail","Kategori boş olamaz.");
        }

        $kategoriModel = new \App\Models\BlogCategoryModel();
        helper('site');
        $slug = create_slug($kategori);

        $find = $kategoriModel->where("slug",$slug)->find();

        if($find){
            return redirect()->to("/dashboard/blog/kategoriler")->with("fail","Böyle bir kategori zaten bulunuyor.");
        }
        
        if($kategoriModel->save([
            "slug" => $slug,
            "title" => $kategori
        ])){
            return redirect()->to("/dashboard/blog/kategoriler")->with("success","kategori eklendi");
        }else{
            return redirect()->to("/dashboard/blog/kategoriler")->with("fail","Bir sorun oluştu.");
        }


        
    }

    public function toggle_category(){
        
        $status = $_GET['status'];
        $id = isset($_GET['id']) ? $_GET['id'] : '';

        if($id == 1){
            return $this->respond(["error" => "Bu işlemi yapma yetkiniz bulunmuyor"],400);
        }

        if(!is_numeric($id)){
            return $this->respond(["error" => "İd parametresi gereklidir."]);
        }

        $model = new \App\Models\BlogCategoryModel();


        if($model->update($id,["status" => $status == 'true'])){
            return $this->respond(["success" => "başarılı"]);
        }else{
            return $this->respond(["error" => "Güncellenemedi."]);
        }

    }
    public function remove_category($id){

        if($id == 1){
            return redirect()->back()->with("fail","Anakategori silinemez.");
        }

        if(!is_numeric($id)){
            return redirect()->back();
        }

        $kategoriModel = new \App\Models\BlogCategoryModel();
        $data = $kategoriModel->find($id);

        if(!$data){
            return redirect()->back();
        }


        if($kategoriModel->delete($id)){

            $jModel = new \App\Models\BlogCategoryJoinModel();
            $jModel->where("categoryid",$id)->delete();

            $jModel->ifNotExistsAddKategori();
           

            return redirect()->back()->with("success","Silindi");
        }else{
            return redirect()->back()->with("fail","Bir sorun oluştu.");
        }

    }
    public function edit_category(){
        $slug = $this->request->getPost('slug');
        $category = $this->request->getPost('category');
        if(empty($slug)){
            helper('url');
            $slug = create_slug($category);
        }
        $id = $this->request->getPost('id');

        $kategoriModel = new \App\Models\BlogCategoryModel();

        $find = $kategoriModel->find($id);
        if($find){

            if($kategoriModel->where("slug",$slug)->where("id !=",$id)->find()){
                return redirect()->back()->with("fail","Bu slug zaten kullanılıyor!");
            }else{

                $find["slug"] = $slug;
                $find["title"] = $category;

                if($kategoriModel->save($find)){
                    return redirect()->back()->with("success","Güncelleme işlemi tamamlandı.");
                }else{
                    return redirect()->back()->with("fail","Bir sorun oluştu.");
                }



            }

        }else{
            return redirect()->back();
        }
        

    }

}
