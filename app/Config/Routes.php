<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/*
$routes->get('/', 'Home::index',['namespace' => 'App\Controllers\Frontend']);


$routes->get('/hakkimizda', 'Frontend\Home::hakkimizda');
$routes->get('/ekibimiz', 'Frontend\Home::ekibimiz');
$routes->get('/sikca-sorulanlar', 'Frontend\Home::faq');


$routes->get('/foto-galeri', 'Frontend\Home::foto_galeri');

$routes->get('/video-galeri', 'Frontend\Home::video_galeri');

$routes->get('/iletisim', 'Frontend\Home::iletisim');

$routes->get('/blog', 'Frontend\Home::blog');
$routes->get('/blog/([^/]+)/?', 'Frontend\Home::blog_one/$1');

$routes->get('/hizmetlerimiz', 'Frontend\Home::services');

$routes->get('/hizmetlerimiz/([^/]+)/?', 'Frontend\Home::services_one/$1');

$routes->get('/etkinliklerimiz', 'Frontend\Home::events');

$routes->get('/etkinliklerimiz/([^/]+)/?', 'Frontend\Home::events_one/$1');
*/


$routes->get("/site-bakimda","Frontend\Home::bakimda");

$routes->group('', ["namespace" => "App\Controllers\Frontend","filter" => 'MaintenanceFrontend'],static function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('hakkimizda', 'Home::hakkimizda');
    $routes->get('ekibimiz', 'Home::ekibimiz');
    $routes->get('sikca-sorulanlar', 'Home::faq');
    $routes->get('foto-galeri', 'Home::foto_galeri');

    $routes->get('video-galeri', 'Home::video_galeri');

    $routes->get('iletisim', 'Home::iletisim');
    $routes->post('iletisim', 'Home::iletisim_post');

    $routes->get('blog', 'Blog::blog');
    $routes->get('blog/([^/]+)/?', 'Blog::blog_one/$1');

    $routes->get('hizmetlerimiz', 'Services::services');

    $routes->get('hizmetlerimiz/([^/]+)/?', 'Services::services_one/$1');

    $routes->get('etkinliklerimiz', 'Events::events');

    $routes->get('etkinliklerimiz/([^/]+)/?', 'Events::events_one/$1');
});


/** ADMIN DASHBOARD BACKEND ROUTES */

$routes->addRedirect("(admin|login|giris)",'dashboard/login');

$routes->get('dashboard/login', 'Backend\Auth::login',["filter" => "AlreadyLoggedIn"]);
$routes->post('dashboard/login', 'Backend\Auth::login_post',["filter" => "AlreadyLoggedIn"]);

$routes->group('dashboard', ["namespace" => "App\Controllers\Backend","filter" => 'AuthCheck'],static function ($routes) {

    $routes->get('/', 'Dashboard::index');

    $routes->post('yeni-bolum', 'Dashboard::new_section_post');
    $routes->post('bolum-sil/([^/]+)/?', 'Dashboard::section_delete/$1');
    $routes->get('bolum/([^/]+)/?', 'Dashboard::section_info/$1');
    $routes->post('bolum-update', 'Dashboard::section_update');
    $routes->post('section/toggle', 'Dashboard::section_toggle');
    $routes->post('section/order', 'Dashboard::section_order');

    $routes->post('menu/order', 'Dashboard::menu_order');

    $routes->get('logout', 'Auth::logout');


    $routes->group('ayarlar', static function ($routes) {
        $routes->get('genel', 'Settings::public_settings');
        $routes->post('genel', 'Settings::public_settings_post');

        $routes->get('iletisim-bilgileri', 'Settings::contact_settings');
        $routes->post('iletisim-bilgileri', 'Settings::contact_settings_post');

        $routes->get('gelismis', 'Settings::ultra_settings');
        $routes->post('gelismis', 'Settings::ultra_settings_post');

        $routes->get('mail', 'Settings::mail_setting');
        $routes->post('mail', 'Settings::mail_setting_post');
    });

    $routes->group('bildirimler', static function ($routes) {
        $routes->get('/', 'Notifications::index');
        $routes->post('/', 'Notifications::index_post');

        $routes->get('([\d]+)/?', 'Notifications::detail/$1');
        $routes->post('([\d]+)/?', 'Notifications::detail_post/$1');
    });
   

    $routes->group('profil', static function ($routes) {
        $routes->get('/', 'Profile::about');

        $routes->post('/', 'Profile::about_post');

        $routes->get('sifre', 'Profile::password');
        $routes->post('sifre', 'Profile::password_post');
    });


   
    $routes->group('kurumsal', static function ($routes) {
        $routes->get('musteri-yorumlari', 'Corporate::customer_comments');
        $routes->get('musteri-yorumlari/ekle', 'Corporate::customer_comments_add');
        $routes->post('musteri-yorumlari/ekle', 'Corporate::customer_comments_add_post');
        $routes->get('musteri-yorumlari/duzenle/([\d]+)/?', 'Corporate::customer_comments_edit/$1');
        $routes->post('musteri-yorumlari/duzenle/([\d]+)/?', 'Corporate::customer_comments_edit_post/$1');
        $routes->get('musteri-yorumlari/sil/([\d]+)/?', 'Corporate::customer_comments_delete/$1');
        $routes->get('musteri-yorumlari/toggle', 'Corporate::customer_comments_toggle');
        $routes->get('musteri-yorumlari/siralama', 'Corporate::customer_comments_siralama');
        
        $routes->get('slider', 'Corporate::slider');
        $routes->get('slider/ekle', 'Corporate::slider_ekle');
        $routes->post('slider/ekle', 'Corporate::slider_ekle_post');
        $routes->get('slider/duzenle/([\d]+)/?', 'Corporate::slider_duzenle/$1');
        $routes->post('slider/duzenle/([\d]+)/?', 'Corporate::slider_duzenle_post/$1');
        $routes->get('slider/sil/([\d]+)/?', 'Corporate::slider_delete/$1');
        $routes->get('slider/siralama', 'Corporate::slider_siralama');
        $routes->get('slider/toggle', 'Corporate::slider_toggle');

        $routes->get('hakkimizda', 'Corporate::about');
        $routes->get('ekibimiz', 'Corporate::team');
        $routes->get('ekibimiz/yeni', 'Corporate::team_add');
        $routes->post('ekibimiz/yeni', 'Corporate::team_add_post');
        $routes->get('ekibimiz/sil/([\d]+)/?', 'Corporate::team_delete/$1');
        $routes->get('ekibimiz/duzenle/([\d]+)/?', 'Corporate::team_edit/$1');
        $routes->post('ekibimiz/duzenle/([\d]+)/?', 'Corporate::team_edit_post/$1');


        $routes->get('sikca-sorulanlar', 'Corporate::faq');
        $routes->get('sikca-sorulanlar/ekle', 'Corporate::faq_add');
        $routes->post('sikca-sorulanlar/ekle', 'Corporate::faq_add_post');
        $routes->get('sikca-sorulanlar/duzenle/([\d]+)/?', 'Corporate::faq_edit/$1');
        $routes->post('sikca-sorulanlar/duzenle/([\d]+)/?', 'Corporate::faq_edit_post/$1');
        $routes->get('sikca-sorulanlar/sil/([\d]+)/?', 'Corporate::faq_delete/$1');

        $routes->group('sayfalar', static function ($routes) {
            $routes->get('/', 'Pages::pages');
            $routes->get('yeni', 'Pages::pages_add');
            $routes->post('yeni', 'Pages::pages_add_post');
            $routes->get('guncelle/([^/]+)/?', 'Pages::pages_edit/$1');
            $routes->post('guncelle/([^/]+)/?', 'Pages::pages_edit_post/$1');
            $routes->get('sil/([^/]+)/?', 'Pages::pages_delete/$1');
            $routes->get('toggle', 'Pages::toggle');
        });

    });

    $routes->group('hizmetler', static function ($routes) {
        $routes->get('/', 'Services::index');
        $routes->get('yeni-ekle', 'Services::insert_service');
        $routes->post('yeni-ekle', 'Services::insert_service_post');
        $routes->get('duzenle/([^/]+)/?', 'Services::insert_service_edit/$1');
        $routes->post('duzenle/([^/]+)/?', 'Services::insert_service_edit_post/$1');
        $routes->get('cop/([^/]+)/?', 'Services::insert_service_trash/$1');
        $routes->get('sil/([^/]+)/?', 'Services::insert_service_delete/$1');
        $routes->get('resimsil/([^/]+)/?', 'Services::insert_service_imgdelete/$1');
    });
    $routes->group('etkinlikler', static function ($routes) {
        $routes->get('/', 'Events::index');
        $routes->get('yeni-ekle', 'Events::insert_event');
        $routes->post('yeni-ekle', 'Events::insert_event_post');
        $routes->get('duzenle/([^/]+)/?', 'Events::insert_event_edit/$1');
        $routes->post('duzenle/([^/]+)/?', 'Events::insert_event_edit_post/$1');
        $routes->get('cop/([^/]+)/?', 'Events::insert_event_trash/$1');
        $routes->get('sil/([^/]+)/?', 'Events::insert_event_delete/$1');
        $routes->get('resimsil/([^/]+)/?', 'Events::insert_event_imgdelete/$1');

    });

    $routes->group('blog', static function ($routes) {
        $routes->get('/', 'Blog::index');
        $routes->get('yeni-ekle', 'Blog::insert_blog');
        $routes->post('yeni-ekle', 'Blog::insert_blog_post');
        $routes->get('duzenle/([^/]+)/?', 'Blog::insert_blog_edit/$1');
        $routes->post('duzenle/([^/]+)/?', 'Blog::insert_blog_edit_post/$1');
        $routes->get('cop/([^/]+)/?', 'Blog::insert_blog_trash/$1');
        $routes->get('sil/([^/]+)/?', 'Blog::insert_blog_delete/$1');

        $routes->get('resimsil/([^/]+)/?', 'Blog::insert_blog_imgdelete/$1');

        $routes->get('kategoriler', 'Blog::categories');
        $routes->post('kategori/ekle', 'Blog::add_category');
        $routes->get('kategori/toggle', 'Blog::toggle_category');
        $routes->get('kategoriler/sil/([\d]+)/?', 'Blog::remove_category/$1');
        $routes->post('kategoriler/duzenle', 'Blog::edit_category');
    });

    $routes->group('medya', static function ($routes) {
        $routes->get('foto-galeri', 'Media::photo_gallery');
        $routes->post('foto-galeri', 'Media::photo_gallery_post');
        $routes->get('foto-galeri/sil/([\d]+)/?', 'Media::photo_gallery_delete/$1');
        $routes->get('video-galeri', 'Media::video_gallery');
        $routes->get('video-galeri/yeni', 'Media::video_gallery_add');
        $routes->post('video-galeri/yeni', 'Media::video_gallery_add_post');
        $routes->get('video-galeri/duzenle/([\d]+)/?', 'Media::video_gallery_edit/$1');
        $routes->post('video-galeri/guncelle/([\d]+)/?', 'Media::video_gallery_edit_post/$1');
        $routes->get('video-galeri/sil/([\d]+)/?', 'Media::video_gallery_delete/$1');
    });


});





/*
$routes->get("/(admin|login|giris)",function(){
    return redirect()->to(base_url('dashboard/login'));
});*/


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
