<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthCheckFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->has('loggedUser')){
            return redirect()->to('/dashboard/login')->with('fail',"Bu alanı görüntülemek için giriş yapmalısınız.");
        }

        $user = service('user');

        if($user['demo']){
                if($request->getMethod() == 'post'){
                    return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
                }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
      
    }
}