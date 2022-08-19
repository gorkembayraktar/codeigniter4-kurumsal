<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;


class Media extends LoggedController
{

  
    public function photo_gallery(){
        $photoModel = new \App\Models\GalleryPhotoModel();

        $list = $photoModel->orderby("id","desc")->findAll();


        return view("back/media/photo_gallery",["title" => "Foto Galeri","list" => $list]);
    }

    public function photo_gallery_delete($id){
        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }
        
        
        $photoModel = new \App\Models\GalleryPhotoModel();

        $item = $photoModel->find($id);

        if(!$item){
            return redirect()->to("/dashboard/medya/foto-galeri")->with("fail","Resim bulunamadı.");
        }

        $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'gallery';

        if(file_exists($directory . DIRECTORY_SEPARATOR . $item['image'])){
            unlink($directory . DIRECTORY_SEPARATOR . $item['image']);
        }

        if($photoModel->delete($id)){
            return redirect()->to("/dashboard/medya/foto-galeri")->with("success","Resim silindi.");
        }else{
            return redirect()->to("/dashboard/medya/foto-galeri")->with("fail","Resim silinemedi.");
        }
       
    }

    public function photo_gallery_post(){


        $data = [];

        $data['userid'] = session()->get('loggedUser');


        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {

            $newName = $fimg->getRandomName();

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'gallery';
    
            if($fimg->move($directory, $newName)){

                $data['image'] = $newName;

                $photoModel = new \App\Models\GalleryPhotoModel();

                if($photoModel->insert($data)){
                    return redirect()->to("/dashboard/medya/foto-galeri")->with("success","Resim yüklendi.");
                }else{
                    return redirect()->to("/dashboard/medya/foto-galeri")->with("fail","Resim yüklenemedi.");
                }
        
               

            }else{
                return redirect()->to("/dashboard/medya/foto-galeri")->with("fail","Resim taşınamadı.");
            }

            

        }else{
            return redirect()->to("/dashboard/medya/foto-galeri")->with("fail","Resim seçilmedi.");
        }


       
    }


    public function video_gallery(){
        $videoModel = new \App\Models\GalleryVideoModel();

        $item = $videoModel->findAll();
       

        return view("back/media/video_gallery",["title" => "Video Galeri","videos" => $item]);
    }

    public function video_gallery_add(){
        $videoModel = new \App\Models\GalleryVideoModel();

        $item = $videoModel->findAll();
       

        return view("back/media/video_gallery_add",["title" => "Video Galeri","videos" => $item]);
    }
    

    public function video_gallery_add_post(){
        $videoModel = new \App\Models\GalleryVideoModel();

        $data = [];

        $data['userid'] = session()->get('loggedUser');
        $data['title'] = $this->request->getPost('title');
        $data['iframe'] = $this->request->getPost('iframe');

        if($videoModel->save($data)){
            return redirect()->to("/dashboard/medya/video-galeri")->with("success","Kayıt oluşturuldu.");
        }else{
            return redirect()->to("/dashboard/medya/video-galeri")->with("fail","Kayıt oluşturulamadı");
        }

        

        
    }

    public function video_gallery_delete($id){
        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }
        

        $videoModel = new \App\Models\GalleryVideoModel();


        if($videoModel->delete($id)){
            return redirect()->to("/dashboard/medya/video-galeri")->with("success","Kayıt silindi.");
        }else{
            return redirect()->to("/dashboard/medya/video-galeri")->with("fail","Kayıt silinemedi.");
        }

        
    }
    
    public function video_gallery_edit($id){
        $videoModel = new \App\Models\GalleryVideoModel();

        $video = $videoModel->find($id);

        if(!$video){
            return redirect()->to("/dashboard/medya/video-galeri")->with("fail","Kayıt bulunamadı.");
        }

        return view("back/media/video_gallery_edit",["title" => "Video Galeri","video" => $video]);

        
    }

    public function video_gallery_edit_post($id){
        $videoModel = new \App\Models\GalleryVideoModel();

        $video = $videoModel->find($id);

        if(!$video){
            return redirect()->to("/dashboard/medya/video-galeri")->with("fail","Kayıt bulunamadı.");
        }

        $video['title'] = $this->request->getPost('title');
        $video['iframe'] = $this->request->getPost('iframe');


        if($videoModel->save($video)){
            return redirect()->to("/dashboard/medya/video-galeri")->with("success","Güncelleme başarılı.");
        }else{
            return redirect()->to("/dashboard/medya/video-galeri")->with("fail","Güncellenemedi");
        }


        
    }



}
