<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-4">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                <form method="post" action="<?=base_url("dashboard/blog/kategori/ekle")?>">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="">Kategori Adı</label>
                        <input type="text" name="category" required class="form-control" >
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm btn-block float-right">Ekle</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tüm Kategoriler</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                               
                                    
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı </th>
                                <th>Durum </th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list as $c): ?>
                            <tr>
                                <td><?=$c["title"]?></td>
                                <td><?=$c["total"]?></td>
                                <td>
                                    <input type="checkbox" class="toggle-event" data-categoryid="<?=$c['id']?>" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" data-toggle="toggle"  <?=($c["status"] == '1'? 'checked' :'')?> /></td>
                                <td>
                                    <a data-category-name="<?=$c['title']?>" data-category-slug="<?=$c['slug']?>" data-category-id="<?=$c['id']?>"  title="Kategoriyi düzenle" class="btn btn-sm btn-primary edit-click"><i class="fa fa-edit text-white"></i></a>
                                    <a data-category-name="<?=$c['title']?>" data-id="<?=$c['id']?>" data-category-count="0" title="Kategoriyi sil" class="btn btn-sm btn-danger remove-click"><i class="fa fa-times text-white"></i></a>

                                </td>
                                
                            </tr>
                            <?php endforeach ?>
                                                        
                        </tbody>
                    </table>
                  
                </div>
            </div>
        </div>
    </div>

</div>




  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="post" action="<?=base_url("dashboard/blog/kategoriler/duzenle")?>">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Düzenle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
       
                <?= csrf_field() ?>          
                <div class="form-group">
                    <label>Kategori Adı</label>
                    <input id="kategori" type="text" class="form-control" name="category" />
                    <input id="kategori_id" name="id" type="hidden" />
                </div>
                <div class="form-group">
                    <label>Kategori Slug</label>
                    <input id="slug" type="text" class="form-control" name="slug" />
                </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
          <input type="submit" class="btn btn-success" value="Kaydet" />
        </div>
    </form>
      </div>
    </div>
  </div>

<?= $this->endSection() ?>


<?= $this->section("css") ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?= $this->endSection() ?>



<?= $this->section("javascript") ?>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
$(".edit-click").click(function(){
        let id = $(this).data('category-id');
        let name = $(this).data('category-name');
        let slug = $(this).data('category-slug');

        $("#kategori").val(name);
        $("#slug").val(slug);
        $("#kategori_id").val(id);

        $("#editModal").modal();
       
});

$(".remove-click").click(function(){

    let id = this.dataset.id;
    Swal.fire({
        title: 'Silmek istediğinize emin misiniz?',
        showDenyButton: true,
        confirmButtonText: 'Vazgeç',
        denyButtonText: `Sil`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
        } else if (result.isDenied) {
           let path = "<?=base_url("dashboard/blog/kategoriler/sil")?>/";
           path += id;

           window.location = path;
        }
    })
       
});


$(function() {

    let adres = "<?=base_url("dashboard/blog/kategori/toggle")?>";

    $('.toggle-event').change(function() {
        $.get(adres,{id:$(this).data('categoryid'),status:$(this).prop('checked')}).then(function(data,text,xhr){
            if(xhr.status === 200){
                toastr.success('Güncellendi', 'Kayıt güncellendi.')
            }
        });
    })
})

</script>
<?= $this->endSection() ?>
