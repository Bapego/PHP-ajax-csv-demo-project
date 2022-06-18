<?php
	//Csatlakozunk a megadott ab-hoz
	$conn = new mysqli('127.0.0.1','root','','test');
	
	//Hiba esetén kiírjuk a hibát és kilépünk
	if($conn->connect_errno > 0){
		echo $conn->connect_error;
		die();
	}		
?>