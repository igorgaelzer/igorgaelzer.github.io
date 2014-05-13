
<?php echo form_open('login', array('class' => 'form-signin well', 'role' => 'form')); ?>
	
    <h2 class="form-signin-heading">Login</h2>

    <?php echo $this->session->flashdata('feedback');?>

    <input type="text" name="username" class="form-control" placeholder="Email" required autofocus>

    <input type="password" name="password" class="form-control" placeholder="Senha" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>

</form>