<?php  
 if (isset($posts)) { ?>
 

<h2><?php echo $posts['title']; ?></h2>
 <small style="background:#E1E1E1;display: block;">Posted On :<?php echo $posts['created_at'];?> in :<strong> <?php echo $posts['name']; ?></strong></small><br>
  	<img class="img-responsive" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $posts['postimage']; ?>">
<div class="post-body">
	<?php echo $posts['body'] ; ?>
</div>
<?php 
 if ($this->session->userdata('user_id')==$posts['user_id']) { ?>
    
    <hr>
 <a class="btn btn-info btn-sm pull-right" href="<?php echo base_url(); ?>Posts/edit/<?php echo $posts['slug']; ?>">Edit</a>

<?php echo form_open("Posts/delete/".$postid->id); ?>
  <input type="submit" name="submit" value="Delete" class="btn btn-danger btn-sm">
</form>

 <?php } ?>

<hr>
<h3>Comments</h3>
 <div class="well">
 <?php 
   if (isset($comments)) {
     foreach ($comments as $value) {  ?>
      
   <h5><?php echo $value['body']; ?>[ BY <strong><?php echo $value['name']; ?></strong>]</h5>
     
  <?php } }?>
</div>
<hr>
<h3>Add Comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open("Comment/create/".$posts['id']) ;?>
  <div class="form-group">
  	<label>Name</label>
  	 <input type="text" name="name" class="form-control">
  </div>

   <div class="form-group">
   	<label>Email</label>
  	 <input type="text" name="email" class="form-control">
  </div>

  <div class="form-group">
   	<label>Body</label>
  	 <textarea name="body" class="form-control"> 
  	 	
  	 </textarea>
  </div>
   <input type="hidden" name="slug" value="<?php echo $posts['slug'] ; ?>">
   <button type="submit" class="btn btn-primary btn-sm">Comment</button>
</form>

<?php 


  
 }else
 {
  redirect('Posts/index/');
 }
?>