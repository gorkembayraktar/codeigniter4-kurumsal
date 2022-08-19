<?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>


     <!-- portfolio-section -->
     <section class="gallery-page-section">
        <div class="container">
            <div class="sortable-masonry">
                <div class="items-container row clearfix">
                    <?php foreach($photos as $photo):?>
                    <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all program nature">


                        <div class="gallery-block">
                            <div class="image-box">
                                <figure class="image"><img style="width: 100%;height: 330px;object-fit: cover;" src="<?=base_url("public/images/gallery/".$photo['image'])?>" alt=""></figure>
                                <div class="overlay-box"><a href="<?=base_url("public/images/gallery/".$photo['image'])?>" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-add"></i></a></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach?>
                                           
                </div>
            </div>
           
        </div>
    </section>
    <!-- portfolio-section end -->


<?= $this->endSection() ?>