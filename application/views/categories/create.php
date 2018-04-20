<h2>
	<?php echo $title; ?>
</h2>
<?php  echo validation_errors();  ?>
 
<?php echo form_open_multipart('Category/create'); ?>
     <fieldset>
     <div class="form-group">
      <label class="col-lg-2 control-label">Name</label>
      <div class="col-lg-10">
        <input class="form-control" name="name" id="name" placeholder="Catrgory Name" type="text">
      </div>
    </div>

   <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
 </fieldset>

<?php echo form_close();  ?>
