<?php

namespace App\Controllers\Frontend;

use App\Controllers\FrontendController;

class Services extends FrontendController
{

  
    public function __construct(){
        parent::__construct();
    }
    

    public function services(){
        $page = $this->request->getVar('p');
        if(!is_numeric($page) || $page < 1) $page = 1;

      
        $serviceModel = new \App\Models\ServicesModel();

        $perPage = 6;
        $count = $serviceModel->where("publish",1)->orderBy("created_at","desc")->countAllResults();

        $maxPage =  ceil($count / $perPage);

        if($page > $maxPage) $page = $maxPage;

        $data =  $serviceModel->where("publish",1)->orderBy("created_at","desc")->limit($perPage)->offset(($page-1)*$perPage)->get()->getResult('array');
 
        $pagination = [
            "page" => $page,
            "maxPage" => $maxPage
        ];
        return view('front/services',["title" => "Hizmetlerimiz","image" => "public/images/background/page-title.jpg","data"=>$data,"pagination" => $pagination]);
    }
    public function services_one($param){

        $servicesModel = new \App\Models\ServicesModel();

        if(!session()->has('loggedUser')){
            $servicesModel->where("publish",1);
        }
        $sec = $servicesModel->where("slug",$param)->limit(1)->get()->getRowArray();
     
        if(!$sec){
           return redirect()->to("/hizmetlerimiz");
        }

        $title = $sec['title'];

        $services =$servicesModel->where('publish',1)->orderBy("created_at","asc")->findAll();

        return view('front/services_single',["title" => $title,"image" => "public/images/background/page-title.jpg","services" => $services,"data" => $sec]);
    }


    
}