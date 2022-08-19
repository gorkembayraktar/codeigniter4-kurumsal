 
 <?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>


        <!-- classes-section -->
    <section class="classes-section classes-page-section sec-pad">
        <div class="container">
            <div class="row">
                <?php foreach($data as $item):?>
                <div class="col-lg-4 col-md-6 col-sm-12 block-column">
                    <div class="inner-block wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <!--770x435 en boy images for services-->
                        <figure class="image-box"><a href="<?=base_url("hizmetlerimiz/".$item['slug'])?>"><img style="width: 100%;height: 280px;object-fit: cover;" src="<?=base_url("public/images/services/".$item["image"])?>" alt="<?=$item['title']?>"></a></figure>
                        <div class="lower-content">
                            <div class="link-btn"><a href="<?=base_url("hizmetlerimiz/".$item['slug'])?>"><i class="flaticon-next"></i></a></div>
                            <h3><a href="<?=base_url("hizmetlerimiz/".$item['slug'])?>"><?=$item['title']?></a></h3>
                            <div class="text"><?=substr(strip_tags($item['content']),0,200)?>...</div>
                        </div>
                    </div>
                </div>
                <?php endforeach?>
               
            </div>
            <div class="pagination-wrapper centred">
                <ul class="pagination">
                    <?php for($i=1;$i<=$pagination['maxPage'];$i++):  ?>
                        <li><a class="<?=$i == $pagination['page'] ? 'active' : ''?>" class="page-link"<?=($i != $pagination['page'] ? 'href="?p='.$i.'"'  : '')?>><?=$i?></a></li>
                    <?php endfor ?>
                </ul>
            </div>
        </div>
    </section>
    <!-- classes-section end -->

<?= $this->endSection() ?>