<?php
	session_start();
	if(!isset($_SESSION["logado_ria"]) || $_SESSION["logado_ria"] != 1){
		header('Location: http://tiagohca.com/ria/login.php');
	}
?>

<!DOCTYPE html>
<html lang="pt" ng-app="ria">

	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Não Ria!</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body ng-controller="mainCtrl">
		<div style="padding-top: 20px">
			<div class="container">
				<div class="title">
					<h1>Faça seu adversário rir, mas não ria!</h1>
				</div>
				<div class="well">
					<div class="row-fluid">
						<div class="table-responsive">
							<h2>{{joke.question}}</h2>
							<h3>{{joke.answer}}</h3>
						</div>
					</div>
				</div>
				
				<div class="well">
					<div class="row">
						<a class="btn btn-danger btn-block btn-lg" ng-click="nextJoke()">Próximo!</a>
						<br>
					</div>
				</div>
			</div>
		</div>
		
		<!-- script references -->
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/data.js"></script>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
		<script>
			angular.module('ria', []).controller('mainCtrl', ['$scope', '$interval', function($scope, $interval) {				
				$scope.nextJoke = function(){
			      var joke = jokes[Math.floor(Math.random()*jokes.length)]
			      $scope.joke = joke
			    }
			}]).filter('secondsToDateTime', [function() {
			    return function(seconds) {
			        return new Date(1970, 0, 1).setSeconds(seconds);
			    };
			}]);
		</script>
	</body>
</html>
