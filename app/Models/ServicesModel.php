<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['userid','slug','title','content','created_at','publish','updated_at','image'];


    public function GetServicesWithUser($whereIn,$q = ''){
         $this->select("*,services.id as servisid")
        ->join("users","users.id = services.userid","left")
        ->whereIn("publish", $whereIn)
        ->orderBy("created_at","desc");

        if($q){
            $this->like('title',$q);
            $this->orLike('content',$q);
        }


        return $this->findAll();
    }
    

}