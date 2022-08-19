<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> SmurfWeb | Yönetim Paneli</title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url('public/back/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">

 
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url('public/back/css/sb-admin-2.min.css')?>" rel="stylesheet">

    <link href="<?=base_url('public/back/css/revize.css')?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">


    <?= $this->renderSection('css') ?>


</head>


<body id="page-top" class="bg-dark">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->

    <?=$this->include("back/layouts/sidebar")?>

    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">


        
            <!-- Topbar navbar -->
            <?=$this->include("back/layouts/navbar")?>
            <!-- End of Topbar navbar -->