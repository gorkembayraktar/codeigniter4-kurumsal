<?php

namespace App\Controllers\Frontend;

use App\Controllers\FrontendController;

class Blog extends FrontendController
{

    
    public function __construct(){
        parent::__construct();
    }
    
     
    public function blog(){

        $page = $this->request->getVar('p');
        if(!is_numeric($page) || $page < 1) $page = 1;

      
        $blogModel = new \App\Models\BlogModel();

        $perPage = 6;
        $count = $blogModel->where("publish",1)->orderBy("created_at","desc")->countAllResults();

        $maxPage =  ceil($count / $perPage);

        if($page > $maxPage) $page = $maxPage;

        $data =  $blogModel->where("publish",1)->orderBy("created_at","desc")->limit($perPage)->offset(($page-1)*$perPage)->get()->getResult('array');
 
        $pagination = [
            "page" => $page,
            "maxPage" => $maxPage
        ];
        return view('front/blog',["title" => "Blog","image" => "public/images/background/page-title.jpg", "data"=>$data,"pagination" => $pagination]);
    }

    public function blog_one($param){
        $blogModel = new \App\Models\BlogModel();

        if(!session()->has('loggedUser')){
            $blogModel->where("publish",1);
        }
        $sec = $blogModel->where("slug",$param)->limit(1)->get()->getRowArray();

        
     
        if($sec){
            $title = $sec['title'];

            $blogModel->where("id !=",$sec['id']);
        }else{
            $title = "Blog Bulunamadı";
        }

        $lastBlog = $blogModel->where("publish",1)->orderBy("created_at","desc")->limit(3)->get()->getResult('array');

        $servisModel = new \App\Models\ServicesModel();
        $services =$servisModel->where('publish',1)->orderBy("created_at","asc")->findAll();


        return view('front/blog_single',["title" => $title,"image" => "public/images/background/page-title.jpg","blog" => $sec,"lastBlog"=>$lastBlog,"services" => $services]);
       
    }


}