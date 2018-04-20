<h2><?php echo $title; ?></h2>

<ul class="list-group">
<?php 
 if (isset($categories)) {
 	foreach ($categories as $value) { ?>
 	 
 	 <li class="list-group-item"><a href="<?php echo site_url('Category/posts/'.$value['id']);?>"><?php echo $value['name'] ;?></a></li>	
 
   <?php } }?>	
</ul>