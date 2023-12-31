<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8">

    <title>LOGIN PAGE</title>

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

    <!-- Modernizr (browser feature detection library) -->
    <script src="<?php echo base_url() ?>assets/js/vendor/modernizr-3.3.1.min.js"></script>
</head>

<body>
    <!-- Login Container -->
    <div id="login-container">
        <!-- Login Header -->
        <h1 class="h3 text-light text-center push-top-bottom animation-slideDown">
            <i class="fa fa-university"></i> <br> <strong>Selamat Datang di Sistem Informasi Pelayanan dan Pengaduan Masyarakat</strong>
        </h1>
        <!-- END Login Header -->

        <!-- Login Block -->
        <div class="block animation-fadeInQuickInv">
            <!-- Login Title -->
            <div class="block-title">
                <div class="block-options pull-right">
                    <a href="<?php echo site_url('login/register'); ?>" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="Buat Akun Baru"><i class="fa fa-plus"></i></a>
                </div>
                <h2>Silahkan Login</h2>
            </div>
            <!-- END Login Title -->
            <?php
            if ($this->session->userdata('gagal_login') != "") {
                echo '<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>GAGAL!</strong> Username dan Password tidak cocok.</div>';
            }
            if ($this->session->userdata('sukses_register') != "") {
                echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>SUKSES REGISTER!</strong> Silahkan Login.</div>';
            }
            ?>
            <!-- Login Form -->
            <form id="form-login" action="<?php echo site_url('login/proses_user') ?>" method="post" class="form-horizontal">
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username.." autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password..">
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-12 text-center">
                        <button type="submit" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-sign-in"> </i> LOGIN</button>
                    </div>
                </div>
            </form>
            <!-- END Login Form -->
        </div>
        <!-- END Login Block -->

        <!-- Footer -->
        <footer class="text-muted text-center animation-pullUp">
            <small>
                <a href="<?php echo site_url('login/admin') ?>">_</a>
                <span>2023</span> &copy; <a href="https://dlh.banjarmasinkota.go.id/" target="_blank">Dinas Lingkungan Hidup</a>
            </small>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Login Container -->

    <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
    <script src="<?php echo base_url() ?>assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/plugins.js"></script>
    <script src="<?php echo base_url() ?>assets/js/app.js"></script>

    <!-- Load and execute javascript code used only in this page -->
    <script src="<?php echo base_url() ?>assets/js/pages/readyLogin.js"></script>
    <script>
        $(function() {
            ReadyLogin.init();
        });
    </script>
</body>

</html>