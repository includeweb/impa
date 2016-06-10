<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Raien</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,500,700' rel='stylesheet' type='text/css'>
	<!-- Optional theme -->
	 <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php echo add_style('style');?>
    <?php echo add_style('font-awesome.min');?>
  </head>
  <body>
    <!-- Main container -->
    <div class="container-fluid no-padding">
  		<!-- Top info -->
    	
    		
    	
    	<!-- / Top info -->
    	

				<nav class="navbar navbar-default navbar-fixed-top top-info-navbar ">
					<div class="container">
						<div class="top-info">
			    			<div class="col-md-6">TELÉFONO:  011-4701-9316 & líneas rotativas       EMAIL: ventas@raien.com.ar</div>
			    			<div class="col-md-6">
			    				<div class="pull-right">
				    				<a href="" target="_blank">
				    					<img src="<?=base_url();?>images/web/youtube-icon.png" alt="Youtube">
				    				</a>
				    				<a href="" target="_blank">
				    					<img src="<?=base_url();?>images/web/facebook-icon.png" alt="Facebook">
				    				</a>	
				    				<a href="" target="_blank">
				    					<img src="<?=base_url();?>images/web/blogger-icon.png" alt="Blogger">
				    				</a>
			    				</div>
			    			</div>
	    				</div>
    				</div>
				</nav>
	    		<nav class="navbar navbar-default navbar-fixed-top raien-navbar">
					<div class="container ">
					
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="#"><img src="<?=base_url();?>images/web/logo-raien.png" /></a>
				    </div>

				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      
				      <ul class="nav navbar-nav navbar-right">
				        <li><a href="#">home</a></li>
				        
				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">productos <span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li>
				            	<a href="#">
				            		<div class="sub-navigation">
				            			<div class="sub-navigation-icon">
				            				<img src="<?=base_url();?>images/web/categoria-icon.png" />
				            			</div>
				            			<div class="sub-navigation-text">
				            				Categoría
				            			</div>
				            		</div>
				            	</a>
				            </li>
				            <li>
				            	<a href="#">
				            		<div class="sub-navigation">
				            			<div class="sub-navigation-icon">
				            				<img src="<?=base_url();?>images/web/aplicacion-icon.png" />
				            			</div>
				            			<div class="sub-navigation-text">
				            				Aplicación
				            			</div>
				            		</div>
				            	</a>
				            </li>
				            <li>
				            	<a href="#">
				            		<div class="sub-navigation">
				            			<div class="sub-navigation-icon">
				            				<img src="<?=base_url();?>images/web/marca-icon.png" />
				            			</div>
				            			<div class="sub-navigation-text">
				            				Marca
				            			</div>
				            		</div>
				            	</a>
				            </li>
				          
				          </ul>
				        </li>
				        <li><a href="#">ingeniería</a></li>
				        <li><a href="#">capacitación</a></li>
				        <li><a href="#">institucional</a></li>
				        <li><a href="#">contacto</a></li>
				        <li><a href="#">trabaja con raien</a></li>
				      </ul>
				    </div><!-- /.navbar-collapse -->
				  	</div>
				</nav>
		
		
    </div>
    <div class="container-fluid no-padding">
		<!-- Content -->
		<?php echo $content_for_layout?>
		<!-- / Content -->		
    </div>
 	<!-- / Main container -->

  


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>