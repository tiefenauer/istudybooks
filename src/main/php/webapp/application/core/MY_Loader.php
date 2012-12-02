<?php

/**
 * /application/core/templateLoader.php
 *
 */

class MY_Loader extends CI_Loader
{
    public function __construct()
    {
        parent::__construct();
    }

    public function template($template_name, $vars = array(), $return = FALSE)
    {   
    	$CI = get_instance();
        $CI->load->model('offers_model');
		$data['types'] = $CI->offers_model->get_types();
		$vars = array_merge($data,$vars);
		
		$content  = $this->view('include/header', $vars, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('include/footer', $vars, $return);

        if ($return)
        {
            return $content;
        } else 
        	echo $content;
        
    }
}
?>