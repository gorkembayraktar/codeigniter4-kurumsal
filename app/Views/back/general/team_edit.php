<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>



<form method="post" action="<?=base_url("dashboard/kurumsal/ekibimiz/duzenle/".$team['id'])?>" enctype="multipart/form-data">

    <?= csrf_field() ?>

    <div class="card shadow mb-4">

        <div class="card-header">
            Sayfa Oluştur

            <div class="float-right">
                <div class="form-row">
                    <div class="col">
                        <button class="btn btn-info">Düzenle</button>
                    </div>
                </div>
            
            </div>

        </div>      
        <div class="card-body">
        
            

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ad Soyad</label>
                        <input type="text" name="fullname" reqired class="form-control" value="<?=$team['fullname']?>">
                    </div>
                    <div class="form-group">
                        <label>Ünvan</label>
                        <input type="text" name="degree" reqired class="form-control" value="<?=$team['degree']?>">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mini Resim</label>
                        <input type="file" name="image" reqired class="form-control">
                        <?php if(!empty($team['image'])): ?>
                            <img src="<?=base_url("public/images/teams/".$team['image'])?>" height="100" />
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Sosyal Medya</label>
                        <div class="row">
                            <div class="col">
                            <select id="selectType" name="type" class="form-control">
                                <option>İnstagram</option>
                                <option>Facebook</option>
                                <option>Twitter</option>
                                <option>Youtube</option>
                            </select>
                            </div>
                            <div class="col">
                                <button class="btn btn-sm btn-primary" type="button" onclick="add()">Ekle</button>
                            </div>
                            
                        </div>

                        <div id="socialList">
                            <?php if(!empty($team['socials'])): ?>

                                <?php foreach(json_decode($team['socials'],true) as $social => $links):?>
                                        <?php foreach($links as $key => $link): ?>
                                            <div  class="form-inline mb-2" id="<?=$social.$key?>"><?=$social?><input type="text" name="social[<?=$social?>][]" value="<?=$link?>" class="form-control"><button class="btn btn-sm btn-danger" onclick="<?=$social.$key?>.remove()" type="button">&times;</button></div>
                                        <?php endforeach?>
                                <?php endforeach?>
                            <?php endif ?>
                        
                        </div>
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

function add(){

    var uniq = 'id' + (new Date()).getTime();
    let val = document.querySelector("#selectType").value;
    val = val.toLocaleLowerCase('tr-TR')
    $("#socialList").append(`<div  class="form-inline mb-2" id="${uniq}">${val}<input type="text" name="social[${val}][]" class="form-control"><button class="btn btn-sm btn-danger" onclick="${uniq}.remove()" type="button">&times;</button></div>`);
}

</script>


<?= $this->endSection() ?>