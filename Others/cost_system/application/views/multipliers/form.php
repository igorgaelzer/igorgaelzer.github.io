
<?php add_js('multipliers.js'); ?>

<div id="title-bar" class="page-header row">
    <div class="col-md-6">
        <h1>Novo Multiplicador</h1>                            
    </div>
    <div class="col-md-6" id="header-btns"></div>
</div>

<?php echo $this->session->flashdata('feedback');?>

<?php if(validation_errors()):?>
	<div class='alert alert-danger'><?php echo validation_errors(); ?></div>
<?php endif;?>

<?php echo form_open((isset($multipliers)) ? 'multipliers/update/'.$multipliers->id : 'multipliers/add', array('class' => 'form', 'role' => 'form')); ?>

	<div class="form-group col-md-6">
		<label for="nome">Nome</label>
		<?php echo form_input(array('name' => 'name', 'required' => 'required', 'class' => 'form-control', 'value' => (isset($multipliers)) ? $multipliers->name : '')); ?>		
	</div>

	<div class="form-group col-md-6">
		<label for="descricao">Descrição</label>
		<?php echo form_input(array('name' => 'description', 'required' => 'required', 'class' => 'form-control', 'value' => (isset($multipliers)) ? $multipliers->description : '')); ?>		
	</div>		

	<div class="row">
		<div class="col-md-12 ">

			<div class="col-md-8">

				<div class="row">
					<div class="col-md-6"><label>Custo</label></div>
					<div class="col-md-6"><label>Valor</label></div>
				</div>

				<div class="row group-data">
					<div class="col-md-6"><div class="form-group"><input type="text" name="cost_name[]" id="cost_name" class="form-control"></div></div>
					<div class="col-md-3">
						<div class="input-group">
							<input type="text" name="value[]" id="cost_value" class="form-control">
							<span class="input-group-addon">%</span>																
						</div>							
					</div>
					<div class="col-md-1">
						<button type="button" id="remove-button" class="btn btn-default btn-md"><i class="glyphicon glyphicon-trash"></i></button>
					</div>	
				</div>
				
			</div>

			<div class="col-md-4 box-multiplicador">
				<div class="well">
					<p>Multiplicador</p>
					<h1 class="multiplier">0</h1>
				</div>
			</div>

		</div>	
	</div>

	<button type="submit" class="btn btn-primary pull-right">salvar</button>			  	
  
</form>