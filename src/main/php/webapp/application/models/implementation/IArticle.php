<?php
// Deklariere das Interface 'IArticle'
interface IArticle
{
    public function getId();
	public function setId($id);	
    public function getType();
	public function getTitle();	
    public function getData($element=false);
	public function setData($inDTO);
	public function getTabel();
}

?>