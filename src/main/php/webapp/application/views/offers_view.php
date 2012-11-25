<?php 
$tokens = explode('/', $_SERVER['REQUEST_URI']);
$activetab = $tokens[sizeof($tokens)-1] === 'offers'?'Buch':$tokens[sizeof($tokens)-1];
$base = explode('/offers/', $_SERVER['REQUEST_URI']);
$base = $base[0] . '/offers';
?>

<div class="row">
	<div class="span12">
		<ul class="nav nav-tabs">
			<?php foreach ($types as $type): 
				$typename = $type['typename'];
				$active = ($typename === $activetab)?'class ="active"':'';?>
			<li <?=$active?>>
				<a href="<?=$base . '/show/' . $typename?>"><?=$typename?></a>
			</li>				
			<?php endforeach ?>
		</ul>
	</div>
	
	<table class="span12 table table-striped table-bordered table-hover">
		<caption>Laufende Angebote</caption>
		<thead>
			<th class="span1">ID</th>
			<th class="span4">Titel</th>
			<th class="span2">Typ</th>
			<th class="span1">Preis</th>
		</thead>
		<tbody>
		<!-- Loop over offers -->
		<?php foreach ($offers as $offer): ?>
			<tr>
				<td><?php echo $offer['id'] ?></td>
				<td><?php echo $offer['title'] ?></td>
				<td><?php echo $offer['articletype'] ?></td>
				<td><?php echo $offer['price'] ?></td>
			</tr>
		<?php endforeach ?>
			
		</tbody>
		
	</table>
</div>