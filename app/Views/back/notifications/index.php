<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>


<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>İsim</th>
                                            <th>Mail Adresi</th>    
                                            <th>Konu Başlığı</th> 
                                            <th>Gönderim  tarihi</th> 
                                            <th>Aksiyon</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach($list as $item): ?>
                                        <tr style="<?=$item['isRead'] ? '' : 'background-color:#ddc' ?>">
                                            <td><?=$item['id']?></td>
                                            <td><?=$item['name']?></td>
                                            <td><?=$item['mail']?></td>
                                            <td><?=$item['subject']?></td>
                                            <td><?=$item['created_at']?></td>
                                            <td>
                                                <div class="btn-group"> 
                                                <a href="<?=base_url("dashboard/bildirimler/".$item['id'])?>" class="btn btn-sm btn-success text-light"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </td>
                                          
                                        </tr>
                                    <?php endforeach ?>
                                        
                                                                               
    
                                    </tbody>
                                </table>

<?= $this->endSection() ?>


