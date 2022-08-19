<?php

namespace App\Controllers;
use App\Controllers\BaseController;


class FrontendController extends BaseController
{

    public function __construct(){

        $settingService = service('setting');

        $view = \Config\Services::renderer();
        $view->setData([
            "setting" =>  $settingService->getData(),
            "menus" => $settingService->getMenus(),
            "fistServices" => $settingService->getServices()
        ]);

    }

}
