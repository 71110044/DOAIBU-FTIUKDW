<?php
	include("koneksi.php");
	include("utility.php");
	session_start();
?>

<center><h4>Keranjang Belanja</h4></center>
<?php
	$carinota = "SELECT idnota FROM nota WHERE id = ".$_SESSION['id']." AND tanggalbeli IS NULL";
	$hasil = mysql_query($carinota);
	$idnota;
	if (mysql_num_rows($hasil) > 0) {
		$data = mysql_fetch_assoc($hasil);
		$idnota = $data['idnota'];
		$total = 0;
		$query = "SELECT a.namabarang as namabarang, b.jumlahbeli as jumlahbeli, a.harga as harga, b.subtotal as subtotal, b.idbarang as idbarang  from barang a , keranjang b WHERE a.idbarang = b.idbarang AND b.idnota = ".$idnota;

		$res = mysql_query($query);?>
		
		<table border="1">
		
		<tr>
			<td>Nama Barang</td>
			<td>Jumlah Beli</td>
			<td>Harga</td>
			<td>Subtotal</td>
			<td>Hapus</td>
		</tr>
		<?php while ($data = mysql_fetch_assoc($res)) {?>
		<tr>
			<td><?php echo $data['namabarang'];?></td>
			<td><?php echo $data['jumlahbeli'];?></td>
			<td><?php echo $data['harga'];?></td>
			<td><?php echo $data['subtotal'];?></td>
			<td><center><img src="images/silang.png" width="10" height="10" class="hapus" id="hapus-<?php echo $idnota; ?>-<?php echo $data['idbarang']; ?>"/></center></td>
		</tr>
		<?php
			$total += $data['subtotal'];
		 } ?>
		<tr>
			<td>Total</td>
			<td colspan="4"><span id="totalbeli"><?php echo $total; ?></span></td>
		</tr>
		</table>
		Metode Pengiriman :
		<select name="metode" id="metode">
			<option value="JNE">JNE</option>
			<option value="TIKI">TIKI</option>
		</select><br/>
		Metode Pembayaran :
		<select name="transfer" id="transfer">
			<option value="BCA">BCA</option>
			<option value="Mandiri">Mandiri</option>
		</select><br/>
		Pesan :<input type="text" name="pesan" id="pesan"/><br/>
		<input type="submit" name="checkout-<?php echo $idnota; ?>" value="Beli" id="checkout"/>
	<?php 
		}
			$carinota = "SELECT idnota FROM nota WHERE id = ".$_SESSION['id']." AND tanggalbeli IS NOT NULL AND tanggalbayar IS NULL";
			$hasil = mysql_query($carinota);
			$idnota;
			if (mysql_num_rows($hasil) > 0) {
				while ($data2 = mysql_fetch_assoc($hasil)) {
					$idnota = $data2['idnota'];
					$total = 0;
					$query = "SELECT a.namabarang as namabarang, b.jumlahbeli as jumlahbeli, a.harga as harga, b.subtotal as subtotal, b.idbarang as idbarang  from barang a , keranjang b WHERE a.idbarang = b.idbarang AND b.idnota = ".$idnota;

					$res = mysql_query($query);?>
					
					<table border="1">
					
					<tr>
						<td>Nama Barang</td>
						<td>Jumlah Beli</td>
						<td>Harga</td>
						<td>Subtotal</td>
						<td>Hapus</td>
					</tr>
					<?php while ($data = mysql_fetch_assoc($res)) {?>
					<tr>
						<td><?php echo $data['namabarang'];?></td>
						<td><?php echo $data['jumlahbeli'];?></td>
						<td><?php echo $data['harga'];?></td>
						<td><?php echo $data['subtotal'];?></td>
						<td><center><img src="images/silang.png" width="10" height="10" class="hapus" id="hapus-<?php echo $idnota; ?>-<?php echo $data['idbarang']; ?>"/></center></td>
					</tr>
					<?php
						$total += $data['subtotal'];
					 } ?>
					<tr>
						<td>Total</td>
						<td colspan="4"><span id="totalbeli"><?php echo $total; ?></span></td>
					</tr>
					</table>
					Metode Pengiriman :
					<select name="metode" id="metode">
						<option value="JNE">JNE</option>
						<option value="TIKI">TIKI</option>
					</select><br/>
					Metode Pembayaran :
					<select name="transfer" id="transfer">
						<option value="BCA">BCA</option>
						<option value="Mandiri">Mandiri</option>
					</select><br/>
					Pesan :<input type="text" name="pesan" id="pesan"/><br/>
					<input type="submit" name="konfirmasi-<?php echo $idnota; ?>" value="Konfirmasi" id="konfirmasi"/>
	<?php
				}
			}
	?>