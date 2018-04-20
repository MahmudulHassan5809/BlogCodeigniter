<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function register()
    {
    	$data['title']='Sign Up';
    	$this->form_validation->set_rules('name','Name','required');
    	$this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_users.email]',array('is_unique' => 'This Email already exists in our records.'));
    	$this->form_validation->set_rules('password','Password','required');
    	$this->form_validation->set_rules('password2','Confirm Password','matches[password]');
    	
    	$this->form_validation->set_rules('username', 'User name', 'trim|min_length[3]|required|max_length[15]|is_unique[tbl_users.username]',array('is_unique' => 'This username already exists in our records.'));
    	
    	if($this->form_validation->run()==FALSE)
    	{
    		$this->load->view('templates/header');
    		$this->load->view('users/register',$data);
    		$this->load->view('templates/footer');
    	}
    	else
    	{
    	  $enc_password=md5($this->input->post('password'))	;
    	  $this->User_model->register($enc_password);
          $this->session->set_flashdata('user_regi','Yor Are Now Registered');
    	  redirect('Posts');
    	}

    }

    public function login()
    {    
    	 $data['title']='Log In';

    	$this->form_validation->set_rules('email','Email','required');
    	$this->form_validation->set_rules('password','Password','required');
    	

    	if($this->form_validation->run()==FALSE)
    	{
    		$this->load->view('templates/header');
    		$this->load->view('users/login',$data);
    		$this->load->view('templates/footer');
    	}
    	else
    	{
    	 $email=$this->input->post('email');	
    	 $password=md5($this->input->post('password'));
    	 

    	  $user_id=$this->User_model->login($email,$password);
    	  if ($user_id) {
    	  	  $user_data=array(
                 'user_id'=>$user_id,
                 'username'=>$username,
                 'logged_in'=>true

    	  	  ); 
    	  	  $this->session->set_userdata($user_data);

    	  	 $this->session->set_flashdata('user_loggedin','You Are Loged In');
    	  	 redirect('Posts');
    	  }
    	  else
    	  {
           $this->session->set_flashdata('login_failed','Login Failed');
    	   redirect('User/login');
        
    	  }
          
    	}
    }

    public function logout()
    {
    	$this->session->unset_userdata('logged_in');
    	$this->session->unset_userdata('user_id');
    	$this->session->unset_userdata('username');

    	$this->session->set_flashdata('user_logout','You are now logged out');
        redirect('User/login');
    }




}