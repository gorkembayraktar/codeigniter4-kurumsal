<?php if($events): ?>

    <?php  $json = json_decode($events['features']['props'],true); ?>

    <!-- event-section -->
    <section class="event-section" style="background-image: url(<?=base_url("public/images/".($json['images'] ? "sections/".$json['images'][0] : "event-bg.jpg"))?>);">
        <div class="anim-icon">
            <div class="icon icon-1 float-bob-x"></div>
        </div>
        <div class="container">
                <div class="sec-title centred">
                    <h5><?=$events['features']['info']?></h5>
                    <h1><?=$events['features']['title']?></h1>
                </div>
                    <div class="row">
                        <?php foreach($events['data'] as $event):?>
                        <div class="col-xl-6 col-lg-12 col-md-12 event-block">
                            <div class="event-block-one wow fadeInRight" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <figure class="image-box"><a href="<?=base_url('etkinlik/'.$event['slug'])?>"><img style="height: 300px;object-fit: cover;" src="<?=base_url('public/images/events/'.$event['image'])?>" alt="<?=$event['title']?>"></a></figure>
                                    <div class="content-box">
                                        <h3><a href="<?=base_url('etkinlik/'.$event['slug'])?>"><?=$event['title']?></a></h3>
                                        <div class="text"><?=substr(strip_tags($event['content']),0,250)?>...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach?>
                        
                </div>
        </div>
    </section>
    <!-- event-section end -->

<?php endif ?>