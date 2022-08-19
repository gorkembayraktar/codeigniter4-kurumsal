 
 <?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>


     <!-- blog-details -->
  <section class="blog-details sidebar-page-container">
    <div class="container">
        <div class="row" style="margin-top: -40px;">
            <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side" style="margin-bottom: 50px">
                <div class="sidebar">
                    <div class="sidebar-categories sidebar-widget">
                        <h3 class="sidebar-title">Hizmetlerimiz</h3>
                        <div class="widget-content">
                            <ul>
                                <?php foreach($services as $service): ?>
                                <li><a style="<?=$service['id'] == $data['id'] ? 'color:#ff7162':''?>" href="<?=base_url('hizmetlerimiz/'.$service['slug'])?>"><?=$service['title']?></a></li>
                                <?php endforeach?>                                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="inner-box">
                        <div class="content-style-one">
                            <figure class="image-box"><img style="width: 100%" src="<?=base_url("public/images/services/".$data['image'])?>" alt="<?=$data['title']?>"></figure>
                            <div class="top-content" style="margin-top: -40px">
                                <h1><?=$data['title']?></h1>
                            </div>
                            <div class="text"><?=$data['content']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- blog-details end -->

<?= $this->endSection() ?>