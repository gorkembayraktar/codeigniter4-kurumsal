<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>








    <div class="card shadow mb-4">

        <div class="card-header">
            Yeni Müşteri Yorumu Ekle
        </div>      

        <form method="post" action="<?=base_url("dashboard/kurumsal/musteri-yorumlari/ekle")?>" enctype="multipart/form-data">

        <?= csrf_field() ?>
        <div class="card-body">
        
            

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Adı Soyadı(*)</label>
                        <input type="text" name="name" reqired class="form-control" value="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Ünvanı / Veli (*)</label>
                        <input type="text" name="unvan" reqired class="form-control" value="">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Derecelendirme (Yıldız Sayısı)</label>
                        <select class="form-control" name="star">
                            <option value="1" >✰</option>
                            <option value="2">✰✰</option>
                            <option value="3">✰✰✰</option>
                            <option value="4">✰✰✰✰</option>
                            <option value="5" selected>✰✰✰✰✰</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Yorumu (*)</label>
                        <textarea class="form-control"  name="comment"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Resim</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

           
            </div>
              
            
        </div>

        

        <div class="card-footer">
            <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-success ">Yorumu Ekle</button>
            </div>

        </div>

        </form>

    </div>



   



<?= $this->endSection() ?>