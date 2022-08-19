<?php

namespace App\Libraries;




class Setting{
    
    protected $data;
    protected $menus;

    protected $services;

    public function __construct(){
        $settingsModel = new \App\Models\SettingsModel();

        $this->data = $settingsModel->find(1);
    }

    public function getData(){
        return $this->data;
    }
    public function getMenus(){
        if($this->menus) return $this->menus;

        $menuModel = new \App\Models\MenuModel();

        $menus = $menuModel->where('parent',0)->orderBy("sira","asc")->findAll();
 
        foreach($menus as &$menu){
             $menu['children'] = $menuModel->where("parent",$menu['id'])->orderBy("sira","asc")->findAll();
        }
     
        $m = [];

        foreach($menus as $x){
            $s = [];

            $s['to']   = $x['type'] == 0 ? $x['link'] :  $this->_menuTo($x['name']);
            $s['name'] = $x['displayname'] ?? $x['name'];
            
            $s['children'] = $this->_setMenu($x['name']);

            foreach($x['children'] as $children){

                $f = $this->_setMenu($children['name']);
                if($f){
                    $s['children'][] = $f;
                }

                $s['children'][] = [
                    "to" => $children['type'] == 0 ? $children['link'] : $this->_menuTo($children['name']),
                    "name" => $children['displayname'] ?? $children['name']
                ];
            }
   
            $m[] = $s;
        }

        $this->menus = $m;
        return $this->menus;
    }


    public function getServices(){
        // info : initiliaze it in the _setMenu function
        return $this->services;
    }
    

    private function _menuTo($menu){
        $to = '';
        switch($menu){
            case 'Anasayfa':
               $to = '/';
            break;
            case 'Kurumsal':
                $to = '/';
            break;
            case 'Hizmetler':
                $to = '/hizmetlerimiz';
            break;
            case 'Etkinlikler':
                $to = '/etkinliklerimiz';
            break;
            case 'Multi Medya':
                $to = '';
            break;
            case 'Sıkça Sorulanlar':
                $to = '/sikca-sorulanlar';
            break;
            case 'Video Galeri':
                $to = '/video-galeri';
            break;
            case 'Foto Galeri':
                $to = '/foto-galeri';
            break;
            case 'Blog':
                $to = '/blog';
            break;
            case 'Ekibimiz':
                $to = '/ekibimiz';
            break;
            case 'Hakkımızda':
                $to = '/hakkimizda';
            break;
            case 'İletişim':
                $to = '/iletisim';
            break;
        }
        return $to;
    }

    private function _setMenu($menu){
        switch($menu){
            case 'Hizmetler':
                $ServicesModel = new \App\Models\ServicesModel();
                $data = $ServicesModel->where("publish",1)->orderBy("created_at","desc")->limit(5)->get()->getResult('array');
                
                $this->services = $data;

                $yeni = array();
                foreach($data as $item){
                    $yeni[] = [
                        "to" => "/hizmetlerimiz/".$item['slug'] ,
                        "name" => $item['title'] 
                    ];
                }
                $yeni[] = [
                    "to" => "/hizmetlerimiz",
                    "name" => "Tümünü Görüntüle"
                ];
                return $yeni;
            break;
            case 'Etkinlikler':
                $EventsModel = new \App\Models\EventsModel();
                $data = $EventsModel->where("publish",1)->orderBy("created_at","desc")->limit(5)->get()->getResult('array');
                $yeni = array();
                foreach($data as $item){
                    $yeni[] = [
                        "to" => "/etkinliklerimiz/".$item['slug'] ,
                        "name" => $item['title'] 
                    ];
                }
                $yeni[] = [
                    "to" => "/etkinliklerimiz",
                    "name" => "Tümünü Görüntüle"
                ];
                return $yeni;
                
            break;
        }

        return null;
    }
    
}