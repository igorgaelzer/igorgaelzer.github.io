
<?php add_js('price_list.js'); ?>

<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Atualizar lista de preço</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns"></div>
</div>

<?php echo $this->session->flashdata('feedback');?>

<?php if(validation_errors()):?>
	<div class='alert alert-danger'><?php echo validation_errors(); ?></div>
<?php endif;?>

<?php echo form_open('price_list/update/'.$price_list->id, array('class' => 'form', 'role' => 'form')); ?>

    <div class="row">
		  <div class="form-group col-md-6">
		    <label for="nome">Nome da Lista</label>
		    <?php echo form_input(array('name' => 'name', 'class' => 'form-control', 'value' => (isset($price_list)) ? $price_list->name : '')); ?>
		  </div>

		  <div class="form-group col-md-6">
		    <label for="descricao">Descrição Lista</label>
		    <?php echo form_input(array('name' => 'description', 'class' => 'form-control', 'value' => (isset($price_list)) ? $price_list->description : '')); ?>
		  </div>

		  <div class="form-group col-md-6">
		    <label for="marca">Marca</label>
		    <?php echo form_input(array('name' => 'brand', 'class' => 'form-control', 'value' => (isset($price_list)) ? $price_list->brand : '')); ?>
		  </div>

		  <div class="form-group col-md-6">
		    <label for="cliente">Cliente</label>
		    <?php echo form_input(array('name' => 'client', 'class' => 'form-control', 'value' => (isset($price_list)) ? $price_list->client : '')); ?>
		  </div>
	</div>

	<div class="row col-md-12 lista-modelos">

		<div class="col-md-6">
			<div class="pull-left"><label>Selecione os modelos que você deseja adicionar na lista</label></div>
		</div>

		<div class="col-md-6 form-inline">

			<div class="form-group col-md-6">			
				<label>Marca:</label>
				<?php echo form_dropdown('brand_list', array('' => 'Todos') + $brand_list, '', 'class="form-control" id="brand-list"'); ?>
			</div>

			<div class="form-group col-md-6">
				<label>Cliente:</label>
				<?php echo form_dropdown('client_id', array('' => 'Todos') + $client_list, '', 'class="form-control" id="client-list"'); ?>
			</div>

		</div>

		<div class="table-responsive">
	    	<table class="table table-striped table-bordered table-hover" id="lista-modelos">
		  		<thead>
		          <tr>
		          	<th><input type="checkbox" id="check_all"></th>
		          	<th>Referência</th>
		            <th>Descrição</th>
		            <th>Marca</th>
		            <th>Cliente</th>		    		
		            <th>Valor</th>
		    		<th>Criação</th>
		    		<th>Ult. Alteração</th>
		          </tr>
		  		</thead>

		  		<tbody>

		  		<?php 
		  			foreach($models_list as $k => $m) : 
		  				$selected = '';
		  				if(!empty($price_list->models_pricelist)) {
		  					foreach($price_list->models_pricelist as $mpk => $mp) {
		  						if($m->id == $mp->model_id) {
		  							$selected = 'checked="checked"';
		  						}
		  					}
		  				}
		  		?>

		  		  <tr>
		  		  	<td><input type="checkbox" <?php echo $selected; ?> name="models_list[]" value="<?php echo $m->id; ?>"></td>
		            <td><?php echo $m->reference; ?></td>
		            <td><?php echo $m->description; ?></td>
		  			<td><?php echo $m->brand; ?></td>
		  			<td><?php echo $m->client; ?></td>
		            <td>R$<?php echo number_format($m->total_price, 2, ',', '.'); ?></td>
		  			<td><?php echo date('d/m/Y', strtotime($m->created)); ?></td>
		    		<td><?php echo date('d/m/Y', strtotime($m->updated)); ?></td> 					
		  	      </tr>

		  	    <?php endforeach; ?>
	  	    
	  			</tbody>
			</table>
	    </div>

	</div>

	<div class="row">
		<div class="form-group col-md-6">		
	    	<label for="descricao">Selecione o multiplicador que você deseja aplicar:</label>
	    	<?php echo form_dropdown('multiplier_id', $multipliers_list, $price_list->multiplier_id, 'class="form-control"'); ?>
	  	</div>	
	</div>

	<button type="submit" class="btn btn-primary pull-right">salvar</button>

<?php echo form_close(); ?>