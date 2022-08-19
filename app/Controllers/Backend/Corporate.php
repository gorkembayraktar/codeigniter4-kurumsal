<?php

namespace App\Controllers\Backend;
use App\Controllers\LoggedController;

use CodeIgniter\API\ResponseTrait;

class Corporate extends LoggedController
{

    use ResponseTrait;

    public function __construct(){
        parent::__construct();

        helper(['form']);

    }
  
    public function customer_comments(){
        $commentsModel = new \App\Models\CommentsModel();
        $comments = $commentsModel->orderby("sira","asc")->findAll();
        return view("back/general/customer_comments",["title" => "Müşteri Yorumları","comments" => $comments]);
    }
    public function customer_comments_add(){
       

        return view("back/general/customer_comments_add",["title" => "Müşteri Yorumu Ekle"]);
    }
    public function customer_comments_add_post(){
        $data = [];
        $data["name"] = $this->request->getPost('name');
        $data['subname'] = $this->request->getPost('unvan');

        $data['star'] = $this->request->getPost('star');

        $data['comment'] = $this->request->getPost('comment');

        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {

            $newName = $fimg->getRandomName();

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'customer';
    
            $fimg->move($directory, $newName);

            $data['image'] = $newName;

        }


        $commentsModel = new \App\Models\CommentsModel();


        if($commentsModel->insert($data)){
            return redirect()->to("/dashboard/kurumsal/musteri-yorumlari")->with("success","Müşteri yorumunuz kaydedildi..");
        }else{
            return redirect()->back()->with("fail","Kaydedilemedi.");
        }
    }
    public function customer_comments_edit($id){
        $commentsModel = new \App\Models\CommentsModel();
        $comment = $commentsModel->find($id);

        if(!$comment){
            return redirect()->back()->with("fail","Müşteri yorumu bulunamadı.");
        }



        return view("back/general/customer_comments_edit",["title" => "Müşteri Yorumu Düzenle","comment" => $comment]);
    }

    public function customer_comments_edit_post($id){

        $commentsModel = new \App\Models\CommentsModel();

        $data = $commentsModel->find($id);

        if(!$data){
            return redirect()->back()->with("fail","Bir sorun oluştu.");
        }

        $data["name"] = $this->request->getPost('name');
        $data['subname'] = $this->request->getPost('unvan');

        $data['star'] = $this->request->getPost('star');

        $data['comment'] = $this->request->getPost('comment');

        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {

            $newName = $fimg->getRandomName();

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'customer';
    
            $fimg->move($directory, $newName);

            // önceki resmi temizle

            if(!empty($data['image']) && file_exists($directory . DIRECTORY_SEPARATOR . $data['image'])){
                unlink($directory . DIRECTORY_SEPARATOR . $data['image']);
            }


            $data['image'] = $newName;

        }

        if($commentsModel->save($data)){
            return redirect()->to("/dashboard/kurumsal/musteri-yorumlari")->with("success","Müşteri yorumunuz güncellendi.");
        }else{
            return redirect()->back()->with("fail","Güncellenirken bir sorun oluştu.");
        }


    }
    public function customer_comments_delete($id){

        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }

        $commentsModel = new \App\Models\CommentsModel();

        $data = $commentsModel->find($id);

        if(!$data){
            return redirect()->back()->with("fail","Bir sorun oluştu.");
        }


        if($commentsModel->delete($data)){

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'customer';

            if(!empty($data['image']) && file_exists($directory.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($directory.DIRECTORY_SEPARATOR.$data['image']);
            }

            return redirect()->to("/dashboard/kurumsal/musteri-yorumlari")->with("success","Müşteri yorumu silindi.");


        }else{
            return redirect()->back()->with("fail","Bir sorun oluştu.");
        }



        
    }

    public function customer_comments_toggle(){
        $status = $_GET['status'];
        $id = $_GET['id'];

        if(!is_numeric($id)){
            return $this->respond(["error" => "İd parametresi gereklidir."]);
        }

        $commentsModel = new \App\Models\CommentsModel();


        if($commentsModel->update($id,["active" => $status == 'true'])){
            return $this->respond(["success" => "Müşteri yorumu güncellendi."]);
        }else{
            return $this->respond(["error" => "Güncellenemedi."]);
        }


    }
    public function customer_comments_siralama(){

        $data = $_GET['comment'];
        $commentsModel = new \App\Models\CommentsModel();

        foreach($data as $key => $id){

            $commentsModel->update($id,["sira" => $key + 1]);

        }
        return $this->respond(["success" => "Güncellendi."]);
    }
    public function slider(){

        $sliderModel = new \App\Models\SlidersModel();

        $list = $sliderModel->orderby("sira","asc")->findAll();

        foreach($list as &$item){

            $find = strpos($item['content'],'.');

            if($find !== -1){
                $item["context"]["first"] = substr($item['content'],0,$find);
                $item["context"]["after"] = substr($item['content'],$find + 1,strlen($item['content']));
            }

            $item["context"]["devami"] = $find !== FALSE;
  
        }

    


        return view("back/general/slider",["title" => "Slider Ayarları","list" => $list]);
    }
    public function slider_ekle(){
        return view("back/general/slider_add",["title" => "Yeni Slider Ekle"]);
    }
    public function slider_ekle_post(){

        $data = [];
        
        $data['title'] = $this->request->getPost('title');
        
        $data['subtitle'] = $this->request->getPost('subtitle');
        
        $data['content'] = $this->request->getPost('content');
        $data['buttonName'] = $this->request->getPost('buttonName');
        $data['buttonRedirect'] = $this->request->getPost('buttonRedirect');

        $data['user_id'] = session()->get('loggedUser');

        if(empty($data['title'])){
            return redirect()->back()->with("fail","Başlık alanı zorunludur.");
        }


        $fimg = $this->request->getFile('slider');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {

            $newName = $fimg->getRandomName();

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'slider';
    
            $fimg->move($directory, $newName);

            $data['image'] = $newName;

        }



        $sliderModel = new \App\Models\SlidersModel();


        if($sliderModel->insert($data)){
            return redirect()->to("/dashboard/kurumsal/slider")->with("success","Başarılı şekilde eklendi");
        }else{
           return redirect()->back()->with("fail","Bir sorun oluştu.");
        }




    }
    public function slider_duzenle($id){
        if(empty($id)){
            return redirect()->back();
        }

        $sliderModel = new \App\Models\SlidersModel();

        $slider = $sliderModel->find($id);

        if(!$slider){
            return redirect()->to("/dashboard/kurumsal/slider")->with("fail","Böyle bir slider bulunamadı.");
        }


        return view("back/general/slider_edit",["title" => "Slider Bilgilerini Düzenle","slider" => $slider]);

    
    }

    public function slider_duzenle_post($id){

        if(empty($id)){
            return redirect()->back();
        }

        $sliderModel = new \App\Models\SlidersModel();

        $slider = $sliderModel->find($id);

        if(!$slider){
            return redirect()->to("/dashboard/kurumsal/slider")->with("fail","Böyle bir slider bulunamadı.");
        }

        $slider['title'] = $this->request->getPost('title');
        $slider['subtitle'] = $this->request->getPost('subtitle');
        $slider['content'] = $this->request->getPost('content');
        $slider['buttonName'] = $this->request->getPost('buttonName');
        $slider['buttonRedirect'] = $this->request->getPost('buttonRedirect');



        $fimg = $this->request->getFile('slider');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {

            $newName = $fimg->getRandomName();

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'slider';
    
            $fimg->move($directory, $newName);


            if(file_exists($directory.DIRECTORY_SEPARATOR.$slider['image'])){
                unlink($directory.DIRECTORY_SEPARATOR.$slider['image']);
            }


            $slider['image'] = $newName;

        }



        if($sliderModel->save($slider)){
            return redirect()->to("/dashboard/kurumsal/slider")->with("success","Slider bilgileri güncellendi");
        }else{
            return redirect()->back()->with("fail","Bilgiler güncellenirken bir sorunla karşılaşıldı.");
        }

    }
    public function slider_delete($id){
        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }

        $sliderModel = new \App\Models\SlidersModel();

        $slider = $sliderModel->find($id);

        if(!$slider){
            return redirect()->to("/dashboard/kurumsal/slider")->with("fail","Böyle bir slider bulunamadı.");
        }


       

        $sliderImage = $slider['image'];


        if($sliderModel->delete($slider)){

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'slider';

            if(!empty($sliderImage) && file_exists($directory.DIRECTORY_SEPARATOR.$sliderImage)){
                unlink($directory.DIRECTORY_SEPARATOR.$sliderImage);
            }

            return redirect()->to("/dashboard/kurumsal/slider")->with("success","Slider silindi.");
        }else{
            return redirect()->back()->with("fail","Bilgiler silinirken bir sorunla karşılaşıldı.");
        }
    

    }
    public function slider_siralama(){

        $data = $_GET['slider'];
        $sliderModel = new \App\Models\SlidersModel();

        foreach($data as $key => $id){

            $sliderModel->update($id,["sira" => $key + 1]);

        }
        return $this->respond(["success" => "Güncellendi."]);
    }
    public function slider_toggle(){
        $status = $_GET['status'];
        $id = $_GET['id'];

        if(!is_numeric($id)){
            return $this->respond(["error" => "İd parametresi gereklidir."]);
        }

        $sliderModel = new \App\Models\SlidersModel();


        if($sliderModel->update($id,["active" => $status == 'true'])){
            return $this->respond(["success" => "Slider bilgisi güncellendi."]);
        }else{
            return $this->respond(["error" => "Güncellenemedi."]);
        }


    }
    public function about(){
        return view("back/general/about",["title" => "Hakkında Ayarlar"]);
    }
    public function team(){
        $model = new \App\Models\TeamModel();
        $teams = $model->findAll();

        return view("back/general/team",["title" => "Ekibimiz Ayarlar","teams" => $teams]);
    }
    public function team_add(){

        return view("back/general/team_add",["title" => "Yeni Üye Ekle"]);
    }
    public function team_add_post(){

        $data = [];
        $data["social"] = $this->request->getPost("social");
        $data["fullname"] = $this->request->getPost("fullname");
        $data["degree"] = $this->request->getPost("degree");


        $newList = [];
        if(!empty($data['social'])){

            foreach($data['social'] as $key =>  $socials){
                if(count($socials) > 0){
                    foreach($socials as $social){
                        if(!empty($social)){
                            $newList[$key][] = $social;
                        }
                    }
                }
            }

        }

        $data["socials"] = json_encode($newList);

        if(empty($data["fullname"])){

            return redirect()->back()
            ->with("fail","Adı boş olamaz");

        }else if(empty($data["degree"])){

            return redirect()->back()
            ->with("fail","Ünvanı boş olamaz");

        }

        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {

            $newName = $fimg->getRandomName();

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'teams';
    
            $fimg->move($directory, $newName);

            $data['image'] = $newName;

        }

        

        $TeamModel = new \App\Models\TeamModel();

        if($TeamModel->save($data)){
            session()->setFlashData("success","Başarılı.");
            return redirect()->to("/dashboard/kurumsal/ekibimiz")->withInput();
        }else{
            return view("back/general/team_add",["title" => "Yeni Üye Ekle"])
            ->with("fail","Bir hata oluştu.");
        }

        return view("back/general/team_add",["title" => "Yeni Üye Ekle"]);
    }

    public function team_edit($id){
        $teamModel = new \App\Models\TeamModel();

        $data = $teamModel->find($id);

        if(!$data){
            return redirect()->back();
        }



        return view("back/general/team_edit",["title" => "Bilgileri Düzenle","team" => $data]);

    }
    public function team_edit_post($id){
        $teamModel = new \App\Models\TeamModel();

        $data = $teamModel->find($id);

        if(!$data){
            return redirect()->back()->with("fail","Bir sorun oluştu.");
        }
        $s = $this->request->getPost("social");
        $data["fullname"] = $this->request->getPost('fullname');
        $data['degree'] = $this->request->getPost('degree');


        $newList = [];
        if(!empty($s)){

            foreach($s  as $key =>  $socials){
                if(count($socials) > 0){
                    foreach($socials as $social){
                        if(!empty($social)){
                            $newList[$key][] = $social;
                        }
                    }
                }
            }

        }

        $data["socials"] = json_encode($newList);



        $fimg = $this->request->getFile('image');

        if ($fimg->isValid() && ! $fimg->hasMoved()) {

            $newName = $fimg->getRandomName();

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'teams';
    
            $fimg->move($directory, $newName);

            // önceki resmi temizle

            if(!empty($data['image']) && file_exists($directory . DIRECTORY_SEPARATOR . $data['image'])){
                unlink($directory . DIRECTORY_SEPARATOR . $data['image']);
            }


            $data['image'] = $newName;

        }

        if($teamModel->save($data)){
            return redirect()->to("/dashboard/kurumsal/ekibimiz")->with("success","Güncellendi.");
        }else{
            return redirect()->back()->with("fail","Güncellenirken bir sorun oluştu.");
        }

    }

    public function team_delete($id){
        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }

        $teamModel = new \App\Models\TeamModel();

        $data = $teamModel->find($id);

        if(!$data){
            return redirect()->back()->with("fail","Bir sorun oluştu.");
        }


        if($teamModel->delete($data)){

            $directory = FCPATH . 'public'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'teams';

            if(!empty($data['image']) && file_exists($directory.DIRECTORY_SEPARATOR.$data['image'])){
                unlink($directory.DIRECTORY_SEPARATOR.$data['image']);
            }

            return redirect()->to("/dashboard/kurumsal/ekibimiz")->with("success","Başarılı şekilde silindi.");


        }else{
            return redirect()->back()->with("fail","Bir sorun oluştu.");
        }

        
    }
    public function faq(){

        $faqModel = new \App\Models\FaqModel();

        $list = $faqModel->findAll();

        return view("back/general/faq",["title" => "Sıkça Sorunlan Sorular","list" => $list]);


    }

    public function faq_add(){

        $faqModel = new \App\Models\FaqModel();

        $list = $faqModel->findAll();

        return view("back/general/faq_add",["title" => "Sıkça Sorunlan Sorular","list" => $list]);


    }

    public function faq_edit($id){

        $faqModel = new \App\Models\FaqModel();

        $faq = $faqModel->find($id);

        return view("back/general/faq_edit",["title" => "Sıkça Sorunlan Sorular","faq" => $faq]);


    }

    public function faq_edit_post($id){

        $faqModel = new \App\Models\FaqModel();

        $faq = $faqModel->find($id);

        
        $faq['title'] = $this->request->getPost('soru');
        $faq['content'] = $this->request->getPost('cevap');


        if($faqModel->save($faq)){
            return redirect()->to("/dashboard/kurumsal/sikca-sorulanlar")->with("success","Güncellendi.");
        }else{
            return redirect()->to("/dashboard/kurumsal/sikca-sorulanlar")->with("fail","Hata oluştu.");
        }

    }

    public function faq_delete($id){

        $user = service('user');
        if($user['demo']){
            return redirect()->back()->with("fail","Bu işlem demo modunda kısıtlanmıştır.");
        }
        
        
        $faqModel = new \App\Models\FaqModel();

        

        if($faqModel->delete($id)){
            return redirect()->to("/dashboard/kurumsal/sikca-sorulanlar")->with("success","Başarılı şekilde silindi.");
        }else{
            return redirect()->to("/dashboard/kurumsal/sikca-sorulanlar")->with("fail","Hata oluştu.");
        }

    }

    public function faq_add_post(){

        $faqModel = new \App\Models\FaqModel();


        $data = [];

        $data['title'] = $this->request->getPost('soru');
        $data['content'] = $this->request->getPost('cevap');

        if($faqModel->insert($data)){
            return redirect()->to("/dashboard/kurumsal/sikca-sorulanlar")->with("success","Başarılı şekilde eklendi.");
        }else{
            return redirect()->to("/dashboard/kurumsal/sikca-sorulanlar")->with("fail","Bir sorun oluştu.");
        }

        

        


    }



}
