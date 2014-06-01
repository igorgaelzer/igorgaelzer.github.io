<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Usuários</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns">
    	<a href="<?php echo site_url('users/add'); ?>" class="btn btn-primary "><span class="glyphicon glyphicon-plus"></span>Novo Usuário</a>	
    </div>
</div>

<?php echo $this->session->flashdata('feedback');?>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover" id="dataTable">
		<thead>
      		<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Admin</th>
				<th>Criação</th>
	        	<th>Ult. Alteração</th>
				<th></th>
      		</tr>
		</thead>

		<tbody>

    <?php foreach($users as $k => $u) : ?>  

			<tr>
				<td><?php echo anchor('users/update/'.$u->id, $u->name);?></td>
				<td><?php echo $u->username; ?></td>
				<td><?php echo ($u->is_admin == 1) ? 'Sim' : 'não'; ?></td>
				<td><?php echo date('d/m/Y', strtotime($u->created)); ?></td>
	    		<td><?php echo date('d/m/Y', strtotime($u->updated)); ?></td>
				<td><?php echo anchor('users/delete/'.$u->id, 'Delete', array('class' => 'delete-register', 'id' => 'delete-button'));?></td>
			</tr>

    <?php endforeach;?>  

		</tbody>
</table>
</div>