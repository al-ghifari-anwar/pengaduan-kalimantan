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
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 4cm;
            }
            
            .judul_atas {
                margin-top:-170px;
                margin-left:-65px;
            }

            .garis_judul_atas {
                margin-top:-15px;
            }

            .div_logo {
            }

            .logo {
                margin-top: -90px;
                width: 160px;
                height: 140px;
            }

            .div_kop{
                margin-left: 120px;
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
                border-bottom: 5px solid #000000;
            }

            .garis_dua {
                margin-top:3px;
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

            .filter {
                margin-top:2px;
                margin-left:30px;
                font-size: 11;
                font-family: sans-serif;
                text-align: left;
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
                margin-left:550px;
                font-size: 11;
                font-family: sans-serif;
                position:fixed;
            }

            .kepala_dinas {
                margin-top:24px;
                margin-left:550px;
                font-size: 11;
                font-family: sans-serif;
                position:fixed;
            }

            .nama_kepala {
                margin-top:97px;
                margin-left:550px;
                font-size: 11;
                font-family: sans-serif;
                position:fixed;
            }

            .pembina {
                margin-top:113px;
                margin-left:550px;
                font-size: 11;
                font-family: sans-serif;
                position:fixed;
            }

            .nip {
                margin-top:130px;
                margin-left:550px;
                font-size: 11;
                font-family: sans-serif;
                position:fixed;
            }

            footer {
                position: fixed; 
                bottom: 0.5cm; 
                left: 0cm; 
                right: 0cm;
                height: 350px;
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
        </div>    
        <div class="div_logo">
            <img class="logo" src="<?= 'upload/logo.png';?>">
        </div>
        <div class="div_kop">
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
        </div>
        <p class="garis_satu" style="margin-top:3%;"></p>   
        <p class="garis_dua" style="margin-top:-10px;"></p> 
        <div class="cetak">
            <span><b>Cetak : <?= $nama;?><b></span>
        </div>
        <div class="tanggal_cetak">
            <span><b>Tanggal Cetak : <?= $tgl;?></b></span>
        </div>
        <div class="filter">
            <span><b>Filter &nbsp;: <?= $bulan;?> <?= $year;?></b></span>
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
                        <th style="text-align:center;">Nama Laporan</th>
                        <th style="text-align:center;">Bentuk Tindakan</th>
                        <th style="text-align:center;">Tim Eksekutor</th>
                        <th style="text-align:center;">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($tindak_lanjut as $data) { ?>
                    <tr>
                        <td scope="row" style="text-align:center;"><?= $no;?></td>
                        <td style="text-align:center;"><?= date('d-m-Y', strtotime($data['tanggal']));?></td>
                        <td><?= $data['nama_laporan'];?></td>
                        <td><?= $data['bentuk_tindakan'];?></td>
                        <td style="text-align:center;"><?= $data['tim_eksekutor'];?></td>
                        <td><?= $data['hasil'];?></td>
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