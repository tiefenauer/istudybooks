<?php
// Deklariere das Interface 'IOrder'
interface IOrder
{
    public function getId();
	public function setId($id);	
    public function getPrice();
	public function setPrice($price);
	public function getArticle();
}

?>