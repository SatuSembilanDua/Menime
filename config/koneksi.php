<?php
/*
	$host = 'localhost';
	$user = 'root';      
	$password = '';      
	$database = '_dbmenime_';  

	$con  = new mysqli($host, $user, $password, $database);

	if ($con->connect_error) {
  		die("Terjadi Kesalahan saat koneksi ke database!<br>"."Connection failed: " . $con->connect_error);
	}
*/
	
	$con = new SQLite3('dbmenime.db');
	
	if(!$con) {
  		die("Terjadi Kesalahan saat koneksi ke database!<br>"."Connection failed: " . $con->lastErrorMsg());
	}


	include "QueryBuilder.php";
?>