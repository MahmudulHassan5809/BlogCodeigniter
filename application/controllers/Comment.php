<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {
  public function create($id)
  {


    $slug=$this->input->post('slug');
    
    $data['posts']=$this->Post_model->get_posts($slug);

    
        $data['postid'] = $this->Post_model->get_post_by_id($slug);
        $post_id=$data['posts']['id'];

    $this->form_validation->set_rules('name','Name','required');
    $this->form_validation->set_rules('email','Email','required');
    
    $this->form_validation->set_rules('body','Body','required');

    if ($this->form_validation->run()==FALSE) {
    	  $this->load->view('templates/header');
    	  $this->load->view('posts/view',$data);
    	  $this->load->view('templates/footer');

    }
    else
    {
           $this->Comment_model->create_comment($id);
           redirect('Posts/'.$slug);
    }


  }

}