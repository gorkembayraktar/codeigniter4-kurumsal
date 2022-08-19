<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailsModel extends Model
{
    protected $table = 'emails';
    protected $primaryKey = 'id';
    protected $allowedFields = ['host','port','email','password','secure','replyMail'];

    

}