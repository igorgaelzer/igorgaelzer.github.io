<div id="title-bar" class="page-header row">
    <div class="col-lg-6">
        <h1>Editar Usuário</h1>                            
    </div>
    <div class="col-lg-6" id="header-btns"></div>
</div>

<?php if(validation_errors()):?>
	<div class='alert alert-danger'><?php echo validation_errors(); ?></div>
<?php endif;?>

<div class="well col-md-5">

<?php echo form_open('users/update/'.$users->id, array('class' => 'form', 'role' => 'form')); ?>

    <div class="row">

		  <div class="form-group">
		    <label for="empresa">Nome</label>
		    <?php echo form_input(array('name' => 'name', 'class' => 'form-control', 'required' => 'required', 'value' => (isset($users)) ? $users->name : set_value('name'))); ?>
		  </div>

		  <div class="form-group">
		    <label for="cidade">Email</label>
		    <?php echo form_input(array('name' => 'username', 'class' => 'form-control', 'type' => 'email', 'required' => 'required', 'value' => (isset($users)) ? $users->username : set_value('username'))); ?>
		  </div>

		  <div class="form-group">
		    <label for="estado">Admin</label>
		    <?php echo form_checkbox(array('name' => 'is_admin', 'value' => 1, 'checked' => ($users->is_admin) ? TRUE : FALSE)); ?>
		  </div>
	   	  	  
	   	  <button type="submit" class="btn btn-primary pull-right">editar usuário</button> 	  
	</div>
	
</form>
</div>


<div class="well col-md-5 pull-right">

<?php echo form_open('users/update_password/'.$users->id, array('class' => 'form', 'role' => 'form')); ?>

    <div class="row">
		  
		  <div class="form-group">
		    <label for="estado">Senha</label>
		    <?php echo form_password(array('name' => 'password', 'class' => 'form-control', 'required' => 'required')); ?>
		  </div>

		  <div class="form-group">
		    <label for="estado">Confirma Senha</label>
		    <?php echo form_password(array('name' => 'confirm_password', 'class' => 'form-control', 'required' => 'required')); ?>
		  </div>
	   	  	  
	   	  <button type="submit" class="btn btn-primary pull-right">mudar senha</button> 	  
	</div>
	
</form>

</div>