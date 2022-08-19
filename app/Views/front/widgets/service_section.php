<?php if($services):?>
    <!-- service-section -->
    <?php $json = json_decode($services['features']['props'],true) ?>
    <section class="service-section sec-pad" style="background-image: url(<?=base_url("/public/images/sections/".$json['images'][0])?>);">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 inner-column">
                    <div class="inner-content">
                        <div class="sec-title style-two">
                            <h5><?=$services['features']['info']?></h5>
                            <h1><?=$services['features']['title']?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 carousel-column">
                    <div class="carousel-content">
                        <div class="services-carousel owl-carousel owl-theme">
                            <?php foreach($services['data'] as $service): ?>
                                <div class="service-block-one">
                                    <div class="inner-box">
                                        <div class="icon-box"><i class="flaticon-drum"></i></div>
                                        <h3><a href="<?=base_url("hizmetlerimiz/".$service['slug'])?>"><?=$service['title']?></a></h3>
                                        <div class="text"><?=substr(strip_tags($service['content']),0,150)?>...</div>
                                    </div>
                                </div>
                            <?php endforeach?>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service-section end -->

    <?php endif ?>