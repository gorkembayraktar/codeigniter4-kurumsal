   <!-- gallery-section -->
   <section class="gallery-section sec-pad centred">
        <div class="container-fluid">
                <div class="sec-title">
                    <h5><?=$photos['features']['info']?></h5>
                    <h1><?=$photos['features']['title']?></h1>
                </div>
                <div class="gallery-carousel owl-carousel owl-theme">

                    <?php foreach($photos['data'] as $photo): ?>
                    <div class="gallery-block">
                        <div class="image-box">
                            <figure class="image"><img style="width: 100%;height: 300px;object-fit: cover;" src="<?=base_url("public/images/gallery/".$photo['image'])?>" alt=""></figure>
                            <div class="overlay-box"><a href="<?=base_url("public/images/gallery/".$photo['image'])?>" class="lightbox-image" data-fancybox="gallery"><i class="flaticon-add"></i></a></div>
                        </div>
                    </div>
                    <?php endforeach?>
                                    
                </div>
        </div>
    </section>
    <!-- gallery-section end -->