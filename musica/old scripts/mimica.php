<?php
	include 'dbdata.php';
	
	session_start();
	if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != 1){
		header('Location: http://undersights.com/qual-e-a-musica/login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Qual é a música</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
<body>

	<?
		// connecting to db
		$db = new mysqli($servername, $username, $password, $dbname);
		$db->set_charset("utf8");
		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		} 

		$sql = "SELECT * FROM Mimica ORDER BY RAND() LIMIT 7";
		if(!$result = $db->query($sql)){
			die('There was an error running the query [' . $db->error . ']');
			echo $db->error;
		}
	?>	
		
	<div style="padding-top: 20px">
		<div class="container">
			<div class="well">
				<div class="row-fluid">
					<div class="table-responsive">
						<table class="table table-bordered info">
							<thead>
								<tr class="info">
									<th>Nota</th>
									<th>Música</th>
									<th>Artista</th>
								</tr>
							</thead>
							<tbody>
								<tr class="info">
									<? $row = $result->fetch_assoc();
									echo '<td>Dó</td>';
									echo '<td>'.$row["title"].'</td>';
									echo '<td>'.$row["artist"].'</td>';
									?>
								</tr>
								<tr class="info">
									<? $row = $result->fetch_assoc();
									echo '<td>Ré</td>';
									echo '<td>'.$row["title"].'</td>';
									echo '<td>'.$row["artist"].'</td>';
									?>
								</tr>
								<tr class="info">
									<? $row = $result->fetch_assoc();
									echo '<td>Mi</td>';
									echo '<td>'.$row["title"].'</td>';
									echo '<td>'.$row["artist"].'</td>';
									?>
								</tr>
								<tr class="info">
									<? $row = $result->fetch_assoc();
									echo '<td>Fá</td>';
									echo '<td>'.$row["title"].'</td>';
									echo '<td>'.$row["artist"].'</td>';
									?>
								</tr >
								<tr class="info">
									<? $row = $result->fetch_assoc();
									echo '<td>Sol</td>';
									echo '<td>'.$row["title"].'</td>';
									echo '<td>'.$row["artist"].'</td>';
									?>
								</tr>
								<tr class="info">
									<? $row = $result->fetch_assoc();
									echo '<td>Lá</td>';
									echo '<td>'.$row["title"].'</td>';
									echo '<td>'.$row["artist"].'</td>';
									?>
								</tr>
								<tr class="info">
									<? $row = $result->fetch_assoc();
									echo '<td>Si</td>';
									echo '<td>'.$row["title"].'</td>';
									echo '<td>'.$row["artist"].'</td>';
									?>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				</div>
			</div>
		</div>
		
		<? include "buttons.php"; ?>
		</div>
		
		<!-- script references -->
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>