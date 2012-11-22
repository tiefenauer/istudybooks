<?php
// Deklariere das Interface 'iTemplate'
interface IOrder
{
    public function getId();
	public function setId();	
    public function getData();
	public function setData($inDTO);
	public function getArticle();
}

?>