<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Multiplicadores</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns">
    	<a href="<?php echo site_url('multipliers/add');?>" class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span>Novo Multiplicador</a>	
    </div>
</div>

<?php echo $this->session->flashdata('feedback');?>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="dataTable">
		<thead>
          <tr>
    		<th>Nome</th>
    		<th>Descrição</th>
    		<th>Valor</th>
    		<th>Criação</th>
    		<th>Ult. Alteração</th>
            <th></th>
          </tr>
		</thead>

		<tbody>

        <?php foreach($multipliers as $k => $d) : ?> 

			<tr>
				<td><?php echo anchor('multipliers/update/'.$d->id, $d->name);?></td>
				<td><?php echo $d->description; ?></td>
				<td><?php echo number_format($d->TOTAL, 2, ',', '.'); ?></td>
				<td><?php echo date('d/m/Y', strtotime($d->created)); ?></td>
				<td><?php echo date('d/m/Y', strtotime($d->updated)); ?></td>
                <td width="20%">
                    <?php echo anchor('multipliers/duplicate/'.$d->id, 'Duplicar', array('class' => 'btn btn-sm btn-primary'));?>
                    <?php echo anchor('multipliers/delete/'.$d->id, 'Delete', array('class' => 'delete-register', 'id' => 'delete-button'));?>                     
                </td>
			</tr>

        <?php endforeach; ?>
			
		</tbody>
</table>
</div>