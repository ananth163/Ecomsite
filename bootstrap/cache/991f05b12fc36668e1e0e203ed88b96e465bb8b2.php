<!-- Update Category -->
<div class="reveal reveal-update" id="item-<?php echo e($category->id); ?>" data-reveal data-close-on-click="false"
													data-close-on-esc="false">
  <div class="notification callout"></div>
  <h3>Update Category</h3>
  		<form action="/admin/products/categories/<?php echo e($category->id); ?>/edit" method="post">
  			<div class="input-group">
  				<input type="text" id="item-name-<?php echo e($category->id); ?>" name="name" value="<?php echo e($category->name); ?>">
  				<div>
  					<input type="submit" class="button update-category" 
  					data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" id="<?php echo e($category->id); ?>" value="Update">
  				</div>
  			</div>
		</form>
  <a href="/admin/products/categories " class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </a>
</div><?php /**PATH D:\Ecomsite\resources\views/admin/includes/modal.blade.php ENDPATH**/ ?>