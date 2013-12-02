<?php
	include("koneksi.php");
	include("utility.php");
	session_start();
?>
	<div id="profilku">
		<h3 style="margin-left: 200px;">Konfirmasi Pembelian</h3>
		<form method="post" action="checkout.php">
			Metode Pengiriman : <input type="text" name="metodekirim"/><br/>
			Metode Pembayaran : <input type="text" name="metodebayar"/><br/>
			Pesan			  : <textarea name="pesan"></textarea><br/>
		</form>
	
	</div>