<?php
require_once 'connection.php';
	// Karakterkódolás, biztos ami biztos mindent lefedek
	mysqli_query($conn, 'SET NAMES UTF-8');
	mysqli_query($conn, "SET character_set_results=utf8");
	mysqli_set_charset($conn, 'utf-8');
	$conn->set_charset("utf8");
$arr = array();

	$keywords = $conn->real_escape_string($_POST['keywords']);
	$sql = "SELECT * FROM ugyfelek WHERE id LIKE '%".$keywords."%' OR nev LIKE '%".$keywords."%' OR telefon LIKE '%".$keywords."%'
										 OR email LIKE '%".$keywords."%' OR telepules LIKE '%".$keywords."%' OR isz LIKE '%".$keywords."%'
										 OR kozterulet_neve LIKE '%".$keywords."%' OR kozterulet_jellege LIKE '%".$keywords."%' OR hazszam LIKE '%".$keywords."%'
										 OR ep LIKE '%".$keywords."%' OR iph LIKE '%".$keywords."%' OR szint LIKE '%".$keywords."%'
										 OR ajto LIKE '%".$keywords."%' OR adoszam LIKE '%".$keywords."%' OR szegmensnev LIKE '%".$keywords."%'
										 OR szallito LIKE '%".$keywords."%' OR vevo LIKE '%".$keywords."%' OR penznem LIKE '%".$keywords."%'
										 OR afakoteles LIKE '%".$keywords."%' OR csoport LIKE '%".$keywords."%'";
	$result = mysqli_query($conn, $sql);
	$html="";
	
	
	if (mysqli_num_rows($result) > 0) {
		
	
	
	
	//Táblaszerkezet
	 $html .= "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
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
		 $html .= "<tr><td>" . $row['id']."</td>
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
	
	 $html .= "</tbody></table></div>";
	} else {
	 $html .= "Nincs ilyen rekord a táblában";
}
echo $html;
die();