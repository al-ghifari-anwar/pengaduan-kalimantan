<?php $this->load->view('header'); ?>
<?php $user = $this->session->userdata('userdata_desa'); ?>
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
                            <li>Surat</li>
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
                <h2>DATA SURAT </h2>



            </div>
            <div class="block-section">
                <button class="btn btn-effect-ripple btn-danger btn-sm" title="Print"><i class="fa fa-print"></i><a target="__blank" style="color:#ffffff;" href="<?= base_url('surat/laporansurat'); ?>"> Print</a></button>
                <?php if ($user['level'] == 'admin') : ?>
                    <a href="#modal-fade" title="Tambah Surat" class="btn btn-effect-ripple btn-info btn-sm float-end" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Data</a>
                <?php endif; ?>
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
                            <th class="text-center">Nomor Surat</th>
                            <th class="text-center">Jenis Surat</th>
                            <th class="text-center">Tujuan</th>
                            <th class="text-center">Object</th>
                            <?php if ($user['level'] == 'admin') : ?>
                                <th class="text-center"><i class="fa fa-flash"></i> Opsi</th>
                            <?php endif; ?>
                            <th class="text-center"><i class="fa fa-flash"></i> Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($surat as $data) : $no++ ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td class="text-center"><?php echo date('d-m-Y', strtotime($data['tanggal_surat'])) ?></td>
                                <td><?php echo $data['nomor_surat'] ?></td>
                                <td><?php echo $data['jenis_surat'] ?></td>
                                <td class="text-center"><?php echo $data['tujuan'] ?></td>
                                <td><?php echo $data['objek'] ?></td>
                                <?php if ($user['level'] == 'admin') : ?>
                                    <td class="text-center" width="200px">
                                        <a href="#modal-tambah<?= $data['id_surat']; ?>" title="Tambah Tindakan" class="btn btn-effect-ripple btn-info btn-sm" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                        <!-- <a href="#modal-detail<?= $data['id_surat']; ?>" title="Detail Tindakan" class="btn btn-effect-ripple btn-success btn-sm" data-toggle="modal"><i class="fa fa-search"></i></a> -->
                                        <a href="<?php echo site_url('surat/hapus/' . $data['id_surat']) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $data['nomor_surat']; ?>');" data-toggle="tooltip" title="Hapus <?php echo $data['nomor_surat']; ?>" class="btn btn-effect-ripple btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                    </td>
                                <?php endif; ?>
                                <?php if ($user['level'] == 'admin') : ?>
                                    <?php if ($data['status_surat'] == '1') : ?>
                                        <td class="text-center" width="200px">
                                            <a href="<?php echo site_url('surat/cetak/') . $data['id_surat'] ?>" title="Cetak Surat" class="btn btn-effect-ripple btn-info btn-sm" target="__blank"><i class="fa fa-print"></i></a>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($user['level'] == 'kepala') : ?>
                                    <td class="text-center" width="200px">
                                        <?php if ($data['status_surat'] == '0') : ?>
                                            <a href="<?php echo site_url('surat/konfirmasi/') . $data['id_surat'] ?>" title="Konfimasi Surat" class="btn btn-effect-ripple btn-success btn-sm"><i class="fa fa-check"></i></a>
                                        <?php endif; ?>
                                        <a href="<?php echo site_url('surat/cetak/') . $data['id_surat'] ?>" title="Cetak Surat" class="btn btn-effect-ripple btn-info btn-sm" target="__blank"><i class="fa fa-print"></i></a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <div id="modal-tambah<?= $data['id_surat']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"><strong><i class="fa fa-pencil"></i> Edit Surat</strong></h3>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-validation" action="<?php echo site_url('surat/edit_proses/') . $data['id_surat'] ?>" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label>Nomor Surat</label>
                                                    <input type="text" name="nomor_surat" class="form-control" placeholder="Masukkan Nama Admin" required value="<?= $data['nomor_surat'] ?>">
                                                    <?php echo form_error('nomor_surat') ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Surat</label>
                                                    <select name="jenis" id="jenis" class="form-control">
                                                        <option value="pengantar">Pengantar</option>
                                                        <option value="peringatan">Peringatan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tujuan Surat</label>
                                                    <input type="text" name="tujuan" class="form-control" placeholder="Masukkan Tujuan" required value="<?= $data['tujuan'] ?>">
                                                    <?php echo form_error('tujuan') ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Objek</label>
                                                    <input type="text" name="objek" class="form-control" placeholder="Masukkan Objek" required value="<?= $data['objek'] ?>">
                                                    <?php echo form_error('objek') ?>
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
                            <div id="modal-detail<?= $data['id_surat']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                        <input type="text" name="tim_eksekutor" class="form-control" value="<?= $data['tim_eksekutor']; ?>" readonly>
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

<!-- Regular Fade -->
<div id="modal-fade" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong><i class="fa fa-plus"></i> Tambah Surat</strong></h3>
            </div>
            <div class="modal-body">
                <form id="form-validation" action="<?php echo site_url('surat/tambah_proses') ?>" method="POST" enctype="multipart/form-data">
                    <!-- <div class="col-sm-6"> -->
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" name="nomor_surat" class="form-control" placeholder="Masukkan Nama Admin" required>
                        <?php echo form_error('nomor_surat') ?>
                    </div>
                    <div class="form-group">
                        <label>Jenis Surat</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="pengantar">Pengantar</option>
                            <option value="peringatan">Peringatan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tujuan Surat</label>
                        <input type="text" name="tujuan" class="form-control" placeholder="Masukkan Tujuan" required>
                        <?php echo form_error('tujuan') ?>
                    </div>
                    <div class="form-group">
                        <label>Objek</label>
                        <input type="text" name="objek" class="form-control" placeholder="Masukkan Objek" required>
                        <?php echo form_error('objek') ?>
                    </div>
                    <div class="form-group form-actions">
                        <button type="submit" class="btn btn-effect-ripple btn-primary btn-sm" name="tambah_anggota ">Simpan</button>
                        <button type="reset" class="btn btn-effect-ripple btn-danger btn-sm" style="float:right;">Reset</button>
                    </div>
                    <!-- </div> -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Regular Fade -->

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