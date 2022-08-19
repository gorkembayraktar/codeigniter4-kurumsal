<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!--<base href="/" /> -->
    <title><?=$setting['title']?></title>
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?=base_url('public/images/'.$setting['favicon'])?>" sizes="32x32">
    <link rel="apple-touch-icon" href="<?=base_url('public/images/'.$setting['favicon'])?>">

    <meta name="description" content="<?=$setting['seo_description']?>">
    <meta name="keywords" content="<?=$setting['seo_keywords']?>">
    <meta name="author" content="<?=$setting['seo_author']?>">

    <!-- Stylesheets -->
    <link href="<?=base_url('public/css/style.css')?>" rel="stylesheet">
    <link href="<?=base_url('public/css/responsive.css')?>" rel="stylesheet">

    <link rel="stylesheet" href="<?=base_url('public/css/sweetalert2.min.css')?>">

    <style>

        @media (max-width: 767px) {
            .mo {
                display: none !important;
            }
        }
        @media (min-width: 767px) {
            .ma {
                display: none !important;
            }
        }

        <?=$setting['html_css']?>

    </style>

    <?=$setting['html_head']?>

    <!-- Header alanına eklemek istediğiniz kodu giriniz  -->
</head>

<!-- page wrapper -->
<body class="boxed_wrapper">



<?php if($setting['preloader']):?>
<!-- .preloader -->
<div class="preloader"></div>
<!-- /.preloader -->
<?php endif?>


<!-- Main Header -->
<header class="main-header">

    <div class="header-top">
        <div class="container">
            <div class="inner-container clearfix">
                <div class="social-links pull-left">
                    <ul class="social-list">
                        
                            <li><a href="<?=$setting['facebook'] ?? '#' ?>"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?=$setting['instagram'] ?? '#' ?>"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="<?=$setting['youtube'] ?? '#' ?>"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="<?=$setting['twitter'] ?? '#' ?>"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="header-info pull-right">
                    <ul class="info-list">
                        <li>
                            <i class="fas fa-phone"></i>
                            <a href="tel:<?=$setting['telephone']?>"><?=$setting['telephone']?></a>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?=$setting['email']?>"><?=$setting['email']?></a>
                        </li>
                        <li>
                            <i class="fas fa-map"></i>
                            <a><?=$setting['adress']?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom">
        <div class="container">
            <div class="clearfix">
                <div class="logo-box pull-left">
                    <figure class="logo"><a href="<?=base_url()?>"><img style="height: 65px" src="<?=base_url('public/images/'.$setting['logo'])?>" alt="Logo"></a></figure>
                </div>
                <div class="nav-outer pull-right clearfix">
                    <div class="menu-area">
                        <nav class="main-menu navbar-expand-lg">
                            <div class="navbar-header">
                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">

                                    <?php foreach($menus as $menu): ?>
                                    <li class="<?=isset($menu['children']) ? 'dropdown' : ''?>">
                                        <a href="<?=!empty( $menu['to'] ) ? base_url($menu['to']) : ''?>"><?=$menu['name']?></a>
                                        
                                        <?php if(isset($menu['children'])): ?>
                                        <ul>
                                            <?php foreach($menu['children'] as $children): ?>
                                            <li><a href="<?=!empty( $children['to'] ) ? base_url($children['to'])  : ''?>"><?=$children['name']?></a></li>
                                                           
                                            <?php endforeach ?>
                                        </ul>
                                        <?php endif ?>
                                    </li>

                                    <?php endforeach ?>
                                    
                                    </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Sticky Header-->
    <div class="sticky-header">
        <div class="container clearfix">
            <figure class="logo-box"><a href="<?=base_url()?>"><img style="height: 45px;" src="<?=base_url('public/images/'.$setting['logo'])?>" alt="Logo"></a></figure>
            <div class="menu-area">
                <nav class="main-menu navbar-expand-lg">
                    <div class="navbar-header">
                        <!-- Toggle Button -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse clearfix">
                        <ul class="navigation clearfix">
                            
                            <?php foreach($menus as $menu): ?>
                                <li class="<?=isset($menu['children']) ? 'dropdown' : ''?>">
                                    <a href="<?=!empty( $menu['to'] ) ? base_url($menu['to']) : ''?>"><?=$menu['name']?></a>
                                    
                                    <?php if(isset($menu['children'])): ?>
                                    <ul>
                                        <?php foreach($menu['children'] as $children): ?>
                                        <li><a href="<?=!empty( $children['to'] ) ? base_url($children['to'])  : ''?>"><?=$children['name']?></a></li>
                                                        
                                        <?php endforeach ?>
                                    </ul>
                                    <?php endif ?>
                                </li>

                            <?php endforeach ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div><!-- sticky-header end -->
</header>
<!-- End Main Header -->




<?php if($setting['active'] == 0): ?>
<!-- BAKIM MODU -->

<div class="bakim-modu" style="position:fixed;top:50%;z-index:999;background-color:skyblue;padding:12px;color:#f00;border-radius:4px;font-family:Arial;">
    Bakım Modu Aktif
</div>

<!-- en bakım -->

<?php endif ?>