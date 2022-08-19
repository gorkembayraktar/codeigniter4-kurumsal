<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>

<div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <a href="<?=base_url("dashboard/kurumsal/sayfalar/yeni")?>" class="m-0 font-weight-bold text-white btn btn-primary">Yeni Sayfa Oluştur</a>
                            <h6 class="m-0 font-weight-bold float-right text-primary">4 sayfa bulundu.</h6>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               
                                    
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Sayfa Resim</th>
                                            <th>Sayfa Başlığı</th>    
                                            <th>Durum</th>
                                            <th>Aksiyon</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">
                                        <?php foreach($list as $item):?>
                                        <tr id="page_<?=$item['id']?>">
                                            <td></td>
                                            <td>
                                                <?php if(!empty($item['image'])): ?>
                                                <img src='<?=base_url("public/images/pages/".$item["image"])?>' height="50" width="50"/>
                                                <?php else: ?>
                                                Eklenmedi.
                                                <?php endif ?>
                                            </td>
                                        
                                            <td><?=$item['title']?></td>
                                            <td><input type="checkbox" class="toggle-event" data-pageid="<?=$item['id']?>" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" data-toggle="toggle"  <?=$item['active'] ? 'checked' : ''?>  /></td>
                                    
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" target="_blank" class="btn btn-sm btn-success text-light"><i class="fa fa-eye"></i></a>
                                                    <a href="<?=base_url("dashboard/kurumsal/sayfalar/guncelle/".$item['id'])?>"  class="btn btn-sm btn-info text-light "><i class="fa fa-pen"></i></a>
                                                   <!-- route http de tanımlı name ile gelir -->
                                                    <button data-pageid="<?=$item['id']?>"   class="btn btn-sm btn-danger text-light remove-click"><i class="fa fa-times"></i></button>
                                                    
                                                </div>
                                            </td>
                                        </tr>

                                        <?php endforeach ?>
                       
                                                                                
                                    </tbody>
                                </table>
                              
                            </div>
                        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bu Sayfayı silmek istediğinize emin misiniz?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="button" class="btn btn-danger" id="removeBtn">Evet, Sil!</button>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>


<?= $this->section('css') ?>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>


<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<script>

$(".remove-click").click(function(){

        const id = this.dataset.pageid;

        $("#removeBtn").attr("selectedId",id);

       $("#editModal").modal();
       
});

$("#removeBtn").click(function(){
    const id = $("#removeBtn").attr("selectedId");
    window.location = "<?=base_url("dashboard/kurumsal/sayfalar/sil")?>/"+id;
});

$(function() {

let adres = "<?=base_url("dashboard/kurumsal/sayfalar/toggle")?>";

$('.toggle-event').change(function() {
$.get(adres,{id:$(this).data('pageid'),status:$(this).prop('checked')}).then(function(data,text,xhr){

    toastr.success('Güncellendi', 'Kayıt güncellendi.')

}).catch(async function(data,text,xhr){
    toastr.error('Hata', data.responseJSON.error);
})
})
})


</script>

<?= $this->endSection() ?>