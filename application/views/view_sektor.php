<!DOCTYPE html>
<html lang="en">
<?php $login=$this->session->userdata('user');  ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ukm</title>
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/creative.min.css" rel="stylesheet">
  </head>
  <body id="page-top">
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
          <?php 
          if ($login == "anjaradmin"){ ?>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url('index.php/home/inputUkm'); ?>">Input Data</a>
            </li>
           <?php } ?>
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
                <div class="form-group">
                </div>             
                <br/>
                <form action="<?php echo base_url('index.php/home/paginationSektor'); ?>" method="GET" class="form-inline">
                 <select name="tahun" class="form-control" >
                <option>Tahun</option>                  
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2021">2021</option>
                    
                </select>
                <select name="kecamatan" class="form-control" >
                <option>Kecamatan</option><?php
                    foreach($data as $data1){?>
                    <option value="<?php echo $data1->id_kecamatan; ?>"> <?php echo $data1->nama_kecamatan; ?>
                    </option>
                    <?php } ?>
                </select>
                <select name="select" class="form-control" >
                <option>Sektor</option><?php               
                    foreach($sek as $data1){?>
                    <option value="<?php echo $data1->nama_sektor; ?>"<?php if($this->session->userdata('sess_ringkasan')== $data1->nama_sektor) {echo "selected";}?>><?php echo $data1->nama_sektor; ?>
                    </option>
                    <?php } ?>
                </select>
                <input class="btn btn-primary ml-3" type="submit" value="ok">
                </form>
                <br>                
                <?php 
                if ($status==1 && $rek != null){ ?>
                   <form action="<?php base_url('Home/pagination'); ?>" method="GET" class="form-inline">
                    <input class="form-control" type="text" name="cari" placeholder="Cari ..">
                    <input class="btn btn-primary ml-3" type="submit" value="CARI">
                    </form>
                    <br>
                    <?php
                    $cari = $this->session->userdata('sess_ringkasan2');
                    foreach($rek as $x)?>
                 <a style="margin-bottom:10px" href="<?php echo base_url('index.php/home/Laporan?ids=').$x->id_sektor.'&idk='.$x->id_kecamatan.'&cari='.$cari; ?>" target="_blank" class="btn btn-primary ml-3"><span class='glyphicon glyphicon-print'></span>  Cetak</a> 
                <br>
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Desa</th>
                        <th>Sektor</th>
                        <th>Jenis Usaha</th>
                        <th>Tenaga Kerja</th>
                        <th>Nama Usaha</th>
                        <th>Lokasi Usaha</th>
                        <th>Omset (Rp)</th>
                        <th>Assets (Rp)</th>
                        <?php  if ($login == "anjaradmin"){ ?>
                        <th>Opsi</th>
                        <?php } ?>
                    </tr>
                    <?php $no=$this->uri->segment('3');
                    $kode=1;
                    foreach($rek as $data){
                  $no++; ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data->nama; ?></td>
                        <td><?php echo $data->alamat; ?></td>
                        <td><?php echo $data->nama_desa; ?></td>
                        <td><?php echo $data->nama_sektor; ?></td>
                        <td><?php echo $data->jenis_usaha; ?></td>                      
                        <td><?php echo $data->tenaga_kerja; ?></td>
                        <td><?php echo $data->nama_usaha; ?></td>
                        <td><?php echo $data->lokasi_usaha; ?></td>
                        <td><?php echo $data->omset; ?></td>
                        <td><?php echo $data->asset; ?></td>
                         <?php  if ($login == "anjaradmin"){ ?>
                        <td><a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='<?php echo base_url('index.php/home/paginationSektor?idr=').$data->id_rekap; ?>' }" class="btn btn-danger">Hapus</a>
                            <a href="<?php echo base_url('index.php/home/editSektor?idr=').$data->id_rekap.'&idd='.$data->id_desa.'&kode='.$kode; ?>" class="btn btn-warning">Edit</a></td>
                    </tr>
                        <?php } } ?>                   
                </table>
                <?php  echo $pagination;  echo 'jumlah data ', $jum; } else { echo "Data Tidak Ada"; } ?>
            </div>
        </div>
    </div>
    </section>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/creative.min.js"></script>
  </body>
</html>