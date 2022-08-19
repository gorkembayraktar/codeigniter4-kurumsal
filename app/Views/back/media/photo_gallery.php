<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <form id="fileUpload"  method="post" action="<?=base_url("dashboard/medya/foto-galeri")?>" enctype="multipart/form-data">
    <div class="card-header">
        Profil Resimleri
     
            <button class="float-right btn-success bb-custom-file">
                <i class="fas fa-file-upload"></i> Resim yükle
                <input type="file" id="imgInp" name="image" class="form-control">
            </button>

    </div>   
    </form>   
    <div class="card-body">
            <div class="row">

                <?php foreach($list as $item): ?>
                <div class="col-6 col-md-3 mb-3 image-container">
                    <img width="100%" height="200" class="rounded" src="<?=base_url("public/images/gallery/".$item['image'])?>" />
                    <div class="features">
                        <span class="pt-3 pl-4 text-sm"><?=$item['created_at']?></span>
                        <a href="<?=base_url("dashboard/medya/foto-galeri/sil/".$item['id'])?>" class="btn btn-sm btn-danger remove-btn">&times;</a>
                    </div>
                </div>

                <?php endforeach ?>

            </div>
    </div>
    <div class="card-footer">

    </div>

</div>






<?= $this->endSection() ?>



<?= $this->section('javascript') ?>

<script>

const imgInp = document.querySelector("#imgInp");
imgInp.onchange = evt => {
 
    document.querySelector("#fileUpload").submit();
  
}

</script>


<?= $this->endSection() ?>