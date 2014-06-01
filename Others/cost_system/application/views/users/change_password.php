<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Mudar Senha</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns"></div>
</div>

<?php if(validation_errors()):?>
	<div class='alert alert-danger'><?php echo validation_errors(); ?></div>
<?php endif;?>

<?php echo form_open('users/edit_password', array('class' => 'form', 'role' => 'form')); ?>

    <div class="row col-md-4">

		  <div class="form-group">
		    <label for="estado">Senha Atual</label>
		    <?php echo form_password(array('name' => 'old_password', 'class' => 'form-control', 'required' => 'required')); ?>
		  </div>

		  <div class="form-group">
		    <label for="estado">Nova Senha</label>
		    <?php echo form_password(array('name' => 'password', 'class' => 'form-control', 'required' => 'required')); ?>
		  </div>

		  <div class="form-group">
		    <label for="estado">Confirma Senha</label>
		    <?php echo form_password(array('name' => 'confirm_password', 'class' => 'form-control', 'required' => 'required')); ?>
		  </div>
	   	  	  
	   	  <button type="submit" class="btn btn-primary pull-right">salvar</button> 	  
	</div>

</form>