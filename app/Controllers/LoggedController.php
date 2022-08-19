<?php

namespace App\Controllers;
use App\Controllers\BaseController;


class LoggedController extends BaseController
{

    public function __construct(){

        $view = \Config\Services::renderer();
        
        $user = service('user');

        $contacts = new \App\Models\ContactsModel();
        
        $count = $contacts->where("isRead",0)->countAllResults();

        $data = $contacts->orderBy("isRead","asc")->orderBy('created_at','desc')->limit(3)->get()->getResult('array');

        $view->setData([
            "user" =>  $user,
            "notification" => [
                "count" => $count,
                "data" => $data
            ] 
        ]);


    }

}
