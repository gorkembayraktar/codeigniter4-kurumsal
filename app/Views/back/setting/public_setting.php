<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>

<form method="post" action="<?=base_url("dashboard/ayarlar/genel")?>" enctype="multipart/form-data">

    <?= csrf_field() ?>

    <div class="card shadow mb-4">

        <div class="card-header">
            Ayarlar
        </div>      
        <div class="card-body">
        
            

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Site Başlığı</label>
                        <input type="text" name="title" reqired class="form-control" value="<?=$settings['title']?>">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label class="text-success">Site Aktiflik Durumu</label>
                        <select class="form-control" name="active">
                            <option  <?=$settings['active'] == "1" ? 'selected' : ''?>  value="1">Açık</option>
                            <option  <?=$settings['active'] == "0" ? 'selected' : ''?> value="0">Kapalı</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>PreLoader</label>
                        <select class="form-control" name="preloader">
                            <option  <?=$settings['preloader'] == "1" ? 'selected' : ''?>  value="1">Açık</option>
                            <option  <?=$settings['preloader'] == "0" ? 'selected' : ''?> value="0">Kapalı</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Logo</label>
                        <?php if(!empty($settings['logo'])): ?>
                        <img height="100" src="<?=base_url("public/images/".$settings['logo'])?>" />
                        <?php endif ?>
                        <input type="file" name="logo"  class="form-control">
                        
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Favicon</label>
                        <?php if(!empty($settings['favicon'])): ?>
                        <img height="50" src="<?=base_url("public/images/".$settings['favicon'])?>" />
                        <?php endif ?>
                        <input type="file" name="favicon" class="form-control">
                    </div>

                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Footer</label>
                        <textarea name="footer" class="form-control" ><?=$settings['footer']?></textarea>
                    </div>

                </div>


            </div>
              
            
        </div>

    </div>



    <div class="card shadow mb-4">

        <div class="card-header">
           Site Seo Ayarları [META]
        </div>      
        <div class="card-body">
            <div class="row">
                    

                    <div class="col-md-6">
                            <div class="form-group">
                                <label>Keywords (Anahtar kelimeler)</label>
                                <input type="text" name="seo_keywords"  class="form-control" value="<?=$settings['seo_keywords']?>">
                            </div>
                    </div>

                    <div class="col-md-6">
                            <div class="form-group">
                                <label>Author (Yazar)</label>
                                <input type="text" name="seo_author"  class="form-control" value="<?=$settings['seo_author']?>">
                            </div>
                    </div>

                    <div class="col-12">
                            <div class="form-group">
                                <label>Description (Açıklama/Hakkında)</label>
                                <textarea  name="seo_description" class="form-control"><?=$settings['seo_description']?></textarea>
                            </div>
                    </div>
            </div>
            
        </div>

    </div>

    <div class="card-footer">
        <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">Bilgileri Güncelle</button>
        </div>
    </div>

</form>

<?= $this->endSection() ?>