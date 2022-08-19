<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>


<div class="card shadow mb-4">
   
    <div class="card-header">
            <a href="<?=base_url("dashboard/medya/video-galeri/yeni")?>" class="m-0 font-weight-bold text-white btn btn-primary">
                Yeni Video Ekle</a>
     
           
    </div>   
    <div class="card-body">

    <div class="table-responsive">
                               
                                    
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead>
                                       <tr>
                                           <th>ID</th>
                                           <th>Video Başlığı</th> 
                                           <th>Aksiyon</th>
                                       </tr>
                                   </thead>
                                   <tbody id="orders">

                                       <?php foreach($videos as $item): ?>
                                       <tr id="comment_<?=$item['id']?>">
                                           <td><?=$item['id']?></td>

                                           <td><?=$item['title']?></td>

                                           <td>
                                               <div class="btn-group"> 
                                                   <a href="<?=base_url("dashboard/medya/video-galeri/duzenle/".$item['id'])?>"  class="btn btn-sm btn-info text-light"><i class="fa fa-pen"></i></a>
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



<?= $this->section('javascript') ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>



function youAreSure(id){
    Swal.fire({
        title: 'Videoyu Kaldırmak istediğinize emin misiniz?',
        showDenyButton: true,
        confirmButtonText: 'Vazgeç',
        denyButtonText: `Kaldır`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
        } else if (result.isDenied) {
           let path = "<?=base_url("dashboard/medya/video-galeri/sil")?>/";
           path += id;

           window.location = path;
        }
    })
}

</script>

<?= $this->endSection() ?>