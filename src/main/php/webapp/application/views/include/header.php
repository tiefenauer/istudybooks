<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8" />
   <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
   <link href="<?= base_url('css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
   <link href="<?= base_url('css/docs.css') ?>" rel="stylesheet">  
   
  <!-- <link href="<?= base_url('css/jquery-ui-1.9.2.custom.min.css') ?>" rel="stylesheet">-->
   
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
   <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
</head>
<body>
<div class="container" id="banner">
	<div class="row">
		<div class="span3"><!-- Logo --></div>
		<div class="span7 visible-desktop"><!-- addtional infos --></div>
		<div class="span2"><!-- login --></div>
	</div>	
</div>
        
<div class="container">
	<div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </a>
	            <a class="brand" href="<?= base_url('') ?>">istudybooks</a>
	            <div class="nav-collapse">
	                <ul class="nav">
	                     <li class="dropdown">
	                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" href="<?= base_url('/offer/add/') ?>">Artikel eintragen
	                            <b class="caret"></b>
	                            </a>
	                            <ul class="dropdown-menu">
	                            	<?php foreach ($types as $type): 
											$typename = $type['typename'];
												echo '<li><a href="'.site_url('/offer/add/' . $typename). '">'.$typename.' eintragen</a>	</li>';	
										endforeach ?>
	                            </ul>
	                        </li>  
	                        
	                        <!--
	                   
	                    	<li>
	                    		<ul><?php foreach ($types as $type): 
											$typename = $type['typename'];
												echo '<li><a href="'.site_url('/offer/add/' . $typename). '">'.$typename.' eintragen</a>	</li>';	
										endforeach ?>
								  </ul>
	                    	</li>
	                    </ul>
	                    -->
	            </div>
	            <div class="nav-collapse">
	                    <ul class="nav">
	                    	<li><a href="<?= base_url('/offers') ?>">Angebote</a></li>	                    	
	                    </ul>
	                    <ul class="nav pull-right">
<?php
							if($this->session->userdata('logged_in'))
				{ 
							$session_data = $this->session->userdata('logged_in');
							$data['username'] = $session_data['username'];
					?>
				 			<li><a href="<?= base_url('/welcome/logout') ?>">Logout</a></li> 
<?php			}
							else
				{ ?>				          
	             			<li><a href="<?= base_url('/login') ?>">Login</a></li>
	             			<li><a href="<?= base_url('/register') ?>">Register</a></li>
<?php			}
?>			                    	
	                    </ul>
	            </div>	                 
	                    
            </div>
		</div>
	</div>
	
	<div class="notificationWrapper">
	 <?php 
	 $this->load->library('session');
	 if($this->session->userdata('notification')){ echo '<div class="notification"><div>'.$this->session->userdata('notification').'</div></div>'; 
		 $this->session->set_userdata('notification',false);
	 }
	            ?>
	</div>
            	