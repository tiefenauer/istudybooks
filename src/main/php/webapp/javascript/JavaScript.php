<?php

 function javascript() {

  $javascript = "
  	$(document).ready(function() {
        $('ul.nav>li').hover(function(){
        	$(this).children('ul').slideDown();
        },function(){
        	$(this).children('ul').slideUp();
        });
     });
       ";

  return $javascript;
}

?>
