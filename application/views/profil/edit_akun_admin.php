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
                        <h1>Edit Password</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPEMAS</a></li>
                            <li>Edit Password <?php echo $profil['nama_admin'] ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- END Forms Components Header -->
        <?php
        if ($this->session->flashdata('sukses_edit') != "") {
            echo '<div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Sukses!</strong> Data Berhasil Diedit
                      </div>';
        }
        ?>
        <?php
        if ($this->session->flashdata('gagal_edit') != "") {
            echo '<div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>GAGAL!</strong> Password Salah
                      </div>';
        }
        ?>
        <!-- Form Components Row -->
        <div class="row">
            <div class="col-md-9">
                <!-- Horizontal Form Block -->
                <div class="block">
                    <!-- Horizontal Form Title -->
                    <div class="block-title">
                        <h2>Password</h2>
                    </div>
                    <!-- END Horizontal Form Title -->

                    <!-- Horizontal Form Content -->
                    <form action="<?php echo site_url('profil/edit_akun_admin_proses/' . $profil['id_admin']) ?>" method="post" class="form-horizontal form-bordered">
                        <div class="form-group row">
                            <label class="col-md-4 control-label">Password Lama</label>
                            <div class="col-md-8">
                                <input type="password" name="password_lama" class="form-control">
                                <?php echo form_error('password_lama'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 control-label">Password Baru</label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control">
                                <?php echo form_error('password'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 control-label">Konfirmasi Password Baru</label>
                            <div class="col-md-8">
                                <input type="password" name="password2" class="form-control">
                                <?php echo form_error('password2'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-effect-ripple btn-warning btn-sm" title="Simpan">Simpan</button>
                                <button type="reset" class="btn btn-effect-ripple btn-danger btn-sm" style="float:right;" title="Reset">Reset</button>
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