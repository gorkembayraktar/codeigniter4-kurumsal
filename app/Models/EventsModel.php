<?php

namespace App\Models;

use CodeIgniter\Model;

class EventsModel extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $allowedFields = ['userid','slug','title','content','created_at','publish','updated_at','image'];


    public function GetEventsWithUser($whereIn,$q = ''){
        $this->select("*,events.id as servisid")
       ->join("users","users.id = events.userid","left")
       ->whereIn("publish", $whereIn)
       ->orderBy("created_at","desc");

       if($q){
           $this->like('title',$q);
           $this->orLike('content',$q);
       }


       return $this->findAll();
   }
    

}