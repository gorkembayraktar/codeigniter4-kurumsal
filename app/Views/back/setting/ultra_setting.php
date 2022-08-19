<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>

<form action="<?=base_url("dashboard/ayarlar/gelismis")?>" method="POST">

<?= csrf_field() ?>


<div class="card shadow mb-4">

    <div class="card-header">
    <p><span class="text-danger">Dikkat</span> bu işlemin sonucunda web siteniz erişilemez duruma gelebilir. Program yöneticinize danışın.</p>
    </div>      
    <div class="card-body">
           
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-4">
                            CSS Kodlarınız
                        </div>
                        <div class="col-8">
                        <textarea name="css" class="form-control" rows="5" placeholder=".example {font-size:1rem;}"><?=$data['html_css']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-4">
                            Javascript Kodlarınız
                        </div>
                        <div class="col-8">
                        <textarea name="js" class="form-control" rows="5" placeholder="document.body.onclick = function(){};"><?=$data['html_js']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="row">
                        <div class="col-4">
                        &#60;head&#62;   &#60;/head&#62; 
                        tagları arasına dahil edebileceğiniz css/javascript referansları.
                        <p>(Google anlytics scriptini ekleyebilirsiniz.)</p>
                        </div>
                        <div class="col-8">
                        <textarea name="head" class="form-control" rows="5"><?=$data['html_head']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                        &#60;body&#62;   &#60;/body&#62; 
                        tagları arasına dahil edebileceğiniz komutlar 
                        </div>
                        <div class="col-8">
                        <textarea name="body" class="form-control" rows="5"><?=$data['html_body']?></textarea>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="card-footer">
        <button class="btn btn-block btn-success text-center">Güncelle</button>
    </div>

</div>

</form>

<?= $this->endSection() ?>