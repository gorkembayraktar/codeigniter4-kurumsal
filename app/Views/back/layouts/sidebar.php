  <?php $request = \Config\Services::request(); ?>
  
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url("dashboard")?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><span style="">SmurfWeb</span></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?=base_url("dashboard")?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Yönetim Paneli</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Arayüz
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link <?=($request->uri->getSegment(2) == 'kurumsal' ? null : 'collapsed')?>" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kurumsal</span>
        </a>
        <div id="collapseTwo" class="collapse <?=($request->uri->getSegment(2) == 'kurumsal' ? 'show' : '')?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Bileşenler</h6>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'kurumsal' && $request->uri->getSegment(3) == 'slider' ? 'active' : null)?>" href="<?=base_url("dashboard/kurumsal/slider")?>">Slider</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'kurumsal' && $request->uri->getSegment(3) == 'musteri-yorumlari' ? 'active'  : null)?>" href="<?=base_url("dashboard/kurumsal/musteri-yorumlari")?>">Müşteri Yorumları</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'kurumsal' && $request->uri->getSegment(3) == 'ekibimiz' ? 'active' : null)?>" href="<?=base_url("dashboard/kurumsal/ekibimiz")?>">Ekibimiz</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'kurumsal' && $request->uri->getSegment(3) == 'sikca-sorulanlar'? 'active'  : null)?>" href="<?=base_url("dashboard/kurumsal/sikca-sorulanlar")?>">Sıkça Sorulanlar</a>
                <h6 class="collapse-header">Sayfalar</h6>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'kurumsal' && $request->uri->getSegment(3) == 'sayfalar' && $request->uri->getSegment(4) == '' ? 'active'  : null)?>" href="<?=base_url("dashboard/kurumsal/sayfalar")?>">Sayfalar</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'kurumsal' && $request->uri->getSegment(3) == 'sayfalar' &&  $request->uri->getSegment(4) == 'yeni' ? 'active'  : null)?>" href="<?=base_url("dashboard/kurumsal/sayfalar/yeni")?>">Yeni Sayfa</a>
            </div>
        </div>
    </li>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link <?=($request->uri->getSegment(2) == 'hizmetler' ? null : 'collapsed')?>" href="#" data-toggle="collapse" data-target="#collapseX"
            aria-expanded="true" aria-controls="collapseX">
            <i class="fas fa-fw fa-cog"></i>
            <span>Hizmetler</span>
        </a>
        <div id="collapseX" class="collapse <?=($request->uri->getSegment(2) == 'hizmetler' ? 'show' : '')?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'hizmetler' && $request->uri->getSegment(3) == '' ? 'active' : null)?>" href="<?=base_url("dashboard/hizmetler/")?>" href="<?=base_url("dashboard/hizmetler/")?>">Hizmetler</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'hizmetler' && $request->uri->getSegment(3) == 'yeni-ekle' ? 'active' : null)?>" href="<?=base_url("dashboard/hizmetler/yeni-ekle")?>">Yeni Hizmet Ekle</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link <?=($request->uri->getSegment(2) == 'etkinlikler' ? null : 'collapsed')?>" href="#" data-toggle="collapse" data-target="#collapseX2"
            aria-expanded="true" aria-controls="collapseX2">
            <i class="fas fa-fw fa-cog"></i>
            <span>Etkinlikler</span>
        </a>
        <div id="collapseX2" class="collapse <?=($request->uri->getSegment(2) == 'etkinlikler' ? 'show' : '')?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'etkinlikler' && $request->uri->getSegment(3) == '' ? 'active' : null)?>" href="<?=base_url("dashboard/etkinlikler/")?>">Etkinlikler</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'etkinlikler' && $request->uri->getSegment(3) == 'yeni-ekle' ? 'active' : null)?>" href="<?=base_url("dashboard/etkinlikler/yeni-ekle")?>">Yeni Etkinlik Ekle</a>
            </div>
        </div>
    </li>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link  <?=($request->uri->getSegment(2) == 'blog' ? null : 'collapsed')?>" href="#" data-toggle="collapse" data-target="#collapseX3"
            aria-expanded="true" aria-controls="collapseX3">
            <i class="fas fa-fw fa-cog"></i>
            <span>Blog</span>
        </a>
        <div id="collapseX3" class="collapse <?=($request->uri->getSegment(2) == 'blog' ? 'show' : '')?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'blog' && $request->uri->getSegment(3) == '' ? 'active' : null)?>" href="<?=base_url("dashboard/blog/")?>">Yazılar</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'blog' && $request->uri->getSegment(3) == 'yeni-ekle' ? 'active' : null)?>" href="<?=base_url("dashboard/blog/yeni-ekle")?>">Yeni Yazı Ekle</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'blog' && $request->uri->getSegment(3) == 'kategoriler' ? 'active' : null)?>" href="<?=base_url("dashboard/blog/kategoriler")?>">Kategoriler</a>
            </div>
        </div>
    </li>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link <?=($request->uri->getSegment(2) == 'medya' ? null : 'collapsed')?>" href="#" data-toggle="collapse" data-target="#collapseX4"
            aria-expanded="true" aria-controls="collapseX4">
            <i class="fas fa-fw fa-cog"></i>
            <span>Multi Medya</span>
        </a>
        <div id="collapseX4" class="collapse <?=($request->uri->getSegment(2) == 'medya' ? 'show' : '')?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'medya' && $request->uri->getSegment(3) == 'foto-galeri' ? 'active' : null)?>" href="<?=base_url("dashboard/medya/foto-galeri")?>">Foto Galeri</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'medya' && $request->uri->getSegment(3) == 'video-galeri' ? 'active' : null)?>" href="<?=base_url("dashboard/medya/video-galeri")?>">Video Galeri</a>
            </div>
        </div>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Site
    </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link <?=($request->uri->getSegment(2) == 'ayarlar' ? null : 'collapsed')?>" href="#" data-toggle="collapse" data-target="#collapseX5"
            aria-expanded="true" aria-controls="collapseX5">
            <i class="fas fa-fw fa-cog"></i>
            <span>Ayarlar</span>
        </a>
        <div id="collapseX5" class="collapse <?=($request->uri->getSegment(2) == 'ayarlar' ? 'show' : '')?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'ayarlar' && $request->uri->getSegment(3) == 'genel' ? 'active' : null)?>" href="<?=base_url("dashboard/ayarlar/genel")?>">Genel</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'ayarlar' && $request->uri->getSegment(3) == 'iletisim-bilgileri' ? 'active' : null)?>" href="<?=base_url("dashboard/ayarlar/iletisim-bilgileri")?>">İletişim Bilgileri</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'ayarlar' && $request->uri->getSegment(3) == 'gelismis' ? 'active' : null)?>" href="<?=base_url("dashboard/ayarlar/gelismis")?>">Gelişmiş</a>
                <a class="collapse-item <?=($request->uri->getSegment(2) == 'ayarlar' && $request->uri->getSegment(3) == 'mail' ? 'active' : null)?>" href="<?=base_url("dashboard/ayarlar/mail")?>">Email</a>
            </div>
        </div>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->