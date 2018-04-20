<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model 
{

 public function __construct()
 {
 	$this->load->database();
 }
 
 public function get_posts($slug=FALSE,$limit=FALSE,$offset=FALSE)
 {
    if ($limit) {
       $this->db->limit($limit,$offset);
    }
    if ($slug===FALSE) {
    	 $this->db->order_by('posts.id','DESC');
         $this->db->join('tbl_cat','tbl_cat.id=posts.cat_id');
    	 $query=$this->db->get('posts');
    	 return $query->result_array();
    }
            $this->db->join('tbl_cat','tbl_cat.id=posts.cat_id');
     $query=$this->db->get_where('posts',array('slug'=>$slug));
     return $query->row_array();
 }

 public function create_post($post_image)
 {
 	$slug=url_title($this->input->post('title'));

 	$data=array(
        'title'=>$this->input->post('title'),
        'slug' =>$slug,
        'body'=>$this->input->post('body'),
        'cat_id'=>$this->input->post('cat_id'),
        'user_id'=>$this->session->userdata('user_id'),
        'postimage'=>$post_image
 	);

 	return $this->db->insert('posts',$data);
 }

  public function get_post_by_id($slug){
    $this->db->where('slug', $slug);
    $query = $this->db->get('posts');
    return $query->row();
  }


  public function delete_post($id)
  {
    $image_file_name = $this->db->select('postimage')->where('id', $id)->get('posts')->row()->postimage;
    $cwd = getcwd();//save the current directory
    $image_file_path = $cwd."\\assets\\images\\posts\\";
    chdir($image_file_path);
    unlink($image_file_name);
    chdir($cwd);//Restore the previous worling directory
    $this->db->where('id', $id);
    $this->db->delete('posts');
    return true;
  }

  public function update_post($post_image=FALSE)
  {
    $data=array();
    $slug=url_title($this->input->post('title'));
    $id=$this->input->post('id');

     if ($post_image==FAlSE) {
         
         $data=array(
        'title'=>$this->input->post('title'),
        'slug' =>$slug,
        'body'=>$this->input->post('body'),
        'cat_id'=>$this->input->post('cat_id')
      );

      $this->db->where('id',$id);
      return $this->db->update('posts',$data);

       }else{
          $image_file_name = $this->get_image_by_id($id);
          $cwd = getcwd();//save the current directory
          $image_file_path = $cwd."\\assets\\images\\posts\\";
          chdir($image_file_path);
          unlink($image_file_name);
          chdir($cwd);//Restore the previous worling directory
          $data=array(
        'title'=>$this->input->post('title'),
        'slug' =>$slug,
        'body'=>$this->input->post('body'),
        'cat_id'=>$this->input->post('cat_id'),
        'postimage'=>$post_image
       );
     
      $this->db->where('id',$id);
    return $this->db->update('posts',$data);

      } 
   
   
    
  }

  public function get_cat()
  {
    $this->db->order_by('name');
    $query=$this->db->get('tbl_cat');
    return $query->result_array();
  }

  public function get_post_by_category($id)
  {
    $this->db->order_by('posts.id','DESC');
    $this->db->join('tbl_cat','tbl_cat.id=posts.cat_id');
         $query=$this->db->get_where('posts',array('cat_id'=>$id));
         return $query->result_array();



  }

  public function get_image_by_id($id)
  {
    // $this->db->where('id', $id);
    $query = $this->db->select('postimage')->where('id', $id)->get('posts')->row()->postimage;
    return $query;

  }


}