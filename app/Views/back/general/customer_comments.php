<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>


<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?=base_url("dashboard/kurumsal/musteri-yorumlari/ekle")?>" class="m-0 font-weight-bold text-white btn btn-primary">Yeni Müşteri yorumu ekle</a>
                            <h6 class="m-0 font-weight-bold float-right text-primary"><?=( count($comments) > 0 ? count($comments).' müşteri yorumu listelendi.' : 'Hiç müşteri yorumu bulunamadı.')?> </h6>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               
                                    
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Resim</th>
                                            <th>Müşteri Adı</th>    
                                            <th>Müşteri Ünvanı</th> 
                                            <th>Yıldız</th> 
                                            <th>Gösterilsin</th>
                                            <th>Aksiyon</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">

                                        <?php foreach($comments as $item): ?>
                                        <tr id="comment_<?=$item['id']?>">
                                            <td><i class="fa fa-arrows-alt handle" style="cursor:move;"></i></td>

                                            <td><img src='<?=empty($item['image']) ? base_url("public/images/student-parent-hero.jpg") : base_url("public/images/customer/".$item['image'])?>' height="50" width="50"/></td>
                                        
                                            <td><?=$item['name']?></td>
                                            <td><?=$item['subname']?></td>
                                            <td>
                                                <?php for($i = 1 ; $i <= min(5,$item['star']);$i++ ): ?>
                                                    ✰
                                                <?php endfor;?>
                                            </td>
                                            
                                            <td>
                                                <input type="checkbox" class="toggle-event" data-commentid="<?=$item['id']?>" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" data-toggle="toggle"  <?=($item['active'] ? 'checked' : '')?>  />
                                            </td>
                                    
                                            <td>
                                                <div class="btn-group"> 
                                                    <a href="<?=base_url("dashboard/kurumsal/musteri-yorumlari/duzenle/".$item['id'])?>"  class="btn btn-sm btn-info text-light"><i class="fa fa-pen"></i></a>
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

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?= $this->endSection() ?>



<?= $this->section('javascript') ?>


<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>

$("#orders").sortable(
    {
        handle:'.handle',
        update:function(){
            const siralama = $("#orders").sortable('serialize');
            $.get("<?=base_url("dashboard/kurumsal/musteri-yorumlari/siralama")?>?"+siralama,function(data,status,http){

                if(http.status == 200)
                    toastr.success('Sıralama Ayarı.', 'Sıralama kaydedildi.')
                else
                    toastr.error('Sıralama Ayarı.', 'Bir sorun oluştu')

            });
        }
    }
);


$(function() {

    let adres = "<?=base_url("dashboard/kurumsal/musteri-yorumlari/toggle")?>";

    $('.toggle-event').change(function() {
    $.get(adres,{id:$(this).data('commentid'),status:$(this).prop('checked')}).then(function(data,text,xhr){
        if(xhr.status === 200){
            toastr.success('Güncellendi', 'Kayıt güncellendi.')
        }
    });
    })
})


function youAreSure(id){
    Swal.fire({
        title: 'Müşteri yorumunu kaldırmak istediğinize emin misiniz?',
        showDenyButton: true,
        confirmButtonText: 'Vazgeç',
        denyButtonText: `Sil`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
        } else if (result.isDenied) {
           let path = "<?=base_url("dashboard/kurumsal/musteri-yorumlari/sil/")?>/";
           path += id;

           window.location = path;
        }
    })
}

</script>

<?= $this->endSection() ?>

