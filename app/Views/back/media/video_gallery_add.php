<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>

<form method="post" action="<?=base_url("dashboard/medya/video-galeri/yeni")?>">
    <?= csrf_field() ?>

<div class="card shadow mb-4">
   
    <div class="card-header">
          Yeni video ekle 
    </div>   
    <div class="card-body">
        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <label>Video Başlığı</label>
                    <input type="text" name="title" reqired class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>İframe</label>
                    <textarea type="text" name="iframe" required class="form-control"></textarea>
                </div>
            </div>

            


        </div>
        

    </div>

    <div class="card-footer">
        <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success ">Yeni video ekle</button>
        </div>
    </div>

</div>

</form>



<?= $this->endSection() ?>