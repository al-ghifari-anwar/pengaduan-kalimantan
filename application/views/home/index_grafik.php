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

        <!-- Forms Components Header -->

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

                            <li>Grafik Berdasarkan Pengaduan & Kategori</li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

        <!-- END Table Styles Header -->

        <!-- END Forms Components Header -->



        <!-- Form Components Row -->

        <div class="row">

            <div class="col-sm-4">

                <div class="block full">
                    <div class="block-title">
                        <h2>Filter</h2>
                    </div>
                    <div class="row">
                        <!-- <div class="col-sm-12"> -->
                        <form action="<?= base_url('home/grafik') ?>" method="POST">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-md-3 form-label">Bulan</label>
                                    <div class="col-md-9">
                                        <select name="month" id="" class="form-control">
                                            <option value="01" <?= $month == '01' ? 'selected' : '' ?>>Januari</option>
                                            <option value="02" <?= $month == '02' ? 'selected' : '' ?>>Februari</option>
                                            <option value="03" <?= $month == '03' ? 'selected' : '' ?>>Maret</option>
                                            <option value="04" <?= $month == '04' ? 'selected' : '' ?>>April</option>
                                            <option value="05" <?= $month == '05' ? 'selected' : '' ?>>Mei</option>
                                            <option value="06" <?= $month == '06' ? 'selected' : '' ?>>Juni</option>
                                            <option value="07" <?= $month == '07' ? 'selected' : '' ?>>Juli</option>
                                            <option value="08" <?= $month == '08' ? 'selected' : '' ?>>Agustus</option>
                                            <option value="09" <?= $month == '09' ? 'selected' : '' ?>>September</option>
                                            <option value="10" <?= $month == '10' ? 'selected' : '' ?>>Oktober</option>
                                            <option value="11" <?= $month == '11' ? 'selected' : '' ?>>November</option>
                                            <option value="12" <?= $month == '12' ? 'selected' : '' ?>>Desember</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-danger">Terapkan</button>
                            </div>
                        </form>
                        <!-- </div> -->
                    </div>
                </div>

            </div>

            <div class="col-sm-8">

                <div class="block full">

                    <div class="block-title">

                        <h2><?= $grafik_pengaduan; ?> <b style="">" <?= bulan_panjang($month); ?> "</b></h2>

                    </div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-9">
                                <div class="mypiechart">
                                    <center><canvas id="grafik_pengaduan" width="400" height="397"></canvas></center>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="col-md-2">
                                    <div style="width:30px;height:35px;background-color:#deb25c;"></div>
                                </div>
                                <div class="col-md-10">
                                    <h4 style="margin-right:15px;"><b>Pengaduan</b></h4>
                                </div>
                                <div class="col-md-2">
                                    <div style="width:30px;height:35px;background-color:#afde5c;"></div>
                                </div>
                                <div class="col-md-10">
                                    <h4 style="margin-right:15px;"><b>Sudah Verifikasi</b></h4>
                                </div>
                                <div class="col-md-2">
                                    <div style="width:30px;height:35px;background-color:#de4b39;"></div>
                                </div>
                                <div class="col-md-10">
                                    <h4 style="margin-right:15px;"><b>Belum Verifikasi</b></h4>
                                </div>
                                <div class="col-md-2">
                                    <div style="width:30px;height:35px;background-color:#45a7b9;"></div>
                                </div>
                                <div class="col-md-10">
                                    <h4 style="margin-right:15px;"><b>Tindak Lanjut</b></h4>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-sm-12">

                <div class="block full">

                    <div class="block-title">

                        <h2><?= $grafik_kategori; ?> <b style="">" <?= bulan_panjang($month); ?> "</b></h2>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="mypiechart" width="1000">

                                <canvas id="myChart"></canvas>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- END Page Content -->

</div>

<!-- END Main Container -->



<?php $this->load->view('footer'); ?>

<script src="<?= base_url('assets/chart/rpie.js'); ?>"></script>

<script src="<?= base_url('assets/chart/chart.min.js'); ?>"></script>

<script type="text/javascript">
    var pengaduan = {
        values: [<?= $count_all->pengaduan; ?>, <?= $verif->pengaduan; ?>, <?= $not_verif->pengaduan; ?>, <?= $tindak_lanjut->pengaduan; ?>],
        colors: ['#deb25c', '#afde5c', '#de4b39', '#45a7b9'],
        animation: true,
        animationSpeed: 30,
        fillTextData: true,
        fillTextColor: '#fff',
        fillTextAlign: 1.50,
        fillTextPosition: 'inner',
        doughnutHoleSize: null,
        doughnutHoleColor: '#fff',
        offset: 1
    };
    generatePieGraph('grafik_pengaduan', pengaduan);
</script>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {

        type: 'bar',

        data: {

            labels: ['Penyaranan', 'Perusakan', 'Pencemaran', 'Pelayanan', 'Pengaduan'],

            datasets: [{

                label: 'Kategori',

                data: [<?= $penyaranan->kategori; ?>, <?= $perusakan->kategori; ?>, <?= $pencemaran->kategori; ?>, <?= $pelayanan->kategori; ?>, <?= $pengaduan_kat->kategori; ?>],

                backgroundColor: [

                    '85',

                    '80',

                    '70',

                    '40',

                    '75'

                ],

                borderColor: [

                    'rgba(255, 99, 132, 1)',

                    'rgba(54, 162, 235, 1)',

                    'rgba(255, 206, 86, 1)',

                    'rgba(75, 192, 192, 1)',

                    'rgba(153, 102, 255, 1)'

                ],

                borderWidth: 2

            }]

        },

        options: {

            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Kategori Pengaduan'
                }
            },
            scales: {

                y: {

                    beginAtZero: true

                }

            }

        }

    });
</script>