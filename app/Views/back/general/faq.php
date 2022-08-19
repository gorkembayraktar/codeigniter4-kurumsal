<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>


<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?=base_url("dashboard/kurumsal/sikca-sorulanlar/ekle")?>" class="m-0 font-weight-bold text-white btn btn-primary">Yeni Soru/Cevap Ekle</a>
                            <h6 class="m-0 font-weight-bold float-right text-primary"><?=( count($list) > 0 ? count($list).' soru-cevap listelendi.' : 'Hiç soru-cevap bulunamadı.')?> </h6>
                            
                        </div>
                        <div class="card-body">

                                                    
                            <div id="accordion">

                                <?php foreach($list as $key => $item): ?>
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_<?=$item['id']?>" aria-expanded="true" aria-controls="collapseOne">
                                        <?=$item['title']?>
                                        </button>
                                    </h5>
                                    </div>

                                    <div id="collapse_<?=$item['id']?>" class="collapse <?=$key == 0 ? 'show' : ''?>" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <?=$item['content']?>
                                    </div>
                                    <div class="card-footer">
                                            <div class="btn-group"> 
                                                    <a href="<?=base_url("dashboard/kurumsal/sikca-sorulanlar/duzenle/".$item['id'])?>"  class="btn btn-sm btn-info text-light"><i class="fa fa-pen"></i></a>
                                                   <!-- route http de tanımlı name ile gelir -->
                                                    <a href="#" onclick="youAreSure(<?=$item['id']?>)" class="btn btn-sm btn-danger text-light"><i class="fa fa-times"></i></a>
                                                    
                                            </div>
                                    </div>
                                    </div>
                                </div>

                                <?php endforeach ?>
                       
                            </div>

                        </div>

</div>




<?= $this->endSection() ?>






<?= $this->section('css') ?>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?= $this->endSection() ?>



<?= $this->section('javascript') ?>




<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>



function youAreSure(id){
    Swal.fire({
        title: 'Yorumu silmek istediğinize emin misiniz?',
        showDenyButton: true,
        confirmButtonText: 'Vazgeç',
        denyButtonText: `Sil`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
        } else if (result.isDenied) {
           let path = "<?=base_url("dashboard/kurumsal/sikca-sorulanlar/sil/")?>/";
           path += id;

           window.location = path;
        }
    })
}

</script>

<?= $this->endSection() ?>


