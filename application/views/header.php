<!DOCTYPE html>
<html class="no-js" lang="en"> <!--<![endif]-->

<head>
    <meta charset="utf-8">

    <title><?php echo $judul ?></title>

    <meta name="description" content="AppUI is a Web App Bootstrap Admin Template created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>/assets/img/Favicondlh.png">
    <!-- END Icons -->

    <!-- CSS Transaksi -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/cssku.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/style-gue.css" />

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/bootstrap.min.css">

    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/plugins.css">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/main.css">

    <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/themes.css">
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) -->
    <link rel="stylesheet" href="<?= base_url('assets/chart/bar.chart.min.css'); ?>" />
    <script src="<?php echo base_url() ?>/assets/js/vendor/modernizr-3.3.1.min.js"></script>

    <!-- jQuery, Bootstrap, jQuery plugins and Custom JS code -->
    <script src="<?php echo base_url() ?>/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/vendor/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/plugins.js"></script>
    <script src="<?php echo base_url() ?>/assets/js/app.js"></script>

</head>

<body>
    <!-- Page Wrapper -->
    <div id="page-wrapper" class="page-loading">
        <!-- Preloader -->
        <!-- Preloader functionality (initialized in js/app.js) - pageLoading() -->
        <!-- Used only if page preloader enabled from inc/config (PHP version) or the class 'page-loading' is added in #page-wrapper element (HTML version) -->
        <div class="preloader">
            <div class="inner">
                <!-- Animation spinner for all modern browsers -->
                <div class="preloader-spinner themed-background hidden-lt-ie10"></div>

                <!-- Text for IE9 -->
                <h3 class="text-primary visible-lt-ie10"><strong>Loading..</strong></h3>
            </div>
        </div>
        <!-- END Preloader -->

        <!-- Page Container -->
        <div id="page-container" class="header-fixed-top sidebar-visible-lg-full">

            <?php
            $userdata = $this->session->userdata('userdata_desa');

            if ($userdata['akses'] == 'admin') {
                $this->load->view('main_sidebar');
            } elseif ($userdata['akses'] == 'user') {
                $this->load->view('main_sidebar_user');
            }
            ?>