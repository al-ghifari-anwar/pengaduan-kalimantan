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
                        <h1>Edit Data Penduduk</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPEMAS</a></li>
                            <li><a href="<?php echo site_url('penduduk') ?>">Penduduk</a></li>
                            <li>Edit</a></li>
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
                        <h2>Edit Penduduk</h2>
                    </div>
                    <!-- END Horizontal Form Title -->

                    <!-- Horizontal Form Content -->
                    <form action="<?= base_url('penduduk/edit_proses'); ?>" method="post" enctype='multipart/form-data' class="form-horizontal form-bordered">
                        <div class="form-group">
                            <label class="col-md-3 control-label">NIK</label>
                            <div class="col-md-9">
                                <input type="hidden" name="id_user" class="form-control" autocomplete="off" value="<?= $id_user; ?>">
                                <input type="text" name="nik" class="form-control" autocomplete="off" value="<?= $nik; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama</label>
                            <div class="col-md-9">
                                <input type="text" name="nama" class="form-control" autocomplete="off" value="<?= $nama; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">No Hp</label>
                            <div class="col-md-9">
                                <input type="number" name="nohp" class="form-control" autocomplete="off" value="<?= $nohp; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tempat Lahir</label>
                            <div class="col-md-9">
                                <input type="text" name="tempat_lahir" class="form-control" autocomplete="off" value="<?= $tempat_lahir; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <input id="example-datepicker3" type="text" name="tanggal_lahir" class="form-control input-datepicker" placeholder="Tanggal/Bulan/Tahun" data-date-format="dd-mm-yyyy" value="<?= $tanggal_lahir; ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Jenis Kelamin</label>
                            <div class="col-md-9">
                                <select name="jk" id="example-chosen" class="select-chosen">
                                    <option value="">--Pilih Jenis Kelamin--</option>
                                    <option value="L" <?php if ($jk == 'L') {
                                                            echo "selected";
                                                        } ?>>Laki-Laki</option>
                                    <option value="P" <?php if ($jk == 'P') {
                                                            echo "selected";
                                                        } ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Agama</label>
                            <div class="col-md-9">
                                <select name="id_agama" id="example-chosen" class="select-select2" style="width: 100%;">
                                    <option value="">--Pilih Agama--</option>
                                    <?php foreach ($agama as $row) : ?>
                                        <option value="<?php echo $row->id_agama ?>" <?php if ($row->id_agama == $id_agama) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $row->nama_agama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Alamat</label>
                            <div class="col-md-9">
                                <input type="text" name="alamat" class="form-control" autocomplete="off" value="<?= $alamat; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username</label>
                            <div class="col-md-9">
                                <input type="text" name="username" class="form-control" autocomplete="off" value="<?= $username; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Picture</label>
                            <div class="col-md-9">
                                <input type="file" name="pict" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <?php if ($pict == "") { ?>
                                    <img src="<?= base_url('upload/default.jpg') ?>" width="130" height="100">
                                <?php } else { ?>
                                    <img src="<?= base_url('upload/penduduk/' . $pict) ?>" width="130" height="100">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group form-actions">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-effect-ripple btn-primary btn-sm">Simpan</button>
                                <a href="<?= base_url('penduduk') ?>" class="btn btn-effect-ripple btn-danger btn-sm" style="float:right; text-decoration: none; color: white;">Kembali</a>
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