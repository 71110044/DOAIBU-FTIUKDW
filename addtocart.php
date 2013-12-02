<?php
	include("koneksi.php");
	include("utility.php");
	session_start();

	cleanALL($_POST);
	$idb = $_POST['id'];
	$jumlahbeli = $_POST['jumlahbeli'];
	$harga = $_POST['harga'];

	if (isset($_SESSION['id'])) 
	{
		 	$idnota;
			$carinota = "SELECT idnota FROM nota WHERE id = ".$_SESSION['id']." AND tanggalbeli IS NULL";
			$res = mysql_query($carinota);

			//CEK APAKAH ADA NOTA YANG BELUM CHECKOUT...
			if (mysql_num_rows($res) > 0) {
				// Belum checkout, maka pake nota yang lama...
				$row = mysql_fetch_assoc($res);
				$idnota = $row['idnota'];
			}
			else {
				// Jika user udah checkout, maka ganti nota baru...
				$querynota = "INSERT into nota (idnota, id) VALUES (NULL, ".$_SESSION['id'].")";
				mysql_query($querynota);
				$querylastinsert = "SELECT LAST_INSERT_ID() as idnota FROM nota";
				$row = mysql_fetch_assoc(mysql_query($querylastinsert));
				$idnota = $row['idnota'];
			}

			// CEK APAKAH DI KERANJANG SUDAH ADA BARANG $idb ATAU BELUM...
			$caribarang = "SELECT * FROM keranjang WHERE idnota = ".$idnota." AND idbarang = ".$idb;
			$res = mysql_query($caribarang);
			if (mysql_num_rows($res) > 0) {
				$data = mysql_fetch_assoc($res);
				$querycart = "UPDATE keranjang SET jumlahbeli = ".($data["jumlahbeli"]+$jumlahbeli).", subtotal = ".($data["subtotal"]+$jumlahbeli*$harga)." WHERE idnota = ".$idnota." AND idbarang = ".$idb;
				mysql_query($querycart);
			}
			else {
				$querycart = "INSERT into keranjang (idnota, idbarang, jumlahbeli, subtotal) VALUES (".$idnota.", ".$idb.", ".$jumlahbeli.", ".$jumlahbeli*$harga.")";
				mysql_query($querycart);
			}
			
			// YANG PERLU DIKEMBALIKAN: total item, total bayar
			$qq = "SELECT SUM(subtotal) as totalbayar, SUM(jumlahbeli) as totalbarang FROM keranjang WHERE idnota = ".$idnota;
			$res = mysql_query($qq);
			$data = mysql_fetch_assoc($res);
	}
	else {
		$databaru = array();
		$idkeranjang;

		$adabarang = false;

		if (!isset($_SESSION['keranjang']))
			$_SESSION['keranjang'] = array();
		
		foreach ($_SESSION['keranjang'] as $key => $value) {
			if ($value["idbarang"] == $idb) {
				$adabarang = true;
				$idkeranjang = $key;
				$databaru = $value;
				break;
			}
		}
		
		if ($adabarang) {
			$databaru["jumlahbeli"] += $jumlahbeli;
			$databaru["subtotal"] += $jumlahbeli*$harga;

			$_SESSION["keranjang"][$idkeranjang] = $databaru;
		}
		else {
			$databaru["idbarang"] = $idb;
			$databaru["jumlahbeli"] = $jumlahbeli;
			$databaru["subtotal"] = $jumlahbeli*$harga;
			
			$_SESSION["keranjang"][] = $databaru;
		}
		
		// YANG PERLU DIKEMBALIKAN: total item, total bayar
		$data = array();
		$data["totalbarang"] = 0;
		$data["totalbayar"] = 0;
		foreach ($_SESSION['keranjang'] as $value) {
			$data["totalbarang"] += $value["jumlahbeli"];
			$data["totalbayar"] += $value["subtotal"];
		}
	}

	echo json_encode(array("ok"=>true, "totalbarang"=>$data["totalbarang"], "totalbayar"=>$data["totalbayar"], "login"=>isset($_SESSION['id'])));
?>