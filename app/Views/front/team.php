 
 <?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section',["tester" => "merhaba"]) ?>
 
 
 
 <!-- our-teachers -->
 <section class="our-teachers teachers-page-section sec-pad centred">
        <div class="container">
            <div class="row">

                <?php foreach($team as $teacher):?>

                    <div class="col-xl-4 col-lg-6 col-md-12 block-column">
                        <div class="teachers-block-one wow fadeInUp" data-wow-delay="600ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-holder">
                                    <figure class="image-box"><a><img src="<?=base_url("public/images/teams/".$teacher['image'])?>" alt="<?=$teacher['fullname']?>"></a></figure>
                                </div>
                                <div class="lower-content">
                                    <h3><a><?=$teacher['fullname']?></a></h3>
                                    <span class="designation"><?=$teacher['degree']?></span>
                                    <ul class="social-list">
                                    <?php if(!empty($teacher['socials'])): ?>

                                        <?php foreach(json_decode($teacher['socials'],true) as $social => $links):?>
                                                <?php foreach($links as $link): ?>
                                                    <li><a href="<?=$link?>" ><i class="fab fa-<?=$social?>"></i></a></li>
                                                <?php endforeach?>
                                        <?php endforeach?>
                                    <?php endif ?>
                                        
                                        
                                        
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                        
                    
            </div>
            <div class="pagination-wrapper centred">
                <ul class="pagination">
                    <li><a class="active" class="page-link">1</a></li>
                 </ul>
            </div>
        </div>
    </section>
    <!-- our-teachers end -->


<?= $this->endSection() ?>