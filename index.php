<?php
	require_once 'connection.php';
	require_once 'functions.php';
	// Karakterkódolás, biztos ami biztos mindent lefedek
	mysqli_query($conn, 'SET NAMES UTF-8');
	mysqli_query($conn, "SET character_set_results=utf8");
	mysqli_set_charset($conn, 'utf-8');
	$conn->set_charset("utf8");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"> 
	<link href="starter-template.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
  <body>
	<div id="wrap">
		<div class="container">
			<div class="row">
				<form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
					<fieldset>
						<!-- Tábla neve -->
						<legend>Ügyféladattár</legend>
						<!-- File kiválasztása gomb-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="filebutton">Fájl kiválasztása</label>
							<div class="col-md-4">
								<input type="file" name="file" id="file" class="input-large">
							</div>
						</div>
						<!-- Importálás gomb -->
						<div class="form-group">
							<label class="col-md-4 control-label" for="singlebutton">Importálva</label>
							<div class="col-md-4">
								<button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Töltés...">Importálás</button>
								<br/><br/>
							</div>
							
							<div class="container">
								<div class="starter-template">
									<form role="form" method="post">
										<div class="form-group">
											<input type="text" class="form-control" id="keyword" placeholder="Írd be a keresési kulcsszót">
										</div>
									</form>
									<ul id="content">
										<?php
											get_all_records($conn);
										?>
									</ul>
								</div>
							</div>    
					</fieldset>
				</form>
			</div>
			<script type="text/javascript">
			$(document).ready(function() {
				$('#keyword').on('input', function() {
					var searchKeyword = $(this).val();
					//3 karaktertől kezdi a keresést
					if (searchKeyword.length >= 0) {
						$.post('search.php', { keywords: searchKeyword }, function(data) {
							$('ul#content').html(data);
						}, "html");
					}
				});
			});
			</script>
		</div>
	</body>
</html>