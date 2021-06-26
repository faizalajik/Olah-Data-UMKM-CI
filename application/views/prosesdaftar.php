<?php
	include "koneksi.php";
	include "rc4.php" ; 

	$nama	=$_POST['nama'];
	$username	=$_POST['username'];
	$password	=$_POST['password'];
	$retype =$_POST['retype'];
	$email =$_POST['email'];
	$foto=$_FILES['foto']['name'];
	$rc4 = new rc4() ; 
	$chiperu = $rc4->proses($username) ;
	$chipern = $rc4->proses($nama) ;
	$chiperp = $rc4->proses($password) ;
	$chipere = $rc4->proses($email) ;
	
	if($password==$retype){
		move_uploaded_file($_FILES['foto']['tmp_name'], "foto/".$_FILES['foto']['name']);
		$query	= mysqli_query($konek,"Insert into akun values('$chipern','$chiperu','$chiperp','$chipere','$foto')") or die (mysqli_error($konek));
		if($query){
		header("location:login.php");
		}
	}else{
		header("location:daftar.php?pesan=tidak_sama");
	}
?>