<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>




<form method="post" action="<?=base_url("dashboard/profil/sifre")?>" enctype="multipart/form-data">

    <?= csrf_field() ?>

    <div class="card shadow mb-4">

        <div class="card-header">
            Profil Ayarları
        </div>      
        <div class="card-body">
        
            

            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Mevcut Şifreniz</label>
                        <input type="password" name="current" reqired class="form-control" value="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Yeni Şifreniz</label>
                        <input type="password" name="password" reqired class="form-control" value="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Yeni Şifreniz</label>
                        <input type="password" name="passwordcheck" reqired class="form-control" value="">
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