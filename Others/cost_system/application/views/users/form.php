<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1><?php echo (isset($users)) ? 'Editar' : 'Novo'; ?> Usuário</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns"></div>
</div>

<?php if(validation_errors()):?>
	<div class='alert alert-danger'><?php echo validation_errors(); ?></div>
<?php endif;?>

<?php echo form_open((isset($users)) ? 'users/update/'.$users->id : 'users/add', array('class' => 'form', 'role' => 'form')); ?>

    <div class="row col-md-4">

		  <div class="form-group">
		    <label for="empresa">Nome</label>
		    <?php echo form_input(array('name' => 'name', 'class' => 'form-control', 'required' => 'required', 'value' => (isset($users)) ? $users->name : set_value('name'))); ?>
		  </div>

		  <div class="form-group">
		    <label for="cidade">Email</label>
		    <?php echo form_input(array('name' => 'username', 'class' => 'form-control', 'type' => 'email', 'required' => 'required', 'value' => (isset($users)) ? $users->username : set_value('username'))); ?>
		  </div>

		  <div class="form-group">
		    <label for="estado">Senha</label>
		    <?php echo form_password(array('name' => 'password', 'class' => 'form-control', 'required' => 'required')); ?>
		  </div>

		  <div class="form-group">
		    <label for="estado">Confirma Senha</label>
		    <?php echo form_password(array('name' => 'confirm_password', 'class' => 'form-control', 'required' => 'required')); ?>
		  </div>

		  <div class="form-group">
		    <label for="estado">Admin</label>
		    <?php echo form_checkbox(array('name' => 'is_admin', 'value' => 1)); ?>
		  </div>
	   	  	  
	   	  <button type="submit" class="btn btn-primary pull-right">salvar</button> 	  
	</div>
	
	

</form>