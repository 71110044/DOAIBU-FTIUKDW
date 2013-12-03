<?php
	include("koneksi.php");
	include("utility.php");
	session_start();

	cleanALL($_POST);
	if (isset($_SESSION['id'])) {
		$idnota = $_POST['idnota'];
		$tanggaltransfer = $_POST['tanggaltransfer'];
		$rekening = $_POST['rekening'];

		$qq = "UPDATE nota SET norek = '".$rekening."', tanggalbayar = '".$tanggaltransfer."' WHERE idnota = ".$idnota;
		mysql_query($qq);

	//UPDATE STOK BARANG di ADMIN

	// $qq = "SELECT * FROM keranjang WHERE idnota = ".$idnota;
	// $res = mysql_query($qq);
	// while($data = mysql_fetch_assoc($res)) {
	// 	$qq = "SELECT stok, totalbeli FROM barang WHERE idbarang = ".$data['idbarang'];
	// 	$barang = mysql_fetch_assoc(mysql_query($qq));
	// 	$query = "UPDATE barang set stok = ".($barang['stok']-$data['jumlahbeli']).", totalbeli = ".($barang['totalbeli']+$data['jumlahbeli'])." WHERE idbarang = ".$data['idbarang'];
	// 	mysql_query($query);
	// }
	}
?>

Terima kasih telah melakukan konfirmasi pembayaran.
Kami akan memvalidasi transaksi Anda dan segera mengirim barang Anda dalam waktu 1 x 24 jam.