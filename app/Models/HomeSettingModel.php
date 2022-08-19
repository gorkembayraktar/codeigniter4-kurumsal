<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeSettingModel extends Model
{
    protected $table = 'home_setting';
    protected $primaryKey = 'id';

    protected $allowedFields = ['section','title','info','content','active','props','sira'];

}