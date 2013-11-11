<?php
	@session_start();
?>
				<div id="fsearch">
					<img src="images/cari.png" width="186px"/>
					<form method="" action="">
						<input type="text" name="search"  style="width: 130px;"/>
						<input type="submit" value="Cari" style="width: 40px;">
					</form>
				</div>
				<?php
					if (isset($_SESSION['id'])) {
				?>
				<div id="profil">
					<img src="images/profil.png" width="186px"/><br/>
					<img src="images/default.png" alt="fotoprofil" width= "75px" height="70px"/>
					<a href="#">Lihat Profil</a>
				</div>
				<?php
					};
				?>
				<div id="bayar">
					<img src="images/pembayaran.png" width="186px"/><br/>
					<img src="images/bca.png" height="40px" title="BCA"/><br/>
					123456789<br/>a/n Herlius Caraka<br/><br/>
					<img src="images/mandiri.png" height="40px" title="MANDIRI"/><br/>
					123456789<br/>a/n Herlius Caraka
				</div>
				<div id="jne">
					<img style="width: 126px; height: 50px;" src="http://i.imgur.com/JzyLE.png" alt="JNE" title="JNE">
					<form action="http://www.jne.co.id/index.php" method="get" name="input" target="_new2">
					    <input name="mib" value="tracking.detail" type="hidden">
					    <label for="textJNE">JNE:</label> <input name="awb" type="text" class="textongkir" id="textJNE">
					    <input value="Submit" type="submit">
					</form>
					<img style="width: 126px; height: 50px;" src="http://i.imgur.com/Wlfnn.jpg" alt="TIKI" title="TIKI">
					<form method="post" action="http://www.tiki-online.com/?cat=Verty7788JasKJ" name="frmtracksg">
						<label for="textTIKI">TIKI:</label> <input name="get_con" type="text" class="textongkir" id="textTIKI">
        				<input class="tombol" name="submit" value="Submit" type="submit">
        			</form>
				</div>