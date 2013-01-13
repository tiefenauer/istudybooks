 <head>
   <title>Buy</title>
 </head>
<?php echo validation_errors();
	$article = $offer->getArticle();
	$article_ID = $article->getId();
	$offer_ID = $offer->getId();
	$type = 'book';
?>

<?=form_open('offer/order/'.$type.'/'.$offer_ID);

	if($offer_ID!==false)$hidden['offer_ID'] = $offer_ID;
?>
<?=form_hidden($hidden);?>
  
    <h3>Buy <?php echo $type; ?> "<?php echo @$article->getTitle(); ?>"</h3>
    <br/>
    <div class="row">
    	<div class="span2"><label for="name">Name: </label></div>
    	<div class="span3"><input name="name" type="text" required="required" placeholder="name" value="" /></div>
    </div>
    <div class="row">
    	<div class="span2"><label for="firstname">First name: </label></div>
    	<div class="span3"><input name="firstname" type="text" required="required" placeholder="firstname" value="" /></div>
    </div>
    <div class="row">
    	<div class="span2"><label for="edition">Address: </label></div>
    	<div class="span3"><input name="address" type="text" placeholder="address"  value="" /></div>
    </div>	
    <div class="row">
    	<div class="span2"><label for="email">Email: </label></div>
    	<div class="span3"><input name="email" type="text" required="required" placeholder="email" value="" /></div>
    </div>
  <?php
	echo '<input name="submit" type="submit" value="order '.$type.'" />';
	?>
</form>