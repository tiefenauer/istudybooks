 <head>
   <title>Offer overview</title>
 </head>
<?php 
$tokens = explode('/', $_SERVER['REQUEST_URI']);
$activetab = $tokens[sizeof($tokens)-1] === 'offers'|'Alle'?'Alle':$tokens[sizeof($tokens)-1];
$base = explode('/offers', $_SERVER['REQUEST_URI']);
$base = $base[0] . '/offers';
$active_class = 'class ="active"';
?>
<style>
	.view_offer:hover {
		cursor: hand;
		cursor: pointer;
	}
</style>

<div class="row">
	<div class="span12">
		<ul class="nav nav-tabs">
			<li <?=$activetab==='Alle'?$active_class:'' ?>>
				<a href="<?=$base?>">Alle</a>
			</li>
			<?php foreach ($types as $type): 
				$typename = $type['typename'];
				$active = ($typename === $activetab)?$active_class:'';?>
			<li <?=$active?>>
				<a href="<?=$base . '/filter/' . $typename?>"><?=$typename?></a>
			</li>				
			<?php endforeach ?>
		</ul>
	</div>
	
	<table class="span12 table table-striped table-bordered table-hover">
		<caption>Laufende Angebote</caption>
		<thead>
			<?php if($this->session->userdata('logged_in')){ ?>
			<th class="span1">edit</th>
			<?php } //if($this->session->userdata('logged_in')){ ?>
			<th class="span1">id</th>
			<th class="span4">title</th>
			<th class="span2">type</th>
			<th class="span1">price</th>
			<th class="span1">buy</th>
		</thead>
		<tbody>
		<!-- Loop over offers -->
		<?php foreach ($offers as $offer):
			$id =  $offer->getId();
			$type = $offer->getArticle()->getType();
			$title = $offer->getArticle()->getTitle();
			$price = $offer->getPrice();
			?>
			<tr class="view_offer">
				<?php if($this->session->userdata('logged_in')){ ?>
				<td>
					<a 	href="<?php echo site_url('/offer/edit/'.$type.'/'.$id); ?>"
						class="btn">
						<i class="icon-edit"></i>
						<?='edit '.$type ?>
					</a>
				</td>
				<?php }//if($this->session->userdata('logged_in')){ ?>
				<td><?=$id ?></td>
				<td><a class="view_offer_link" href="<?php echo site_url('/offer/view/'.$id ) ?>"><?=$title ?></a></td>
				<td><?=$type ?></td>
				<td><?=$price ?></td>
				<td>
					<a 	href="<?php echo site_url('/offer/buy/'.$type.'/'.$id); ?>"
						class="btn btn-success"
					>
						<i class="icon-shopping-cart icon-white"></i>
						<?='Buy '.$type ?>
					</a>
				</td>
			</tr>
		<?php endforeach ?>
			
		</tbody>
		
	</table>
</div>
<script>
	$('.view_offer').click(function() {
  		window.location.href = $(this).find('.view_offer_link').attr('href');
	});
</script>
