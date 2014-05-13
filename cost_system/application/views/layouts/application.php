<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo (isset($page_title)) ? $page_title : 'Nordweg - Sistema de Custos'; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>">    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/jquery.dataTables.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/jquery-ui-1.10.4.custom.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/style.css'; ?>">

    <script src="<?php echo base_url() . 'assets/js/jquery-1.10.2.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/dataTables.tableTools.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery-ui-1.10.4.custom.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery.ui.autocomplete.min.js'; ?>"></script>

    <script src="<?php echo base_url() . 'assets/js/main.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/js/holder.js'; ?>"></script>

    <?php echo put_headers(); ?>

</head>

<body>
	<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">

      <div class="container">

        <div class="navbar-header">          
          <a class="navbar-brand" href="/"><b>Nordweg</b></a>
        </div>

        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <!--<li <?php echo ($this->router->fetch_class() == 'dashboard') ? 'class="active"' : '';?>><a href="<?php echo site_url('dashboard');?>">Dashboard</a></li>-->
            <li <?php echo ($this->router->fetch_class() == 'models') ? 'class="active"' : '';?>><a href="<?php echo site_url('models');?>">Modelos</a></li>
            <li <?php echo ($this->router->fetch_class() == 'materials') ? 'class="active"' : '';?>><a href="<?php echo site_url('materials');?>">Materiais</a></li>
            <li <?php echo ($this->router->fetch_class() == 'suppliers') ? 'class="active"' : '';?>><a href="<?php echo site_url('suppliers');?>">Fornecedores</a></li>
            <li <?php echo ($this->router->fetch_class() == 'multipliers') ? 'class="active"' : '';?>><a href="<?php echo site_url('multipliers');?>">Multiplicadores</a></li>
            <li <?php echo ($this->router->fetch_class() == 'price_list') ? 'class="active"' : '';?>><a href="<?php echo site_url('price_list');?>">Listas de Preços</a></li>            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('user')->name;?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
              <?php if($this->session->userdata('user')->is_admin == 1) : ?>
                <li><?php echo anchor('users/index/', 'Listar Usuários');?></li>
              <?php endif; ?>  
                <li><?php echo anchor('users/edit_password/', 'Mudar senha');?></li> 
                <li class="divider"></li>               
                <li><a href="<?php echo site_url('logout');?>">Logout</a></li>                
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="main-content container">

		<?=$yield?>    

	  </div>	  
    
</body>
</html>