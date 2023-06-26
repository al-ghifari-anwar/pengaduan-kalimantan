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
                        <h1>Data Pengaduan</h1>
                    </div>
                </div>
                <div class="col-sm-6 hidden-xs">
                    <div class="header-section">
                        <ul class="breadcrumb breadcrumb-top">
                            <li><a href="<?php echo site_url('') ?>">SIPEMAS</a></li>
                            <li>Pengaduan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Table Styles Header -->

        <!-- Datatables Block -->
        <!-- Datatables is initialized in js/pages/uiTables.js -->
        <div class="block full">
            <div class="block-title">
                <h2>Data Pengaduan</h2>
            </div>
            <?php
            $user = $this->session->userdata('userdata_desa');
            ?>
            <?php if ($user['akses'] == 'user') { ?>
                <button class="btn btn-effect-ripple btn-danger btn-sm" title="Print"><i class="fa fa-print"></i><a target="__blank" style="color:#ffffff;" href="<?= base_url('pengaduan/laporanpengaduan'); ?>"> Print</a></button>
            <?php } else { ?>
            <?php } ?>
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
                <?php
                if ($this->session->flashdata('sukses_verifikasi') != "") {
                    echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Sukses!</strong> Berhasil Verifikasi
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
                            <th class="text-center">Nama Penduduk</th>
                            <th class="text-center">Nama Laporan</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Tempat</th>
                            <th class="text-center">Status</th>
                            <th class="text-center"><i class="fa fa-flash"></i> Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pengaduan as $row) { ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $no ?>
                                </td>
                                <td class="text-center">
                                    <?php echo date('d-m-Y', strtotime($row->tanggal)) ?>
                                </td>
                                <td>
                                    <strong><?php echo $row->nama ?></strong>
                                </td>
                                <td>
                                    <?php echo $row->nama_laporan ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row->nama_kategori ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $row->tempat ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($row->status == 0) {
                                        $label = "label label-success";
                                        $text = "Sudah Diverifikasi";
                                        $color = "btn-danger";
                                        $icon = "gi gi-remove";
                                    } elseif ($row->status == 1) {
                                        $label = "label label-danger";
                                        $text = "Menunggu Verifikasi";
                                        $color = "btn-success";
                                        $icon = "gi gi-ok";
                                    } elseif ($row->status == 2) {
                                        $label = "label label-info";
                                        $text = "Tindak Lanjut";
                                        $color = "btn-info";
                                        $icon = "gi gi-rocket";
                                    }
                                    ?>
                                    <span class="<?php echo $label; ?>">
                                        <?php echo $text; ?>
                                    </span>
                                </td>
                                <?php
                                $user = $this->session->userdata('userdata_desa');
                                if ($user['akses'] == 'admin') {
                                ?>
                                    <td class="text-center">
                                        <a href="<?php echo site_url('pengaduan/detail/' . $row->id_pengaduan) ?>" data-toggle="tooltip" title="Detail Pengaduan" class="btn btn-effect-ripple btn-s btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                        <?php if ($user['level'] == 'admin') : ?>
                                            <a href="#modal-ubah-status<?= $row->id_pengaduan; ?>" title="Ubah Status" class="btn btn-effect-ripple btn-info btn-sm" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                        <?php endif; ?>
                                    </td>
                                    <div id="modal-ubah-status<?= $row->id_pengaduan; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h3 class="modal-title"><strong><i class="fa fa-plus"></i> Ubah Status</strong></h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="form-validation" action="<?php echo site_url('pengaduan/edit_proses') ?>" method="POST">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 control-label">Status</label>
                                                            <div class="col-md-9">
                                                                <select name="status" id="example-chosen" class="select-chosen">
                                                                    <option value="">--Pilih Status--</option>
                                                                    <?php if ($row->status == 2) { ?>
                                                                        <option value="0" <?php if ($row->status == '0') {
                                                                                                echo "selected";
                                                                                            } ?>>Sudah Diverifikasi</option>
                                                                        <option value="1" <?php if ($row->status == '1') {
                                                                                                echo "selected";
                                                                                            } ?>>Menunggu Diverifikasi</option>
                                                                    <?php } else { ?>
                                                                        <option value="0" <?php if ($row->status == '0') {
                                                                                                echo "selected";
                                                                                            } ?>>Sudah Diverifikasi</option>
                                                                        <option value="1" <?php if ($row->status == '1') {
                                                                                                echo "selected";
                                                                                            } ?>>Menunggu Diverifikasi</option>
                                                                        <option value="2" <?php if ($row->status == '2') {
                                                                                                echo "selected";
                                                                                            } ?>>Tindak Lanjut</option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input type="hidden" name="id_pengaduan" class="form-control" value="<?= $row->id_pengaduan; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3 control-label">Eksekutor</label>
                                                            <div class="col-md-9">
                                                                <select name="eksekutor" id="eksekutor" class="form-control">
                                                                    <?php foreach ($eksekutor as $eks) :  ?>
                                                                        <option value="<?= $eks['id_eksekutor'] ?>"><?= $eks['nama_eksekutor'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-3 control-label">Penjadwalan Tindakan</label>
                                                            <div class="col-md-9">
                                                                <input type="date" name="penjadwalan" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col" hidden>
                                                            <input type="text" name="lat" class="form-control" value="<?= $row->lat; ?>" hidden>
                                                            <input type="text" name="long" class="form-control" value="<?= $row->long; ?>" hidden>
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
                                <?php } elseif ($user['akses'] == 'user') { ?>
                                    <td class="text-center">
                                        <a href="<?php echo site_url('pengaduan/detail/' . $row->id_pengaduan) ?>" data-toggle="tooltip" title="Detail Pengaduan" class="btn btn-effect-ripple btn-s btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="<?php echo site_url('pengaduan/edit/' . $row->id_pengaduan) ?>" data-toggle="tooltip" title="Edit Pengaduan" class="btn btn-effect-ripple btn-s btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                        <a href="<?php echo site_url('pengaduan/hapus/' . $row->id_pengaduan) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus?')" data-toggle="tooltip" title="Delete Pengaduan" class="btn btn-effect-ripple btn-s btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                    </td>
                                <?php } ?>
                            </tr>
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