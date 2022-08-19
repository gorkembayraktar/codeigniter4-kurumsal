<?php

namespace App\Models;

use CodeIgniter\Model;

class SlidersModel extends Model
{
    protected $table = 'slider';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title','buttonName','buttonRedirect','user_id','subtitle','content','image','created_date','updated_date','sira','active'];

    


}