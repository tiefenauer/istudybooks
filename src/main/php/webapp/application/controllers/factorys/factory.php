<?php
class Factory
{
	private $articleArray = array( CONST_TYPE_BOOK => Book.class );
					
	static public function getOffers($articleType = CONST_TYPE_EMPTY){
		$offers = array();
		if($articleType == CONST_TYPE_EMPTY){
			$class = NULL;
			foreach ($articleArray as $const => $class){
				$class->getData();
			}
		} else {
			$class = $articleArray[$articleType];
		}	
	}
	
	static public function getOffer($articleType,$articleId){
		if($articleType){
			
		}	
	}
	
	static public function getArticles($articleType = CONST_TYPE_EMPTY){
		$offers = array();
		if($articleType == CONST_TYPE_EMPTY){
			$class = NULL;
			foreach ($articleArray as $const => $class){
				$class->getData();
			}
		} else {
			$class = $articleArray[$articleType];
		}	
	}
	
	static public function getArticle($articleType,$articleId){
		if($articleType){
			
		}	
	}
			
}
?>