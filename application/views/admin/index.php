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
                            <li>Admin Sistem</li>
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
                <h2>DATA ADMIN </h2>
            </div>
            <a href="#modal-fade" title="Tambah Agama" class="btn btn-effect-ripple btn-info btn-sm" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Data</a>
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
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Tempat, Tanggal Lahir</th>
                            <th class="text-center">No Hp</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center"><i class="fa fa-flash" alt="Aksi"></i> Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($admin as $row) : $no++ ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td><?php echo $row->nama_admin ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($row->jk == "L") {
                                        $tampil = "Laki - Laki";
                                    } else {
                                        $tampil = "Perempuan";
                                    }
                                    ?>
                                    <?php echo "$tampil"; ?>
                                </td>
                                <td class="text-center"><?php echo $row->tempat_lahir . ", " . date('d-m-Y', strtotime($row->tanggal_lahir)) ?></td>
                                <td class="text-center"><?php echo $row->nohp ?></td>
                                <td class="text-center"><?php echo $row->alamat ?></td>
                                <td class="text-center" width="200px">
                                    <a href="<?php echo site_url('admin/detail/' . $row->id_admin) ?>" data-toggle="tooltip" title="Edit <?php echo $row->nama_admin ?>" class="btn btn-effect-ripple btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo site_url('admin/hapus/' . $row->id_admin) ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus <?php echo $row->nama_admin ?>');" data-toggle="tooltip" title="Hapus <?php echo $row->nama_admin ?>" class="btn btn-effect-ripple btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
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
                <h3 class="modal-title"><strong><i class="fa fa-plus"></i> Tambah Admin</strong></h3>
            </div>
            <div class="modal-body">
                <form id="form-validation" action="<?php echo site_url('admin/tambah_proses') ?>" method="POST" enctype="multipart/form-data">
                    <!-- <div class="col-sm-6"> -->
                    <div class="form-group">
                        <label>Nama Admin</label>
                        <input type="text" name="nama_admin" class="form-control" placeholder="Masukkan Nama Admin" required>
                        <?php echo form_error('nama_admin') ?>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukkan Tempat Lahir" required>
                        <?php echo form_error('tempat_lahir') ?>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input id="example-datepicker3" type="text" name="tanggal_lahir" class="form-control input-datepicker" placeholder="Tanggal-Bulan-Tahun" data-date-format="dd-mm-yyyy" required>
                        <?php echo form_error('tanggal_lahir') ?>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jk" id="example-chosen" class="select-chosen" required>
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <?php echo form_error('jk') ?>
                    </div>
                    <div class="form-group">
                        <label>No Hp</label>
                        <input type="number" name="nohp" class="form-control" placeholder="Masukkan No Hp" required>
                        <?php echo form_error('nohp') ?>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" required>
                        <?php echo form_error('alamat') ?>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                        <?php echo form_error('username') ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                        <?php echo form_error('password') ?>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password2" class="form-control" placeholder="Konfirmasi Password" required>
                        <?php echo form_error('password2') ?>
                    </div>
                    <div class="form-group">
                        <label>Picture</label>
                        <input type="file" name="pict" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Level Admin</label>
                        <select name="level_admin" id="level_admin" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="kepala">Kepala Dinas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Eksekutor</label>
                        <select name="eksekutor" id="eksekutor" class="form-control">
                            <?php foreach ($eksekutor as $eks) :  ?>
                                <option value="<?= $eks['id_eksekutor'] ?>"><?= $eks['nama_eksekutor'] ?></option>
                            <?php endforeach; ?>
                        </select>
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