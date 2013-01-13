<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller{
 public function __construct()
 {
  parent::__construct();
  $this->load->model('user');
 }
 public function index()
 {
  if(($this->session->userdata('logged_in')!=""))
  {
   $this->load->template('welcome_message');
  }
  else{
   $data[]="";
   $this->load->helper('form');  
   $this->load->template("registration_view",$data);
  }
 }

 public function login()
 {
  $username=$this->input->post('user_name');
  $password=$this->input->post('password');
  $result=$this->user->login($username,$password);
  if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'pk_user' => $row->pk_user,
         'username' => $row->username,
         'email' => $row->email
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
   }
  $this->index();
 }

 public function registration()
 {
  $this->load->library('form_validation');
  // field name, error message, validation rules
  $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|min_length[4]|xss_clean');
  $this->form_validation->set_rules('email_address', 'Your Email', 'trim|required|valid_email');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  $this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required|matches[password]');

  if($this->form_validation->run() == FALSE)
  {
   $this->index();
  }
  else
  {
   $this->user->add_user();
   $this->login();
  }
 }

}
?>