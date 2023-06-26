<?php $this->load->view('header'); ?>
<?php $user = $this->session->userdata('userdata_desa'); ?>
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
        <!-- Table Styles Header -->
        <div class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <div class="header-section">
                        <h1></h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPEMAS</a></li>
                            <li>Tindakan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->

        <!-- Datatables Block -->
        <!-- Datatables is initialized in ../assets/js/pages/uiTables.js -->
        <div class="block full">
            <div class="block-title">
                <h2>DATA TINDAKAN </h2>
            </div>
            <div class="block-section">
                <?php
                if ($this->session->flashdata('sukses_tambah') != "") {
                    echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Sukses!</strong> Data Berhasil Disimpan
                              </div>';
                }
                ?>

                <?php
                if ($this->session->flashdata('sukses_hapus') != "") {
                    echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Sukses!</strong> Data Berhasil Dihapus
                              </div>';
                }
                ?>
            </div>
            <div class="table-responsive">
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nama Laporan</th>
                            <th class="text-center">Bentuk Tindakan</th>
                            <th class="text-center">Tim Eksekutor</th>
                            <th class="text-center">Hasil</th>
                            <th class="text-center">Penjadwalan</th>
                            <th class="text-center"><i class="fa fa-flash"></i> Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($tindakan as $data) : $no++ ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td class="text-center"><?php echo date('d-m-Y', strtotime($data['tanggal'])) ?></td>
                                <td><?php echo $data['nama_laporan'] ?></td>
                                <td><?php echo $data['bentuk_tindakan'] ?></td>
                                <td class="text-center"><?php echo $data['nama_eksekutor'] ?></td>
                                <td><?php echo $data['hasil'] ?></td>
                                <td><?php echo date('d M, Y', strtotime($data['penjadwalan'])) ?></td>
                                <td class="text-center" width="200px">
                                    <?php if ($user['level'] == 'admin' || $user['level'] == 'petugas') : ?>
                                        <a href="#modal-tambah<?= $data['id_tindakan']; ?>" title="Tambah Tindakan" class="btn btn-effect-ripple btn-info btn-sm" data-toggle="modal"><i class="fa fa-plus"></i></a>
                                    <?php endif; ?>
                                    <a href="#modal-detail<?= $data['id_tindakan']; ?>" title="Detail Tindakan" class="btn btn-effect-ripple btn-success btn-sm" data-toggle="modal"><i class="fa fa-search"></i></a>
                                    <?php if ($user['level'] == 'admin') : ?>
                                        <a href="<?php echo site_url('tindakan/hapus/' . $data['id_tindakan']) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $data['nama_laporan']; ?>');" data-toggle="tooltip" title="Hapus <?php echo $data['nama_laporan']; ?>" class="btn btn-effect-ripple btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <div id="modal-tambah<?= $data['id_tindakan']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"><strong><i class="fa fa-plus"></i> Tambah Tindakan</strong></h3>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-validation" action="<?php echo site_url('tindakan/tindakan_proses') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Nama Laporan</label>
                                                    <div class="col-md-9">
                                                        <input type="hidden" name="id_tindakan" class="form-control" value="<?= $data['id_tindakan']; ?>">
                                                        <input type="text" name="nama_laporan" class="form-control" value="<?= $data['nama_laporan']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Bentuk Tindakan</label>
                                                    <div class="col-md-9">
                                                        <textarea name="bentuk_tindakan" class="form-control" rows="5"><?= $data['bentuk_tindakan']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Tim Eksekutor</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="tim_eksekutor" class="form-control" value="<?= $data['nama_eksekutor']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Hasil</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="hasil" class="form-control" value="<?= $data['hasil']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Bukti</label>
                                                    <div class="col-md-9">
                                                        <input type="file" name="bukti" class="form-control" value="<?= $data['bukti']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Latitutde</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="lat" class="form-control" value="<?= $data['lat']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Longitude</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="lat" class="form-control" value="<?= $data['long']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Lokasi</label>
                                                    <div class="col-md-9">
                                                        <a href="https://maps.google.com/?q=<?= $data['lat'] ?>,<?= $data['long'] ?>" class="btn btn-danger" target="__blank">Cek Lokasi</a>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-effect-ripple btn-primary btn-sm">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="modal-detail<?= $data['id_tindakan']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"><strong><i class="fa fa-plus"></i> Detail Tindakan</strong></h3>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-validation" action="<?php echo site_url('tindakan/tindakan_proses') ?>" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-md-3 control-label">Nama Laporan</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="nama_laporan" class="form-control" value="<?= $data['nama_laporan']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Bentuk Tindakan</label>
                                                    <div class="col-md-9">
                                                        <textarea name="bentuk_tindakan" class="form-control" readonly rows="5"><?= $data['bentuk_tindakan']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Tim Eksekutor</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="tim_eksekutor" class="form-control" value="<?= $data['nama_eksekutor']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Latitutde</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="lat" class="form-control" value="<?= $data['lat']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Longitude</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="lat" class="form-control" value="<?= $data['long']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Lokasi</label>
                                                    <div class="col-md-9">
                                                        <a href="https://maps.google.com/?q=<?= $data['lat'] ?>,<?= $data['long'] ?>" class="btn btn-danger" target="__blank">Cek Lokasi</a>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3">Hasil</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="hasil" class="form-control" value="<?= $data['hasil']; ?>" readonly>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Datatables Block -->
    </div>
    <!-- END Page Content -->

</div>
<!-- END Main Container -->

<?php $this->load->view('footer'); ?>

<!-- Load and execute javascript code used only in this page -->
<script src="<?php echo base_url() ?>/assets/js/pages/uiTables.js"></script>
<script>
    $(function() {
        UiTables.init();
    });
</script>

<!-- Load and execute javascript code used only in this page -->
<script src="<?php echo base_url() ?>/assets/js/pages/formsComponents.js"></script>
<script>
    $(function() {
        FormsComponents.init();
    });
</script>

<script>
    <?php
    if (isset($modal_show)) {
        echo $modal_show;
    }
    ?>
</script>
<script>
    var defaultCenter = {
        lat: -3.3186067,
        lng: 114.5943784
    };

    var map;

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
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

    $(function() {
        $('#modal-tambah18').on('shown', function() {
            google.maps.event.trigger(map, "resize");
        });
    });
</script>