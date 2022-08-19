
            
        </div>
        <!-- End of Main Content -->
            
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SmurfWeb 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ayrılmak istiyor musunuz?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Oturum bilgilerini sonlandırmak için çıkış yap butonuna basınız.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Vazgeç</button>
                    <a class="btn btn-primary" href="<?=site_url("dashboard/logout")?>">Çıkış yap</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url('public/back/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?=base_url('public/back/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url('public/back/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url('public/back/js/sb-admin-2.min.js')?>"></script>

    <!-- Page level plugins -->
    <script src="<?=base_url('public/back/vendor/chart.js/Chart.min.js')?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?=base_url('public/back/js/demo/chart-area-demo.js')?>"></script>
    <script src="<?=base_url('public/back/js/demo/chart-pie-demo.js')?>"></script>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <script type="text/javascript" src="<?=base_url('public/back/js/toastr_config.js')?>"></script>



    <script type="text/javascript">
             <?php if(!empty(session()->getFlashData('fail'))): ?>    
                toastr.error(`<?=session()->getFlashData('fail')?>`, '', []);
            <?php elseif(!empty(session()->getFlashData('success'))): ?>
                toastr.success(`<?=session()->getFlashData('success')?>`, '', []);
            <?php elseif(!empty(session()->getFlashData('info'))): ?>
                toastr.info(`<?=session()->getFlashData('info')?>`, '', []);
                
            <?php endif ?>
    </script>

    <?= $this->renderSection('javascript') ?>



</body>

</html>