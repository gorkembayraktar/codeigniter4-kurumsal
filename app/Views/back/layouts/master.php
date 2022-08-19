<?= $this->include("back/layouts/header")?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

               <!-- Page Heading -->
               <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?=$title?></h1>
                        <a href="<?=base_url()?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Web siteyi Görüntüle</a>
                </div>

                <?= $this->renderSection('content') ?>


            </div>
            <!-- /.container-fluid -->
<?= $this->include("back/layouts/footer")?>
  
