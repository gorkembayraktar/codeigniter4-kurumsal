<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>



<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?=base_url("dashboard/blog/yeni-ekle")?>" class="m-0 font-weight-bold mr-3 btn btn-outline-primary">Yeni Yazı Ekle</a>
                            <h6 class="m-0 font-weight-bold float-right text-primary"><?=( count($list) > 0 ? count($list).' yazı listelendi.' : 'Hiç yazı bulunamadı.')?> </h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-5">
                                <div>
                                    <ul class="custom-items">
                                        <li><a href="?status=all">Tümü (<?=$statics['all']?>)</a></li>
                                        <li><a href="?status=publish">Yayımlanmış (<?=$statics['publish']?>)</a></li>
                                        <li><a href="?status=draft">Taslak (<?=$statics['draft']?>)</a></li>
                                        <?php if($statics['trash'] > 0): ?>

                                        <li><a href="?status=trash">Çöp (<?=$statics['trash']?>)</a></li>

                                        <?php endif ?>
                                    </ul>
                                </div>

                            </div>    

                            <div class="table-responsive">
                               
                                    
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Başlık</th> 
                                            <th>Yazar</th>  
                                            <th>Kategoriler</th>  
                                            <th>Durum</th>
                                            <th>Tarih</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orders">

                                        <?php foreach($list as $item): ?>
                                        <tr id="custom_<?=$item['blogid']?>">
                                            <td><div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">

                                                </div</td>
    
                                            <td class="blog-title">
                                                <a href="<?=base_url("dashboard/blog/duzenle/".$item['blogid'])?>"><?=htmlspecialchars($item['title'])?></a>

                                                <div class="blog-detail">


                                                    <p><?=substr( strip_tags($item['content']),0,300 )?><p>
                                                    <div class="actions">
                                                        <?php if($item['publish'] == -1): ?>
                                                            <a href="<?=base_url("dashboard/blog/duzenle/".$item['blogid'])?>">Kurtar</a>
                                                            |
                                                            <a href="<?=base_url("dashboard/blog/sil/".$item['blogid'])?>" class="text-danger">Kalıcı Sil</a>
                                                        <?php else: ?>

                                                            <a href="<?=base_url("dashboard/blog/duzenle/".$item['blogid'])?>">Düzenle</a>
                                                            |
                                                            <a href="<?=base_url("dashboard/blog/cop/".$item['blogid'])?>" class="text-danger">Çöp</a>
                                                            |
                                                            <?php if($item['publish'] == 0): ?>
                                                            <a href="<?=base_url("blog/".$item['slug'])?>" target="_blank">Ön İzleme</a>
                                                            <?php else: ?>
                                                                <a href="<?=base_url("blog/".$item['slug'])?>" target="_blank">Görüntüle</a>
                                                            <?php endif ?>
                                                        <?php endif ?>

                                                    </div>

                                                </div>
                                            
                                            </td>

                                            <td><?=$item['username']?></td>

                                            <td>

                                                <?php foreach($item['kategoriler'] as $c):?>
                                                    <span class="badge badge-secondary"><?=$c['title']?></span> 
                                                <?php endforeach ?>
                                            </td>


                                            <td>
                                                <?php if($item['publish'] == 1): ?>
                                                    <span class="badge badge-success">Yayınlandı</span>
                                                <?php else:?>
                                                    <span class="badge badge-secondary">Taslak</span>
                                                <?php endif ?>
                                            </td>

                                            <td>
                                                <?php if($item['publish'] == 1): ?>
                                                    <?php if(empty($item['updated_at'])): ?> 
                                                        Yayımlanmış <br>
                                                        <?=$item["created_at"]?>
                                                    <?php else: ?>
                                                        Son düzenleme <br>
                                                        <?=$item["updated_at"]?>
                                                    <?php endif ?>
                                                <?php else:?>
                                                    <?php if(empty($item['updated_at'])): ?> 
                                                        Oluşturuldu <br>
                                                        <?=$item["created_at"]?>
                                                    <?php else: ?>
                                                        Son düzenleme <br>
                                                        <?=$item["updated_at"]?>
                                                    <?php endif ?>
                                                   
                                                <?php endif ?>
                                            </td>
                                        </tr>
                                        
                                        <?php endforeach ?> 
                                    </tbody>
                                </table>
                              
                            </div>
                        </div>
    </div>



<?= $this->endSection() ?>


