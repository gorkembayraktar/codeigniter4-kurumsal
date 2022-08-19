<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MaintenanceFrontendFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $settingService = service('setting');

        $setting = $settingService->getData();

        if(!session()->has('loggedUser')){
            if(  $setting['active'] == 0){
                return redirect()->to('/site-bakimda');
            }
        }
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }
}