<?php $this->load->view('header'); ?>

<!-- Main Container -->
<div id="main-container">
    <header class="navbar navbar-inverse navbar-fixed-top">
        <!-- Left Header Navigation -->
        <ul class="nav navbar-nav-custom">
            <!-- Main Sidebar Toggle Button -->
            <li>
                <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                    <i class="fa fa-ellipsis-v fa-fw animation-fadeInRight" id="sidebar-toggle-mini"></i>
                    <i class="fa fa-bars fa-fw animation-fadeInRight" id="sidebar-toggle-full"></i>
                </a>
            </li>
            <!-- END Main Sidebar Toggle Button -->

            <!-- Header Link -->
            <li class="hidden-xs animation-fadeInQuick">
                <a href=""><strong>SISTEM INFORMASI PELAYANAN DAN PENGADUAN MASYARAKAT</strong></a>
            </li>
            <!-- END Header Link -->
        </ul>
        <!-- END Left Header Navigation -->

        <?php $this->load->view('right_menu'); ?>

    </header>
    <!-- END Header -->

    <!-- Page content -->
    <div id="page-content">
        <!-- Forms Components Header -->
        <!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1>Detail Profil</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPEMAS</a></li>
                            <li>Detail Profil <?php echo $profil['nama'] ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- END Forms Components Header -->

        <!-- Form Components Row -->
        <?php
        if ($this->session->flashdata('sukses_edit') != "") {
            echo '<div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Sukses!</strong> Data Berhasil Diedit
                      </div>';
        }
        ?>
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form Block -->
                <div class="block">
                    <!-- Horizontal Form Title -->
                    <div class="block-title">
                        <h2>Picture</h2>
                    </div>
                    <!-- END Horizontal Form Title -->

                    <div class="gallery-image-container animation-fadeInQuick2" data-category="travel">
                        <?php if($profil['pict'] == "") { ?>
                            <img src="<?= base_url('upload/default.jpg') ?>" style="width:100%; height:50%;">
                            <a href="<?= base_url('upload/default.jpg') ?>" class="gallery-image-options" data-toggle="lightbox-image" title="<?= $profil['nama'];?>">
                                <h2 class="text-light"><strong><?= $profil['nama'];?></strong></h2>
                                <i class="fa fa-search-plus fa-3x text-light"></i>
                            </a>
                        <?php }else{ ?>    
                            <img src="<?= base_url('upload/penduduk/'.$profil['pict']) ?>" style="width:100%; height:50%;">
                            <a href="<?= base_url('upload/penduduk/'.$profil['pict']) ?>" class="gallery-image-options" data-toggle="lightbox-image" title="<?= $profil['nama'];?>">
                                <h2 class="text-light"><strong><?= $profil['nama'];?></strong></h2>
                                <i class="fa fa-search-plus fa-3x text-light"></i>
                            </a>
                        <?php } ?>    
                    </div>
                </div>
                <!-- END Horizontal Form Block -->
            </div>
            <div class="col-md-8">
                <!-- Horizontal Form Block -->
                <div class="block">
                    <!-- Horizontal Form Title -->
                    <div class="block-title">
                        <h2>Edit Profil</h2>
                    </div>
                    <!-- END Horizontal Form Title -->

                    <!-- Horizontal Form Content -->
                    <form class="form-horizontal form-bordered">
                        <div class="form-group">
                            <label class="col-md-3 control-label">NIK</label>
                            <div class="col-md-9">
                                <input type="text" name="nik" class="form-control" value="<?php echo $profil['nik'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama</label>
                            <div class="col-md-9">
                                <input type="text" name="nama" class="form-control" value="<?php echo $profil['nama'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tempat Lahir</label>
                            <div class="col-md-9">
                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $profil['tempat_lahir'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <input type="text" name="tanggal_lahir" class="form-control input-datepicker" placeholder="Tanggal/Bulan/Tahun" value="<?php echo date('d-m-Y', strtotime($profil['tanggal_lahir'])) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <input type="text" name="jk" class="form-control" value="<?php echo $profil['jk'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Agama</label>
                            <div class="col-md-9">
                                <input type="text" name="nama_agama" class="form-control" value="<?php echo $profil['nama_agama'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Alamat</label>
                            <div class="col-md-9">
                                <input type="text" name="alamat" class="form-control" value="<?php echo $profil['alamat'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">No Hp</label>
                            <div class="col-md-9">
                                <input type="text" name="nohp" class="form-control" value="<?php echo $profil['nohp'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-effect-ripple btn-primary btn-sm"><a href="<?= base_url('profil/profil_user/'.$profil['nik']);?>" style="color:#ffffff;">Edit</a></button>  
                            </div>
                        </div>
                    </form>
                    <!-- END Horizontal Form Content -->
                </div>
                <!-- END Horizontal Form Block -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</div>
<!-- END Main Container -->

<?php $this->load->view('footer'); ?>