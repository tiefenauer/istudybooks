<html>
<head>
	<title>403 Forbidden</title>
</head>
<body>

<?=form_open('book/book_insert');?>

<?=form_hidden('pk_book', $this->uri->segment(4));?>

</form>

</body>
</html>