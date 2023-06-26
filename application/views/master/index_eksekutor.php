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
                            <li>Eksekutor</li>
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
                <h2>DATA Eksekutor </h2>
            </div>
            <a href="#modal-add" class="btn btn-effect-ripple btn-info btn-sm" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Data</a>
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
                            <th class="text-center">Nama Eksekutor</th>
                            <th class="text-center"><i class="fa fa-flash"></i> Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($eksekutor as $row) { ?>
                            <tr class="text-center">
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['nama_eksekutor']; ?></td>
                                <td class="text-center" width="200px">
                                    <a href="#modal-edit<?= $row['id_eksekutor']; ?>" class="btn btn-effect-ripple btn-success btn-sm" data-toggle="modal"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo site_url('master/actionhapuseksekutor/' . $row['id_eksekutor']); ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $row['nama_eksekutor'] ?>');" data-toggle="tooltip" title="Hapus <?php echo $row['nama_eksekutor'] ?>" class="btn btn-effect-ripple btn-danger btn-sm"> <i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            <div id="modal-edit<?= $row['id_eksekutor']; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h3 class="modal-title"><strong><i class="fa fa-plus"></i> Edit Eksekutor</strong></h3>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form-validation" action="<?= base_url('master/actioneksekutor'); ?>" method="POST">
                                                <div class="form-group row">
                                                    <label class="col-md-3">Nama Eksekutor</label>
                                                    <input type="hidden" name="statusdata" class="form-control" value="Edit Data">
                                                    <input type="hidden" name="id_eksekutor" class="form-control" value="<?= $row['id_eksekutor']; ?>">
                                                    <div class="col-md-9">
                                                        <input type="text" name="nama_eksekutor" class="form-control" value="<?= $row['nama_eksekutor']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-effect-ripple btn-primary btn-sm">Edit</button>
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
<!-- Regular Fade -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong><i class="fa fa-plus"></i> Tambah Eksekutor</strong></h3>
            </div>
            <div class="modal-body">
                <form id="form-validation" action="<?= base_url('master/actioneksekutor'); ?>" method="POST">
                    <div class="form-group row">
                        <label class="col-md-3">Nama Eksekutor</label>
                        <input type="hidden" name="statusdata" class="form-control" value="Tambah Data">
                        <div class="col-md-9">
                            <input type="text" name="nama_eksekutor" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-effect-ripple btn-primary btn-sm">Tambah</button>
                            <button type="reset" class="btn btn-effect-ripple btn-danger btn-sm" style="float:right;">Reset</button>
                        </div>
                    </div>
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