<?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>


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
                            <h5>Neden Ayoft Anaokulu?</h5>
                            <h1>Hakkımızda</h1>
                        </div>
                        <div class="text">
                            <p style="margin-bottom: 15px; overflow-wrap: break-word;">Ayoft Anaokulunda öğretmen-çocuk ilişkisini (çocuklarla bağ kurulması ve kurulan bağların yıl boyunca sağlıklı bir şekilde yönetilmesi) merkeze alan bir sınıf yönetimi modeli okul öncesi alanından mezun nitelikli öğretmenlerle sürdürülür.</p><p style="margin-bottom: 15px; overflow-wrap: break-word;">Ayoft Anaokulu olarak okulumuzda çalışan tüm öğretmenleri yoğun bir merkezi eğitimle yeni döneme hazırlıyoruz. Sene içerisinde de destek eğitimlerimize devam ediyoruz.</p><p style="margin-bottom: 15px; overflow-wrap: break-word;">Alanında uzman eğitimciler tarafından dünyadaki gelişmeler takip edilerek titizlikle hazırlanan günlük planlar ile çocuğunuzun okula girişinden okuldan çıkış anına kadar günün her anını planlıyoruz.</p>                        </div>
                        <br>
                        <div class="btn-box"><a href="iletisim" class="theme-btn">İletişime Geç</a></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <figure class="image image-1"><img src="<?=base_url("public/images/about-1.jpg")?>" alt=""></figure>
                        <figure class="image image-2"><img src="<?=base_url("public/images/about-2.jpg")?>" alt=""></figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about-section end -->

<?= $this->endSection() ?>