<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= $title;?></title>

        <style>

            @page {

                margin: 0cm 0cm;

            }



            /** Define now the real margins of every page in the PDF **/

            body {

                margin-top: 4cm;

                margin-left: 2cm;

                margin-right: 2cm;

                margin-bottom: 4cm;

            }

            

            .judul_atas {

                margin-top:-170px;

                margin-left:-65px;

            }



            .garis_judul_atas {

                margin-top:-15px;

                margin-left:-10px;

                width:1120px;

            }



            .div_logo {

                margin-left: 70px;

            }



            .logo {

                margin-top: -90px;

                width: 160px;

                height: 140px;

            }



            .pemerintah {

                font-size: 12;

                font-family: sans-serif;

                text-align: center;

            }



            .kantor {

                font-size: 14;

                font-family: sans-serif;

                text-align: center;

            }



            .alamat {

                font-size: 11;

                font-family: sans-serif;

                text-align: center;

            }



            .telp_fax {

                font-size: 11;

                font-family: sans-serif;

                text-align: center;

            }



            .email {

                font-size: 11;

                font-family: sans-serif;

                text-align: center;

            }



            .garis_satu {

                margin-top:-45px;

                margin-left:80px;

                width:850px;

                border-bottom: 2px solid #000000;

            }



            .garis_dua {

                margin-top:3px;

                margin-left:80px;

                width:850px;

                border-bottom: 2px solid #000000;

            }



            .cetak {

                margin-top:10px;

                margin-left:30px;

                font-size: 11;

                font-family: sans-serif;

                text-align: left;

            }



            .tanggal_cetak {

                margin-top:-14px;

                margin-right: 50px;

                font-size: 11;

                font-family: sans-serif;

                text-align: right;

            }



            .judul {

                margin-top: 5px;

                font-family: sans-serif;

            } 

            

            #table {

                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

                border-collapse: collapse;

                width: 100%;

            }



            #table th{

                background: #BBB !important;

                color: #000;

                font-weight: normal;

                padding-top: 1px;

                padding-bottom: 1px;

                border: 1px solid #000;

            }



            #table td {

                border: 1px solid #000;

                padding:3px;

                font-size:10;

            }



            #table tr:nth-child(even){background-color: #fff;}



            #table tr:hover {background-color: #ddd;}



            .kota_tanggal {

                margin-top:5px;

                margin-left:830px;

                font-size: 11;

                font-family: sans-serif;

                position:fixed;

            }



            .kepala_dinas {

                margin-top:24px;

                margin-left:830px;

                font-size: 11;

                font-family: sans-serif;

                position:fixed;

            }



            .nama_kepala {

                margin-top:97px;

                margin-left:830px;

                font-size: 11;

                font-family: sans-serif;

                position:fixed;

            }



            .pembina {

                margin-top:113px;

                margin-left:830px;

                font-size: 11;

                font-family: sans-serif;

                position:fixed;

            }



            .nip {

                margin-top:130px;

                margin-left:830px;

                font-size: 11;

                font-family: sans-serif;

                position:fixed;

            }



            footer {

                position: fixed; 

                bottom: 0.5cm; 

                left: 0cm; 

                right: 0cm;

                height: 150px;

                background-color: #fff;

                color: #000;

                text-align: center;

                line-height: -3cm;

            }

        </style>

    </head>

    <body>

        <div class="judul_atas">

            <h4><?= $title;?></h4>

            <hr class="garis_judul_atas">

        </div>    

        <div class="div_logo">

            <img class="logo" src="<?= 'upload/logo.png';?>">

        </div>

        <div class="pemerintah">

            <h3 style="margin-top: -120px;"><?= $pemerintah;?></h3>

        </div>

        <div class="kantor">

            <h3 style="margin-top: -100px;"><?= $kantor;?></h3>

        </div>

        <div class="alamat">

            <p style="margin-top: -70px;"><?= $alamat;?></p>

        </div>

        <div class="telp_fax">

            <p style="margin-top: -49px;"><?= $telp_fax;?></p>

        </div>

        <div class="email">

            <p style="margin-top: -30px;"><span>Email : <span style="color:#0000ff;"><?= $email;?></span></span></p>

        </div>

        <p class="garis_satu" style="margin-top:3%;"></p>   

        <p class="garis_dua" style="margin-top:-10px;"></p> 

        <div class="cetak">

            <span><b>Cetak : <?= $nama;?><b></span>

        </div>

        <div class="tanggal_cetak">

            <span><b>Tanggal Cetak : <?= $tgl;?></b></span>

        </div>  

        <div class="judul">

            <h2 style="text-align:center"><?= $judul;?></h2>

        </div>

        <main>

            <table id="table">

                <thead>

                    <tr>

                        <th style="width:5%;">No</th>

                        <th style="width:11%;">Tanggal</th>

                        <th>Nama Laporan</th>

                        <th>Kategori</th>

                        <th>Tempat</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                <?php $no=1; foreach ($pengaduan as $data) { ?>

                    <tr>

                        <td scope="row" style="text-align:center;"><?= $no;?></td>

                        <td style="text-align:center;"><?= date('d-m-Y', strtotime($data['tanggal']));?></td>

                        <td><?= $data['nama_laporan'];?></td>

                        <td style="text-align:center;"><?= $data['nama_kategori'];?></td>

                        <td style="text-align:center;"><?= $data['tempat'];?></td>

                        <?php if($data['status'] == 1) { ?>

                            <td style="text-align:center;"><img src="<?= 'upload/no.png';?>" width="120" height="35"></td>

                        <?php }else{ ?>    

                            <td style="text-align:center;"><img src="<?= 'upload/yes.png';?>" width="120" height="35"></td>

                        <?php } ?>    

                    </tr>

                <?php $no++; } ?>    

                </tbody>

            </table>

        </main>    

        <footer>

            <div class="kota_tanggal">

                <span>Banjarmasin, <?= $tgl;?></span>

            </div>

            <div class="kepala_dinas">

                <span>Kepala Dinas</span>

            </div>

            <div class="nama_kepala">

                <span><b>Alive Yoesfah Love, S.IP</b></span>

            </div>

            <div class="pembina">

                <span>Pembina Utama Muda</span>

            </div>

            <div class="nip">

                <span>NIP.19681107 198903 1 009</span>

            </div>

        </footer>    

    </body>

</html>

