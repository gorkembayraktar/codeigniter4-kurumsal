<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;

use CodeIgniter\API\ResponseTrait;

class Dashboard extends LoggedController
{

    use ResponseTrait;

    public function index(){

       // $param1 = $this->request->uri->getSegment(2);
       // $param2 = $this->request->uri->getSegment(3);

       $model = new \App\Models\HomeSettingModel();
       $data = $model->orderBy("sira","asc")->findAll();

       $menuModel = new \App\Models\MenuModel();

       $menus = $menuModel->where('parent',0)->orderBy("sira","asc")->findAll();

       foreach($menus as &$menu){
            $menu['children'] = $menuModel->where("parent",$menu['id'])->orderBy("sira","asc")->findAll();
       }
       
       return view("back/dashboard",["title" => "Yönetim paneli","list" => $data,"menus" => $menus]);
    }

    public function new_section_post(){
        $model = new \App\Models\HomeSettingModel();

        $data["title"] = $this->request->getPost("title");
        $data["section"] = $this->request->getPost("section");


        if($model->where("section",$data['section'])->find()){
            return redirect()->back()->with("fail","Bu alan adı özeldir kullanılamaz.");
        }

        $data["info"] = $this->request->getPost("subtitle");
        $data["content"] = $this->request->getPost("content");

        $data['sira'] = 1000;


        $imageField = ['image_1','image_2'];

        $props = ['images' => []];
        foreach($imageField as $field){
            
            $fimg = $this->request->getFile($field);

            if ($fimg->isValid() && ! $fimg->hasMoved()) {
    
                $newName = $fimg->getRandomName();
    
                $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'sections';
        
                $fimg->move($directory, $newName);
    
                $props['images'][] = $newName;
    
            }

        }
        $btnRedirect = $this->request->getPost("buttonRedirect");
        $btnName = $this->request->getPost("buttonName");
        if(!empty($btnName)){
            $props['button']['name'] = $btnName;
        }
        if(!empty($btnRedirect)){
            $props['button']['redirect'] = $btnRedirect;
        }

        $data['props'] = json_encode($props);

        if($model->save($data)){
            return redirect()->back()->with('success','Alan oluşturuldu.');
        }else{
            return redirect()->back()->with('fail','Alan oluşturulamadı.');
        }

    }

    public function section_delete($id){
        $model = new \App\Models\HomeSettingModel();

        $data = $model->where("id",$id)->limit(1)->get()->getRowArray();

        if($data){

            if($data['fixed'] == "1"){
                return $this->respond(["error" => "Bu işlemi yapma yetkiniz yok."],400);
            }


            if($model->where("id",$data['id'])->delete()){

                $props = $data['props'];
                if(!empty($props)){
                    $json = json_encode($props,true);
    
                    if($json && isset($json['images'])){
                        $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'sections';
                        foreach($json['images'] as $image){
                            if(file_exists($directory . DIRECTORY_SEPARATOR . $image)){
                                unlink($directory . DIRECTORY_SEPARATOR . $image);
                            }
                        }
                    }
    
                }

                return $this->respond(["success" => "Başarılı şekilde silindi."]);

            }else{
                    return $this->respond(["error" => "Bir hata meydana geldi."],400);
            }


           
        }else{
            return $this->respond(["error" => "Belirtilen section bulunamadı."],400);
        }
    }
    public function section_toggle(){

        $id = $this->request->getPost('id');
        $status = $this->request->getPost('status');

        $model = new \App\Models\HomeSettingModel();


        if($data = $model->find($id)){

            $data["active"] = $status == "true";
            if($model->save($data)){
                return $this->respond(["success" => "Güncellendi."]);
            }else{
                return $this->respond(["error" => "Bir sorun oluştu."],400);
            }

        }else{
            return $this->respond(["error" => "Bulunamadı"],400);
        }



    }
    public function section_order(){

        $data = $this->request->getPost('siralama');

        if($data){
            $model = new \App\Models\HomeSettingModel();

            foreach($data as $key => $id){
                $model->update($id,["sira" => $key + 1]);
            }

            return $this->respond(["success" => "Güncellendi"]);

        }


        return $this->respond(["error" => "İşlem başarısız"],400);
    }

    public function section_info($id){
        $model = new \App\Models\HomeSettingModel();

        $data = $model->find($id);

        if($data){

            /*if($data['fixed'] == 1){
                return $this->respond(["error" => "Bu işlemi yapma yetkiniz yok."],400);
            }*/

            if($data['props']){
                $data['props'] = json_decode($data['props']);
            }

            return $this->respond(["data" => $data]);
           
        }else{
            return $this->respond(["error" => "Belirtilen section bulunamadı."],400);
        }
    }

    public function section_update(){
        
        $model = new \App\Models\HomeSettingModel();

        $id = $this->request->getPost("customid");

        $data = $model->find($id);


        if(!$data){
            return redirect()->back();
        }
        


        $data["title"] = $this->request->getPost("title");
        $data["info"] = $this->request->getPost("subtitle");
        $data["content"] = $this->request->getPost("content");

        $imageField = ['image_1','image_2'];

        $props = ['images' =>array()];

        if( ! $data['fixed'] ){
            $props['images'] = !$data['props'] ? [] : json_decode($data['props'],true)['images'];
        }


        if($data['fixed']){
            foreach($props['images'] as $image){
                if(!empty($image) && file_exists($directory.DIRECTORY_SEPARATOR.$image)){
                    unlink($directory.DIRECTORY_SEPARATOR.$image);
                }
            }
        }

        foreach($imageField as $field){
            
            $fimg = $this->request->getFile($field);

            if ($fimg && $fimg->isValid() && ! $fimg->hasMoved()) {
    
                $newName = $fimg->getRandomName();
    
                $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'sections';
        
                $fimg->move($directory, $newName);
    
                $props['images'][] = $newName;


               
    
            }

        }
        $btnRedirect = $this->request->getPost("buttonRedirect");
        $btnName = $this->request->getPost("buttonName");
        if(!empty($btnName)){
            $props['button']['name'] = $btnName;
        }
        if(!empty($btnRedirect)){
            $props['button']['redirect'] = $btnRedirect;
        }

        $field = $this->request->getPost("field");

      
        if($field){
            $x = array_keys($field);
            $output = [];
           
            for($i = 0; $i < count($field[$x[0]]);$i++){
                $set = [];
                foreach($x as $key){
                    $set[$key] = $field[$key][$i];
                }
                $output[] = $set;
            }

            $props['clases'] = $output;
            
        }

        $data['props'] = json_encode($props);

        if($model->save($data)){
            return redirect()->back()->with('success','Alan güncellendi');
        }else{
            return redirect()->back()->with('fail','Bir sorun oluştu.');
        }
    }

    public function menu_order(){
        $data = $this->request->getPost('siralama');

        $model = new \App\Models\MenuModel();

        foreach($data as $key => $item){
            $model->update($item['id'],["sira" => $key + 1,"parent" => 0]);

            if($item['children']){
                foreach($item['children'] as $k => $id){
                    $model->update($id,["sira" => $k + 1,"parent" => $item['id']]);
                }
            }

        }

        return $this->respond(["success" => "Güncellendi"]);

    }
}
