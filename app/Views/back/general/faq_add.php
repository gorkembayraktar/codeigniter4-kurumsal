<?= $this->extend("back/layouts/master")?>



<?= $this->section('content') ?>


<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            Yeni Soru/Cevap Ekle
                        </div>
                        <div class="card-body">

                            <form method="post" action="<?=base_url("dashboard/kurumsal/sikca-sorulanlar/ekle")?>">

                                <?= csrf_field() ?>

                            
                                

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Soru</label>
                                            <input type="text" name="soru" required class="form-control" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Cevap</label>
                                            <textarea  name="cevap" required class="form-control">

                                            </textarea>
                                        </div>
                                    </div>



                                </div>



                                <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-success ">Yeni soru cevap ekle</button>
                                </div>

                            </form>
                    </div>

</div>




<?= $this->endSection() ?>