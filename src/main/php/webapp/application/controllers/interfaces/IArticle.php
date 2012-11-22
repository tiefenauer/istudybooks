<?php
// Deklariere das Interface 'iTemplate'
interface IArticle
{
    public function getId();
	public function setId();	
    public function getData();
	public function setData($inDTO);
	public function getTabel();
}

?>