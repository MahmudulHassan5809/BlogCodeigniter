<style type="text/css">
.post-thumb
 {
      width: 100%;
 }
 .pagnination-links
 {
  margin:30px 0;
 }
 .pagnination-links strong
 {
    padding: 8px 13px;
  margin: 5px;
  background:#f4f4f4;
  border: 1px solid gray;
 }
 a.pagnination-link
 {
  padding: 8px 13px;
  margin: 5px;
  background:#f4f4f4;
  border: 1px solid gray;
 }

</style>


<?php echo $title ;?>

<?php 
  if(isset($posts))
  {
   foreach ($posts as  $value) { ?>
  
   <h3><?php echo $value['title']; ?></h3>	
    
   <div class="row">
   	  <div class="col-md-3">
   	  	<img class="post-thumb thumbnil" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $value['postimage']; ?>">
   	  </div>

   	  <div class="col-md-9">
   	  	 <small style="background:#E1E1E1;display: block;">Posted On :<?php echo $value['created_at'];?> in :<strong> <?php echo $value['name']; ?></strong></small><br>

         <?php echo word_limiter($value['body'],100); ?>

         <p><a class="btn btn-info btn-sm" href="<?php echo site_url('/Posts/view/'.$value['slug']); ?>">Reade More</a></p>
   	  </div>
   </div> 

  
 

<?php } } else{ echo "No Data Found" ;}?>
 <div class="pagnination-links text-center">
<?php echo $this->pagination->create_links();  ?>

</div>