<?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>

 
 
    <!-- portfolio-section -->
    <section class="gallery-page-section">
        <div class="container">
            <div class="sortable-masonry">
                <div class="items-container row clearfix">
                    <?php foreach($videos as $video): ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all program nature">
                            <div class="gallery-block">
                                <?=$video['iframe']?>
                            </div>
                        </div>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    </section>
    <!-- portfolio-section end -->


<?= $this->endSection() ?>