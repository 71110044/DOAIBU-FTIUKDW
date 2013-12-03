<?php
	include("koneksi.php");
	include("utility.php");
	session_start();

	$idnota;
	$totalbarang = 0;
	$totalbayar = 0;
	if (isset($_SESSION['id'])) {
		$carinota = "SELECT idnota FROM nota WHERE id = ".$_SESSION['id']." AND tanggalbeli IS NULL";
		$res = mysql_query($carinota);
		if (mysql_num_rows($res) > 0) {
			$row = mysql_fetch_assoc($res);
			$idnota = $row['idnota'];
			$qq = "SELECT SUM(subtotal) as totalbayar, SUM(jumlahbeli) as totalbarang FROM keranjang WHERE idnota = ".$idnota;
			$res = mysql_query($qq);
			$data = mysql_fetch_assoc($res);
			if ($data["totalbayar"] != NULL) {
				$totalbarang = $data['totalbarang'];
				$totalbayar = $data['totalbayar'];
			}
		}
	}
	else {
		if (isset($_SESSION['keranjang'])) {
			$data = array();
			$data["totalbarang"] = 0;
			$data["totalbayar"] = 0;
			foreach ($_SESSION['keranjang'] as $value) {
				$data["totalbarang"] += $value["jumlahbeli"];
				$data["totalbayar"] += $value["subtotal"];
			}
			$totalbayar = $data["totalbayar"];
			$totalbarang = $data["totalbarang"];
			// echo json_encode(array("ok"=>true, "totalbarang"=>$data["totalbarang"], "totalbayar"=>$data["totalbayar"]));
		}
	}
	echo json_encode(array("totalbarang"=>$totalbarang,"totalbayar"=>$totalbayar));
?>