<?php
	if($_SESSION["logado"] == 1){
		header('Location: http://tiagohca.com/musica/index.php');
	}
	if(isset($_POST["senha"]) && $_POST["senha"] == "berinjelas"){
		session_start();
		$_SESSION["logado"] = 1;
		header('Location: http://tiagohca.com/musica/index.php');
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
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h1 class="text-center">Qual é a música</h1>
      </div>
      <div class="modal-body">
          <form class="form col-md-12 center-block" method="POST" action"login.php">
            <div class="form-group">
              <input type="password" name="senha" class="form-control input-lg" placeholder="Senha">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-lg btn-block" Value="Entrar" />
            </div>
          </form>
      </div>
      <div class="modal-footer">
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
