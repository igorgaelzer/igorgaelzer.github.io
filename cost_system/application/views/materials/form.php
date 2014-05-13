<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1><?php echo (isset($materials)) ? 'Editar' : 'Novo'; ?> Material</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns"></div>
</div>

<?php if(validation_errors()):?>
	<div class='alert alert-danger'><?php echo validation_errors(); ?></div>
<?php endif;?>

<?php echo form_open((isset($materials)) ? 'materials/update/'.$materials->id : 'materials/add', array('class' => 'form', 'role' => 'form')); ?>

    <div class="row">

		  <div class="form-group col-md-6">
		    <label for="descricao">Descrição</label>
		    <?php echo form_input(array('name' => 'description', 'class' => 'form-control', 'required' => 'required', 'value' => (isset($materials)) ? $materials->description : '')); ?>
		  </div>

		  <div class="form-group col-md-6">
		    <label for="fornecedor">Fornecedor</label>
		    <?php echo form_dropdown('suppliers_id', $suppliers_list, '', 'class="form-control"'); ?>
		  </div>

	</div>
	
	<div class="row">	  

		  <div class="form-group col-md-5">
		    <label for="referencia">Referência</label>
		    <?php echo form_input(array('name' => 'reference', 'class' => 'form-control', 'value' => (isset($materials)) ? $materials->reference : '')); ?>
		  </div>

		  <div class="form-group col-md-3">
		    <label for="valor">Valor</label>
		    <div class="input-group">
			    <span class="input-group-addon">R$</span>
			    <?php echo form_input(array('name' => 'price', 'class' => 'form-control', 'value' => (isset($materials)) ? $materials->price : '')); ?>
			</div>    
		  </div>

		  <div class="form-group col-md-4">
		    <label for="medida">Medida</label>
		    <?php echo form_input(array('name' => 'measure', 'class' => 'form-control', 'value' => (isset($materials)) ? $materials->measure : '')); ?>
		  </div>

	</div>
	
	<div class="row">

		  <div class="form-group col-md-6">
		    <label for="marca">Marca</label>
		    <?php echo form_input(array('name' => 'brand', 'class' => 'form-control', 'value' => (isset($materials)) ? $materials->brand : '')); ?>
		  </div>
	   	  	  
	</div>
	
	<button type="submit" class="btn btn-primary pull-right">salvar</button>

</form>