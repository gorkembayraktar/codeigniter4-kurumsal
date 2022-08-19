<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;


class Services extends LoggedController
{

 
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


        $servicesModel = new \App\Models\ServicesModel();
        $list = $servicesModel->getServicesWithUser($where,$this->request->getVar('q'));
        $statics = [];

        foreach($types as $type => $values){
            $statics[$type] = $servicesModel->whereIn("publish",$values)->countAllResults();
        }


        return view("back/services/index",["title" => "Hizmetlerimiz","list" => $list,"statics" => $statics]);
    }
    public function insert_service_delete($id){
        $servicesModel = new \App\Models\ServicesModel();

        $data = $servicesModel->find($id);
        if(!$data){
            return redirect()->back()->with("fail","Belirtilen servis bulunamadı");
        }

    

        if($servicesModel->delete($data)){

            // resmi sil
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'services';

            if(!empty($data['image']) && file_exists($path.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($path.DIRECTORY_SEPARATOR.$data['image']);
            }
            return redirect()->back()->with("success","Başarılı şekilde kaldırıldı.");
        }else{
            return redirect()->back()->with("fail","Belirtilen servis silinemedi");
        }

    }
    public function insert_service_imgdelete($id){
       
        $servicesModel = new \App\Models\ServicesModel();

        $data = $servicesModel->find($id);
        if(!$data){
            return redirect()->back()->with("fail","Belirtilen servis bulunamadı");
        }
        $link = $data['image'];
        $data['image'] = null;
        if($servicesModel->save($data)){

             // resmi sil
             $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'services';

             if(!empty($link) && file_exists($path.DIRECTORY_SEPARATOR.$link)){
                 unlink($path.DIRECTORY_SEPARATOR.$link);
             }

             return redirect()->back();

        }else{
            return redirect()->back()->with("fail","Resim silinemedi.");
        }



    }
    public function insert_service_trash($id){

        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }
        
        $servicesModel = new \App\Models\ServicesModel();

        $find = $servicesModel->find($id);
        if(!$find){
            return redirect()->back()->with("fail","Belirtilen servis bulunamadı.");
        }

        $find['publish'] = -1;

        if($servicesModel->save($find)){
            return redirect()->back()->with("info","Çöp kutusuna taşındı.");
        }else{
            return redirect()->back()->with("fail","Belirtilen servis silinemedi");
        }

    }
    public function insert_service(){

        return view("back/services/insert_service",["title" => "Hizmet Ekle"]);
    }

    public function insert_service_post(){
        
        $data = [];

        $data["title"] = $this->request->getPost('title');

        if(empty($data["title"])){

            session()->setFlashData("fail","Başlık alanını doldurunuz.");
            return view("back/services/insert_service",["title" => "Hizmet Ekle"]);
        }


        helper('site');

        $data["content"] = $this->request->getPost('content');
        $data["publish"] = $this->request->getPost('publish');
        $data["userid"] = session()->get('loggedUser');
        $data["slug"] = create_slug($data['title']);


        $servicesModel = new \App\Models\ServicesModel();


        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {
            $newName = $fimg->getRandomName();
            $fimg->move(FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'services', $newName);
            $data['image'] = $newName;
        }



        if($servicesModel->save($data)){
            session()->setFlashData("success","başarılı");

            //$servicesModel->getInsertID()
            return redirect()->to("dashboard/hizmetler")->withInput();


        }else{
            session()->setFlashData("fail","Kayıt oluşturulamadı.");
            return view("back/services/insert_service",["title" => "Hizmet Ekle"]);
        }

    
    }

    public function insert_service_edit($id){
        $servicesModel = new \App\Models\ServicesModel();

        $find =$servicesModel->find($id);

    
        if(!$find){
            return redirect()->back()->with("fail","Böyle bir kayıt bulunamadı.[edit]");
        }
        return view("back/services/edit_service",["title" => "Hizmet Düzenle","service" => $find]);
    }

    public function insert_service_edit_post($id){
        $servicesModel = new \App\Models\ServicesModel();

        $data =$servicesModel->find($id);

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
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'services';
            $fimg->move($path, $newName);


            if(!empty($data['image']) && file_exists($path.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($path.DIRECTORY_SEPARATOR.$data['image']);
            }

            $data['image'] = $newName;
        }

        if($servicesModel->save($data)){

            if($data['publish'] == 0){
                session()->setFlashData("info","Taslak olarak kaydedildi.");
            }else{
                session()->setFlashData("success","başarılı <a href=''>linke git</a>");
            }

            return redirect()->back()->withInput();


        }else{
            session()->setFlashData("fail","Kayıt oluşturulamadı.");
            return view("back/services/edit_service",["title" => "Hizmet Ekle"]);
        }


    }



}
