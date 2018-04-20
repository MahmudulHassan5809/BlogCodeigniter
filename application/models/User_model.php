<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{

     public function __construct()
 {
 	$this->load->database();
 }

 public function register($enc_password)
 {
 	$data=array(
       'name'=>$this->input->post('name'),
       'email'=>$this->input->post('email'),
       'username'=>$this->input->post('username'),
       'password'=>$enc_password,
       'zipcode'=>$this->input->post('zipcode')
  );
  return $this->db->insert('tbl_users',$data);	
 }

 public function login($email,$password)
 {
    //$this->db->where('username',$username);
   // $this->db->where('password',$password);
    echo $password;
    $query = $this->db->get_where('tbl_users', array('email' => $email,'password'=>$password));
    if($query->num_rows()==1)
    {
       return $query->row(0)->id;
    }
    else
    {
    	return false;
    }
 }




}
