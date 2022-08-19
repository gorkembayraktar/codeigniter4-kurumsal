<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>








    <div class="card shadow mb-4">

        <div class="card-header">
            Müşteri Yorumu Düzenle
        </div>      

        <form method="post" action="<?=base_url("dashboard/kurumsal/musteri-yorumlari/duzenle/".$comment['id'])?>" enctype="multipart/form-data">

        <?= csrf_field() ?>
        <div class="card-body">
        
            

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Adı Soyadı(*)</label>
                        <input type="text" name="name" reqired class="form-control" value="<?=$comment['name']?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ünvanı / Veli (*)</label>
                        <input type="text" name="unvan" reqired class="form-control" value="<?=$comment['subname']?>">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Derecelendirme (Yıldız Sayısı)</label>
                        <select class="form-control" name="star">
                            <option value="1" <?=($comment['star'] == 1 ? 'selected' : '')?>>✰</option>
                            <option value="2"  <?=($comment['star'] == 2 ? 'selected' : '')?>>✰✰</option>
                            <option value="3"  <?=($comment['star'] == 3 ? 'selected' : '')?>>✰✰✰</option>
                            <option value="4"  <?=($comment['star'] == 4 ? 'selected' : '')?>>✰✰✰✰</option>
                            <option value="5"  <?=($comment['star'] == 5 ? 'selected' : '')?>>✰✰✰✰✰</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Yorumu (*)</label>
                        <textarea class="form-control"  name="comment"><?=$comment['comment']?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Resim</label>
                        
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <img width="200px" id="preview" height="200" src="<?=!empty($comment["image"])  ? base_url("public/images/customer/".$comment['image']) :base_url("public/images/student-parent-hero.jpg")?>" />
                </div>

           
            </div>
              
            
        </div>

        

        <div class="card-footer">
            <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-success ">Yorumu Düzenle</button>
            </div>

        </div>

        </form>

    </div>



   



<?= $this->endSection() ?>