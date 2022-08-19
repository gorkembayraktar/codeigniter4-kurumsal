<?php  $json = json_decode($activities['features']['props'],true); ?>

    <!-- activities-section -->
    <section class="activities-section style-two">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box clearfix">
                        <figure class="image"><img src="<?=base_url("public/images/".($json['images'] ? "sections/".$json['images'][0] : "activities-2.jpg"))?>" alt=""></figure>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="title-box">
                            <div class="sec-title style-two">
                                    <h5><?=$activities['features']['info']?></h5>
                                    <h1><?=$activities['features']['title']?></h1>
                                </div>
                        </div>
                        <div class="inner-box">
                            <div class="row">
                                <?php foreach($json['clases'] as $item): ?>

                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                    <div class="single-item wow fadeInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="icon-box"><i class="<?=$item['class']?>"></i></div>
                                        <h3><a><?=$item['title']?></a></h3>
                                        <div class="text"><?=$item['content']?></div>
                                    </div>
                                </div>
                                <?php endforeach?>
                                                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- activities-section end -->