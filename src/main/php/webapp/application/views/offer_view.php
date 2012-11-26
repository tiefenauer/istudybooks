
		Select Type you want to add:

		<ul>
		<?php foreach ($types as $type): 
				$typename = $type['typename'];
				echo '<li><a href="'.site_url('/offer/add/' . $typename). '">'.$typename.'</a>	</li>';	
			  endforeach ?>
		
		</ul>