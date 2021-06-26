<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creative - Start Bootstrap Theme</title>

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
 <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div> 
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
      <div class="container col-md-7 col-md-offset-2.5">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Edit Data UKM</a></h2>
                <?php foreach($data as $data) 
                echo $data->id_desa; ?>
                <!-- <div class="col-md-4 col-md-offset-4"> -->
                <form action="<?php echo base_url('home/edit_aksi') ?>"  method="post">
                  <input type="hidden" name="id_rekap"class="form-control" id="inputnama" value="<?php echo $data->id_rekap; ?>">
                    <div class="form-group row">
                    <label for="inputnama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-8">
                      <input name="nama"class="form-control" id="inputnama" value="<?php echo $data->nama; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputkecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                    <div class="col-sm-8">
                        <select name="id_kecamatan" id="kategori" class="form-control">
                          <?php foreach($kecdb as $kecdb)?>
                        <option value="<?php echo $kecdb->id_kecamatan;?>"><?php echo $kecdb->nama_kecamatan;?></option>
                        <?php foreach($kecamatan as $kecm):?>
                          <option value="<?php echo $kecm->id_kecamatan;?>"><?php echo $kecm->nama_kecamatan;?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputnama" class="col-sm-3 col-form-label">Desa</label>
                    <div class="col-sm-8">
                        <select name="id_desa" class="subkategori form-control">
                           <?php foreach($kec as $desa)?>
                        <option value="<?php echo $desa->id_desa;?>"><?php echo $desa->nama_desa;?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputalamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-8">
                      <input name="alamat"class="form-control" id="inputalamat" value="<?php echo $data->alamat; ?>">
                    </div>
                  </div>
                    <div class="form-group row">
                    <label for="inputsektor" class="col-sm-3 col-form-label">Sektor</label>
                    <div class="col-sm-8">
                        <select name="id_sektor" id="inputsektor" class="form-control" >
                        <?php foreach($sek as $sek)?>
                        <option value="<?php echo $sek->id_sektor; ?>"><?php echo $sek->nama_sektor; ?>
                            </option>
                       <?php
                            foreach($sektor as $data1){?>
                            <option value="<?php echo $data1->id_sektor; ?>"><?php echo $data1->nama_sektor; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputjenisusaha" class="col-sm-3 col-form-label">Jenis Usaha</label>
                    <div class="col-sm-8">
                        <select name="jenisusaha" id="inputjenisusaha" class="form-control" >
                        <?php foreach($jusaha as $jenis)?>
                        <option value="<?php echo $jenis->id_jenisusaha; ?>"><?php echo $jenis->jenis_usaha; ?>
                            </option>
                        <?php foreach($jenisusaha as $ju){?>
                            <option value="<?php echo $ju->id_jenisusaha; ?>"><?php echo $ju->jenis_usaha; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="inputnamausaha" class="col-sm-3 col-form-label">Nama Usaha</label>
                    <div class="col-sm-8">
                      <input name="namausaha"class="form-control" id="inputnamausaha" value="<?php echo $data->nama_usaha; ?>">
                    </div>
                  </div>
                    <div class="form-group row">
                    <label for="inputjumlahtk" class="col-sm-3 col-form-label">Jumlah Tenaga Kerja</label>
                    <div class="col-sm-8">
                      <input name="jumlahtk"class="form-control" id="inputjumlahtk" value="<?php echo $data->tenaga_kerja; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputalokasuusaha" class="col-sm-3 col-form-label">Lokasi Usaha</label>
                    <div class="col-sm-8">
                      <input name="lokasiusaha"class="form-control" id="inputlokasiusaha" value="<?php echo $data->lokasi_usaha; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputomset" class="col-sm-3 col-form-label">Omset</label>
                    <div class="col-sm-8">
                      <input name="omset"class="form-control" id="inputomset" value="<?php echo $data->omset; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputassets" class="col-sm-3 col-form-label">Assets</label>
                    <div class="col-sm-8">
                      <input name="assets"class="form-control" id="inputassets" value="<?php echo $data->asset; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputassets" class="col-sm-3 col-form-label">Tahun</label>
                    <div class="col-sm-8">
                      <input name="tahun"class="form-control" id="inputassets" value="<?php echo $data->tahun; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputassets" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-8">
                      <input class="btn btn-primary ml-3" type="submit" value="Simpan">
                    </div>
                  </div>
                </form>
                </div>
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
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-2.2.3.min.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#kategori').change(function(){
          var id=$(this).val();
          $.ajax({
            url : "<?php echo base_url();?>index.php/home/listDesa",
            method : "POST",
            data : {id: id},
            async : false,
                dataType : 'json',
            success: function(data){
              var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value="'+ data[i].id_desa +'">'+data[i].nama_desa+'</option>';
                    }
                    $('.subkategori').html(html);
            }
          });
        });
      });
    </script>
     <script>   
    $('#notifications').slideDown('slow').delay(1000).slideUp('slow');
</script>
  </body>

</html>