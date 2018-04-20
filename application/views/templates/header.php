<!DOCTYPE html>
<html>
<head>
	<title>Ci BLog</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/flatly/bootstrap.min.css">
  <script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
</head>
   <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
     <a class="navbar-brand" href="#">Ci BLog</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="<?php echo base_url();?>about">About</a></li>
        <li><a href="<?php echo base_url();?>Posts/index">Blog</a></li>
         <li><a href="<?php echo base_url();?>Category/index">Categories</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
         <?php 
           if (!$this->session->userdata('logged_in')) { ?>
             
              <li><a href="<?php echo base_url(); ?>User/register">Register</a></li>
           <li><a href="<?php echo base_url(); ?>User/login">Login</a></li>

          <?php   }
            else {
          ?>
         <li><a href="<?php echo base_url(); ?>Posts/create">Create Post</a></li>
         <li><a href="<?php echo base_url(); ?>Category/create">Create Category</a></li>
         
           <li><a href="<?php echo base_url(); ?>User/logout">Log Out</a></li>

           <?php } ?>
      </ul>
     </div>
   </div>
   </nav>

   <div class="container">
   	
    <?php 
    if ($this->session->flashdata('user_regi')!=NULL) { 
         
      echo "<p class='alert alert-success'>".$this->session->flashdata('user_regi')."</p>";
    }

     if ($this->session->flashdata('login_failed')!=NULL) { 
         
      echo "<p class='alert alert-danger'>".$this->session->flashdata('login_failed')."</p>";
    }

    if ($this->session->flashdata('user_loggedin')!=NULL) { 
         
      echo "<p class='alert alert-success'>".$this->session->flashdata('user_loggedin')."</p>";
    }

    if ($this->session->flashdata('user_logout')!=NULL) { 
         
      echo "<p class='alert alert-success'>".$this->session->flashdata('user_logout')."</p>";
    }

    ?>
   


<body>

