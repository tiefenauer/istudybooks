<?php
// Deklariere das Interface 'IArticle'
interface IArticle
{
    public function getId();
	public function setId($id);	
    public function getType();
	public function setType($type);		
	public function getTitle();	
    public function getData();
	public function setData($inDTO);
	public function getTabel();
}

?>