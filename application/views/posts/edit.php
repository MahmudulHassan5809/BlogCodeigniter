<h2><?php echo $title; ?></h2>
   
   <?php echo validation_errors(); ?>
  
  	<?php echo form_open_multipart("posts/update",['class'=>'form-horizontal']); ?>
  	<input type="hidden" name="id" value="<?php echo $postid->id; ?>">
  <fieldset>
    <legend><?php echo $title; ?></legend>
    <div class="form-group">
      <label for="title" class="col-lg-2 control-label">Title</label>
      <div class="col-lg-10">
        <input class="form-control" name="title" id="title" placeholder="Title" type="text" value="<?php echo $posts['title']; ?>">
      </div>
    </div>
  
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Content</label>
      <div class="col-lg-10">
        <textarea class="form-control" name="body" rows="3" id="editor1">
        	
        	<?php echo $posts['body']; ?>
        </textarea>
          
      </div>
    </div>

     <div class="form-group">
      <label for="catgeroty" class="col-lg-2 control-label">Category Select</label>
      <div class="col-lg-10">
         <select class="form-control" name="cat_id">
              <?php foreach ($categories as $value) { ?>
                
                 <option 
                  <?php 
                    if($posts['cat_id']=$value['id']){?>
                     selected="selected"
                   <?php }?>
                   value="<?php echo $value['id'] ;?>"><?php echo $value['name'] ;?></option>
              <?php } ?>
         </select>
        
      </div>
    </div>

     <div class="form-group">
      <label  class="col-lg-2 control-label">Upload Image</label>
      <div class="col-lg-10">
      	 	<img class="img-responsive" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $posts['postimage']; ?>">
        <input type="file" name="userfile" size="20">
      </div>
    </div>
   
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </fieldset>
 <?php echo form_close();  ?>