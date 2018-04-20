<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	 public function index($offset=0)
     {
        if(!$this->session->userdata('logged_in'))
        {
          redirect('User/login');
        }


        $config['base_url'] = base_url().'Posts/index/';
        $config['total_rows'] = $this->db->count_all('posts');
        $config['per_page'] = 3;
        $config['uri_segment']=3;
        $config['attributes'] = array('class' => 'pagnination-link');

        $this->pagination->initialize($config);

          



        $data['title'] = 'Latest Post'; 
         
        $data['posts']=$this->Post_model->get_posts(FALSE,$config['per_page'],$offset);        
 
        $this->load->view('templates/header');
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
      }

      public function view($slug=NULL)
      {

        $data['posts']=$this->Post_model->get_posts($slug);
        $data['postid'] = $this->Post_model->get_post_by_id($slug);
        $post_id=$data['posts']['id'];
        $data['comments']=$this->Comment_model->get_comment($post_id);
        if (empty($data['posts'])) {
             show_404();
         } 
        $data['title'] = $data['posts']['title'];
        $this->load->view('templates/header');
        $this->load->view('posts/view', $data);
        $this->load->view('templates/footer');  

      }

      public function create()

      {
         if(!$this->session->userdata('logged_in'))
        {
          redirect('User/login');
        }

        $data['title'] = 'Create Post';

        $data['categories']=$this->Post_model->get_cat();
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('body','Body','required');
        
        if ($this->form_validation->run()===FALSE) {
            $this->load->view('templates/header');
           $this->load->view('posts/create', $data);
           $this->load->view('templates/footer'); 
        }
        else
        {
            $config['upload_path']='./assets/images/posts';
            $config['allowed_types']='gif|jpg|png';
            $config['max_size']='2048';
            $config['max_width']='2000';
            $config['max_height']='2000';
            //$config['encrypt_name'] = TRUE;

            $this->load->library('upload',$config);
            if (!$this->upload->do_upload('userfile')) {
                 $errors=array('error'=>$this->upload->display_errors());
                 $post_image='noimage.jpg';
            }
            else
            {
                $data=array('upload_data'=>$this->upload->data());
                $post_image=$_FILES['userfile']['name'];
            }
            $this->Post_model->create_post($post_image);
            redirect('posts/index');
        }

      }

      public function delete($id=NULL)
      {
        if(!$this->session->userdata('logged_in'))
        {
          redirect('User/login');
        }
        $result=$this->Post_model->delete_post($id);
        if ($result==true) {
            redirect('posts/index');
        }
      }

      public function edit($slug=NULL)
      {
        if(!$this->session->userdata('logged_in'))
        {
          redirect('User/login');
        }
        $data['categories']=$this->Post_model->get_cat();
        $data['posts']=$this->Post_model->get_posts($slug);
        if ($this->session->userdata('user_id')!=$this->Post_model->get_posts($slug)['user_id']) {
           redirect('Posts');
        }
        $data['postid'] = $this->Post_model->get_post_by_id($slug);
        if (empty($data['posts'])) {
             show_404();
         } 
        $data['title'] = "Edit Post";
        $this->load->view('templates/header');
        $this->load->view('posts/edit', $data);
        $this->load->view('templates/footer');  

      }

      public function update()
      {
           if(!$this->session->userdata('logged_in'))
        {
          redirect('User/login');
        }
        
            $config['upload_path']='./assets/images/posts/';
            $config['allowed_types']='gif|jpg|png';
            $config['max_size']='2048';
            $config['max_width']='2000';
            $config['max_height']='2000';
            //$config['encrypt_name'] = TRUE;

            $this->load->library('upload',$config);
            if (!$this->upload->do_upload('userfile')) {
                 $errors=array('error'=>$this->upload->display_errors());
                 $result=$this->Post_model->update_post();
            }
            else
            {
                $data=array('upload_data'=>$this->upload->data());
                $post_image=$_FILES['userfile']['name'];
                $result=$this->Post_model->update_post($post_image);
            }
          
            
            if($result==true)
            {
            redirect('Posts');
            }
      }
}
