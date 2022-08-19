<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;


class Notifications extends LoggedController
{

    public function index(){

        $model = new \App\Models\ContactsModel();
        $list = $model->orderBy('created_at','desc')->where('isDeleted',0)->findAll();
        return view("back/notifications/index",["title" => "Bildirimler","list" => $list]);
    }
    public function index_post(){
       
    }
   
    public function detail($id){
        $model = new \App\Models\ContactsModel();
        $item = $model->where([
            "id" => $id,
            "isDeleted" => 0
        ])->limit(1)->get()->getRowArray();

        if(!$item){
            return redirect()->back();
        }

        if(!$item['isRead']){
            $model->update($item['id'],['isRead' => 1]);
        }

        $item['ip_info_json'] = json_decode($item['ip_info_json'],1);
        return view("back/notifications/detail",["title" => "Bildirim Detayları","detail" => $item]);
    }
    public function detail_post($id){

    }
}
