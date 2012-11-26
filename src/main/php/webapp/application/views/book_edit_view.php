<?php echo validation_errors(); ?>

<?=form_open('offer/save/book');?>

<?php 
	
	$hidden = array('article_type' => 'Buch', 'member_id' => '234');
	
?>
<?=form_hidden('pk_book', $this->uri->segment(4));?>
    <div class="row">
    	<div class="span2"><label for="title">Buchname: </label></div>
    	<div class="span3"><input name="title" type="text" required="required" placeholder="Titel des Buches" value="<?= $this->input->post('title') ?>" /></div>
    </div>
    <div class="row">
    	<div class="span2"><label for="author">Author: </label></div>
    	<div class="span3"><input name="author" type="text" required="required" placeholder="Author des Buches" value="<?= $this->input->post('author') ?>" /></div>
    </div>
    <div class="row">
    	<div class="span2"><label for="edition">Edition: </label></div>
    	<div class="span3"><input name="edition" type="text" placeholder="Edition des Buches"  value="<?= $this->input->post('edition') ?>"/></div>
    </div>	
    <div class="row">
    	<div class="span2"><label for="isbn">ISBN: </label></div>
    	<div class="span3"><input name="isbn" type="text" required="required" placeholder="ISBN Nummer des Buches" value="<?= $this->input->post('isbn') ?>"/></div>
    </div>	
    <div class="row">
    	<div class="span2"><label for="picture">Bild: </label></div>
    	<div class="span3"><input name="picture" type="file" value="<?= $this->input->post('picture') ?>"/></div>
    </div>	    
    <div class="row">
    	<div class="span2"><label for="price">Preis: </label></div>
    	<div class="span3"><input name="price" type="text" required="required" placeholder="Gew&uuml;nschter Preis" value="<?= $this->input->post('price') ?>"/></div>
    </div>	
	<div class="row">
    	<div class="span2"><label for="expires">Enddatum: </label></div>
    	<div class="span3"><input name="expires" id="expires" type="datetime" placeholder="Enddatum der Aktion" value="<?= $this->input->post('expires') ?>"/></div>
    </div>
		
	<input name="submit" type="submit" value="Erstellen" />
	
</form>
<script>
	$('#expires').datepicker().on('changeDate', function(ev){$('#expires').datepicker('hide')});
</script>