<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>



<form method="post" action="<?=base_url("dashboard/etkinlikler/duzenle/".$event['id'])?>" enctype="multipart/form-data">

    <?= csrf_field() ?>

    <div class="card shadow mb-4">

        <div class="card-header">
            <?=$title?>

            <div class="float-right">
                <div class="form-row">
                     <div class="col">
                        <select name="publish" class="form-control" style="display:inline-block">
                            <option <?=$event["publish"] == "0" ? 'selected' : ''?> value="0">Taslak Kaydet</option>
                            <option <?=$event["publish"] == "1" ? 'selected' : ''?> value="1">Yayınla</option>
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
                        <input type="text" name="title" reqired class="form-control" value="<?=$event["title"]?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            Mini Resim 
                            <?php if(!empty($event['image'])): ?> 
                            <a onclick="return confirm('Dikkat değişikliler kaybolacak')" href="<?=base_url("dashboard/etkinlikler/resimsil/".$event['id'])?>">(Mini resmi kaldır)</a>
                            <?php endif ?>
                        </label>
                        <?php if(!empty($event['image'])): ?> 
                        <img src="<?=base_url("public/images/events/".$event['image'])?>" width="100%" height="150">
                        <?php endif ?>
                        <input type="file" name="image" reqired class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                        <div class="form-group">
                                    <label for="">İçerik</label>
                                    <textarea name="content" class="form-control" id="summernote" cols="30" rows="50"><?=$event["content"]?></textarea>
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