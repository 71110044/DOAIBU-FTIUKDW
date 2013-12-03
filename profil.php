<?php
	include("koneksi.php");
	include("utility.php");
	session_start();

	cleanALL($_GET);
	$id = $_GET['id'];
	$query  = "SELECT * FROM user WHERE id = $id";
	$res	= mysql_query($query);

	while ($data = mysql_fetch_assoc($res)) {?>

	<div id="profilku">
		<h3 style="margin-left: 200px;">Profilku</h3>
		<div id="profilku2">
			<img src="<?php echo $data['profpic'];?>"/><br/>
		</div>
		<form method="post" action="index.php" enctype="multipart/form-data">
		<div id="profilku3">
			
			<table border="1">
				<tr>
					<td>Username</td>
					<td colspan="2"><?php echo $data['username'];?></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><input type="text" name="nama" value="<?php echo $data['nama'];?>"/></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input type="text" name="alamat" value="<?php echo $data['alamat'];?>"/></td>
				</tr>
				<tr>
					<td>KodePos</td>
					<td><input type="text" name="kodepos" value="<?php echo $data['kodepos'];?>"/></td>
				</tr>
				<tr>
					<td>Telepon</td>
					<td><input type="text" name="telepon"  value="<?php echo $data['telepon'];?>"/></td>
				</tr>
				<tr>
					<td>Email</td>
						<td><input type="text" name="email" value="<?php echo $data['email'];}?>"/></td>
				</tr>
			</table>
		</div>
		<div class="clear"></div>
		<input id="sub1" type="file" name="file"/>
		<input type="submit" value="Simpan">
		</form>
		<div id="tampilcart">
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
								</tr>
								<?php while ($data = mysql_fetch_assoc($res)) {?>
								<tr>
									<td><?php echo $data['namabarang'];?></td>
									<td><?php echo $data['jumlahbeli'];?></td>
									<td><?php echo $data['harga'];?></td>
									<td><?php echo $data['subtotal'];?></td>
								</tr>
								<?php
									$total += $data['subtotal'];
								 } ?>
								<tr>
									<td>Total</td>
									<td colspan="4"><span id="totalbeli"><?php echo $total; ?></span></td>
								</tr>
								</table>
								Nomer Rekening :
								<input type="text" name="rekening" class="rekening" id="rekening-<?php echo $idnota; ?>"/><br/>
								Tanggal Transfer :
								<input type="text" name="tanggaltransfer" class="tanggaltransfer" id="tanggaltransfer-<?php echo $idnota; ?>"/><br/>
								<input type="submit" name="konfirmasi-<?php echo $idnota; ?>" value="Konfirmasi" class="konfirmasi"/>
				<?php
							}
						}
				?>
		</div>
	</div>