<?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>


    <!-- news-section -->
    <section class="news-section blog-page-section">
        <div class="container">
            <div class="row">

            <?php foreach($data as $item):?>
                <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                    <div class="news-block-one wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <figure class="image-box"><a href="<?=base_url("blog/".$item['slug'])?>"><img style="width: 100%;height: 250px;object-fit: cover;" src="<?=base_url("public/images/blog/".$item['image'])?>" alt="<?=$item['title']?>"></a></figure>
                            <div class="lower-content">
                                <h3><a href="<?=base_url("blog/".$item['slug'])?>"><?=$item['title']?></a></h3>
                                <ul class="info-box">
                                    <li><?=date("d/m/Y H:i", strtotime($item['created_at']))?></li>
                                </ul>
                                <div class="text"><?=substr(strip_tags($item['content']),0,150)?>...</div>
                                <div class="link-btn"><a href="<?=base_url("blog/".$item['slug'])?>"><i class="flaticon-next"></i></a></div>
                                <div class="more-btn"><a href="<?=base_url("blog/".$item['slug'])?>" class="theme-btn">Devamını Oku</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach?>
                            
        </div>


            <div class="pagination-wrapper centred">
                <ul class="pagination">
                                                                        <li><a class="active" class="page-link">1</a></li>
                                        </ul>
            </div>



        </div>
    </section>
    <!-- news-section end -->

<?= $this->endSection() ?>