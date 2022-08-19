<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogCategoryModel extends Model
{
    protected $table = 'blog_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title','slug','status'];


    public function  CategoryWithBlogCount(){
        $data = $this
        ->select("blog_categories.*,count(blogcategory.categoryid) as total")
        ->join("blogcategory","blogcategory.categoryid = blog_categories.id","left")
        ->groupBy("blogcategory.categoryid")
        ->findAll();
        return $data;
    }

}