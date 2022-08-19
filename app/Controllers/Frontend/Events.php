<?php

namespace App\Controllers\Frontend;

use App\Controllers\FrontendController;

class Events extends FrontendController
{

  
    
    public function __construct(){
        parent::__construct();
    }
    

    public function events(){
        $page = $this->request->getVar('p');
        if(!is_numeric($page) || $page < 1) $page = 1;

      
        $eventModel = new \App\Models\EventsModel();

        $perPage = 6;
        $count = $eventModel->where("publish",1)->orderBy("created_at","desc")->countAllResults();

        $maxPage =  ceil($count / $perPage);

        if($page > $maxPage) $page = $maxPage;

        $data =  $eventModel->where("publish",1)->orderBy("created_at","desc")->limit($perPage)->offset(($page-1)*$perPage)->get()->getResult('array');
 
        $pagination = [
            "page" => $page,
            "maxPage" => $maxPage
        ];
        return view('front/events',["title" => "Etkinliklerimiz","image" => "public/images/background/page-title.jpg", "data"=>$data,"pagination" => $pagination]);
    }
    public function events_one($param){
        $eventsModel = new \App\Models\EventsModel();

        if(!session()->has('loggedUser')){
            $eventsModel->where("publish",1);
        }
        $sec = $eventsModel->where("slug",$param)->limit(1)->get()->getRowArray();
     
        if(!$sec){
           return redirect()->to("/etkinliklerimiz");
        }

        $title = $sec['title'];

        $events = $eventsModel->where('publish',1)->orderBy("created_at","asc")->findAll();

        return view('front/events_single',["title" => $title,"image" => "public/images/background/page-title.jpg","events" => $events,"data" => $sec]);
    }


    
}