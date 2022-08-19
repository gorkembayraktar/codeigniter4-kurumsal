<?php

namespace App\Controllers\Backend;
use App\Controllers\BaseController;


class Auth extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }

    public function login(){
        return view("back/login");
    }

    public function login_post(){

        
        $validation = $this->validate([
            "username" => [
                'rules' => "required",
                'errors' => [
                    'required' => 'Kullanıcı adı veya mail adresi zorunludur.'
                ]
            ],
            "password" => [
                'rules' => "required|min_length[5]|max_length[12]",
                'errors' => [
                    'required' => "Şifre alanı zorunludur.",
                    'min_length' => "Şifreniz en az 5 karakter olabilir.",
                    'max_length' => "Şifreniz en fazla 12 karakter olabilir."
                ]
            ]
        ]);

        if(!$validation){
            return view("back/login",["validation" => $this->validator]);

        }else{
            

            $username = $this->request->getPost('username');
            
            $password = $this->request->getPost('password');


            //$db = \Config\Database::connect();

            $usersModel = new \App\Models\UsersModel();

            $user_info = $usersModel->where('email',$username)->first();

            if(!$user_info){
                $user_info = $usersModel->where('username',$username)->first();
            }

            if($user_info){
                $check_password = \App\Libraries\Hash::check($password,$user_info['password']);

                if(!$check_password){
                    session()->setFlashData("fail","Kullanıcı bilgileriniz veya şifreniz hatalı.");
                    return redirect()->to('/dashboard/login')->withInput();
                }else{
                    $user_id = $user_info['id'];
                    session()->set("loggedUser",$user_id);
                    return redirect()->to('/dashboard');
                }

            }else{
                session()->setFlashData("fail","Kullanıcı bilgileriniz veya şifreniz hatalı.");
                return redirect()->to('/dashboard/login')->withInput();

            }
        }



    }


    public function logout(){
        if(session()->has('loggedUser')){
            session()->remove('loggedUser');
            return redirect()
                    ->to('/dashboard/login?access=out')
                    ->with("fail","Sistemden başarılı şekilde çıkış yaptınız.");
        }
    }


}

