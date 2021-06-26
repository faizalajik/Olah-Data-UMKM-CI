<!DOCTYPE html>
<html>
<head>
	<title>Showroom</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.js"></script>
	<style type="text/css">
	.kotak{	
		margin-top: 150px;
	}
	</style>
</head>
<body background="foto/wallpaper motor keren.jpg">	
	<div class="col-md-4 col-md-offset-4 kotak bg-success">
		<center><h3>Form Pendaftaran</h3></center>
		<form class="form-horizontal" method="POST" action="<?php echo base_url('index.php/home/inputDaftar'); ?>">
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Nama</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="nama" placeholder="nama">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Username</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="username" placeholder="username">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
		      <input type="Password" class="form-control" name="password" placeholder="*********">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-success">Simpan</button>
		    </div>
		  </div>
		</form>
	</div>	
	<center>
		<div class="col-md-4 col-md-offset-4 bg-info">
			<p style="margin-top: 20px">Copyright&copy2019s</a></p>
		</div>
	</center>												
</body>
</html>