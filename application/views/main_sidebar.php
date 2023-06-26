                <?php $user = $this->session->userdata('userdata_desa'); ?>
                <!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Sidebar Brand -->
                    <div id="sidebar-brand" class="themed-background-social">
                        <a href="<?php echo site_url('') ?>" class="sidebar-title">
                            <i class=""></i> <span class=" fa fa-home sidebar-nav-mini-hide"><strong> SIPEMAS</strong></span>
                        </a>
                    </div>
                    <!-- END Sidebar Brand -->

                    <!-- Wrapper for scrolling functionality -->
                    <div id="sidebar-scroll">
                        <!-- Sidebar Content -->
                        <div class="sidebar-content">
                            <!-- Sidebar Navigation -->
                            <ul class="sidebar-nav">
                                <li>
                                    <a href="#" title="Menu" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-compass sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Menu</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url('home'); ?>" title="Dashboard" class=" fa fa-th-large sidebar-nav-icon<?php if ($aktif == 'dashboard') {
                                                                                                                                            echo " active";
                                                                                                                                        } ?>"> Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('home/grafik'); ?>" title="Grafik" class=" fa fa-pie-chart sidebar-nav-icon<?php if ($aktif == 'grafik') {
                                                                                                                                                    echo " active";
                                                                                                                                                } ?>"> Grafik</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="sidebar-separator">
                                    <i class="fa fa-ellipsis-h"></i>
                                </li>
                                <?php if ($user['level'] == 'admin' || $user['level'] == 'kepala') : ?>
                                    <?php if ($user['level'] == 'admin') : ?>
                                        <li>
                                            <a href="#" title="Data Master" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-more_items sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Data Master</span></a>
                                            <ul>
                                                <li>
                                                    <a href="<?php echo site_url('master/agama') ?>" title="Agama" class="fa fa-sign-language <?php if ($aktif == 'agama') {
                                                                                                                                                    echo " active";
                                                                                                                                                } ?>"> Agama</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('master/kategori') ?>" title="Kategori" class="fa fa-th-list <?php if ($aktif == 'kategori') {
                                                                                                                                                    echo " active";
                                                                                                                                                } ?>"> Kategori</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('master/eksekutor') ?>" title="Eksekutor" class="fa fa-user-secret <?php if ($aktif == 'eksekutor') {
                                                                                                                                                        echo " active";
                                                                                                                                                    } ?>"> Eksekutor</a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a href="<?php echo site_url('penduduk') ?>" title="Data Penduduk" class="<?php if ($aktif == 'penduduk') {
                                                                                                                        echo " active";
                                                                                                                    } ?>">
                                            <i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Data Penduduk</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?php echo site_url('surat') ?>" title="Surat" class="<?php if ($aktif == 'surat' || $aktif == 'data') {
                                                                                                            echo " active";
                                                                                                        } ?>">
                                            <i class="gi gi-file sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Surat</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('pengaduan') ?>" title="Data Pengaduan" class="<?php if ($aktif == 'pengaduan' || $aktif == 'data') {
                                                                                                                        echo " active";
                                                                                                                    } ?>">
                                            <i class="gi gi-file sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Data Pengaduan</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?php echo site_url('tindakan') ?>" title="Data Tindakan" class="<?php if ($aktif == 'tindakan') {
                                                                                                                    echo " active";
                                                                                                                } ?>">
                                        <i class="fa fa-rocket sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Data Tindakan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Laporan" class="sidebar-nav-menu"><i class="fa fa-chevron-left sidebar-nav-indicator sidebar-nav-mini-hide"></i><i class="gi gi-more_items sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Laporan</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url('laporan/pengaduan') ?>" title="Pengaduan" class="fa fa-bullhorn <?php if ($aktif == 'laporanpengaduan') {
                                                                                                                                        echo " active";
                                                                                                                                    } ?>"> Pengaduan</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('laporan/tindakan') ?>" title="Tindakan" class="fa fa-gavel <?php if ($aktif == 'laporantindakan') {
                                                                                                                                    echo " active";
                                                                                                                                } ?>"> Tindakan</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-separator">
                                    <i class="fa fa-ellipsis-h"></i>
                                </li>
                                <?php
                                $user = $this->session->userdata('userdata_desa');
                                if ($user['akses'] == 'user') {
                                ?>

                                    <li>
                                        <a href="<?php echo site_url('profil/profil_admin/' . $user['id_admin']) ?>" title="Profil" class="<?php if ($aktif == 'profil') {
                                                                                                                                                echo " active";
                                                                                                                                            } ?>">
                                            <i class="fa fa-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Profil</span>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                <?php } ?>
                                <?php if ($user['level'] == 'admin') : ?>
                                    <li>
                                        <a href="<?php echo site_url('admin') ?>" title="Admin Sistem" class="<?php if ($aktif == 'admin') {
                                                                                                                    echo " active";
                                                                                                                } ?>">
                                            <i class="fa fa-users sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Admin Sistem</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?php echo site_url('profil/edit_akun_admin/' . $user['id_admin']) ?>" title="Edit Password" class="<?php if ($aktif == 'akun') {
                                                                                                                                                        echo " active";
                                                                                                                                                    } ?>">
                                        <i class="fa fa-key sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Edit Password</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- END Sidebar Navigation -->

                        </div>
                        <!-- END Sidebar Content -->
                    </div>
                    <!-- END Wrapper for scrolling functionality -->

                    <!-- Sidebar Extra Info -->
                    <div id="sidebar-extra-info" class="sidebar-content sidebar-nav-mini-hide">
                        <div class="text-center">
                            <small>
                                <span></span> &copy; 2023 - <a href="https://dlh.banjarmasinkota.go.id/" target="_blank">Dinas Lingkungan Hidup</a>
                            </small>
                        </div>
                    </div>
                    <!-- END Sidebar Extra Info -->
                </div>
                <!-- END Main Sidebar -->