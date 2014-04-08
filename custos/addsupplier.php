<!DOCTYPE html>
<html>
<head>
	<title>Sistema de formação de preços</title>
	<meta name="viewport" content="width=device-width, inicial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="container">
			<a href="index.php" class="navbar-brand">Sistema de formação de preços</a>
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class= "icon-bar"></span>
				<span class= "icon-bar"></span>
				<span class= "icon-bar"></span>
			</button>
			<div class="collapse navbar-collapse navHeaderCollapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="index.php"><span class="glyphicon glyphicon-user"></span> Fornecedores</a> </li>
					<li><a href="#"><span class="glyphicon glyphicon-inbox"></span> Materiais</a> </li>
					<li><a href="#"><span class="glyphicon glyphicon-tags"></span> Produtos</a> </li>
					<li><a href="#"><span class="glyphicon glyphicon-refresh"></span> Multiplicadores</a> </li>
					<li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Listas de preço</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<div id="title-bar" class="page-header row">
			<div class="col-lg-6">
				<h1><span class="glyphicon glyphicon-plus"></span> Adicionar fornecedor</h1>
			</div>
		</div>
		<p>Preencha ou edite os campos abaixo e depois clique em <strong>Salvar</strong>.</p><br>
	</div>
	<div class="container">
		<form method="POST">
			<div class="row">
				<div class="form-group col-md-6">
					<label for="company">Empresa</label>
					<input type="text" action="" type="text" name="company" class="form-control" required="required">
				</div>
				<div class="form-group col-md-6">
					<label for="location">Cidade / Estado</label>
					<input type="text" name="location" class="form-control">
				</div>
				<div class="form-group col-md-6">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control">
				</div>
				<div class="form-group col-md-6">
					<label for="phone">Telefone</label>
					<input type="text" name="phone" class="form-control">
				</div>
				<div class="form-group col-md-6">
					<label for="contact">Nome do vendedor</label>
					<input type="text" name="contact" class="form-control">
				</div>
			</div>
			<div style="float: right; text-align: right">
				<a href="#">Cancelar</a> ou 
				<input type="submit" class="btn btn-success" value="Salvar">
			</div>
		</form>
		
	</div> <!-- Close container -->

	<?php

		$company = $_POST['company'];
		$location = $_POST['location'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$contact = $_POST['contact'];

		$cost = mysql_connect('localhost' , 'root' , 'root') or die(mysql_error() );
		
		mysql_select_db('product_cost' , $cost);
		
		$sql = "INSERT INTO suppliers (company, location, email, phone, contact) VALUES ('$company' , '$location' , '$email' , '$phone' , '$contact')";
		
		mysql_query($sql , $cost);

	?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
</body>
</html>