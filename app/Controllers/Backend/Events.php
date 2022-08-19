<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;


class Events extends LoggedController
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


        $eventsModel = new \App\Models\EventsModel();
        $list = $eventsModel->getEventsWithUser($where,$this->request->getVar('q'));
        $statics = [];

        foreach($types as $type => $values){
            $statics[$type] = $eventsModel->whereIn("publish",$values)->countAllResults();
        }


        return view("back/event/index",["title" => "Etkinliklerimiz","list" => $list,"statics" => $statics]);
    }
    public function insert_event(){
        return view("back/event/insert_event",["title" => "Etkinlik Ekle"]);
    }

    public function insert_event_post(){
        
        $data = [];

        $data["title"] = $this->request->getPost('title');

        if(empty($data["title"])){

            session()->setFlashData("fail","Başlık alanını doldurunuz.");
            return view("back/event/insert_event",["title" => "Etkinlik Ekle"]);
        }


        helper('site');

        $data["content"] = $this->request->getPost('content');
        $data["publish"] = $this->request->getPost('publish');
        $data["userid"] = session()->get('loggedUser');
        $data["slug"] = create_slug($data['title']);


        $eventsModel = new \App\Models\EventsModel();


        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {
            $newName = $fimg->getRandomName();
            $fimg->move(FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'events', $newName);
            $data['image'] = $newName;
        }



        if($eventsModel->save($data)){
            session()->setFlashData("success","Başarılı şekilde kaydedildi.");

            //$servicesModel->getInsertID()
            return redirect()->to("dashboard/etkinlikler")->withInput();


        }else{
            session()->setFlashData("fail","Kayıt oluşturulamadı.");
            return view("back/event/insert_service",["title" => "Etkinlik Ekle"]);
        }

    
    }


    public function insert_event_edit($id){
        $eventsModel = new \App\Models\EventsModel();

        $find =$eventsModel->find($id);

    
        if(!$find){
            return redirect()->back()->with("fail","Böyle bir kayıt bulunamadı.[edit]");
        }
        return view("back/event/edit_event",["title" => "Etkinlik Düzenle","event" => $find]);
    }

    public function insert_event_edit_post($id){
        $eventModel = new \App\Models\EventsModel();

        $data =$eventModel->find($id);

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
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'events';
            $fimg->move($path, $newName);


            if(!empty($data['image']) && file_exists($path.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($path.DIRECTORY_SEPARATOR.$data['image']);
            }

            $data['image'] = $newName;
        }

        if($eventModel->save($data)){

            

            if($data['publish'] == 0){
                session()->setFlashData("info","Taslak olarak kaydedildi.");
            }else{
                session()->setFlashData("success","Başarılı şekilde yayımlandı. <a href=''>linke git</a>");
            }

            return redirect()->back()->withInput();


        }else{
            session()->setFlashData("fail","Kayıt oluşturulamadı.");
            return view("back/event/edit_event",["title" => "Etkinlik Düzenle"]);
        }


    }

    public function insert_event_trash($id){

        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }

        
        $eventsModel = new \App\Models\EventsModel();

        $find = $eventsModel->find($id);
        if(!$find){
            return redirect()->back()->with("fail","Belirtilen hizmet bulunamadı.");
        }

        $find['publish'] = -1;

        if($eventsModel->save($find)){
            return redirect()->back()->with("info","Çöp kutusuna taşındı.");
        }else{
            return redirect()->back()->with("fail","Belirtilen hizmet silinemedi");
        }

    }

    public function insert_event_delete($id){
        $eventsModel = new \App\Models\EventsModel();

        $data = $eventsModel->find($id);
        if(!$data){
            return redirect()->back()->with("fail","Belirtilen hizmet bulunamadı");
        }

    

        if($eventsModel->delete($data)){

            // resmi sil
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'events';

            if(!empty($data['image']) && file_exists($path.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($path.DIRECTORY_SEPARATOR.$data['image']);
            }
            return redirect()->back()->with("success","Başarılı şekilde kaldırıldı.");
        }else{
            return redirect()->back()->with("fail","Belirtilen hizmet silinemedi");
        }

    }

    public function insert_event_imgdelete($id){
       
        $eventsModel = new \App\Models\EventsModel();

        $data = $eventsModel->find($id);
        if(!$data){
            return redirect()->back()->with("fail","Belirtilen hizmet bulunamadı");
        }
        $link = $data['image'];
        $data['image'] = null;
        if($eventsModel->save($data)){

             // resmi sil
             $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'events';

             if(!empty($link) && file_exists($path.DIRECTORY_SEPARATOR.$link)){
                 unlink($path.DIRECTORY_SEPARATOR.$link);
             }

             return redirect()->back();

        }else{
            return redirect()->back()->with("fail","Resim silinemedi.");
        }



    }



}
