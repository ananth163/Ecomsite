<!-- Update Category -->
<div class="reveal reveal-update" id="updateitem-<?php echo e($category->id); ?>" data-reveal data-close-on-click="false"
													data-close-on-esc="false">
  <div class="notification callout"></div>
  <div class="updateCategory">
  <h3>Update Category</h3>
  		<form action="/admin/products/categories/<?php echo e($category->id); ?>/edit" method="post">
  			<div class="input-group">
  				<input type="text" id="updateitem-name-<?php echo e($category->id); ?>" name="name" value="<?php echo e($category->name); ?>">
  				<div>
  					<input type="submit" class="button update-category" 
  					data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" id="<?php echo e($category->id); ?>" value="Update">
  				</div>
  			</div>
		  </form>
    </div>
    <div class="createSubCategory">
      <h3>Create Subcategory</h3>
      <form action="/admin/products/subcategories/<?php echo e($category->id); ?>/create" method="post">
        <div class="input-group">
          <input type="text" id="create-<?php echo e($category->id); ?>" name="name" >
          <div>
            <input type="submit" class="button create-subcategory" 
            data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" id="<?php echo e($category->id); ?>" value="Create">
          </div>
        </div>
    </form>
    </div>
    <div class="reveal-subCategories" id="category-<?php echo e($category->id); ?>">
 
    </div>
  <a href="/admin/products/categories " class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </a>
</div><?php /**PATH D:\Ecomsite\resources\views/admin/includes/updatemodal.blade.php ENDPATH**/ ?>