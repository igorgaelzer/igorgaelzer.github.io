<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Modelos</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns">
    	<a href="<?php echo site_url('models/add');?>" class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span>Novo Produto</a>	
    </div>
</div>

<?php echo $this->session->flashdata('feedback');?>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="dataTable">
		<thead>
	      	<tr>
				<th>Referência</th>
				<th>Descrição</th>
				<th>Marca</th>
				<th>Cliente</th>
				<th>Valor</th>
				<th>Criação</th>
	        	<th>Ult. Alteração</th>
	        	<th></th>
	      	</tr>
		</thead>

		<tbody>

    <?php foreach($models as $k => $d) : ?>  

			<tr>
				<td><?php echo anchor('models/update/'.$d->id, $d->reference);?></td>
				<td><?php echo $d->description; ?></td>
				<td><?php echo $d->brand; ?></td>
	    		<td><?php echo $d->client; ?></td>
				<td>R$<?php echo number_format($d->total_price, 2, ',', '.'); ?></td>
				<td><?php echo date('d/m/Y', strtotime($d->created)); ?></td>
	    		<td><?php echo date('d/m/Y', strtotime($d->updated)); ?></td>
	    		<td>
	    			<?php echo anchor('models/duplicate/'.$d->id, 'Duplicar', array('class' => 'btn btn-sm btn-primary'));?>
		    		<?php echo anchor('models/delete/'.$d->id, 'Delete', array('class' => 'delete-register', 'id' => 'delete-button'));?> 		    		
		    	</td>	    		
			</tr>

    <?php endforeach; ?>  
     
		</tbody>
</table>
</div>