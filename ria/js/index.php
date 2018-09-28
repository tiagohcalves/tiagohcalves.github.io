<?php
	include 'dbdata.php';
	
	session_start();
	if(!isset($_SESSION["logado"]) || $_SESSION["logado"] != 1){
		header('Location: http://tiagohca.com/musica/login.php');
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
		<div style="padding-top: 20px">
			<?
				// connecting to db
				$db = new mysqli($servername, $username, $password, $dbname);
				$db->set_charset("utf8");
				if ($db->connect_error) {
					echo("Connection failed: " . $db->connect_error);
				} 
				
				$sql = "SELECT * FROM m_Palavra";
				if(!$resultComplete = $db->query($sql)){
					echo('There was an error running the query [' . $db->error . ']');
				}	
				while($row = $resultComplete->fetch_array()){ 
					$palavra[] = $row;
				}

				$sql = "SELECT * FROM m_CompleteACancao";
				if(!$resultComplete = $db->query($sql)){
					echo('There was an error running the query [' . $db->error . ']');
				}	
				while($row = $resultComplete->fetch_array()){ 
					$complete[] = $row;
				}
				
				$sql = "SELECT * FROM m_AdivinhaQuem";
				if(!$resultComplete = $db->query($sql)){
					echo('There was an error running the query [' . $db->error . ']');
				}	
				while($row = $resultComplete->fetch_array()){ 
					$adivinha[] = $row;
				}
				
				$sql = "SELECT * FROM m_Mimica";
				if(!$resultComplete = $db->query($sql)){
					echo('There was an error running the query [' . $db->error . ']');
				}	
				while($row = $resultComplete->fetch_array()){ 
					$mimica[] = $row;
				}
			?>

			<div class="container">
				<div class="well">
					<div class="row-fluid">
						<div class="table-responsive">
							<table class="table table-bordered danger" id="tablePalavra">
								<thead>
									<tr class="danger">
										<th>Nota</th>
										<th>Palavra</th>
									</tr>
								</thead>
								<tbody>
									<tr class="danger">
										<td>Dó</td>
										<td></td>
									</tr>
									<tr class="danger">
										<td>Ré</td>
										<td></td>
									</tr>
									<tr class="danger">
										<td>Mi</td>
										<td></td>
									</tr>
									<tr class="danger">
										<td>Fá</td>
										<td></td>
									</tr >
									<tr class="danger">
										<td>Sol</td>
										<td></td>
									</tr>
									<tr class="danger">
										<td>Lá</td>
										<td></td>
									</tr>
									<tr class="danger">
										<td>Si</td>
										<td></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered success" id="tableComplete">
								<thead>
									<tr class="success">
										<th>Nota</th>
										<th>Música</th>
										<th>Resposta</th>
									</tr>
								</thead>
								<tbody>
									<tr class="success">
										<td>Dó</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="success">
										<td>Ré</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="success">
										<td>Mi</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="success">
										<td>Fá</td>
										<td></td>
										<td class = "hidden"></td>
									</tr >
									<tr class="success">
										<td>Sol</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="success">
										<td>Lá</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="success">
										<td>Si</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered warning" id="tableAdivinha">
								<thead>
									<tr class="warning">
										<th>Nota</th>
										<th>Trecho</th>
										<th>Artista</th>
									</tr>
								</thead>
								<tbody>
									<tr class="warning">
										<td>Dó</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="warning">
										<td>Ré</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="warning">
										<td>Mi</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="warning">
										<td>Fá</td>
										<td></td>
										<td class = "hidden"></td>
									</tr >
									<tr class="warning">
										<td>Sol</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="warning">
										<td>Lá</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
									<tr class="warning">
										<td>Si</td>
										<td></td>
										<td class = "hidden"></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered info" id="tableMimica">
								<thead>
									<tr class="info">
										<th>Nota</th>
										<th>Música</th>
										<th>Artista</th>
									</tr>
								</thead>
								<tbody>
									<tr class="info">
										<td>Dó</td>
										<td></td>
										<td></td>
									</tr>
									<tr class="info">
										<td>Ré</td>
										<td></td>
										<td></td>
									</tr>
									<tr class="info">
										<td>Mi</td>
										<td></td>
										<td></td>
									</tr>
									<tr class="info">
										<td>Fá</td>
										<td></td>
										<td></td>
									</tr >
									<tr class="info">
										<td>Sol</td>
										<td></td>
										<td></td>
									</tr>
									<tr class="info">
										<td>Lá</td>
										<td></td>
										<td></td>
									</tr>
									<tr class="info">
										<td>Si</td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
							<button class="btn btn-block btn-lg" id="btnShowAnswers" onclick="showAnswers();">Mostrar Respostas</button>
						</div>
					</div>
				</div>
				
				<div class="well" style="text-align: center;">
					<a class="btn btn-default" onclick="minusMinute()">-</a>
					<span id="time" style="font-weight: bold; font-size: 20px;">03:00</span>
					<a class="btn btn-default" onclick="plusMinute()">+</a>
					<a class="btn btn-default" onclick="startTimer()">GO!</a>
					<a class="btn btn-default" onclick="stopTimer()">Parar</a>
				</div>
				
				<div class="well">
					<div class="row">
						<a class="btn btn-danger btn-block btn-lg" onclick="loadPalavra()"> A palavra é...</a>
						<br>
						<a class="btn btn-success btn-block btn-lg" onclick="loadComplete()">Complete a canção</a>
						<br>
						<a class="btn btn-warning btn-block btn-lg" onclick="loadAdivinha()">Adivinha Quem</a>
						<br>
						<a class="btn btn-primary btn-block btn-lg" onclick="loadMimica()">Pagando Mímica</a>
					</div>
				</div>
			</div>
		</div>
		
		<!-- script references -->
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script>
			var palavra = <? echo json_encode($palavra) ?>;
			var complete = <? echo json_encode($complete) ?>;
			var adivinha = <? echo json_encode($adivinha) ?>;
			var mimica = <? echo json_encode($mimica) ?>;
			
			var time = 3 * 60;
			var answering = false;
			var stop = true;
			
			$(function(){
				hideAll();
			});
		
			function hideAll(){
				$('#tablePalavra').hide();
				$('#tableComplete').hide();
				$('#tableAdivinha').hide();
				$('#tableMimica').hide();
				$('#btnShowAnswers').hide();
			}
			
			function showAnswers(){
				$(".hidden").removeClass("hidden");
			}
			
			function loadPalavra(){
				hideAll();
				$('#tablePalavra').show();
				var table = $('#tablePalavra tbody')[0];
				$(table.rows).each(function(){
					var palavraRow = palavra[Math.floor(Math.random()*palavra.length)];
					var cell1 = $(this)[0].cells[1];
					$(cell1).html(palavraRow.palavra);
				});
				
				resetTimer();
			}
			
			function loadComplete(){
				hideAll();
				$('#tableComplete').show();
				$('#btnShowAnswers').show();
				var table = $('#tableComplete tbody')[0];
				$(table.rows).each(function(){
					var completeRow = complete[Math.floor(Math.random()*complete.length)];
					var cell1 = $(this)[0].cells[1];
					var cell2 = $(this)[0].cells[2];
					$(cell1).html(completeRow.inicio.replace(/\n/g, "<br>"));
					$(cell2).html(completeRow.resposta);
					$(cell2).addClass("hidden");
				});
				
				resetTimer();
			}
			
			function loadAdivinha(){
				hideAll();
				$('#tableAdivinha').show();
				$('#btnShowAnswers').show();
				var table = $('#tableAdivinha tbody')[0];
				$(table.rows).each(function(){
					var adivinhaRow = adivinha[Math.floor(Math.random()*adivinha.length)];
					var cell1 = $(this)[0].cells[1];
					var cell2 = $(this)[0].cells[2];
					$(cell1).html(adivinhaRow.verse);
					$(cell2).html(adivinhaRow.artist);
					$(cell2).addClass("hidden");
				});
				
				resetTimer();
			}
			
			function loadMimica(){
				hideAll();
				$('#tableMimica').show();
				var table = $('#tableMimica tbody')[0];
				$(table.rows).each(function(){
					var mimicaRow = mimica[Math.floor(Math.random()*mimica.length)];
					var cell1 = $(this)[0].cells[1];
					var cell2 = $(this)[0].cells[2];
					$(cell1).html(mimicaRow.title);
					$(cell2).html(mimicaRow.artist);
				});
				
				resetTimer();
			}
			
			function startTimer() {
				if(!answering){
					var duration = time;
					var timer = duration, minutes, seconds;
					answering = true;
					stop = false;
					
					var interval = setInterval(function () {
						minutes = parseInt(timer / 60, 10)
						seconds = parseInt(timer % 60, 10);

						minutes = minutes < 10 ? "0" + minutes : minutes;
						seconds = seconds < 10 ? "0" + seconds : seconds;

						$('#time').text(minutes + ":" + seconds);

						if (stop || (--timer < 0)) {
							answering = false;
							clearInterval(interval);
							stop = false;
							return;
						}
						
						time = timer;
					}, 1000);
				}
			}
			
			function resetTimer(){
				answering = false;
				stop = true;
				time = 3 * 60;
				$('#time').text("3:00");
			}
			
			function minusMinute(){
				if(!answering && time > 0){
					time -= 30;
					
					minutes = parseInt(time / 60, 10)
					seconds = parseInt(time % 60, 10);

					minutes = minutes < 10 ? "0" + minutes : minutes;
					seconds = seconds < 10 ? "0" + seconds : seconds;

					$('#time').text(minutes + ":" + seconds);
				}
			}
			
			function plusMinute(){
				if(!answering){
					time += 30;
					
					minutes = parseInt(time / 60, 10)
					seconds = parseInt(time % 60, 10);

					minutes = minutes < 10 ? "0" + minutes : minutes;
					seconds = seconds < 10 ? "0" + seconds : seconds;

					$('#time').text(minutes + ":" + seconds);
				}
			}
			
			function stopTimer(){
				stop = true;
			}
		</script>
	</body>
</html>
