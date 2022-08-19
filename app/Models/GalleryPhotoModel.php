<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryPhotoModel extends Model
{
    protected $table = 'gallery_photo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','userid','image','created_at'];

    

}