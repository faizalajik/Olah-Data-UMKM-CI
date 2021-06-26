<!DOCTYPE html>
<html lang="en">
<?php $login=$this->session->userdata('user');  ?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ukm</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/creative.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="<?php echo base_url('index.php/home/home'); ?>">Home</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
 <a class="nav-link js-scroll-trigger" href="<?php echo base_url('index.php/home/viewUkm'); ?>">Data UKM</a>
            <li class="nav-item dropdown">
            <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">Sorting
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item nav-link" href="<?php echo base_url('index.php/home/viewSektor'); ?>">Sektor</a></li>
              <li><a class="dropdown-item nav-link" href="<?php echo base_url('index.php/home/viewSortDesa'); ?>">Wilayah</a></li>
              <li><a class="dropdown-item nav-link" href="<?php echo base_url('index.php/home/Rekap'); ?>">Rekap</a></li>
            </ul>
          </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url('index.php/home/inputUkm'); ?>">Input Data</a>
            </li>
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url('index.php/home/logout'); ?>">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <section class="bg-primary" id="dataukm">
      <div class="container col-md-11 col-md-offset-0.5">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Data UKM</a></h2>
                <form action="<?php echo base_url('index.php/home/getRekapKecamatan'); ?>" method="GET" class="form-inline">
                    <select name="tahun" class="form-control" >
                    <option>Tahun</option>                  
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2021">2021</option>

                </select>
                <select name="kecamatan" class="form-control" >
                <option>Kecamatan</option><?php
                $kecamatan;
                $idk;
                    foreach($kecamatan as $kec){?>
                    <option value="<?php echo $kec->id_kecamatan; ?>" <?php if($this->session->userdata('sess_ringkasan1')== $kec->nama_kecamatan) {echo "selected";}?> ><?php echo $kec->nama_kecamatan; ?>
                    </option>
                    <?php 
                    $kecamatan=$kec->nama_kecamatan;
                    $idk=$kec->id_kecamatan;
                } ?>
                </select>
                <input class="btn btn-primary ml-3" type="submit" value="ok">
                </form>
                <br>
                <?php if($status == 1){ 
                    ?>
                    <a style="margin-bottom:10px" href="<?php echo base_url('index.php/home/LaporanRekap?idk=').$idk; ?>" target="_blank" class="btn btn-primary ml-3"><span class='glyphicon glyphicon-print'></span>  Cetak</a> 
                <h4 class="text-center">REKAP DATA JUMLAH UMKM KECAMATAN <?php echo$this->session->userdata('kecamatan_rekap'); ?></a></h4>
                <h4 class="text-center">KABUPATEN BANYUMAS TAHUN <?php echo $this->session->userdata('tahun_rekap'); ?></a></h4>
                <br>
                <table class="table  table-bordered">
                    <tr>
                        <th rowspan="2">NO</th>
                        <th rowspan="2">SEKTOR EKONOMI</th>
                        <th colspan="3">JUMLAH UNIT USAHA</th>
                        <th rowspan="2">TOTAL UNIT USAHA</th>
                        <th colspan="3">JUMLAH TENAGA KERJA</th>
                        <th rowspan="2">TOTAL TENAGA KERJA</th>
                    </tr>
                        <tr>
                            <th>MIKRO</th>
                            <th>KECIL</th>
                            <th>MENENGAH</th>

                            <th>MIKRO</th>
                            <th>KECIL</th>
                            <th>MENENGAH</th>
                        </tr>

                    <?php
                    $no=0;
                    foreach($satu as $satu);
                    foreach($dua as $dua);
                    foreach($tiga as $tiga);
                    foreach($empat as $empat);
                    foreach($lima as $lima);
                    foreach($enam as $enam);
                    foreach($tujuh as $tujuh);
                    foreach($delapan as $delapan);
                    foreach($sembilan as $sembilan);
                    foreach($sektor as $sek){
                  $no++;
                  
                   ?>
                    <tr>
                        <?php if($no==1){
                            $jml_jnmikro1=$satu->mikro;
                            $jml_jnkecil1=$satu->kecil;
                            $jml_jnmenengah1=$satu->menengah;
                            $jml_jn1=$satu->mikro+$satu->kecil+$satu->menengah;
                            $jml_tkmikro1=$satu->mikrotk;
                            $jml_tkkecil1=$satu->keciltk;
                            $jml_tkmenengah1=$satu->menengahtk;
                            $jml_tk1=$satu->mikrotk+$satu->keciltk+$satu->menengahtk;
                        ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $satu->mikro; ?></td>
                        <td><?php echo $satu->kecil; ?></td>
                        <td><?php echo $satu->menengah; ?></td>
                        <td><?php echo $satu->mikro+$satu->kecil+$satu->menengah; ?></td>
                        <td><?php echo $satu->mikrotk; ?></td>
                        <td><?php echo $satu->keciltk; ?></td>
                        <td><?php echo $satu->menengahtk; ?></td>
                        <td><?php echo $satu->mikrotk+$satu->keciltk+$satu->menengahtk; ?></td>
                        <?php } ?>
                        <?php if($no==2){
                            $jml_jnmikro2=$dua->mikro;
                            $jml_jnkecil2=$dua->kecil;
                            $jml_jnmenengah2=$dua->menengah;
                            $jml_jn2=$dua->mikro+$dua->kecil+$dua->menengah;
                            $jml_tkmikro2=$dua->mikrotk;
                            $jml_tkkecil2=$dua->keciltk;
                            $jml_tkmenengah2=$dua->menengahtk;
                            $jml_tk2=$dua->mikrotk+$dua->keciltk+$dua->menengahtk;
                            ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $dua->mikro; ?></td>
                        <td><?php echo $dua->kecil; ?></td>
                        <td><?php echo $dua->menengah; ?></td>
                        <td><?php echo $dua->mikro+$dua->kecil+$dua->menengah; ?></td>
                        <td><?php echo $dua->mikrotk; ?></td>
                        <td><?php echo $dua->keciltk; ?></td>
                        <td><?php echo $dua->menengahtk; ?></td>
                        <td><?php echo $dua->mikrotk+$dua->keciltk+$dua->menengahtk; ?></td>
                        <?php } ?>
                        <?php if($no==3){
                            $jml_jnmikro3=$tiga->mikro;
                            $jml_jnkecil3=$tiga->kecil;
                            $jml_jnmenengah3=$tiga->menengah;
                            $jml_jn3=$tiga->mikro+$tiga->kecil+$tiga->menengah;
                            $jml_tkmikro3=$tiga->mikrotk;
                            $jml_tkkecil3=$tiga->keciltk;
                            $jml_tkmenengah3=$tiga->menengahtk;
                            $jml_tk3=$tiga->mikrotk+$tiga->keciltk+$tiga->menengahtk;
                            ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $tiga->mikro; ?></td>
                        <td><?php echo $tiga->kecil; ?></td>
                        <td><?php echo $tiga->menengah; ?></td>
                        <td><?php echo $tiga->mikro+$tiga->kecil+$tiga->menengah; ?></td>
                        <td><?php echo $tiga->mikrotk; ?></td>
                        <td><?php echo $tiga->keciltk; ?></td>
                        <td><?php echo $tiga->menengahtk; ?></td>
                        <td><?php echo $tiga->mikrotk+$tiga->keciltk+$tiga->menengahtk; ?></td>
                        <?php } ?>
                        <?php if($no==4){
                            $jml_jnmikro4=$empat->mikro;
                            $jml_jnkecil4=$empat->kecil;
                            $jml_jnmenengah4=$empat->menengah;
                            $jml_jn4=$empat->mikro+$empat->kecil+$empat->menengah;
                            $jml_tkmikro4=$empat->mikrotk;
                            $jml_tkkecil4=$empat->keciltk;
                            $jml_tkmenengah4=$empat->menengahtk;
                            $jml_tk4=$empat->mikrotk+$empat->keciltk+$empat->menengahtk;
                            ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $empat->mikro; ?></td>
                        <td><?php echo $empat->kecil; ?></td>
                        <td><?php echo $empat->menengah; ?></td>
                        <td><?php echo $empat->mikro+$empat->kecil+$empat->menengah; ?></td>
                        <td><?php echo $empat->mikrotk; ?></td>
                        <td><?php echo $empat->keciltk; ?></td>
                        <td><?php echo $empat->menengahtk; ?></td>
                        <td><?php echo $empat->mikrotk+$empat->keciltk+$empat->menengahtk; ?></td>
                        <?php } ?>
                        <?php if($no==5){
                            $jml_jnmikro5=$lima->mikro;
                            $jml_jnkecil5=$lima->kecil;
                            $jml_jnmenengah5=$lima->menengah;
                            $jml_jn5=$lima->mikro+$lima->kecil+$lima->menengah;
                            $jml_tkmikro5=$lima->mikrotk;
                            $jml_tkkecil5=$lima->keciltk;
                            $jml_tkmenengah5=$lima->menengahtk;
                            $jml_tk5=$lima->mikrotk+$lima->keciltk+$lima->menengahtk;
                            ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $lima->mikro; ?></td>
                        <td><?php echo $lima->kecil; ?></td>
                        <td><?php echo $lima->menengah; ?></td>
                        <td><?php echo $lima->mikro+$lima->kecil+$lima->menengah; ?></td>
                        <td><?php echo $lima->mikrotk; ?></td>
                        <td><?php echo $lima->keciltk; ?></td>
                        <td><?php echo $lima->menengahtk; ?></td>
                        <td><?php echo $lima->mikrotk+$lima->keciltk+$lima->menengahtk; ?></td>
                        <?php } ?>
                        <?php if($no==6){
                            $jml_jnmikro6=$enam->mikro;
                            $jml_jnkecil6=$enam->kecil;
                            $jml_jnmenengah6=$enam->menengah;
                            $jml_jn6=$enam->mikro+$enam->kecil+$enam->menengah;
                            $jml_tkmikro6=$enam->mikrotk;
                            $jml_tkkecil6=$enam->keciltk;
                            $jml_tkmenengah6=$enam->menengahtk;
                            $jml_tk6=$enam->mikrotk+$enam->keciltk+$enam->menengahtk;
                            ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $enam->mikro; ?></td>
                        <td><?php echo $enam->kecil; ?></td>
                        <td><?php echo $enam->menengah; ?></td>
                        <td><?php echo $enam->mikro+$enam->kecil+$enam->menengah; ?></td>
                        <td><?php echo $enam->mikrotk; ?></td>
                        <td><?php echo $enam->keciltk; ?></td>
                        <td><?php echo $enam->menengahtk; ?></td>
                        <td><?php echo $enam->mikrotk+$enam->keciltk+$enam->menengahtk; ?></td>


                        <?php } ?>
                        <?php if($no==7){
                            $jml_jnmikro7=$tujuh->mikro;
                            $jml_jnkecil7=$tujuh->kecil;
                            $jml_jnmenengah7=$tujuh->menengah;
                            $jml_jn7=$tujuh->mikro+$tujuh->kecil+$tujuh->menengah;
                            $jml_tkmikro7=$tujuh->mikrotk;
                            $jml_tkkecil7=$tujuh->keciltk;
                            $jml_tkmenengah7=$tujuh->menengahtk;
                            $jml_tk7=$tujuh->mikrotk+$tujuh->keciltk+$tujuh->menengahtk;
                            ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $tujuh->mikro; ?></td>
                        <td><?php echo $tujuh->kecil; ?></td>
                        <td><?php echo $tujuh->menengah; ?></td>
                        <td><?php echo $tujuh->mikro+$tujuh->kecil+$tujuh->menengah; ?></td>
                        <td><?php echo $tujuh->mikrotk; ?></td>
                        <td><?php echo $tujuh->keciltk; ?></td>
                        <td><?php echo $tujuh->menengahtk; ?></td>
                        <td><?php echo $tujuh->mikrotk+$tujuh->keciltk+$tujuh->menengahtk; ?></td>
                        <?php } ?>
                        <?php if($no==8){
                            $jml_jnmikro8=$delapan->mikro;
                            $jml_jnkecil8=$delapan->kecil;
                            $jml_jnmenengah8=$satu->menengah;
                            $jml_jn8=$delapan->mikro+$delapan->kecil+$delapan->menengah;
                            $jml_tkmikro8=$delapan->mikrotk;
                            $jml_tkkecil8=$delapan->keciltk;
                            $jml_tkmenengah8=$delapan->menengahtk;
                            $jml_tk8=$delapan->mikrotk+$delapan->keciltk+$delapan->menengahtk;
                            ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $delapan->mikro; ?></td>
                        <td><?php echo $delapan->kecil; ?></td>
                        <td><?php echo $delapan->menengah; ?></td>
                        <td><?php echo $delapan->mikro+$delapan->kecil+$delapan->menengah; ?></td>
                        <td><?php echo $delapan->mikrotk; ?></td>
                        <td><?php echo $delapan->keciltk; ?></td>
                        <td><?php echo $delapan->menengahtk; ?></td>
                        <td><?php echo $delapan->mikrotk+$delapan->keciltk+$delapan->menengahtk; ?></td>
                        <?php } ?>
                        <?php if($no==9){
                            $jml_jnmikro9=$sembilan->mikro;
                            $jml_jnkecil9=$sembilan->kecil;
                            $jml_jnmenengah9=$sembilan->menengah;
                            $jml_jn9=$sembilan->mikro+$sembilan->kecil+$sembilan->menengah;
                            $jml_tkmikro9=$sembilan->mikrotk;
                            $jml_tkkecil9=$sembilan->keciltk;
                            $jml_tkmenengah9=$sembilan->menengahtk;
                            $jml_tk9=$sembilan->mikrotk+$sembilan->keciltk+$sembilan->menengahtk;
                            ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $sek->nama_sektor; ?></td>
                        <td><?php echo $sembilan->mikro; ?></td>
                        <td><?php echo $sembilan->kecil; ?></td>
                        <td><?php echo $sembilan->menengah; ?></td>
                        <td><?php echo $sembilan->mikro+$sembilan->kecil+$sembilan->menengah; ?></td>
                        <td><?php echo $sembilan->mikrotk; ?></td>
                        <td><?php echo $sembilan->keciltk; ?></td>
                        <td><?php echo $sembilan->menengahtk; ?></td>
                        <td><?php echo $sembilan->mikrotk+$sembilan->keciltk+$sembilan->menengahtk; ?></td>
                        <?php } ?>

                    </tr>
                    <?php 
                        
                    }
                    $jml_jnmikro=$jml_jnmikro1+$jml_jnmikro2+$jml_jnmikro3+$jml_jnmikro4+$jml_jnmikro5+$jml_jnmikro6+$jml_jnmikro7+$jml_jnmikro8+$jml_jnmikro9;
                    $jml_jnkecil=$jml_jnkecil1+$jml_jnkecil2+$jml_jnkecil3+$jml_jnkecil4+$jml_jnkecil5+$jml_jnkecil6+$jml_jnkecil7+$jml_jnkecil8+$jml_jnkecil9;
                    $jml_jnmenengah=$jml_jnmenengah1+$jml_jnmenengah2+$jml_jnmenengah3+$jml_jnmenengah4+$jml_jnmenengah5+$jml_jnmenengah6+$jml_jnmenengah7+$jml_jnmenengah8+$jml_jnmenengah9;
                    $jml_jn=$jml_jn1+$jml_jn2+$jml_jn3+$jml_jn4+$jml_jn5+$jml_jn6+$jml_jn7+$jml_jn8+$jml_jn9;
                    $jml_tkmikro=$jml_tkmikro1+$jml_tkmikro2+$jml_tkmikro3+$jml_tkmikro4+$jml_tkmikro5+$jml_tkmikro6+$jml_tkmikro7+$jml_tkmikro8+$jml_tkmikro9;
                    $jml_tkkecil=$jml_tkkecil1+$jml_tkkecil2+$jml_tkkecil3+$jml_tkkecil4+$jml_tkkecil5+$jml_tkkecil6+$jml_tkkecil7+$jml_tkkecil8+$jml_tkkecil9;
                    $jml_tkmenengah=$jml_tkmenengah1+$jml_tkmenengah2+$jml_tkmenengah3+$jml_tkmenengah4+$jml_tkmenengah5+$jml_tkmenengah6+$jml_tkmenengah7+$jml_tkmenengah8+$jml_tkmenengah9;
                    $jml_tk=$jml_tk1+$jml_tk2+$jml_tk3+$jml_tk4+$jml_tk5+$jml_tk6+$jml_tk7+$jml_tk8+$jml_tk9;
                     ?>
                     <tr>
                         <td colspan="2">TOTAL</td>
                         <td><?php echo $jml_jnmikro; ?></td>
                         <td><?php echo $jml_jnkecil; ?></td>
                         <td><?php echo $jml_jnmenengah; ?></td>
                         <td><?php echo $jml_jn; ?></td>
                         <td><?php echo $jml_tkmikro; ?></td>
                         <td><?php echo $jml_tkkecil; ?></td>
                         <td><?php echo $jml_tkmenengah; ?></td>
                         <td><?php echo $jml_tk; ?></td>
                     </tr>
                        
                </table>
            <?php } ?>
            <!--Tampilkan pagination-->

            </div>
        </div>
    </div>
    </section>
   

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url(); ?>assets/js/creative.min.js"></script>

  </body>


</html>