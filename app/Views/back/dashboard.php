<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>


<div class="row">
    <div class="col-md-6">

        <div class="card shadow mb-4">

            <div class="card-header">
                Anasayfa Bölümleri
                <button class="btn btn-info float-right" data-toggle="modal" data-target="#editModal">Bölüm Oluştur</button>
            </div>      
            <div class="card-body">
            
                <ul class="list-group" id="orders"> 
                    <?php foreach($list as $item): ?>
                    <li id="order_<?=$item['id']?>" class="list-group-item handle">
                        <i class="fa fa-arrows-alt handle ui-sortable-handle" style="cursor:move;"></i>
                        <?=$item['section']?> 
                        <span class="float-right"> <input type="checkbox" class="toggle-event" data-sectionid="<?=$item['id']?>" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" data-toggle="toggle" <?=$item['active'] ? 'checked': ''?>  />
                        </span>
                        <?php if(!$item['fixed']): ?>
                            <button class="btn btn-info" onclick="editItem(<?=$item['id']?>)"><i class="fa fa-pen"></i></button>
                            <button class="btn btn-danger" onclick="areYouSure(<?=$item['id']?>,order_<?=$item['id']?>);"><i class="fa fa-times"></i></button>
                        <?php elseif($item['field'] == 1):?>
                            <button class="btn btn-info" onclick="editItemField(<?=$item['id']?>)"><i class="fa fa-pen"></i></button>
                        <?php else: ?>
                            <button class="btn btn-info" onclick="editItemElite(<?=$item['id']?>)"><i class="fa fa-pen"></i></button>
                        <?php endif ?>
                    </li>
                    <?php endforeach ?>
                    
                </ul>

            </div>


        </div>

    </div>
    <div class="col-md-6">

        <div class="card shadow mb-4">

            <div class="card-header">
                Birincil Menü
            </div>      
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group connectedSortable" id="orders_menu"> 

                            <?php foreach($menus as $menu):?>
                            <li id="order_<?=$menu['id']?>" class="list-group-item handle" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa fa-arrows-alt handle ui-sortable-handle" style="cursor:move;"></i>
                                <?=$menu['displayname']?>
                                <div class="children-item">
                                    <div class="form-group">
                                        <label for="inputsm">Görünür Adı (<?=$menu['name']?>)</label>
                                        <input class="form-control input-sm" id="inputsm" type="text" style="height:25px;">
                                    </div>
                                    <button class="btn btn-sm btn-outline-success">Güncelle</button>
                                </div>
                              
                                <?php if($menu['children']):?>
                                   
                                    <ul class="list-group connectedSortable mt-3 orders_menu_sub" id="orders_menu_sub_<?=$menu['id']?>" style="min-height:50px;"> 
                                        <?php foreach($menu['children'] as $children ): ?>
                                            <li id="sub_<?=$children['id']?>" class="list-group-item handle ui-sortable-depth">
                                                <i class="fa fa-arrows-alt handle ui-sortable-handle" style="cursor:move;"></i>
                                                <?=$children['displayname']?>
                                            </li>
                                        <?php endforeach ?>
                                            
                                    </ul>
                                <?php endif ?>
                                  
                            </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
                
            </div>

        </div>
        

    </div>


</div>




<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
    <form action="<?=base_url("dashboard/yeni-bolum")?>" method="POST" class="form__content" enctype="multipart/form-data">
        <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Yeni Bölüm Oluştur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Bölüm Adı</span>
                        </div>
                        <input type="text"  name="section" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Başlık</span>
                        </div>
                        <input type="text" name="title" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
            </div>
           
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Alt Başlık</span>
                </div>
                <input type="text" name="subtitle" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Düğme</span>
                        </div>
                        <input type="text" name="buttonName" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Yönlendir</span>
                        </div>
                        <input type="text" name="buttonRedirect" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                
            </div>
            <div class="form-group">
                <div>
                    <span id="inputGroup-sizing-sm">İçerik</span>
                </div>
                <textarea name="content" class="form-control" id="summernote1" cols="30" rows="50"></textarea>
            </div>
           
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input name="image_1" type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
                
            </div>
            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input name="image_2" type="file" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
            </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-success" id="removeBtn">Oluştur!</button>
      </div>
</form>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
    <form action="<?=base_url("dashboard/bolum-update")?>" method="POST" class="form__content" enctype="multipart/form-data">
        <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bölümü Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Bölüm Adı</span>
                        </div>
                        <input type="text" id="updatesection" name="section" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Başlık</span>
                        </div>
                        <input type="hidden" id="updateid" name="customid" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        <input type="text" id="updatetitle" name="title" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
            </div>
           
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Alt Başlık</span>
                </div>
                <input type="text" id="updatesubtitle" name="subtitle" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Düğme</span>
                        </div>
                        <input type="text" name="buttonName" id="updateBtnName" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Yönlendir</span>
                        </div>
                        <input type="text" name="buttonRedirect" id="updateBtnRedirect" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                
            </div>
            <div class="form-group">
                <div>
                    <span id="inputGroup-sizing-sm">İçerik</span>
                </div>
                <textarea class="form-control" id="updatecontent" name="content" aria-label="Small" aria-describedby="inputGroup-sizing-sm"></textarea>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input name="image_1" type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
                </div>
            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input name="image_2" type="file" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>

                   
            </div>
            <div id="imgList"></div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-success" id="removeBtn">Düzenle</button>
      </div>
</form>
    </div>
  </div>
</div>


<!-- Hizmetler -->
<div class="modal fade" id="updateModalElite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
    <form action="<?=base_url("dashboard/bolum-update")?>" method="POST" class="form__content" enctype="multipart/form-data">
        <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bölümü Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Bölüm Adı</span>
                        </div>
                        <input type="text" disabled id="elitesection" name="section" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Başlık</span>
                        </div>
                        <input type="hidden" id="eliteid" name="customid" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        <input type="text" id="elitetitle" name="title" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
            </div>
           
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Alt Başlık</span>
                </div>
                <input type="text" id="elitesubtitle" name="subtitle" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
           
            <div class="form-group">
                <div>
                    <span id="inputGroup-sizing-sm">İçerik</span>
                </div>
                <textarea class="form-control" id="elitecontent" name="content" aria-label="Small" aria-describedby="inputGroup-sizing-sm"></textarea>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Arka plan görseli</span>
                </div>
                <div class="custom-file">
                    <input name="image_1" type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Resim seç</label>
                </div>
            </div>
            
            <div id="imgListElite"></div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-success" id="removeBtn">Düzenle</button>
      </div>
</form>
    </div>
  </div>
</div>




<!-- Field -->
<div class="modal fade" id="updateModalField" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
    <form action="<?=base_url("dashboard/bolum-update")?>" method="POST" class="form__content" enctype="multipart/form-data">
        <?= csrf_field() ?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bölümü Düzenle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Bölüm Adı</span>
                        </div>
                        <input disabled type="text" id="fieldsection" name="section" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Başlık</span>
                        </div>
                        <input type="hidden" id="fieldid" name="customid" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        <input type="text" id="fieldtitle" name="title" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
            </div>
           
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Alt Başlık</span>
                </div>
                <input type="text" id="fieldsubtitle" name="subtitle" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Arka plan görseli</span>
                </div>
                <div class="custom-file">
                    <input name="image_1" type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Resim seç</label>
                </div>
            </div>
            <div id="imgListfield"></div>

            <div class="row">
                <div class="col-12">
                    <?php for($i = 1; $i<=4;$i++):?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Başlık</span>
                                    </div>
                                    <input type="text" id="prop_title_<?=$i?>" name="field[title][]" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Sınıf</span>
                                    </div>
                                    <input type="text" id="prop_class_<?=$i?>" name="field[class][]" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">İçerik</span>
                                    </div>
                                    <input type="text" id="prop_content_<?=$i?>" name="field[content][]" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            
                        </div>
                    <?php endfor ?>
                    
                </div>
            </div>

        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <button type="submit" class="btn btn-success" id="removeBtn">Düzenle</button>
      </div>
</form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>


<?= $this->section('css') ?>
  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>

.children-item{
    display:none;
}

</style>

<?= $this->endSection() ?>



<?= $this->section("javascript") ?>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>


$('#summernote1').summernote({
        'height':300
  });

  $('#updatecontent').summernote({
        'height':300
  });


$("#orders").sortable(
    {
        handle:'.handle',
        update:function(){
            const siralama = $("#orders").sortable('serialize');
            $.post("<?=base_url("dashboard/section/order")?>",{siralama:decoder(siralama)}).then(function(data,status,http){

                if(http.status == 200)
                    toastr.success('Sıralama Ayarı.', 'Sıralama kaydedildi.')
                else
                    toastr.error('Sıralama Ayarı.', 'Bir sorun oluştu')

            });
        }
    }
);
$("#orders_menu, .orders_menu_sub").sortable(
    {
        connectWith: ".connectedSortable",
        handle:'.handle',
        update:function(){
            const siralama = $("#orders_menu").sortable('serialize');

            const list = decoderArray(siralama).map(function(item){
                item.children = $("#orders_menu_sub_"+item.id)[0] ? decoder($("#orders_menu_sub_"+item.id).sortable('serialize')) : null;
                return item;
            });
            
            $.post("<?=base_url("dashboard/menu/order")?>",{siralama:list}).then(function(data,status,http){
                toastr.success('Sıralama Ayarı.', 'Sıralama kaydedildi.')
            }).catch(function(data){
                toastr.error('Hata');
            });

            
        }
    }
).disableSelection();

function decoder(str){
    var data = str.split("&");

    var obj={};
    for(var key in data)
    {
        obj[key] = data[key].split("=")[1];
    }
    return obj;
}


function decoderArray(str){
    var data = str.split("&");

    var obj=[];
    for(var key in data)
    {
        obj[key] = {id: data[key].split("=")[1] };
    }
    return obj;
}

function areYouSure(id,field){

    Swal.fire({
        title: 'Bu alanı kaldırmak istiyor musunuz?',
        showDenyButton: true,
        confirmButtonText: 'Vazgeç',
        denyButtonText: `Sil`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            
        } else if (result.isDenied) {
            $.post("<?=base_url("dashboard/bolum-sil/")?>/"+id,function(data,status,http){
                toastr.success('Başarılı', data.success);
                field.remove();

            }).catch(function(data){
                toastr.error('Hata');
            });

        }
    })
}

function editItem(id){
    $.get("<?=base_url("dashboard/bolum/")?>/"+id,function(data,status,http){
        $("#updateid").val(data.data.id);
        $('#updatecontent').summernote('code',data.data.content)
        $("#updatetitle").val(data.data.title);
        $("#updatesection").val(data.data.section);
        $("#updatesubtitle").val(data.data.info);
        $("#updateBtnRedirect").val(data.data.props?.button?.redirect);
        $("#updateBtnName").val(data.data.props?.button?.name);

        if(data.data.props?.images){
            let html = data.data.props.images.map(function(image){
                return "<?=base_url("public/images/sections/")?>/"+image;
            }).map(function(image){
                return `<img src='${image}' width="150" />`;
            });
            $("#imgList").html(html);
        }

       
        $("#updateModal").modal();

    }).catch(function(data){
        toastr.error('Hata');
    });
}

function editItemElite(id){
    $.get("<?=base_url("dashboard/bolum/")?>/"+id,function(data,status,http){
        $("#eliteid").val(data.data.id);
        $('#elitecontent').summernote('code',data.data.content)
        $("#elitetitle").val(data.data.title);
        $("#elitesection").val(data.data.section);
        $("#elitesubtitle").val(data.data.info);

        if(data.data.props?.images){
            let html = data.data.props.images.map(function(image){
                return "<?=base_url("public/images/sections/")?>/"+image;
            }).map(function(image){
                return `<img src='${image}' width="150" />`;
            });
            $("#imgListElite").html(html);
        }

       
        $("#updateModalElite").modal();

    }).catch(function(data){
        toastr.error('Hata');
    });
}


function editItemField(id){
    $.get("<?=base_url("dashboard/bolum/")?>/"+id,function(data,status,http){
        $("#fieldid").val(data.data.id);
        $("#fieldtitle").val(data.data.title);
        $("#fieldsection").val(data.data.section);
        $("#fieldsubtitle").val(data.data.info);

        if(data.data.props?.images){
            let html = data.data.props.images.map(function(image){
                return "<?=base_url("public/images/sections/")?>/"+image;
            }).map(function(image){
                return `<img src='${image}' width="150" />`;
            });
            $("#imgListfield").html(html);
        }

        if(data.data.props.clases){

            data.data.props.clases.forEach(function(item,key){
                $("#prop_class_"+(key+1)).val(item.class);
                $("#prop_content_"+(key+1)).val(item.content);
                $("#prop_title_"+(key+1)).val(item.title);
            });

        }

       
        $("#updateModalField").modal();

    }).catch(function(data){
        toastr.error('Hata');
    });
}


$(function() {

    let adres = "<?=base_url("dashboard/section/toggle")?>";

    $('.toggle-event').change(function() {
    $.post(adres,{id:$(this).data('sectionid'),status:$(this).prop('checked')}).then(function(data,text,xhr){
        if(xhr.status === 200){
            toastr.success('Güncellendi', 'Kayıt güncellendi.')
        }
    }).catch(function(){
        toastr.error("Hata","");
    })
})
})

</script>

<?= $this->endSection() ?>