<?php

namespace App\Controllers\Frontend;

use App\Controllers\FrontendController;
use CodeIgniter\Database\RawSql;


class Home extends FrontendController
{

    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $homeModel = new \App\Models\HomeSettingModel();


        $pushFields = [];

        $home = $homeModel->where("active",1)->orderBy("sira","asc")->findAll();

        foreach($home as $key => $k){
            switch($k['section']){
                case 'Slider':
                    $sliderModel = new \App\Models\SlidersModel();
                    $pushFields['slider']['data'] = $sliderModel->where('active',1)->orderBy('sira','asc')->findAll();
                    $pushFields['slider']['features'] = $k;
                    $pushFields['slider']['widget'] = 'main_slider';
                break;
                case 'Hizmetlerimiz':
                    $serviceModel = new \App\Models\ServicesModel();
                    $pushFields['services']['data'] = $serviceModel->where('publish',1)->orderBy('created_at','desc')->findAll();
                    $pushFields['services']['features'] = $k;
                    $pushFields['services']['widget'] = 'service_section';
                break;
                case 'Aktiviteler':
                    $pushFields['activities']['features'] = $k;
                    $pushFields['activities']['widget'] = 'activities_section';
                break;
                case 'Etkinliklerimiz':
                    $eventModel = new \App\Models\EventsModel();
                    $pushFields['events']['data'] = $eventModel->where('publish',1)->orderBy('created_at','desc')->limit(4)->get()->getResult('array');
                    $pushFields['events']['features'] = $k;
                    $pushFields['events']['widget'] = 'event_section';
                break;

                case 'Ekibimiz':
                    $teamModel = new \App\Models\TeamModel();
                    $pushFields['team']['data'] =$teamModel->limit(3)->get()->getResult('array');
                    $pushFields['team']['features'] = $k;
                    $pushFields['team']['widget'] = 'ourteachers_section';
                break;

                case 'Müşteri Yorumları & Sıkça Sorulanlar':
                    $commentsModel = new \App\Models\CommentsModel();
                    $pushFields['comments']['data'] = $commentsModel->where("active",1)->orderBy("sira","asc")->limit(3)->get()->getResult('array');
                    $pushFields['comments']['features'] = $k;
                    $pushFields['comments']['widget'] = 'faq_section';
                    
                    $faqModel = new \App\Models\FaqModel();
                    $pushFields['faq']['data'] = $faqModel->orderBy('created_at','desc')->limit(3)->get()->getResult('array');
                    $pushFields['faq']['features'] = $k;

                break;

                case 'Foto Galeri':
                    $photoGalleryModel = new \App\Models\GalleryPhotoModel();
                    $pushFields['photos']['data'] = $photoGalleryModel->orderBy('created_at','desc')->limit(8)->get()->getResult('array');
                    $pushFields['photos']['features'] = $k;
                    $pushFields['photos']['widget'] = 'gallery_section';
                break;

                case 'Blog':
                    $blogModel = new \App\Models\BlogModel();
                    $pushFields['blog']['data'] = $blogModel->where('publish',1)->orderBy('created_at','desc')->limit(3)->get()->getResult('array');
                    $pushFields['blog']['features'] = $k;
                    $pushFields['blog']['widget'] = 'news_section';
                break;

                default:
                    $pushFields['Custom_'.$key]['features'] = $k;
                    $pushFields['Custom_'.$key]['widget'] = 'about_section';
                break;

            }
        }

        $siralama = [];
        foreach($pushFields as $key => $item){
           if(isset($item['widget']))
            $siralama[] = [
                "widget" => $item['widget'],
                "features" => $item['features']
            ];
        }

        $pushFields['siralama'] = $siralama;
    
        return view('front/home',$pushFields);
    }

    public function hakkimizda(){

        return view('front/about',
        ["title" => "Hakkımızda","image" => "public/images/background/page-title.jpg"]);
    }

    public function ekibimiz(){
        $model = new \App\Models\TeamModel();
        $team =$model->limit(3)->get()->getResult('array');

        return view('front/team',["title" => "Ekibimiz","image" => "public/images/background/page-title.jpg","team"=>$team]);
    }

    public function faq(){

        $faq = new \App\Models\FaqModel();
        $comments = $faq->orderBy("created_at","desc")->get()->getResult('array');

        return view('front/faq',["title" => "Sıkça Sorunlanlar","image" => "public/images/background/page-title.jpg","comments"=>$comments]);
    }  
    
    public function foto_galeri(){
        $model = new \App\Models\GalleryPhotoModel();

        $list = $model->orderBy("created_at","desc")->findAll();
        return view('front/photo_gallery',["title" => "Foto Galeri","image" => "public/images/background/page-title.jpg","photos" => $list]);
    }

    public function video_galeri(){
        $model = new \App\Models\GalleryVideoModel();

        $list = $model->findAll();

        return view('front/video_gallery',["title" => "Video Galeri","image" => "public/images/background/page-title.jpg","videos" => $list]);
    }

    public function iletisim(){
        return view('front/iletisim',["title" => "İletişim","image" => "public/images/background/page-title.jpg"]);
    }

    public function iletisim_post(){

        $contactsModel = new \App\Models\ContactsModel();

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $rawSql = new RawSql("created_at > date_sub(now(), interval 10 minute)");

        $s = $contactsModel->select("created_at")->where("ip_adress",$ip)->where($rawSql)->limit(1)->get()->getResult('array');

        if(count($s) > 0){
            session()->setFlashData("fail","10 dakika içerisinde 1 kez gönderebilirsiniz.");
            return view('front/iletisim',["title" => "İletişim","image" => "public/images/background/page-title.jpg"]);
        }

        $tarih = $this->request->getPost('tarih');



        $isim = $this->request->getPost('isim');
        $to = $this->request->getPost('mail');
        $subject = $this->request->getPost('konu');
        $message = $this->request->getPost('mesaj');

        $now = date('d-m-Y H:i');

        $emailsModel = new \App\Models\EmailsModel();
        $email = $emailsModel->find(1);
        
        $config = [
            "host"=>$email['host'],
            "port" => $email['port'],
            "email" =>$email['email'] ,
            "password"=> $email['password'],
            "secure" => $email['secure']
        ];

        $library = new \App\Libraries\SendMail($config);

        $agent = $_SERVER["HTTP_USER_AGENT"];

       
        

        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

        $city = property_exists($details,'city') ? $details->city : '';
        $library->setFrom($email['email'],"İletişim Formu");
        $library->addAddress($to,$isim);
        $isSend = $library->send($subject,"

            Mail gönderen : $to,
            isim : $isim,

            konu : $subject,
            mesaj : $message

            Tarih : $now,
            Sayfa Güncelleme tarih : $tarih,
            Aygıt Model: $agent,
            IP adresi : $ip,
            Şehir : $city


        ");



       

        $status = $contactsModel->save([
            "name" => $isim,
            "mail" => $to,
            "subject" => $subject,
            "message" => $message,
            "ip_adress" => $ip,
            "ip_info_json" => json_encode($details),
            "device_info" => $agent,
            "isMailSend" => $isSend,
            "sendMailAdress" => $email['email'],
            "page_created_at" => date('Y-m-d H:i:s',strtotime($tarih)),
        ]);

        return view('front/iletisim',["title" => "İletişim","image" => "public/images/background/page-title.jpg","status" => $status]);
    }

    public function bakimda(){
        $settingService = service('setting');
        $setting =  $settingService->getData();

        if($setting['active']){
            return redirect()->to("/");
        }
        return view("bakim");
    }
   





}
