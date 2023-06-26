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
                        <h1>Edit Pengaduan</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPEMAS</a></li>
                            <li><a href="<?php echo site_url('pengaduan') ?>">Pengaduan</a></li>
                            <li>Edit Pengaduan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- END Forms Components Header -->

        <!-- Form Components Row -->
        <div class="row">
            <div class="col-md-8">
                <!-- Horizontal Form Block -->
                <div class="block">
                    <!-- Horizontal Form Title -->
                    <div class="block-title">
                        <h2>Edit Pengaduan</h2>
                    </div>
                    <!-- END Horizontal Form Title -->

                    <!-- Horizontal Form Content -->
                    <form action="<?php echo site_url('pengaduan/edit_proses2/' . $id_pengaduan) ?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Laporan</label>
                            <div class="col-md-9">
                                <input type="text" name="nama_laporan" class="form-control" value="<?= $nama_laporan; ?>">
                                <?php echo form_error('nama_laporan'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tempat</label>
                            <div class="col-md-9">
                                <input type="text" name="tempat" class="form-control" value="<?= $tempat; ?>">
                                <?php echo form_error('tempat'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kategori</label>
                            <div class="col-md-9">
                                <select name="id_kategori" id="example-chosen" class="select-select2" style="width: 100%;">
                                    <option value="">--Pilih Kategori--</option>
                                    <?php foreach ($kategori as $row) : ?>
                                        <option value="<?php echo $row->id_kategori ?>" <?php if ($row->id_kategori == $id_kategori) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $row->nama_kategori ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row gallery">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-4">
                                <div class="gallery-image-container animation-fadeInQuick2" data-category="travel">
                                    <img src="<?= base_url('upload/pengaduan/' . $pict) ?>">
                                    <a href="<?= base_url('upload/pengaduan/' . $pict) ?>" class="gallery-image-options" data-toggle="lightbox-image" title="<?= "Keluhan " . $nama; ?>">
                                        <h2 class="text-light"><strong><?= "Keluhan" . $nama; ?></strong></h2>
                                        <i class="fa fa-search-plus fa-3x text-light"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4"></div>
                            <input type="hidden" name="foto_lama" value="<?= $pict; ?>">
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Picture</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" id="example-file-input" name="foto">
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-effect-ripple btn-primary btn-sm">Simpan</button>
                                <button type="button" class="btn btn-effect-ripple btn-danger btn-sm" style="float:right;"><a href="<?= base_url('pengaduan/data') ?>" style="text-decoration: none; color: white;">Kembali</a></button>
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