<?php 
$tokens = explode('/', $_SERVER['REQUEST_URI']);
$activetab = $tokens[sizeof($tokens)-1] === 'offers'|'Alle'?'Alle':$tokens[sizeof($tokens)-1];
$base = explode('/offers', $_SERVER['REQUEST_URI']);
$base = $base[0] . '/offers';
$active_class = 'class ="active"';
?>

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
			<th class="span1">edit</th>
			<th class="span1">ID</th>
			<th class="span4">Titel</th>
			<th class="span2">Typ</th>
			<th class="span1">Preis</th>
		</thead>
		<tbody>
		<!-- Loop over offers -->
		<?php foreach ($offers as $offer): ?>
			<tr>
				<td><a href="<?php echo 'offer/edit/'.$offer['articletype'].'/'.$offer['articleID']; ?>"><?php echo 'edit '.$offer['articletype'] ?></a></td>
				<td><?php echo $offer['id'] ?></td>
				<td><?php echo $offer['title'] ?></td>
				<td><?php echo $offer['articletype'] ?></td>
				<td><?php echo $offer['price'] ?></td>
			</tr>
		<?php endforeach ?>
			
		</tbody>
		
	</table>
</div>