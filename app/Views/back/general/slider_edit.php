<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>




    <div class="card shadow mb-4">
        <form method="post" action="<?=current_url()?>" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="card-header">
           Düzenle
            | 
           <a href="<?=base_url("dashboard/kurumsal/slider")?>">Slider Listesini görüntüle</a>
        </div>      
        <div class="card-body">

                <div class="row">
                
                    <div class="col-md-6">
                        <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Slider Fotoğrafı</label>
                                        <input type="file"  name="slider" id="slider" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <img width="100%" id="preview" height="200" src="<?=!empty($slider["image"])  ? base_url("public/images/slider/".$slider['image']) :base_url("public/images/default-image.png")?>" />
                                </div>

                        </div>
                    
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Başlık(*)</label>
                                    <input type="text" required name="title" reqired class="form-control" value="<?=$slider["title"]?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alt Başlık</label>
                                    <input type="text" name="subtitle" reqired class="form-control" value="<?=$slider["subtitle"]?>">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>İçerik</label>
                                    <textarea name="content" class="form-control"><?=$slider["content"]?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Düğme</label>
                                            <input type="text" name="buttonName" class="form-control" value="<?=$slider["buttonName"]?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Yönlendir</label>
                                            <input type="text" name="buttonRedirect" class="form-control" value="<?=$slider["buttonRedirect"]?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    
                    


            
                </div>
            
                

               
            
        </div>

        <div class="card-footer">
                 <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-success ">Bilgileri Güncelle</button>
                </div>

        </div>
        </form>   
    </div>





<?= $this->endSection() ?>




<?= $this->section('css') ?>


<?= $this->endSection() ?>



<?= $this->section('javascript') ?>


<script>
const imgInp = document.querySelector("#slider");
const preview = document.querySelector("#preview");
imgInp.onchange = evt => {
  const [file] = imgInp.files
  if (file) {
    preview.src = URL.createObjectURL(file)
  }
}
</script>

<?= $this->endSection() ?>




