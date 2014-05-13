<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Materiais</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns">
    	<a href="<?php echo site_url('materials/add'); ?>" class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span>Novo Material</a>	
    </div>
</div>

<?php echo $this->session->flashdata('feedback');?>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="dataTable">
		<thead>
          <tr>
            <th>Descrição</th>
            <th>Fornecedor</th>
    		<th>Referência</th>
            <th>Valor</th>
    		<th>Medida</th>
    		<th>Marca</th>    				
    		<th>Criação</th>
            <th></th>            
          </tr>
		</thead>

		<tbody>

        <?php foreach($materials as $k => $d) : ?>

    		<tr>
                <td><?php echo anchor('materials/update/'.$d->id, $d->description);?></td>
                <td><?php echo $d->suppliers->company_name; ?></td>
        		<td><?php echo $d->reference; ?></td>
        		<td>R$<?php echo $d->price; ?></td>
                <td><?php echo $d->measure; ?></td>
        		<td><?php echo $d->brand; ?></td>
        		<td><?php echo date('d/m/Y', strtotime($d->created)); ?></td>
                <td><?php echo anchor('materials/delete/'.$d->id, 'Delete', array('class' => 'delete-register', 'id' => 'delete-button'));?></td>
    		</tr>

        <?php endforeach; ?>  

		</tbody>
</table>
</div>