<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>



<form method="post" action="<?=base_url("dashboard/etkinlikler/yeni-ekle")?>" enctype="multipart/form-data">

    <?= csrf_field() ?>

    <div class="card shadow mb-4">

        <div class="card-header">
            Hizmet Ekle

            <div class="float-right">
                <div class="form-row">
                     <div class="col">
                        <select name="publish" class="form-control" style="display:inline-block">
                            <option value="0">Taslak Kaydet</option>
                            <option selected value="1">Yayınla</option>
                        </select>
                    </div>
                    <div class="col">
                        <button class="btn-sm btn-info">Kaydet</button>
                    </div>
                </div>
            
            </div>

        </div>      
        <div class="card-body">
        
            

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" name="title" reqired class="form-control" value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mini Resim</label>
                        <input type="file" name="image" reqired class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                        <div class="form-group">
                                    <label for="">İçerik</label>
                                    <textarea name="content" class="form-control" id="summernote" cols="30" rows="50"><?=set_value('content','')?></textarea>
                        </div>
                </div>


           
            </div>
              
            
        </div>

    </div>

</form>



<?= $this->endSection() ?>



<?= $this->section("css") ?>
  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


<?= $this->endSection() ?>


<?= $this->section("javascript") ?>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
$(document).ready(function() {
  $('#summernote').summernote({
        'height':300
  });
});
</script>


<?= $this->endSection() ?>