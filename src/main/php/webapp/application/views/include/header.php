<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8" />
   <link href="<?= base_url('css/datepicker.css') ?>" rel="stylesheet">
   <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
   <link href="<?= base_url('css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
   <link href="<?= base_url('css/docs.css') ?>" rel="stylesheet">  
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
	                    	<li><a href="<?= base_url('/offer/add/') ?>">Artikel eintragen</a></li>
	                    	<li>	<ul><?php foreach ($types as $type): 
											$typename = $type['typename'];
												echo '<li><a href="'.site_url('/offer/add/' . $typename). '">'.$typename.' eintragen</a>	</li>';	
										endforeach ?>
								  </ul>
	                    	</li>
	                    </ul>
	            </div>
	            <div class="nav-collapse">
	                    <ul class="nav">
	                    	<li><a href="<?= base_url('/offers') ?>">Angebote</a></li>
	                    </ul>
	            </div>	            
            </div>
		</div>
	</div>
            	