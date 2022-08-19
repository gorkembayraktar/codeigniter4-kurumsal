

    <!-- news-section -->
    <section class="news-section">
        <div class="anim-icon">
            <div class="icon icon-1 wow zoomIn" data-wow-delay="00ms" data-wow-duration="1500ms"></div>
        </div>
        <div class="container">
                <div class="sec-title centred">
                    <h5><?=$blog['features']['info']?></h5>
                    <h1><?=$blog['features']['title']?></h1>
                </div>
                <div class="row">

                        <?php foreach($blog['data'] as $item): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 news-block" style="margin-bottom: 20px">
                            <div class="news-block-one wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <figure class="image-box"><a href="blog-icerik/yeni-derslerle-bakim-yapan-cocuklar-8"><img style="width: 100%;height: 250px;object-fit: cover;" src="<?=base_url("public/images/blog/".$item['image'])?>" alt="<?=$item['title']?>"></a></figure>
                                    <div class="lower-content">
                                        <h3><a href="blog-icerik/yeni-derslerle-bakim-yapan-cocuklar-8"><?=$item['title']?></a></h3>
                                        <ul class="info-box">
                                            <li><?=date("d/m/Y H:i", strtotime($item['created_at']));?></li>
                                        </ul>
                                        <div class="text"><?=substr(strip_tags($item['content']),0,150)?>...</div>
                                        <div class="link-btn"><a href="<?=base_url("blog/".$item['slug'])?>"><i class="flaticon-next"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach?>
                                  
                </div>
        </div>
    </section>
    <!-- news-section end -->