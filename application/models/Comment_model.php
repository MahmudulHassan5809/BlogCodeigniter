<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model 
{
    
   public function __construct()
 {
 	$this->load->database();
 }

 public function create_comment($id)
 {

 	$data=array(
         'post_id'=>$id,
         'name'=>$this->input->post('name'),
         'email'=>$this->input->post('email'),
         'body'=>$this->input->post('body')
 	);

 	return $this->db->insert('tbl_comment',$data);
 }

 public function get_comment($post_id)
 {

 	 $query=$this->db->get_where('tbl_comment',array('post_id'=>$post_id));
 	 return $query->result_array();
 }

}