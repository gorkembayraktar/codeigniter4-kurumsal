<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>




<form method="post" action="<?=base_url("dashboard/profil")?>" enctype="multipart/form-data">

    <?= csrf_field() ?>

    <div class="card shadow mb-4">

        <div class="card-header">
            Profil Ayarları
        </div>      
        <div class="card-body">
        
            

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Adınız</label>
                        <input type="text" name="name" reqired class="form-control" value="<?=$user["name"]?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kullanıcı Adınız</label>
                        <input type="text" required pattern="[A-Za-z0-9]{3,16}" name="username" class="form-control" value="<?=$user["username"]?>">
                        <div class="invalid">
                            <p>En az 3 en fazla 16 karakter olabilir</p>
                            <p>Boşluk kullanılamaz</p>
                            <p>Türkçe karakterler kullanılamaz.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Adresiniz</label>
                        <input type="email" name="email" required class="form-control" value="<?=$user["email"]?>">
                        <div class="invalid">
                            <p>Mail adresi @ bulunmalıdır.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Şifreniz </label>
                        <input disabled class="form-control" value="*************">
                        <a href="<?=base_url("dashboard/profil/sifre")?>" style="float:right"><span style="font-size:14px">Şife bilgilerimi değiştir</span></a>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label>Profil Fotoğrafı Seç</label>
                        <?php if(!empty($user['image'])): ?>
                        <img width="100" height="50" src="<?=base_url("public/back/user/".$user['image'])?>">
                        <?php endif ?>
                        
                        <input type="file" name="profil" class="form-control">
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