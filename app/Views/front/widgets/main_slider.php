
<?php if($slider): ?>

    <!-- main-slider -->
    <section class="main-slider style-one">
     
        <div class="main-slider-carousel owl-carousel owl-theme nav-style-one">

        <?php foreach($slider['data'] as $sli): ?>
            <div class="slide" style="background-image:url(<?=base_url("/public/images/slider/".$sli['image'])?>)">
                <div class="container">
                    <div class="content-box">
                        <h3><?=$sli['subtitle']?></h3>
                        <h1><?=$sli['title']?></h1>
                        <div class="text"><?=$sli['content']?></div>

                            <div class="btn-box"><a href="<?=base_url($sli['buttonRedirect'])?>" class="theme-btn"><?=$sli['buttonName']?></a></div>
                        </div>
                </div>
            </div>
        <?php endforeach ?>
        
           
        </div>
    </section>
    <!-- main-slider end -->

<?php endif ?>