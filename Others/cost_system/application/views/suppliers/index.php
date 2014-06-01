<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Fornecedores</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns">
    	<a href="<?php echo site_url('suppliers/add'); ?>" class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span>Novo Fornecedor</a>	
    </div>
</div>

<?php echo $this->session->flashdata('feedback');?>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="dataTable">
		<thead>
      		<tr>
				<th>Nome</th>
				<th>Cidade</th>
				<th>Estado</th>
				<th>Representante</th>
				<th>Telefone</th>
				<th>Email</th>
				<th></th>
      		</tr>
		</thead>

		<tbody>

    <?php foreach($suppliers as $k => $d) : ?>  

			<tr>
				<td><?php echo anchor('suppliers/update/'.$d->id, $d->company_name);?></td>
				<td><?php echo $d->city; ?></td>
				<td><?php echo $d->state; ?></td>
				<td><?php echo $d->representative; ?></td>
				<td><?php echo $d->phone; ?></td>
				<td><?php echo $d->email; ?></td>
				<td><?php echo anchor('suppliers/delete/'.$d->id, 'Delete', array('class' => 'delete-register', 'id' => 'delete-button'));?></td>
			</tr>

    <?php endforeach;?>  

		</tbody>
</table>
</div>