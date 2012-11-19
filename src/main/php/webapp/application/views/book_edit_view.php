<?=form_open('book/book_insert');?>

<?=form_hidden('pk_book', $this->uri->segment(4));?>
    <div class="row">
    	<div class="span2"><label for="name">Buchname: </label></div>
    	<div class="span3"><input name="name" type="text" required="required" placeholder="Names des Buches" /></div>
    </div>
    <div class="row">
    	<div class="span2"><label for="author">Author: </label></div>
    	<div class="span3"><input name="author" type="text" required="required" placeholder="Author des Buches"  /></div>
    </div>
    <div class="row">
    	<div class="span2"><label for="edition">Edition: </label></div>
    	<div class="span3"><input name="edition" type="text" placeholder="Edition des Buches"  /></div>
    </div>	
    <div class="row">
    	<div class="span2"><label for="isbn">ISBN: </label></div>
    	<div class="span3"><input name="isbn" type="text" required="required" placeholder="ISBN Nummer des Buches" /></div>
    </div>	
    <div class="row">
    	<div class="span2"><label for="picture">Bild: </label></div>
    	<div class="span3"><input name="picture" type="file" /></div>
    </div>	    
    <div class="row">
    	<div class="span2"><label for="price">Preis: </label></div>
    	<div class="span3"><input name="price" type="text" required="required" placeholder="Gew&uuml;nschter Preis" /></div>
    </div>	
	<div class="row">
    	<div class="span2"><label for="expires">Enddatum: </label></div>
    	<div class="span3"><input name="expires" id="expires" type="datetime" placeholder="Enddatum der Aktion" /></div>
    </div>
		
	<input name="submit" type="submit" value="Erstellen" />
	
</form>
<script>
	$('#expires').datepicker().on('changeDate', function(ev){$('#expires').datepicker('hide')});
</script>