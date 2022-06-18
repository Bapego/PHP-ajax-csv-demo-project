<?php
require_once 'connection.php';
// Karakterkódolás, biztos ami biztos mint lefedek
	mysqli_query($conn, 'SET NAMES UTF-8');
	mysqli_query($conn, "SET character_set_results=utf8");
	mysqli_set_charset($conn, 'utf-8');
	$conn->set_charset("utf8");
// kiolvasás
function get_all_records($conn){
	$sql = "SELECT * FROM ugyfelek";
	$result = mysqli_query($conn, $sql);
	
	if (mysqli_num_rows($result) > 0) {
	//Táblaszerkezet
	 echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
			 <thead><tr><th>Azonosító</th>
						  <th>Név</th>
						  <th>Telefon</th>
						  <th>Email</th>
						  <th>Település</th>
						  <th>Isz</th>
						  <th>Közterület neve</th>
						  <th>Közterület jellege</th>
						  <th>Házszám</th>
						  <th>Ep.</th>
						  <th>Iph.</th>
						  <th>Szint</th>
						  <th>Ajtó</th>
						  <th>Adószám</th>
						  <th>Szegmensnév</th>
						  <th>Szállító</th>
						  <th>Vevő</th>
						  <th>Pénznem</th>
						  <th>Áfaköteles</th>
						  <th>Csoport</th>
						</tr></thead><tbody>";
	//Szédszedjük az oszlopnevek szerint
	 while($row = mysqli_fetch_assoc($result)) {
		 echo "<tr><td>" . $row['id']."</td>
				   <td>" . $row['nev']."</td>
				   <td>" . $row['telefon']."</td>
				   <td>" . $row['email']."</td>
				   <td>" . $row['telepules']."</td>
				   <td>" . $row['isz']."</td>
				   <td>" . $row['kozterulet_neve']."</td>
				   <td>" . $row['kozterulet_jellege']."</td>
				   <td>" . $row['hazszam']."</td>
				   <td>" . $row['ep']."</td>
				   <td>" . $row['iph']."</td>
				   <td>" . $row['szint']."</td>
				   <td>" . $row['ajto']."</td>
				   <td>" . $row['adoszam']."</td>
				   <td>" . $row['szegmensnev']."</td>
				   <td>" . $row['szallito']."</td>
				   <td>" . $row['vevo']."</td>
				   <td>" . $row['penznem']."</td>
				   <td>" . $row['afakoteles']."</td>
				   <td>" . $row['csoport']."</td>";        
	 }
	
	 echo "</tbody></table></div>";
	 
	 
	 
} else {
	 echo "Nincs rekord a táblában";
}
}

if(isset($_POST["Import"])){
	
	$filename=$_FILES["file"]["tmp_name"];
	//Lekezeljük ha üres a file
	 if($_FILES["file"]["size"] > 0)
	 {
		$file = fopen($filename, "r");
		
		while (($getData = fgetcsv($file, 10000, ";")) !== FALSE){
			if($getData[15] == "True"){
				$getData[15] = 1;
			} 
			else{
				$getData[15] = 0;
			}
			if($getData[16] == "True"){
				$getData[16] = 1;
			} 
			else{
				$getData[16] = 0;
			}
			 $sql = "INSERT into ugyfelek (id,nev,telefon,email,telepules,isz,kozterulet_neve,kozterulet_jellege,hazszam,ep,iph,szint,ajto,adoszam,szegmensnev,szallito,vevo,penznem,afakoteles,csoport) 
				   values (".$getData[0].",'".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."',".$getData[5].",'".$getData[6]."',
				   '".$getData[7]."','".$getData[8]."','".$getData[9]."','".$getData[10]."','".$getData[11]."','".$getData[12]."','".$getData[13]."',
				   '".$getData[14]."','".$getData[15]."','".$getData[16]."','".$getData[17]."',".$getData[18].",'".$getData[19]."')";
				   echo "<pre>";
				   print_r($sql);
				   echo "</pre>";
				   $result = mysqli_query($conn, $sql);
				   
			if(!isset($result)){
			  echo "<script type=\"text/javascript\">
				  alert(\"Sikertelen importálás. Kérem győződjön meg arról, hogy megfelelő fájlt töltött-e fel.\");
				  window.location = \"index.php\"
				  </script>";    
			}
			else{
				echo "<script type=\"text/javascript\">
				alert(\"CSV File sikeresen importálva.\");
				window.location = \"index.php\"
			    </script>";
			}
		}
		
		   fclose($file);  
	 }
	 else {
			echo "<script type=\"text/javascript\">
			alert(\"Hiba! Nincs fltöltve fájl.\");
			window.location = \"index.php\"
		    </script>";
		}
  }
 ?>