<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;


class Profile extends LoggedController
{

  
    public function about(){
        return view("back/profile/about",["title" => "Profil Bilgileri"]);
    }

    public function about_post(){
        
        $usersModel = new \App\Models\UsersModel();

        $user = $usersModel->find(session()->get('loggedUser'));


        $user["name"] = $this->request->getPost("name");
        $user["username"] = $this->request->getPost("username");
        $user["email"] = $this->request->getPost("email");


        $fimg = $this->request->getFile('profil');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {

            $newName = $fimg->getRandomName();

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'back'.DIRECTORY_SEPARATOR.'user';
    
            $fimg->move($directory, $newName);

            //
            $old_file = $directory.DIRECTORY_SEPARATOR.$user['image'];
            if(!empty($user['image']) && file_exists($old_file)){
                unlink($old_file);
            }

            $user['image'] = $newName;

        }



        if($usersModel->save($user)){
            return redirect()->back()->with('success',"Bilgiler Başarılı şekilde kaydedildi.");
        }else{

            return redirect()->back()->with('fail',"Kaydedilirken bir sorunla karşılaşıldı");
        }


        






    }

    public function password(){
        return view("back/profile/password",["title" => "Şifre Değiştir"]);
    }

    public function password_post(){

        $current = $this->request->getPost('current');
        $password = $this->request->getPost('password');
        $passwordcheck = $this->request->getPost('passwordcheck');

        $usersModel = new \App\Models\UsersModel();

        $user = $usersModel->find(session()->get('loggedUser'));

        
        if(empty($current) || empty($password) || empty($passwordcheck)){
            return redirect()->back()->with('fail',"Alanların hepsini doldurunuz.");
        }else if( ! \App\Libraries\Hash::check($current,$user['password'])){
            return redirect()->back()->with('fail',"Mevcut şifrenizi yanlış girdiniz.");
        }else if($password != $passwordcheck){
            return redirect()->back()->with('fail',"Şifre tekrarını doğru giriniz.");
        }else if($current == $password){
            return redirect()->back()->with('fail',"Yeni şifreniz eski şifreniz ile aynı olamaz.");
        }else if(strlen($password) < 5 || strlen($password) > 16){
            return redirect()->back()->with('fail',"Şifre karakter uzunluğu en az 5 karakter en fazla 16 karakter olmalıdır.");
        }else{

            $user["password"] = \App\Libraries\Hash::make($password);

            if($usersModel->save($user)){
                return redirect()->back()->with('success',"Şifreniz başarılı şekilde değiştirildi.");
            }else{
                return redirect()->back()->with('fail',"Güncellenirken bir sorun oluştu.");
            }


        }




       
    }


}
