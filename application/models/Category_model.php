<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model 
{
    
   public function __construct()
 {
 	$this->load->database();
 }

 public function create_category()
 {
    $data=array(

      'name'=>$this->input->post('name')
       );
   return $this->db->insert('tbl_cat',$data);
   
 }

  public function get_categories()
  {
  	 $this->db->order_by('name');
    $query=$this->db->get('tbl_cat');
    return $query->result_array();
  }

  public function get_category($id)
  {
  	$query=$this->db->get_where('tbl_cat',array('id'=>$id));
  	return $query->row_array();
  }
 


}
