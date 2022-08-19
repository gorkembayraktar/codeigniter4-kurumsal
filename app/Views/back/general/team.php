<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>


<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?=base_url("dashboard/kurumsal/ekibimiz/yeni")?>" class="m-0 font-weight-bold text-white btn btn-primary">Yeni Üye Ekle</a> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               
                                    
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Resim</th>
                                            <th>Ünvan</th> 
                                            <th>Ad Soyad</th>    
                                            <th>Sosyal Medya</th> 
                                            <th>Aksiyon</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">

                                        <?php foreach($teams as $item): ?>
                                        <tr id="slider_<?=$item['id']?>">
                                            <td><i class="fa fa-arrows-alt handle" style="cursor:move;"></i></td>
                                            <td>
                                                <?php if(!empty($item['image'])): ?>
                                                <img src='<?=base_url("public/images/teams/".$item['image'])?>' height="50" width="50"/>
                                                <?php endif;?>
                                            </td>
                                        
                                            <td><?=$item['degree']?></td>
                                            <td><?=$item['fullname']?></td>
                                            <td>
                                                <?php if(!empty($item['socials'])): ?>

                                                <?php foreach(json_decode($item['socials'],true) as $social => $links):?>
                                                        <?php foreach($links as $link): ?>
                                                            <a href="<?=$link?>" target="_blank"><i class="fab fa-<?=$social?>"></i></a>
                                                        <?php endforeach?>
                                                <?php endforeach?>
                                                <?php else: ?>
                                                    -
                                                <?php endif ?>

                                            </td>
                                        
                                    
                                            <td>
                                                <div class="btn-group"> 
                                                    <a href="<?=base_url("dashboard/kurumsal/ekibimiz/duzenle/".$item['id'])?>"  class="btn btn-sm btn-info text-light"><i class="fa fa-pen"></i></a>
                                                   <!-- route http de tanımlı name ile gelir -->
                                                    <a href="#" onclick="youAreSure(<?=$item['id']?>)" class="btn btn-sm btn-danger text-light"><i class="fa fa-times"></i></a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php endforeach ?> 
                                    </tbody>
                                </table>
                              
                            </div>
                        </div>
    </div>



<?= $this->endSection() ?>


<?= $this->section('css') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?= $this->endSection() ?>





<?= $this->section("javascript") ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

function youAreSure(id){
    Swal.fire({
        title: 'Slider\'ı Kaldırmak istediğinize emin misiniz?',
        showDenyButton: true,
        confirmButtonText: 'Vazgeç',
        denyButtonText: `Sil`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
        } else if (result.isDenied) {
           let path = "<?=base_url("dashboard/kurumsal/ekibimiz/sil")?>/";
           path += id;

           window.location = path;
        }
    })
}

</script>

<?= $this->endSection() ?>


