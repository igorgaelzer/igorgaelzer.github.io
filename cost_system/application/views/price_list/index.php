<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Listas de Preços</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns">
    	<a href="<?php echo site_url('price_list/add');?>" class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span>Nova Lista</a>	
    </div>
</div>

<?php echo $this->session->flashdata('feedback');?>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="dataTable">
		<thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Criação</th>
                <th>Ult. Alteração</th>
                <th></th>
            </tr>
		</thead>

    	<tbody>

        <?php foreach($pricelist_list as $k => $p) : ?>

			<tr>
				<td><?php echo anchor('price_list/update/'.$p->id, $p->name);?></td>
				<td><?php echo $p->description; ?></td>
				<td><?php echo date('d/m/Y', strtotime($p->created)); ?></td>
                <td><?php echo date('d/m/Y', strtotime($p->updated)); ?></td>
                <td width="20%">
                    <?php echo anchor('price_list/view/'.$p->id, 'Visualizar', array('class' => 'btn btn-sm btn-info'));?>
                    <?php echo anchor('price_list/duplicate/'.$p->id, 'Duplicar', array('class' => 'btn btn-sm btn-primary'));?>
                    <?php echo anchor('price_list/delete/'.$p->id, 'Delete', array('class' => 'delete-register', 'id' => 'delete-button'));?>                    
                </td>
			</tr>	

        <?php endforeach; ?>    

		</tbody>
    </table>
</div>