<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactsModel extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','mail','subject','message','created_at','updated_at','page_created_at','ip_adress','ip_info_json','device_info',
'isMailSend','sendMailAdress','isRead','isDeleted','isReadDate','isDeletedDate'];

    

}