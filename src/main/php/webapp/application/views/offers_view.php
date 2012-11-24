<div class="row">
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