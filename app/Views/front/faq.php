<?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>

<!-- faq-page-section -->
<section class="faq-page-section">

    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 faq-column">
                <div class="faq-content">
                    <ul class="accordion-box active-block">

                        <?php foreach($comments as $key => $comment):  ?>
                            <li class="accordion block">
                                <div class="acc-btn <?=$key == 0 ? 'active' : ''?>">
                                    <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                    <h4><?=$comment['title']?></h4>
                                </div>
                                <div class="acc-content <?=$key == 0 ? 'current' : ''?>">
                                    <div class="content">
                                        <div class="text"><?=$comment['content']?></div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach?>

                    
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- faq-page-section end -->


<?= $this->endSection() ?>