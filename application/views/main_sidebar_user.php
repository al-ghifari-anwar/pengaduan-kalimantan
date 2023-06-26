                <!-- Main Sidebar -->
                <div id="sidebar">
                    <!-- Sidebar Brand -->
                    <div id="sidebar-brand" class="themed-background-social">
                        <a href="<?php echo site_url('') ?>" class="sidebar-title">
                            <i class=""></i> <span class="fa fa-home sidebar-nav-mini-hide"><strong> SIPEMAS</strong></span>
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
                                    <a href="<?php echo site_url('Home/dashboard') ?>" title="Dashboard" class="<?php if ($aktif == 'home') {
                                                                                                                    echo " active";
                                                                                                                } ?>">
                                        <i class="fa fa-th-large sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-separator">
                                    <i class="fa fa-ellipsis-h"></i>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('pengaduan/tambah') ?>" title="Input Pengaduan" class="<?php if ($aktif == 'input') {
                                                                                                                            echo " active";
                                                                                                                        } ?>">
                                        <i class="gi gi-bookmark sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Input Pengaduan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('pengaduan/data') ?>" title="Data Pengaduan" class="<?php if ($aktif == 'data') {
                                                                                                                            echo " active";
                                                                                                                        } ?>">
                                        <i class="gi gi-file sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Data Pengaduan</span>
                                    </a>
                                </li>
                                <li class="sidebar-separator">
                                    <i class="fa fa-ellipsis-h"></i>
                                </li>

                                <li>
                                    <?php
                                    $user = $this->session->userdata('userdata_desa');
                                    ?>
                                    <a href="<?php echo site_url('profil/profil_detail/' . $user['nik']) ?>" title="Profil" class="<?php if ($aktif == 'profil') {
                                                                                                                                        echo " active";
                                                                                                                                    } ?>">
                                        <i class="fa fa-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">Profil</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('profil/edit_akun/' . $user['nik']) ?>" title="Edit Password" class="<?php if ($aktif == 'akun') {
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
                                <span>&copy; 2023 - </span><a href="https://dlh.banjarmasinkota.go.id/" target="_blank">Dinas Lingkungan Hidup</a>
                            </small>
                        </div>
                    </div>
                    <!-- END Sidebar Extra Info -->
                </div>
                <!-- END Main Sidebar -->