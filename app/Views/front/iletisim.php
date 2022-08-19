<?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>
    <?= $this->include('front/widgets/page_title_section') ?>


   <!-- contact-form-section -->
   <section class="contact-form-section sec-pad">
    <div class="container">
        <div class="sec-title centred">
            <h5>Bize Mesaj Gönder</h5>
            <h1>İletişim Formu</h1>
        </div>
        <?php if(isset($status) && $status): ?>
            <div class="alert alert-success">
                Mail başarılı şekilde gönderilmiştir.
            </div>
        <?php else:?>
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 offset-lg-2 form-column">
                <div class="contact-form">

                    <?php if(!empty(session()->getFlashData('fail'))): ?>    
                        <div class="alert alert-danger">
                            <?=session()->getFlashData('fail')?>
                        </div>
                    <?php endif ?>
                    <form action="" method="post" role="form" id="contact-form" class="default-form">
                        <?= csrf_field() ?>
                        <input type="hidden" name="tarih" value="<?=date('d-m-y H:i:s')?>">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <input type="text" name="isim" id="name" class="form-control" required placeholder="İsminiz Soyisminiz">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                <input type="email" name="mail" id="email" class="form-control" required placeholder="Elektronik Posta Adresiniz">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <input type="text" name="konu" id="phone_number" required class="form-control" placeholder="İletmek İstediğiniz Mesajın Konusu">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                <textarea name="mesaj" placeholder="İletmek İstediğiniz Mesajınız"></textarea>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn centred">
                                <button name="iletisim" type="submit" class="theme-btn" name="submit-form">Mesaj Gönder</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php endif ?>
    </div>
</section>
<!-- contact-form-section end -->


<?= $this->endSection() ?>