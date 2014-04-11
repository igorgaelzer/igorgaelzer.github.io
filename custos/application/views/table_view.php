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