<?php
// Deklariere das Interface 'IOffer'
interface IOffer
{
    public function getId();
	public function setId($id);	
    public function getPrice();
	public function setPrice($price);
	public function getDate();
	public function setDate($date);
	public function getArticle();
	public function setArticle($article);
}

?>