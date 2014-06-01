<?php
	
	$cost = mysql_connect('localhost' , 'root' , 'root') or die(mysql_error() );

	mysql_select_db('product_cost' , $cost);

	$sql = "INSERT INTO suppliers (company, location, email, phone, contact) VALUES ('Hey Ho Lets Go' , 'Novo Hamburgo, RS' , 'quality@qualitybr.com.br' , '54 3285 1253' , 'Stuart')";

	mysql_query($sql , $cost);

?>