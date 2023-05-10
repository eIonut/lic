
<?php include('app_logic.php'); ?>
<?php  if (count($errors) > 0) : ?>
  <div class="msg w-100 d-flex justify-content-start align-items-center">
  	<?php foreach ($errors as $error) : ?>
  	  <span class="p-1 mb-2 bg-danger text-light" style="border-radius: 2px;"><?php echo $error ?></span>
  	<?php endforeach ?>
  </div>
<?php  endif ?>