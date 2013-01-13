<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('pk_user, username, email, password');
   $this -> db -> from('tbl_users');
   $this -> db -> where('username = ' . "'" . $username . "'");
   $this -> db -> where('password = ' . "'" . MD5($password) . "'");
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
public function add_user()
 {
  $data=array(
    'username'=>$this->input->post('user_name'),
    'email'=>$this->input->post('email_address'),
    'password'=>md5($this->input->post('password'))
  );
  $this->db->insert('tbl_users',$data);
 } 
}
?>

