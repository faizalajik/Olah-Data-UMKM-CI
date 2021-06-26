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
		margin-top: 90px;
	}

	.kotak .input-group{
		margin-bottom: 20px;
	}
	</style>
</head>
<body background="foto/wallpaper motor keren.jpg">	
	<div class="container">
		<?php 
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == "gagal"){
				echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>  Login Gagal !! Username dan Password Salah !!</div>";
			}
		}
		?>
		<div>
			<h1 align="center"><br><br>SISTEM DATA UMKM KABUPATEN BANYUMAS</h1>
		</div>
		<div>
			<form action="<?php echo base_url(); ?>index.php/home/login" method="post">
				<div class="col-md-4 col-md-offset-4 kotak bg-success">
					<h3>Login</h3>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" placeholder="Username" name="username">
					</div>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
						<input type="password" class="form-control" placeholder="Password" name="password">
					</div>
					<div class="input-group col-md-offset-5" >			
						<input type="submit" class="btn btn-primary" value="Login">
					</div >
				</div>
				<center>
				<div class="col-md-4 col-md-offset-4 bg-info">
						<p style="margin-top: 20px">Belum punya Akun?<a href="<?php echo base_url(); ?>home/daftar"> Daftar</a></p>
						<p>Copyright&copy2018</p>
				</div>
				</center>
			</form>
		</div>
	</div>
</body>
</html>