<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>

<form method="post" action="<?=base_url("dashboard/ayarlar/mail")?>">

    <?= csrf_field() ?>

    <div class="card shadow mb-4">

        <div class="card-header">
           İletişim sayfasında mail göndermek için kullanılacaktır.
        </div>      
        <div class="card-body">

           
            

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Host</label>
                        <input type="text" name="host"  class="form-control" value="<?=$data['host']?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Port</label>
                        <input type="number" name="port" class="form-control" value="<?=$data['port']?>">
                    </div>
                </div>

             
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" value="<?=$data['email']?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Şifre</label>
                        <input type="password" name="password" class="form-control" value="<?=$data['password']?>"  autocomplete="new-password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Secure</label>
                        <select class="form-control" name="secure"><option value="tls" <?=($data['secure'] == 'tls' ? 'selected': '')?>>tls (ssl) </option></select>
                    </div>
                </div>


                
                <div class="col-md-12">
                            <div class="form-group">
                                <label>Reply</label>
                                <input type="email" name="replyMail" class="form-control" value="<?=$data['replyMail']?>" >
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