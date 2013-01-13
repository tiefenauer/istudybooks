 <head>
   <title>Offer detail</title>
 </head>
<?php
$article = $offer->getArticle();
$articledata = json_decode(json_encode($article->getData()));
?>
<div class="container">
	<div class="row-fluid">
		<div class="span3">
			Foto
		</div>
		<div class="span5">
			<h2>Angebotsdetails</h2>
			<table class="table table-condensed">
				<tr>
					<td>ID</td>
					<td><?=$offer->getId()?></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><?=$offer->getPrice()?></td>
				</tr>
				<tr>
					<td>Date</td>
					<td><?=$offer->getDate()?></td>
				</tr>
			</table>
			<h2>Artikeldetails</h2>
			<table class="table table-condensed">
				<tr>
					<td>ID</td>
					<td><?=$article->getId()?></td>
				</tr>
				<tr>
					<td>Typ</td>
					<td><?=$article->getType()?></td>
				</tr>
				<?php foreach ($articledata as $key => $value): 
					if ($key != "picture"){?>					
				<tr>
					<td><?=$key?></td>
					<td><?=$value?></td>
				</tr>
				<?php
					} 
					endforeach ?>
			</table>
			
			<a href="<?php echo site_url('/offer/buy/'.$article->getType().'/'.$article->getId()); ?>" 
				class="btn btn-success">
				<i class="icon-shopping-cart icon-white"></i> 
				Buch kaufen
			</a>
		</div>
	</div>
</div>
