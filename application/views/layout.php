<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Include Web - CMS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />
      	<?php echo add_style('bootstrap.min');?>
        <?php echo add_style('override');?>
        <?php echo add_jscript('jquery-1.11.1.min');?>		
        <?php echo add_jscript('bootstrap.min');?>
        <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300' rel='stylesheet' type='text/css'>
      
		
    </head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=base_url();?>"><div class="pull-left"><img src="<?=base_url();?>images/logo.png" width="50"/></div><div class="logo"> ADMIN</div></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
         
     
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?=$username;?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?=base_url();?>auth/change_password">Cambiar contraseña</a></li>
            <li class="divider"></li>
            <li><a href="<?=base_url();?>auth/logout">Log out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<div class="row-fluid">
		<div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <div class="panel panel-default">
           
            <div class="panel-body">
            <ul class="nav nav-pills nav-stacked">
              <li role="presentation" class="dashboard-tab <?if($active_tab == 'dashboard'){echo "active";}?>"><a href="<?=base_url();?>admin"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
              <li role="presentation" class="productos-tab <?if($active_tab == 'secciones'){echo "active";}?>"><a href="<?=base_url();?>admin/secciones" class="list-group-item"><span class="glyphicon glyphicon-th-list"></span> Secciones</a></li>
              <!--<li role="presentation" class="productos-tab <?if($active_tab == 'textos'){echo "active";}?>"><a href="<?=base_url();?>admin/textos" class="list-group-item"><span class="glyphicon glyphicon-align-left"></span> Textos</a></li>-->
              <li role="presentation" class="productos-tab <?if($active_tab == 'media'){echo "active";}?>"><a href="<?=base_url();?>admin/media" class="list-group-item"><span class="glyphicon glyphicon-picture"></span> Media</a></li>
              <li role="presentation" class="contactos-tab <?if($active_tab == 'contactos'){echo "active";}?>"><a href="<?=base_url();?>admin/contactos" class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span> Contactos</a></li>
              <li role="presentation" class="cvs-tab <?if($active_tab == 'usuarios'){echo "active";}?>"><a href="<?=base_url();?>admin/usuarios" class="list-group-item"><span class="glyphicon glyphicon-user"></span> Usuarios</a></li>
            </ul>
            </div>
          </div>
        </div>
        <div class="col-md-10" id="content-app">
          <?php echo $content_for_layout?>
        </div>
      </div>
          
        </div>
    </div>    
</body>
</html>