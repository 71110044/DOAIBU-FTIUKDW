<?php
	include("koneksi.php");
	if (isset($_POST['daftarusername']) && isset($_POST['daftarpassword']) && isset($_POST['konfirmpassword']) && isset($_POST['daftaralamat']) && isset($_POST['daftarkodepos']) && isset($_POST['daftartelp']) && isset($_POST['daftarnama']) && isset($_POST['daftaremail'])) 
	{

		$daftarusername = $_POST['daftarusername'];
		$daftarpassword = $_POST['daftarpassword'];
		$konfirmpassword = $_POST['konfirmpassword'];
		$daftarnama 	= $_POST['daftarnama'];
		$daftaralamat	= $_POST['daftaralamat'];
		$daftarkodepos  = $_POST['daftarkodepos'];
		$daftartelp		= $_POST['daftartelp'];
		$daftaremail	= $_POST['daftaremail'];


		$query = "INSERT INTO user (id,username,password,nama,alamat,kodepos,telepon,admin,email) VALUES (NULL,'".$daftarusername."','".$daftarpassword."','".$daftarnama."','".$daftaralamat."','".$daftarkodepos."','".$daftartelp."',0,'".$daftaremail."')";

		$res = mysql_query($query) or die ("ini gagal query");
	}
?>