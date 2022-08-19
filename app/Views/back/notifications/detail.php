<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header">
        <a href="<?=base_url("dashboard/bildirimler")?>" class="btn btn-outline-info text-sm"> Geri Git</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                Mail Gönderen
            </div>
            <div class="col-9">
                <?=strip_tags($detail['name'])?> (<?=strip_tags($detail['mail'])?>)
                <p><small><?=$detail['created_at']?></small></p>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                Konu Başlığı
            </div>
            <div class="col-9">
                <?=strip_tags($detail['subject'])?>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                Konu içeriği
            </div>
            <div class="col-9">
                <?=strip_tags($detail['subject'])?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                Detaylar
                <p>ip : <?=$detail['ip_adress']?></p>
                <p>cihaz : <?=strip_tags($detail['device_info'])?></p>
                <?php if(isset($detail['ip_info_json']['city'])): ?>
                <p>Şehir:  <?=$detail['ip_info_json']['city']?></p>
                <?php endif ?>
            </div>
            
        </div>
        
        
    </div>
</div>

<?= $this->endSection() ?>


