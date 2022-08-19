
<?php if($faq || $comments): ?>

    <!-- testimonial-faq -->
    <section class="testimonial-faq">
        <div class="anim-icon">
            <div class="icon icon-1"></div>
        </div>
        <div class="container">
            <div class="row">

            <?php if($comments):?>
                <div class="col-lg-<?=(!$faq ? 12 : 6)?> col-md-12 col-sm-12 testimonial-column">
                    <div class="testimonial-content">
                            <div class="sec-title style-two">
                                <h5>Müşteri Yorumları ile ilgili yazı</h5>
                                <h1>Müşteri Yorumları</h1>
                            </div>
                        <div class="inner-content">
                            <div class="client-testimonial-carousel owl-carousel owl-theme">
                                <?php foreach($comments['data'] as $comment):?>
                                <div class="testimonial-block">
                                    <div class="inner-box">
                                        <div class="author"><?=$comment["name"]?> <span>/ <?=$comment["subname"]?></span></div>
                                        <ul class="rating">
                                            <?php for($i = 1; $i <= $comment['star'];$i++): ?>
                                            <li><i class="fas fa-star"></i></li>
                                            <?php endfor ?>
                                        </ul>
                                        <div class="text"><?=$comment["comment"]?></div>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>

                            <!--Client Thumbs Carousel-->
                            <div class="client-thumb-outer">
                                <div class="client-thumbs-carousel owl-carousel owl-theme">
                                <?php foreach($comments['data'] as $comment):?>
                                    <div class="thumb-item">
                                        <figure class="thumb-box"><img src="<?=base_url("public/images/customer/".$comment["image"])?>" alt="<?=$comment['name']?>"></figure>
                                    </div>
                                <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <?php if($faq):?>
                <div class="col-lg-<?=(!$comments ? 12 : 6)?> col-md-12 col-sm-12 faq-column">
                    <div class="faq-content">
                            <div class="sec-title style-two">
                                <h5>Sıkça Sorulanlar ile ilgili yazı</h5>
                                <h1>Sıkça Sorulanlar</h1>
                            </div>
                                <ul class="accordion-box active-block">

                                    <?php foreach($faq['data'] as $key => $question):?>
                                    <li class="accordion block">
                                        <div class="acc-btn <?=$key == 0 ? 'active' : ''?>">
                                            <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                            <h4><?=$question['title']?></h4>
                                        </div>
                                        <div class="acc-content <?=$key == 0 ? 'current' : ''?>">
                                            <div class="content">
                                                <div class="text"><?=$question['content']?></div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach ?>
                                
                                </ul>

                    </div>
                    <br><br>
                </div>

                <?php endif?>
            
            </div>
        </div>
    </section>
    <!-- testimonial-faq end -->


<?php endif ?>