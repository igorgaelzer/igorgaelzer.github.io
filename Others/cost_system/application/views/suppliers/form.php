<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1><?php echo (isset($suppliers)) ? 'Editar' : 'Novo'; ?> Fornecedor</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns"></div>
</div>

<?php if(validation_errors()):?>
	<div class='alert alert-danger'><?php echo validation_errors(); ?></div>
<?php endif;?>

<?php echo form_open((isset($suppliers)) ? 'suppliers/update/'.$suppliers->id : 'suppliers/add', array('class' => 'form', 'role' => 'form')); ?>

    <div class="row">

		  <div class="form-group col-md-6">
		    <label for="empresa">Empresa</label>
		    <?php echo form_input(array('name' => 'company_name', 'class' => 'form-control', 'required' => 'required', 'value' => (isset($suppliers)) ? $suppliers->company_name : set_value('company_name'))); ?>
		  </div>

		  <div class="form-group col-md-4">
		    <label for="cidade">Cidade</label>
		    <?php echo form_input(array('name' => 'city', 'class' => 'form-control', 'value' => (isset($suppliers)) ? $suppliers->city : set_value('city'))); ?>	
		  </div>

		  <div class="form-group col-md-2">
		    <label for="estado">Estado</label>
		    <?php echo form_input(array('name' => 'state', 'class' => 'form-control', 'value' => (isset($suppliers)) ? $suppliers->state : set_value('state'))); ?>
		  </div>

		  <div class="form-group col-md-6">
		    <label for="email">Email</label>
		    <?php echo form_input(array('name' => 'email', 'class' => 'form-control', 'type' => 'email', 'value' => (isset($suppliers)) ? $suppliers->email : set_value('email'))); ?>
		  </div>

		  <div class="form-group col-md-6">
		    <label for="telefone">Telefone</label>
		    <?php echo form_input(array('name' => 'phone', 'class' => 'form-control', 'type' => 'phone', 'value' => (isset($suppliers)) ? $suppliers->phone : set_value('phone'))); ?>
		  </div>

		  <div class="form-group col-md-6">
		    <label for="representante">Representante</label>
		    <?php echo form_input(array('name' => 'representative', 'class' => 'form-control', 'value' => (isset($suppliers)) ? $suppliers->representative : set_value('representative'))); ?>
		  </div>
	   	  	  
	</div>
	
	<button type="submit" class="btn btn-primary pull-right">salvar</button>

</form>