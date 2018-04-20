<h2 style="text-align: center;"><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>


<?php  echo form_open('User/login') ; ?>
  <div style="width:400px;margin: 0 auto; ">
   
    <div class="form-group">
  	 <label>Email</label>
  	 <input type="email" name="email" class="form-control">
    </div>

   <div class="form-group">
  	 <label>Password</label>
  	 <input type="password" name="password" class="form-control">
   </div>
   
  
  <button type="submit" class="btnh btn-info btn-sm btn-block">Submit</button>
  </div>
<?php form_close(); ?>