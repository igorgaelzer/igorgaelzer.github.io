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
				<h1><span class="glyphicon glyphicon-user"></span> Fornecedores</h1>
			</div>
			<div class="col-lg-6">	
				<a href="addsupplier.php" type="button" id="header-btn" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Adicionar fornecedor</a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<p>Clique no botão <strong>Adicionar fornecedor</strong> para cadastrar os seus fornecedores.</p><br>
			</div>
			<div class="input-group col-lg-3" style="float:right; margin-right: 15px">
			  	<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
			 	<input type="text" class="form-control" placeholder="Busca">
			</div>
		</div>
	</div>
	<br>
	<div class="container">
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Empresa</th>
				<th>Cidade</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>Contato</th>
				<th>Opções</th>
			</tr>
			</thead>


			<?php

				$cost = mysql_connect('localhost' , 'root' , 'root') or die(mysql_error() );

				mysql_select_db('product_cost' , $cost);

				$sql = "SELECT * FROM suppliers";

				$result = mysql_query($sql , $cost);

				// -------------- START OF DYNAMIC DATA IN TABLE -------------- 

				while ($row = mysql_fetch_array($result)) {
			
					$company = $row['company'];
					$location = $row['location'];
					$email = $row['email'];
					$phone = $row['phone'];
					$contact = $row['contact'];

					echo "<tr>";
					echo "<td>$company</td>";
					echo "<td>$location</td>";
					echo "<td>$email</td>";
					echo "<td>$phone</td>";
					echo "<td>$contact</td>";
					echo "<td>Excluir | Duplicar</td>";
					echo "</tr>";
				}

			?>
		</table>
		<ul class="pagination pull-right">
			<li><a href="#">&laquo;</a></li>
			<li><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li><a href="#">&raquo;</a></li>
		</ul>
		<div class="btn-group pull-left" style="margin-top: 20px">
			<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span></button>
			<button type="button" class="btn btn-default">Excel</button>
			<button type="button" class="btn btn-default">PDF</button>
		</div>
	</div> <!-- End of container -->

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
</body>
</html>