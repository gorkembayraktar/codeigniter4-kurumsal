<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id';
    protected $allowedFields = ['userid','slug','title','content','created_at','publish','updated_at','image'];


    public function GetBlogWithUser($whereIn,$q = ''){
        $this->select("*,blog.id as blogid")
       ->join("users","users.id = blog.userid","left")
       ->whereIn("publish", $whereIn)
       ->orderBy("created_at","desc");

       if($q){
           $this->like('title',$q);
           $this->orLike('content',$q);
       
        }



       return $this->findAll();
   }
    

}