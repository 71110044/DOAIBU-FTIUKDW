<?php
	
	$host="localhost";
	$user="root";
	$pass="";
	$database_name="jerseydw";
	mysql_connect($host,$user,$pass) or die("Gagal konek ke Database!");
	mysql_select_db($database_name) or die ("Gagal pilih database");

	//$host="mysql.idhostinger.com";
	//$user="u826617050_jdw";
	//$pass="Melvie0044";
	//$database_name="u826617050_jdw";
	//mysql_connect($host,$user,$pass) or die("Gagal konek ke Database!");
	//mysql_select_db($database_name) or die ("Gagal pilih database");	
?>