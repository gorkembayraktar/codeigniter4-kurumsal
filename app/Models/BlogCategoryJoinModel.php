<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogCategoryJoinModel extends Model
{
    protected $table = 'blogcategory';
    protected $primaryKey = 'id';
    protected $allowedFields = ['blogid','categoryid'];

    public function getList($id){
        $this->select("categoryid")
        ->join("blog","blog.id = blogcategory.blogid","left")
        ->join("blog_categories","blog_categories.id = blogcategory.categoryid","left")
        ->where("blogid",$id);
        return $this->findAll();
    }
    public function getCategories($id){
        $this->select("categoryid,blog_categories.title,blog_categories.slug")
        ->join("blog","blog.id = blogcategory.blogid","left")
        ->join("blog_categories","blog_categories.id = blogcategory.categoryid","left")
        ->where("blogid",$id);
        return $this->findAll();
    }

    public function deleteBlogCategories($blogid){
        return $this->where('blogid',$blogid)->delete();
    }
    public function ifNotExistsAddKategori(){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM blog WHERE id NOT IN (SELECT DISTINCT blogid FROM blogcategory)");

        $results = $query->getResultArray();

        foreach($results as $item){
            $blogid = $item['id'];
            $db->query("INSERT INTO blogcategory SET blogid = $blogid,categoryid = 1");
        }

    }

}