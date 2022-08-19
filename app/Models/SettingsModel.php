<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';

    protected $allowedFields = ['telephone','email','footer','adress','title','favicon','logo','active','preloader','facebook','twitter','instagram','youtube','seo_author','seo_keywords','seo_description','html_js','html_css','html_body','html_head'];

}