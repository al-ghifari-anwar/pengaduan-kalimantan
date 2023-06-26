<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8">

    <title>FORM REGISTRASI</title>

    <meta name="description" content="AppUI is a Web App Bootstrap Admin Template created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/Favicondlh.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/plugins.css">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css">

    <!-- Include a specific file here from <?php echo base_url() ?>assets/css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/themes.css">
    <!-- END Stylesheets -->
</head>

<body>
    <!-- Login Container -->
    <div id="login-container">
        <!-- Register Header -->
        <h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
            <i class="fa fa-plus"></i> <strong> Buat Akun Baru</strong>
        </h1>
        <!-- END Register Header -->

        <!-- Register Form -->
        <div class="block animation-fadeInQuickInv" style="width:650px; margin-left:-130px;">
            <!-- Register Title -->
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="<?php echo site_url('Login') ?>" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Kembali ke halaman login"><i class="fa fa-user"></i></a>
                </div>
                <h2> Daftar Akun Baru</h2>
            </div>
            <!-- END Register Title -->
            <?= validation_errors('<div class="alert alert-danger">', '</div>');
            if ($this->session->flashdata('success')) {
                echo '<div class="alert alert-success" style="color:#ffffff;">';
                echo $this->session->flashdata('success');
                echo '</div>';
            } elseif ($this->session->flashdata('failed')) {
                echo '<div class="alert alert-danger">';
                echo $this->session->flashdata('failed');
                echo '</div>';
            }
            ?>
            <!-- Register Form -->
            <form id="form-validation" action="<?php echo site_url('login/register_proses') ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="number" name="nik" class="form-control" placeholder="NB : NIK harus Sesuai dengan Data Asli" autofocus autocomplete="off" value="<?= set_value('nik'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" autocomplete="off" value="<?= set_value('nama'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <select name="jenis_kelamin" id="example-chosen" class="select-chosen" required>
                                    <option value="">--Pilih Jenis Kelamin--</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" autocomplete="off" value="<?= set_value('tempat_lahir'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" id="example-datepicker3" name="tanggal_lahir" class="form-control input-datepicker" placeholder="Tanggal Lahir" data-date-format="dd-mm-yyyy" autocomplete="off" value="<?= set_value('tanggal_lahir'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <select name="agama" id="example-chosen" class="select-select2" style="width: 100%;" required>
                                    <option value="">--Pilih Agama--</option>
                                    <?php foreach ($agama as $row) : ?>
                                        <option value="<?php echo $row->id_agama ?>"><?php echo $row->nama_agama ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="file" name="pict" class="form-control" placeholder="Picture" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" name="alamat" class="form-control" placeholder="Alamat Tempat Tinggal" autocomplete="off" value="<?= set_value('alamat'); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="number" name="nohp" class="form-control" placeholder="No HP" autocomplete="off" value="<?= set_value('nohp'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" value="<?= set_value('username'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="password" name="confirm_password" class="form-control" placeholder="Verifikasi Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group form-actions">
                            <div class="col-xs-6">
                                <button class="btn btn-effect-ripple btn-danger fa fa-arrow-left"><a href="<?= base_url('login'); ?>" style="text-decoration: none; color: white;"> Kembali</a></button>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button type="submit" class="btn btn-effect-ripple btn-success" name="daftar"><i class="fa fa-plus"></i> Buat Akun</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END Register Form -->
        </div>
        <!-- END Register Block -->

        <!-- Footer -->
        <footer class="text-muted text-center animation-pullUp">
            <span>2023</span> &copy; <a href="https://dlh.banjarmasinkota.go.id/" target="_blank">Dinas Lingkungan Hidup</a>
            </small>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Login Container -->

    <!-- Modal Terms -->
    <div id="modal-terms" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center"><strong>Aturan</strong></h3>
                </div>
                <div class="modal-body">
                    <h4 class="page-header">1. <strong>Aturan Umum</strong></h4>
                    <p>Web ini adalah sarana untuk menampung aspirasi dan keluahan masyarakat Kota Banjarmasin</p>
                    <h4 class="page-header">2. <strong>Akun</strong></h4>
                    <p>Penduduk yang bisa mendaftar dan login adalah masyarakat Banjarmasin</p>
                    <h4 class="page-header">3. <strong>Layanan</strong></h4>
                    <p>Kritik dan Saran dapat anda ajukan ke Admin atau melalui menu keluhan</p>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="button" class="btn btn-effect-ripple btn-sm btn-primary" data-dismiss="modal">Terima</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal Terms -->

    <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
    <script src="<?php echo base_url() ?>/assets/js/vendor/modernizr-3.3.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins.js"></script>
    <script src="<?php echo base_url() ?>assets/js/app.js"></script>
    <script src="<?php echo base_url() ?>assets/js/pages/formsComponents.js"></script>
    <!-- Load and execute javascript code used only in this page -->
    <script>
        $(function() {
            FormsValidation.init();
        });
    </script>
</body>

</html>