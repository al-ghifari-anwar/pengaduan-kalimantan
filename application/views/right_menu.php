<!-- Right Header Navigation -->
<ul class="nav navbar-nav-custom pull-right">

    <!-- User Dropdown -->
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
            <?php
            $user = $this->session->userdata('userdata_desa');

            if ($user['akses'] == 'admin') {
                $akses = 'admin';
                $nama = $user['nama_admin'];
                $pict = $user['pict'];
                echo '<strong>Selamat Datang, ' . $nama . ' </strong>';
                if ($pict == "") {
                    echo '<img src="' . base_url('upload/default.jpg') . '" alt="avatar">';
                } else {
                    echo '<img src="' . base_url('upload/admin/' . $pict) . '" alt="avatar">';
                }
            } else {
                $akses = 'user';
                $nama = $user['nama'];
                $pict = $user['pict'];
                echo '<strong>Selamat Datang, ' . $nama . ' </strong>';
                if ($pict == "") {
                    echo '<img src="' . base_url('upload/default.jpg') . '" alt="avatar">';
                } else {
                    echo '<img src="' . base_url('upload/penduduk/' . $pict) . '" alt="avatar">';
                }
            }
            ?>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-header">
                <strong><?= $nama; ?></strong>
            </li>
            <li>
                <a href="#modal-stok" data-toggle="modal">
                    <i class="fa fa-power-off fa-fw pull-right"></i> Log Out
                </a>
            </li>
        </ul>
    </li>
    <!-- END User Dropdown -->

</ul>
<!-- END Right Header Navigation -->