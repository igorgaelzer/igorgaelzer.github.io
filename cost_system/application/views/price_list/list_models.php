<?php foreach($models_list as $k => $m) : ?>

<tr>
  	<td><input type="checkbox" name="models_list[]" value="<?php echo $m->id; ?>"></td>
	<td><?php echo $m->reference; ?></td>
	<td><?php echo $m->description; ?></td>
	<td><?php echo $m->brand; ?></td>
	<td><?php echo $m->client; ?></td>
	<td>R$<?php echo number_format($m->total_price, 2, ',', '.'); ?></td>
	<td><?php echo date('d/m/Y', strtotime($m->created)); ?></td>
	<td><?php echo date('d/m/Y', strtotime($m->updated)); ?></td> 					
</tr>

<?php endforeach; ?>