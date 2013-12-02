<?php
	include("koneksi.php");
	include('utility.php');
	session_start();

	if (!empty($_POST['daftarusername']) && !empty($_POST['daftarpassword']) &&
		!empty($_POST['konfirmpassword']) && !empty($_POST['daftaralamat']) &&
		!empty($_POST['daftarkodepos']) && !empty($_POST['daftartelp']) &&
		!empty($_POST['daftarnama']) && !empty($_POST['daftaremail'])) 
	{
		cleanALL($_POST);
		$daftarusername = $_POST['daftarusername'];
		$daftarpassword = $_POST['daftarpassword'];
		$konfirmpassword = $_POST['konfirmpassword'];
		$daftarnama 	= $_POST['daftarnama'];
		$daftaralamat	= $_POST['daftaralamat'];
		$daftarkodepos  = $_POST['daftarkodepos'];
		$daftartelp		= $_POST['daftartelp'];
		$daftaremail	= $_POST['daftaremail'];

		$query1 = "SELECT username FROM user WHERE username = '".$daftarusername."'";

		$res1	= mysql_query($query1);

		if (mysql_num_rows($res1) > 0) {
			
			echo json_encode(array("ok"=>false,"error"=>"Username sudah ada..."));
		}
		else{
			$query = "INSERT INTO user (id,username,password,nama,alamat,kodepos,telepon,admin,email)
					  VALUES (NULL,'".$daftarusername."','".$daftarpassword."','".
					  	$daftarnama."','".$daftaralamat."','".$daftarkodepos."','".
					  	$daftartelp."',0,'".$daftaremail."')";

			$res = mysql_query($query);

			if ($res) 
			{
				$querylastinsert = "SELECT LAST_INSERT_ID() as id FROM user";
				$row = mysql_fetch_assoc(mysql_query($querylastinsert));
				$_SESSION['id'] = $row['id'];
				$_SESSION['username'] = $daftarusername;

				if (isset($_SESSION['keranjang'])) {
					$querynota = "INSERT into nota (idnota, id) VALUES (NULL, ".$_SESSION['id'].")";
					mysql_query($querynota);
					$querylastinsert = "SELECT LAST_INSERT_ID() as idnota FROM nota";
					$row = mysql_fetch_assoc(mysql_query($querylastinsert));
					$idnota = $row['idnota'];

					foreach ($_SESSION['keranjang'] as $key => $value) {
						$querycart = "INSERT into keranjang (idnota, idbarang, jumlahbeli, subtotal) VALUES (".$idnota.", ".$value['idbarang'].", ".$value['jumlahbeli'].", ".$value['subtotal'].")";
						mysql_query($querycart);
					}
					
				}

				echo json_encode(array("ok"=>true, "username"=>$daftarusername,"admin"=>false, "id"=>$_SESSION['id']));
			}
			else
				echo json_encode(array("ok"=>false,"error"=>"Sistem Sedang Error, Coba Lagi!"));
		}
	}
	else {
		echo json_encode(array("ok"=>false,"error"=>"Data harus diisi semua!"));
	}
?>