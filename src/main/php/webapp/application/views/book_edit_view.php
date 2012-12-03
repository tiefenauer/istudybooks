<?php echo validation_errors();

	$article_ID = !empty($article->getId()) ? $article->getId() : false;
?>

<?=form_open('offer/save/book/'.$article_ID);?>

<?php ;
	$offer_ID = !empty($offer->getId()) ? $offer->getId() : false;

	$hidden = array('pk_book' => $this->uri->segment(4));
	if($article_ID!==false)$hidden['fk_article'] = $article_ID;
	if($offer_ID!==false)$hidden['order_fk_article'] = $offer_ID;
?>
<?=form_hidden($hidden);?>
    
    <?php $text = ($article_ID !== false) ? 'edit article' : 'create book'; ?>
    <h3><?php echo $text; ?></h3>
    
    <div class="row">
    	<div class="span2"><label for="title">Buchname: </label></div>
    	<div class="span3"><input name="title" type="text" required="required" placeholder="Titel des Buches" value="<?= @$article->getTitle('title') ?>" /></div>
    </div>
    <div class="row">
    	<div class="span2"><label for="author">Author: </label></div>
    	<div class="span3"><input name="author" type="text" required="required" placeholder="Author des Buches" value="<?= @$article['author'] ?>" /></div>
    </div>
    <div class="row">
    	<div class="span2"><label for="edition">Edition: </label></div>
    	<div class="span3"><input name="edition" type="text" placeholder="Edition des Buches"  value="<?= @$article['edition'] ?>" /></div>
    </div>	
    <div class="row">
    	<div class="span2"><label for="isbn">ISBN: </label></div>
    	<div class="span3"><input name="isbn" type="text" required="required" placeholder="ISBN Nummer des Buches" value="<?= @$article['isbn'] ?>" /></div>
    </div>	
    <div class="row">
    	<div class="span2"><label for="picture">Bild: </label></div>
    	<div class="span3"><input name="picture" type="file" value="<?= @$article['picture'] ?>" /></div>
    </div>	   
    
    
    <?php $text = ($offer_ID) ? 'edit offer' : 'create offer'; ?>
    <h3><?php echo $text; ?></h3>
     
    <div class="row">
    	<div class="span2"><label for="price">Preis: </label></div>
    	<div class="span3"><input name="price" type="text" placeholder="Gew&uuml;nschter Preis" value="<?= @$offer['price'] ?>" /></div>
    </div>	
	<div class="row">
    	<div class="span2"><label for="expires">Enddatum: </label></div>
    	<div class="span3"><input name="expires" id="expires" type="datetime" placeholder="Enddatum der Aktion" value="<?= @$offer['expires'] ?>" /></div>
    </div>
		
		
	<?php $text = ($article_ID !== false) ? 'save' : 'create';
	echo '<input name="submit" type="submit" value="'.$text.'" />';
	?>
</form>
<script>
	$('#expires').datepicker().on('changeDate', function(ev){$('#expires').datepicker('hide')});
</script>