<div class="reveal reveal-delete" id="deleteitem-<?php echo e($id); ?>" data-reveal>
  <div class="heading text-center">
  	Are you sure you want to do that?
  </div> 
  <div class="notification callout"></div> 
  <div id="content">
        <p>Clicking yes will delete <?php echo e($name); ?>.<br>  Seriously, have you thought this through?</p>
 
        <a class="button success delete-category" id="<?php echo e($id); ?>" 
        data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>"><i class="fa fa-check-circle" aria-hidden="true">
        	
        </i>Yes, do it now!</a>
 
        <a class="button alert close" data-close aria-label="Close modal"><i class="fa fa-check-circle" aria-hidden="true"></i>No, I’m insane!</a>
    </div>
</div><?php /**PATH D:\Ecomsite\resources\views/admin/includes/deletemodal.blade.php ENDPATH**/ ?>