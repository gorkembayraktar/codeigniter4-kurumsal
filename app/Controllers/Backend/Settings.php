<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;


class Settings extends LoggedController
{

    public function contact_settings(){


        $settingsModel = model('SettingsModel');

        $settings = $settingsModel->find(1);

        return view("back/setting/contact_setting",["title" => "İletişim Ayarları","settings" => $settings]);
    }

    public function contact_settings_post(){

        $settingsModel = model('SettingsModel');

        $find = $settingsModel->find(1);

        $find['facebook'] = $this->request->getPost('facebook');

        $find['instagram'] = $this->request->getPost('instagram');

        $find['twitter'] = $this->request->getPost('twitter');

        $find['youtube'] = $this->request->getPost('youtube');

        $find['telephone'] = $this->request->getPost('tel');

        $find['email'] = $this->request->getPost('mail');

        $find['adress'] = $this->request->getPost('adres');


        if($settingsModel->save($find)){
            return redirect()->back()->with('success',"Bilgiler Başarılı şekilde kaydedildi.");
        }else{
            return redirect()->back()->with('fail',"Bilgiler kaydedilemedi.");
        }
    
    }

  
    public function public_settings(){


        $settingsModel = model('SettingsModel');

        $settings = $settingsModel->find(1);

        return view("back/setting/public_setting",["title" => "Genel Ayarlar","settings" => $settings]);
    }

    public function public_settings_post(){

        $settingsModel = model('SettingsModel');

        $find = $settingsModel->find(1);
        
        $find['title'] = $this->request->getPost('title');
        
        $find['active'] = $this->request->getPost('active') == '1';

        $find['seo_author'] = $this->request->getPost('seo_author');

        $find['seo_description'] = $this->request->getPost('seo_description');

        $find['seo_keywords'] = $this->request->getPost('seo_keywords');

        $find['footer'] = $this->request->getPost('footer');

        $find['preloader'] = $this->request->getPost('preloader') == '1';



        //LOGO İŞLEMLERİ

        

        $img = $this->request->getFile('logo');

        if ($img->isValid() && ! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $ext = $img->getClientExtension();

            $newfilename = 'logo.'.$ext;

            
            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images';

            if(file_exists($path.DIRECTORY_SEPARATOR.$newfilename)){
                unlink($path.DIRECTORY_SEPARATOR.$newfilename);
            }
            
            $img->move($path, $newfilename);


            $find['logo'] = $newfilename;

        }

        // FAVİCON İŞLEMLERİİ

        $fimg = $this->request->getFile('favicon');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {
            $newName = $fimg->getRandomName();
            $ext = $fimg->getClientExtension();

            $newfilename = 'favicon1.'.$ext;

            $path = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images';

            if(file_exists($path.DIRECTORY_SEPARATOR.$newfilename)){
                unlink($path.DIRECTORY_SEPARATOR.$newfilename);
            }
            
            
            $fimg->move($path, $newfilename);


            $find['favicon'] = $newfilename;

        }



        if($settingsModel->save($find)){
            return redirect()->to("/dashboard/ayarlar/genel")->with('success',"Bilgiler Başarılı şekilde kaydedildi.");
        }else{
            return redirect()->back()->with('fail',"Bilgiler kaydedilemedi.");
        }
    
        
    }

    public function ultra_settings(){

        $settingsModel = model('SettingsModel');

        $find = $settingsModel->find(1);

        return view("back/setting/ultra_setting",["title" => "Gelişmiş ayarlar","data" => $find]);
    }

    public function ultra_settings_post(){
        $settingsModel = model('SettingsModel');

        $find = $settingsModel->find(1);


        $find["html_js"] = $this->request->getPost('js');
        $find["html_css"] = $this->request->getPost('css');
        $find["html_head"] = $this->request->getPost('head');
        $find["html_body"] = $this->request->getPost('body');

        if($settingsModel->save($find)){
            return redirect()->back()->with('success',"Bilgiler Başarılı şekilde kaydedildi.");
        }else{
            return redirect()->back()->with('fail',"Bilgiler kaydedilemedi.");
        }

       
    }

    public function mail_setting(){
        $emailModel = model('EmailsModel');

        $data = $emailModel->find(1);

        return view("back/setting/mail_setting",["title" => "Mail Ayarları","data"=>$data]);
    }

    public function mail_setting_post(){
        
        $emailModel = model('EmailsModel');

        $find = $emailModel->find(1);

        if(!$find){
            return redirect()->back()->with('fail',"Teknik bir sorun oluştu.");
        }

        $find['host'] = $this->request->getPost('host');
        $find['port'] = $this->request->getPost('port');
        $find['email'] = $this->request->getPost('email');
        $find['password'] = $this->request->getPost('password');
        $find['secure'] = $this->request->getPost('secure');
        $find['replyMail'] = $this->request->getPost('replyMail');

        if($emailModel->save($find)){
            return redirect()->back()->with('success',"Bilgiler Kaydedildi.");
        }else{
            return redirect()->back()->with('fail',"Bir sorun oluştu.");
        }




    }

}
