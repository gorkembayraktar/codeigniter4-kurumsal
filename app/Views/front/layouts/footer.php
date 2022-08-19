

<!-- main-footer -->
<footer class="main-footer">
    <div class="footer-top">
        <div class="parallax-scene parallax-scene-2 parallax-icon">
            <span data-depth="0.40" class="parallax-layer icon icon-1"></span>
            <span data-depth="0.50" class="parallax-layer icon icon-2"></span>
            <span data-depth="0.30" class="parallax-layer icon icon-3"></span>
            <span data-depth="0.40" class="parallax-layer icon icon-4"></span>
            <span data-depth="0.50" class="parallax-layer icon icon-5"></span>
            <span data-depth="0.30" class="parallax-layer icon icon-6"></span>
            <span data-depth="0.40" class="parallax-layer icon icon-7"></span>
        </div>
        <div class="container">
            <div class="widget-section">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="about-widget footer-widget">
                            <h3 class="widget-title">Hakkımızda</h3>
                            <div class="widget-content">
                                <div class="text">
                                    <p style="outline: none; padding: 0px; margin-bottom: 20px; line-height: 24px;">
                                        <b><?=$setting['seo_description']?></b>
                                    </p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="link-widget footer-widget">
                            <h3 class="widget-title">Hızlı Menü</h3>
                            <div class="widget-content">
                                <ul>
                                    <li><a href="<?=base_url()?>">Anasayfa</a></li>
                                    <li><a href="/hakkimizda.html">Hakkımızda</a></li>
                                    <li><a href="<?=base_url("ekibimiz")?>">Ekibimiz</a></li>
                                    <li><a href="<?=base_url("sikca-sorulanlar")?>">Sıkça Sorulanlar</a></li>
                                    <li><a href="<?=base_url("hizmetlerimiz")?>">Hizmetlerimiz</a></li>
                                    <li><a href="<?=base_url("etkinliklerimiz")?>">Etkinliklerimiz</a></li>
                                    <li><a href="<?=base_url("foto-galeri")?>">Foto Galeri</a></li>
                                    <li><a href=<?=base_url("video-galeri")?>">Video Galeri</a></li>
                                    <li><a href="<?=base_url("blog")?>">Bizden Haberler</a></li>
                                    <li><a href="<?=base_url("iletisim")?>">İletişim</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="link-widget footer-widget">
                            <h3 class="widget-title">Hizmetlerimiz</h3>
                            <div class="widget-content">
                                <ul>
                                    <?php foreach($fistServices as $service): ?>
                                        <li><a href="<?=base_url("hizmetlerimiz/".$service['slug'])?>"><?=$service['title']?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                        <div class="contact-widget footer-widget">
                            <h3 class="widget-title">İletişim Bilgileri</h3>
                            <div class="widget-content">
                                <ul class="info-list">
                                    <li><i class="fas fa-home"></i><?=$setting['adress']?>
                                    </li>
                                    <li><i class="fas fa-phone"></i><a href="tel:<?=$setting['telephone']?>"><?=$setting['telephone']?></a></li>
                                    <li><i class="fas fa-envelope"></i><a href="mailto:<?=$setting['email']?>"><?=$setting['email']?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="inner-container clearfix">
                <div class="left-content pull-left">
                    <div class="copyright"><p><?=$setting['footer']?></p></div>
                </div>
                <div class="right-content pull-right">
                    <figure class="footer-logo"><a href="index.html"><img style="height: 50px" src="<?=base_url('public/images/'.$setting['logo'])?>" alt="Logo"></a></figure>
                    <ul class="social-style-one footer-social clearfix">
                                                    <li><a href="<?=$setting['facebook'] ?? '#' ?>"><i class="fab fa-facebook-f"></i></a></li>
                                                                            <li><a href="<?=$setting['instagram'] ?? '#' ?>"><i class="fab fa-instagram"></i></a></li>
                                                                            <li><a href="<?=$setting['youtube'] ?? '#' ?>"><i class="fab fa-youtube"></i></a></li>
                                                                            <li><a href="<?=$setting['twitter'] ?? '#' ?>"><i class="fab fa-twitter"></i></a></li>
                                                        </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- main-footer end -->



<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <i class="fa fa-arrow-up"></i>
</button>



<script src="<?=base_url('public/js/jquery.js')?>"></script>
<script src="<?=base_url('public/js/popper.min.js')?>"></script>
<script src="<?=base_url('public/js/bootstrap.min.js')?>"></script>

<script src="<?=base_url('public/js/owl.js')?>"></script>
<script src="<?=base_url('public/js/wow.js')?>"></script>
<script src="<?=base_url('public/js/validation.js')?>"></script>
<script src="<?=base_url('public/js/jquery.fancybox.js')?>"></script>
<script src="<?=base_url('public/js/appear.js')?>"></script>
<script src="<?=base_url('public/js/parallax.min.js')?>"></script>
<script src="<?=base_url('public/js/isotope.js')?>"></script>

<!-- map script -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
<script src="<?=base_url('public/js/gmaps.js')?>"></script>
<script src="<?=base_url('public/js/map-helper.js')?>"></script>

<!-- main-js -->
<script src="<?=base_url('public/js/script.js')?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.js"></script>


<?=$setting['html_body']?>

<?php if(!empty($setting['html_js'])):?>

    <script>
        <?=$setting['html_js']?>
    </script>

<?php endif?>


<!-- Footer alanına eklemek istediğiniz kodu giriniz  -->

</body><!-- End of .page_wrapper -->
</html>
