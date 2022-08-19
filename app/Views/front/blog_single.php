<?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>

   

 <!-- blog-details -->
 <section class="blog-details sidebar-page-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <?php if($blog): ?>
                    <div class="blog-details-content">
                        <div class="inner-box">
                            <div class="content-style-one">
                                <div class="top-content">
                                    <h4><?=date("d/m/Y H:i", strtotime($blog['created_at']));?></h4>
                                    <h1><?=$blog['title']?></h1>
                                </div>
                                <figure class="image-box"><img style="width: 100%" src="<?=base_url("public/images/blog/".$blog['image'])?>" alt="<?=$blog['title']?>"></figure>
                                <div class="text"><?=$blog['content']?></div>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="sidebar">
                        <div class="sidebar-post sidebar-widget">
                            <h3 class="sidebar-title">Son Yazılar</h3>
                            <div class="widget-content">
                                <?php foreach($lastBlog as $item):?>
                                <div class="post">
                                    <figure class="image"><a href="<?=base_url("blog/".$item['slug'])?>"><img src="<?=base_url("public/images/blog/".$item['image'])?>" alt="<?=$item['title']?>"></a></figure>
                                    <span class="post-date"><?=date("d/m/Y H:i", strtotime($item['created_at']));?></span>
                                    <h4><a href="<?=base_url("blog/".$item['slug'])?>"><?=$item['title']?></a></h4>
                                </div>
                                <?php endforeach ?>
                                                            
                            </div>
                        </div>
                        <div class="sidebar-categories sidebar-widget">
                            <h3 class="sidebar-title">Hizmetlerimiz</h3>
                            <div class="widget-content">
                                <ul>
                                <?php foreach($services as $service): ?>
                                    <li><a href="<?=base_url("hizmetlerimiz/".$service['slug'])?>"><?=$service['title']?></a></li>
                                    <?php endforeach?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-details end -->


<?= $this->endSection() ?>