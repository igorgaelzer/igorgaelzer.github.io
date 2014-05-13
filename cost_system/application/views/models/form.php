<?php add_js('models.js'); ?>

<div id="title-bar" class="page-header row">
    <div class="col-md-6">
        <h1>Cadastro de novo modelo</h1>                            
    </div>
    <div class="col-md-6" id="header-btns"></div>
</div>

<?php if(validation_errors() || isset($image_error)):?>
	<div class='alert alert-danger'>
	<?php echo validation_errors(); ?>
	<?php echo isset($image_error) ? $image_error : ''; ?>
	</div>
<?php endif;?>

<?php echo form_open_multipart((isset($models)) ? 'models/update/'.$models->id : 'models/add', array('class' => 'form', 'role' => 'form')); ?>

    <div class="row">
		<div class="form-group col-md-6">
			<label for="referencia">Referência</label>
			<?php echo form_input(array('name' => 'reference', 'required' => 'required', 'class' => 'form-control', 'value' => (isset($models)) ? $models->reference : set_value('reference'))); ?>
		</div>

		<div class="form-group col-md-6">
			<label for="descricao">Descrição do produto</label>
			<?php echo form_input(array('name' => 'description', 'class' => 'form-control', 'value' => (isset($models)) ? $models->description : set_value('description'))); ?>
		</div>

		<div class="form-group col-md-6">
			<label for="marca">Marca</label>
			<?php echo form_input(array('name' => 'brand', 'class' => 'form-control', 'value' => (isset($models)) ? $models->brand : set_value('brand'))); ?>
		</div>

		<div class="form-group col-md-6">
			<label for="cliente">Cliente</label>
			<?php echo form_input(array('name' => 'client', 'class' => 'form-control', 'value' => (isset($models)) ? $models->client : set_value('client'))); ?>
		</div>
	</div>

	<div class="row">

		<div class="col-md-9">

			<div class="row">
				<div class="col-md-4"><label>Material</label></div>
				<div class="col-md-2"><label>Quantidade</label></div>
				<div class="col-md-2"><label>Preço</label></div>
				<div class="col-md-2"><label>Total</label></div>
			</div> 

		<ul id="items-sortable">

			<li class="group-data">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group ui-widget">							
							<input type="text" name="material[]" class="form-control autocomplete" id="material">
							<input type="text" name="material_id[]" class="hidden" id="material_id">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<input type="text" name="quantity[]" class="form-control" id="quantity">							
						</div>
					</div>
					<div class="col-md-2">
						<div class="input-group">
							<span class="input-group-addon">R$</span>
							<input type="text" name="price[]" class="form-control price" id="price" placeholder="" disabled>
						</div>							
					</div>
					<div class="col-md-2">
						<div class="input-group">
							<span class="input-group-addon">R$</span>
							<input type="text" name="total_price[] total_price" class="form-control" id="total_price" placeholder="" disabled>
						</div>							
					</div>
					<div class="col-md-1">
						<button type="button" id="remove-button" class="btn btn-default btn-md"><i class="glyphicon glyphicon-trash"></i></button>
					</div>	
				</div>
			</li>

		</ul>
		
		<div class="col-md-4 pull-right total-modelos">
			<span class="badge" id="total_m"><h4>R$0,00</h4></span>
		</div>

		</div>

		<div class="col-md-3 img-modelo">
			<img src="holder.js/200x200" class="img-responsive img-thumbnail" alt="Responsive image">
			<hr>
			<div class="form-group">
				<input type="file" name="image_model" class="form-control">
			</div>
		</div>
		
	</div>
	
	<button type="submit" class="btn btn-primary pull-right">salvar</button>  	
  
<?php echo form_close(); ?>