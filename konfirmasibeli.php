<?php
	include("koneksi.php");
	include("utility.php");
	session_start();

	cleanALL($_POST);
	$totalbeli = $_POST['totalbeli'];
	$metode = $_POST['metode'];
	$transfer = $_POST['transfer'];
	$pesan = $_POST['pesan'];
	$idnota = $_POST['idnota'];

	date_default_timezone_set('Asia/Jakarta');
	$qq = "UPDATE nota set total = ".$totalbeli.", tanggalbeli = '".date("Y-m-d")."', pesan = '".$pesan."', metode = '".$metode."', transfer = '".$transfer."' WHERE idnota = ".$idnota;
	//echo $qq;
	mysql_query($qq);
?>

		Terima kasih telah berbelanja di jerseydw.com.
		Setelah melakukan pembayaran, harap melakukan konfirmasi pembayaran di halaman profil Anda supaya kami dapat mengirim barang pesanan Anda.