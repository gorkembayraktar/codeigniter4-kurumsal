<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>

<form method="post" action="<?=base_url("dashboard/ayarlar/iletisim-bilgileri")?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="card shadow mb-4">

        <div class="card-header">
            Ayarlar
        </div>      
        <div class="card-body">
        
                
                
                                 
                    <div class="row">
                        <div class="col-md-6">

                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group">
                                        <label><i class="fas fa-phone"></i> Telefon Numarası</label>
                                        <input type="text" name="tel" reqired class="form-control" value="<?=$settings['telephone']?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label><i class="fas fa-envelope"></i> Kurumsal Mail Adresi</label>
                                        <input type="email" name="mail" reqired class="form-control" value="<?=$settings['email']?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label><i class="fas fa-map"></i> Kurumsal Adres Bilgileriniz</label>
                                        <textarea name="adres"  class="form-control"><?=$settings['adress']?></textarea>
                                    </div>

                                </div>

   
                            </div>

                        </div>
                      

                        <div class="col-md-6">
                            <div class="row">
                              
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> <i class="fab fa-facebook"></i> Facebook</label>
                                        <input type="text" name="facebook" class="form-control"  value = "<?=$settings['facebook']?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label> <i class="fab fa-instagram"></i> İnstagram</label>
                                        <input type="text" name="instagram" class="form-control"  value = "<?=$settings['instagram']?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label> <i class="fab fa-twitter"></i> Twitter</label>
                                        <input type="text" name="twitter" class="form-control" value = "<?=$settings['twitter']?>">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label> <i class="fab fa-youtube"></i> Youtube</label>
                                        <input type="text" name="youtube" class="form-control"  value = "<?=$settings['youtube']?>">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                  
                  

              
            
        </div>

    </div>



    <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success ">Bilgileri Güncelle</button>
    </div>

</form>

<?= $this->endSection() ?>