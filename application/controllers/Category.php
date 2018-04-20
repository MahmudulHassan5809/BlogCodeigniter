<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function index()
	{   
        if(!$this->session->userdata('logged_in'))
        {
          redirect('User/login');
        }
		$data['title']='Create Lists';
        $data['categories']=$this->Category_model->get_categories();
             $this->load->view('templates/header');
     		 $this->load->view('categories/index',$data);
     		 $this->load->view('templates/footer');

	}

     public function create()
     {
        if(!$this->session->userdata('logged_in'))
        {
          redirect('User/login');
        }

     	$data['title']='Create Category';

     	$this->form_validation->set_rules('name','Name','required');

     	if ($this->form_validation->run()==FALSE) 
     	{
     		 $this->load->view('templates/header');
     		 $this->load->view('categories/create',$data);
     		 $this->load->view('templates/footer');
     	}
     	else
     	{
           $this->Category_model->create_category();
           redirect('Category/index');
     	}
     }

     public function posts($id)
     {
        if(!$this->session->userdata('logged_in'))
        {
          redirect('User/login');
        }
       $data['title']=$this->Category_model->get_category($id)['name'];

       $data['posts']=$this->Post_model->get_post_by_category($id);

             $this->load->view('templates/header');
     		 $this->load->view('posts/index',$data);
     		 $this->load->view('templates/footer');

     }



	 }