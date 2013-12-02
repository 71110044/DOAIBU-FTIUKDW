<?php
	include("koneksi.php");
	include("utility.php");
	session_start();

	$idnota;
	if (isset($_SESSION['id'])) {
		$carinota = "SELECT idnota FROM nota WHERE id = ".$_SESSION['id']." AND tanggalbeli IS NULL";
		$res = mysql_query($carinota);
		if (mysql_num_rows($res) > 0) {
			$row = mysql_fetch_assoc($res);
			$idnota = $row['idnota'];
			$qq = "DELETE FROM keranjang WHERE idnota = ".$idnota;
			mysql_query($qq);
		}
	}
	else {
		$_SESSION['keranjang'] = array();
	}
?>