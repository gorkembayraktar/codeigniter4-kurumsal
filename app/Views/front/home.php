<?= $this->extend("front/layouts/master")?>



<?= $this->section('content') ?>


    <?php foreach($siralama as $item): ?>
        <?php if($item['widget'] == 'about_section'):?>
            <?= view('front/widgets/'.$item['widget'],['data' => $item['features']]) ?>
        <?php else: ?>
            <?= $this->include('front/widgets/'.$item['widget']) ?>
        <?php endif ?>
    <?php endforeach?>

 
<?= $this->endSection() ?>