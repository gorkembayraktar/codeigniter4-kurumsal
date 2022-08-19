<!-- about-section -->
    <section class="about-section style-two">
        <div class="anim-icon">
            <div class="icon icon-1 float-bob-x"></div>
            <div class="icon icon-3"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <div class="sec-title style-two">
                            <h5><?=$data["info"]?></h5>
                            <h1><?=$data["title"]?></h1>
                        </div>
                        <div class="text">
                            <p style="margin-bottom: 15px; overflow-wrap: break-word;"><?=$data["content"]?></div>
                        <br>
                        <?php  $json = json_decode($data['props'],true);  ?>

                        <?php if(isset($json['button'])): ?>
                        <div class="btn-box"><a href="<?=base_url($json['button']['redirect'])?>" class="theme-btn"><?=$json['button']['name']?></a></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <?php foreach($json['images'] as $key => $image): ?>
                        <figure class="image image-<?=$key+1?>"><img src="<?=base_url("/public/images/sections/".$image)?>" alt=""></figure>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->