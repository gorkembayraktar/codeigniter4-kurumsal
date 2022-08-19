<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;
use CodeIgniter\API\ResponseTrait;

class Pages extends LoggedController
{
    use ResponseTrait;
  
    public function __construct(){
        parent::__construct();

        helper(['form']);

    }
    public function pages(){
        $model = new \App\Models\PagesModel();
        $list = $model->orderBy("created_at","desc")->findAll();

        return view("back/pages/pages",["title" => "Sayfalar","list" => $list]);
    }
    public function pages_add(){
        return view("back/pages/pages_add",["title" => "Sayfa Ekle"]);
    }

    public function pages_add_post(){

        
        $data = [];

        $data["title"] = $this->request->getPost('title');

        if(empty($data["title"])){

            session()->setFlashData("fail","Başlık alanını doldurunuz.");
            return view("back/pages/pages_add",["title" => "Sayfa Oluştur"]);
        }


        helper('site');

        $data["content"] = $this->request->getPost('content');
        $data["userid"] = session()->get('loggedUser');
        $data["slug"] = create_slug($data['title']);
        $data["subtitle"] = $this->request->getPost('subtitle');


        $model = new \App\Models\PagesModel();


        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {
            $newName = $fimg->getRandomName();
            $fimg->move(FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pages', $newName);
            $data['image'] = $newName;
        }



        if($model->save($data)){
            session()->setFlashData("success","Başarılı şekilde kaydedildi.");

            //$servicesModel->getInsertID()
            return redirect()->to("dashboard/kurumsal/sayfalar")->withInput();


        }else{
            session()->setFlashData("fail","Kayıt oluşturulamadı.");
            return view("back/pages/pages_add",["title" => "Sayfa Oluştur"]);
        }


        return view("back/pages/pages_add",["title" => "Sayfa Oluştur"]);
    }


    public function pages_edit($id){
        $model = new \App\Models\PagesModel();
        $page = $model->find($id);

        if(!$page){
            return redirect()->back();
        }


        return view("back/pages/pages_edit",["title" => $page["title"]." sayfasını düzenle","page" => $page]);
    }


    
    public function pages_edit_post($id){
       
        $pagesModel = new \App\Models\PagesModel();

        $data =$pagesModel->find($id);

        if(!$data){
            return redirect()->back()->with("fail","Böyle bir kayıt bulunamadı.[edit.replaced]");
        }

        helper('site');

        $data['title'] = $this->request->getPost('title');
        $data["content"] = $this->request->getPost('content');
        $data["subtitle"] = $this->request->getPost('subtitle');
        $data["userid"] = session()->get('loggedUser');
        $data["slug"] = create_slug($data['title']);


        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {
            $newName = $fimg->getRandomName();
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pages';
            $fimg->move($path, $newName);


            if(!empty($data['image']) && file_exists($path.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($path.DIRECTORY_SEPARATOR.$data['image']);
            }

            $data['image'] = $newName;
        }

        if($pagesModel->save($data)){
            session()->setFlashData("info","Sayfa düzenlendi");
            return redirect()->to("/dashboard/kurumsal/sayfalar")->withInput();
        }else{
            session()->setFlashData("fail","Kayıt oluşturulamadı.");
            return view("back/pages/pages_edit",["title" => "Sayfa Düzenle"]);
        }
    }
    public function pages_delete($id){

        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }
        

        $PagesModel = new \App\Models\PagesModel();

        $data = $PagesModel->find($id);
        if(!$data){
            return redirect()->back();
        }

    

        if($PagesModel->delete($data)){

            // resmi sil
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'pages';

            if(!empty($data['image']) && file_exists($path.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($path.DIRECTORY_SEPARATOR.$data['image']);
            }
            return redirect()->back()->with("success","Başarılı şekilde kaldırıldı.");
        }else{
            return redirect()->back()->with("fail","Belirtilen sayfa silinemedi");
        }
    }
    public function toggle(){
        $status = $_GET['status'];
        $id = isset($_GET['id']) ? $_GET['id'] : '';


        if(!is_numeric($id)){
            return $this->respond(["error" => "İd parametresi gereklidir.[pages.toggle]"],400);
        }

        $model = new \App\Models\PagesModel();
    
        if($model->update($id,["active" => $status == true])){
            return $this->respond(["success" => "başarılı"]);
        }else{
            return $this->respond(["error" => "Güncellenemedi."]);
        }

    }

}
