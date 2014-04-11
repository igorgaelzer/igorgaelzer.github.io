<!DOCTYPE html>
<html>
<head>
	<title>Sistema de formação de preços</title>
	<meta name="viewport" content="width=device-width, inicial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/styles.css">
</head>
<body>
	<?php error_reporting(E_ALL ^ E_DEPRECATED); ?>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<a class="navbar-brand">Sistema de formação de preços</a>
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class= "icon-bar"></span>
				<span class= "icon-bar"></span>
				<span class= "icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="suppliers"><span class="glyphicon glyphicon-user"></span> Fornecedores</a> </li>
					<li><a href="materials"><span class="glyphicon glyphicon-inbox"></span> Materiais</a> </li>
					<li><a href="products"><span class="glyphicon glyphicon-tags"></span> Produtos</a> </li>
					<li><a href="multipliers"><span class="glyphicon glyphicon-refresh"></span> Multiplicadores</a> </li>
					<li><a href="pricelists"><span class="glyphicon glyphicon-list-alt"></span> Listas de preço</a></li>
				</ul>
			</div>
		</div>
	</div>