<?php $this->load->view('header'); ?>
<!-- Main Container -->
<?php $user = $this->session->userdata('userdata_desa'); ?>
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
                            <li>Penduduk</li>
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
                <h2>DATA PENDUDUK </h2>
            </div>
            <button class="btn btn-effect-ripple btn-danger btn-sm" title="Print"><i class="fa fa-print"></i><a target="__blank" style="color:#ffffff;" href="<?= base_url('penduduk/laporanpengadu'); ?>"> Print</a></button>
            <br>
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

                <?php
                if ($this->session->flashdata('sukses_edit') != "") {
                    echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Sukses!</strong> Data Berhasil Diedit
                              </div>';
                }
                ?>
            </div>
            <div class="table-responsive">
                <table id="example-datatable" class="table table-striped table-bordered table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Tempat, Tanggal Lahir</th>
                            <th class="text-center">Agama</th>
                            <th class="text-center">Alamat</th>
                            <?php if ($user['level'] == 'admin') : ?>
                                <th class="text-center"><i class="fa fa-flash"></i> Opsi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($penduduk as $row) { ?>
                            <tr class="text-center">
                                <td><?php echo $no; ?></td>
                                <td><strong><?php echo $row['nik'] ?></strong></td>
                                <td><?php echo $row['nama'] ?></td>
                                <td>
                                    <?php
                                    if ($row['jk'] == "L") {
                                        $tampil = "Laki - Laki";
                                    } else {
                                        $tampil = "Perempuan";
                                    }
                                    ?>
                                    <?php echo "$tampil"; ?>
                                </td>
                                <td><?php echo $row['tempat_lahir'] . ", " . $row['tanggal_lahir'] ?></td>
                                <td><?php echo $row['nama_agama']; ?></td>
                                <td><?php echo $row['alamat']; ?></td>
                                <?php if ($user['level'] == 'admin') : ?>
                                    <td class="text-center" width="200px">
                                        <a href="#modal-fade-detail<?= $row['id_user']; ?>" class="btn btn-effect-ripple btn-warning btn-sm" data-toggle="modal"><i class="fa fa-search"></i></a>
                                        <a style="color:#ffffff;" href="<?= base_url('penduduk/edit_data/' . $row['id_user']) ?>" class="btn btn-effect-ripple btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo site_url('penduduk/hapus/' . $row['id_user']) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $row['nama'] ?>');" data-toggle="tooltip" title="Hapus <?php echo $row['nama'] ?>" class="btn btn-effect-ripple btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <div id="modal-fade-detail<?= $row['id_user']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"><strong><i class="fa fa-search"></i> Detail Penduduk</strong></h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">NIK</label>
                                                        <div class="col-md-6">
                                                            <b>: <span><?= $row['nik']; ?></span></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">Tempat Lahir</label>
                                                        <div class="col-md-6">
                                                            <b>: <span><?= $row['tempat_lahir']; ?></span></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">Nama Lengkap </label>
                                                        <div class="col-md-6">
                                                            <b>: <span><?= $row['nama']; ?></span></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">Tanggal Lahir</label>
                                                        <div class="col-md-6">
                                                            <b>: <span><?= $row['tanggal_lahir']; ?></span></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">Jenis Kelamin</label>
                                                        <div class="col-md-6">
                                                            <?php if ($row['jk'] == "L") { ?>
                                                                <b>: <span>Laki-laki</span></b>
                                                            <?php } else { ?>
                                                                <b>: <span>Perempuan</span></b>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">No HP</label>
                                                        <div class="col-md-6">
                                                            <b>: <span><?= $row['nohp']; ?></span></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">Agama</label>
                                                        <div class="col-md-6">
                                                            <b>: <span><?= $row['nama_agama']; ?></span></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">Alamat</label>
                                                        <div class="col-md-6">
                                                            <b>: <span><?= $row['alamat']; ?></span></b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">Picture</label>
                                                        <div class="col-md-6">
                                                            <?php if ($row['pict'] == "") { ?>
                                                                <img src="<?= base_url('upload/default.jpg') ?>" width="130" height="100">
                                                            <?php } else { ?>
                                                                <img src="<?= base_url('upload/penduduk/' . $row['pict']) ?>" width="130">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-6">Status</label>
                                                        <div class="col-md-6">
                                                            <?php if ($row['is_active'] == "0") { ?>
                                                                <!-- <img src="<?= base_url('upload/default.jpg') ?>" width="130" height="100"> -->
                                                                <span><b>:</b> Not Active</span>
                                                                <br>
                                                                <a href="<?= base_url('penduduk/aktifasi/') . $row['id_user'] ?>" class="mt-3 btn btn-primary">Activate</a>
                                                            <?php } else { ?>
                                                                <!-- <img src="<?= base_url('upload/penduduk/' . $row['is_active']) ?>" width="130"> -->
                                                                <span><b>:</b> Active</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $no++;
                        } ?>
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