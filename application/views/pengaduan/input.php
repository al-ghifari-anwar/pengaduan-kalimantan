<?php $this->load->view('header'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARtk6FXNyN9Ro1w-wymJdphDm2yRj4zFw&language=id&region=ID"></script>
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
                        <h1>Input Pengaduan</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPEMAS</a></li>
                            <li><a href="<?php echo site_url('pengaduan') ?>">Pengaduan</a></li>
                            <li>Input Pengaduan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->
        <!-- END Forms Components Header -->

        <!-- Form Components Row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form Block -->
                <div class="block">
                    <!-- Horizontal Form Title -->
                    <div class="block-title">
                        <h2>Input Pengaduan</h2>
                    </div>
                    <!-- END Horizontal Form Title -->

                    <!-- Horizontal Form Content -->
                    <form action="<?php echo site_url('Pengaduan/tambah_proses') ?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nama Laporan</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="nama_laporan" autocomplete="off">
                                        <?php echo form_error('nama_laporan'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tempat</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="tempat" autocomplete="off">
                                        <?php echo form_error('tempat'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Kategori</label>
                                    <div class="col-md-9">
                                        <select name="kategori" id="example-chosen" class="select-select2" style="width: 100%;">
                                            <option value="">--Pilih Kategori--</option>
                                            <?php foreach ($kategori as $row) : ?>
                                                <option value="<?php echo $row['id_kategori'] ?>"><?php echo $row['nama_kategori'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('kategori'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Picture</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" id="example-file-input" name="pict">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Latitude</label>
                                    <div class="col-md-9">
                                        <input type="text" name="lat" id="lat" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Longitude</label>
                                    <div class="col-md-9">
                                        <input type="text" name="long" id="long" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group form-actions">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-effect-ripple btn-primary btn-sm">Simpan</button>
                                        <button type="reset" class="btn btn-effect-ripple btn-danger btn-sm" style="float:right;">Reset</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">Lokasi</label>
                                    <div id="map" style="height: 300px; width: 100%;"></div>
                                </div>
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

<script>
    var defaultCenter = {
        lat: -3.3186067,
        lng: 114.5943784
    };

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: defaultCenter
        });

        var marker = new google.maps.Marker({
            position: defaultCenter,
            map: map,
            title: 'Click to zoom',
            draggable: true
        });


        marker.addListener('drag', handleEvent);
        marker.addListener('dragend', handleEvent);

        var infowindow = new google.maps.InfoWindow({
            content: '<h4>Drag untuk pindah lokasi</h4>'
        });

        infowindow.open(map, marker);
    }

    function handleEvent(event) {
        document.getElementById('lat').value = event.latLng.lat();
        document.getElementById('long').value = event.latLng.lng();
    }

    $(function() {
        initMap();
    })
</script>

<?php $this->load->view('footer'); ?>