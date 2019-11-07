<!-- Update Category -->
<div class="reveal reveal-update" id="updateitem-<?php echo e($subCategory->id); ?>" data-reveal data-close-on-click="false"
													data-close-on-esc="false">
  <div class="notification callout"></div>
  <h3>Update Sub Category</h3>
  		<form action="/admin/products/subcategories/<?php echo e($subCategory->id); ?>/edit" method="post">
  			<div class="row">
  				<input type="text" id="updateitem-name-<?php echo e($subCategory->id); ?>" name="name" value="<?php echo e($subCategory->name); ?>">
          <div class="row">
            <label>Move this to
              <select name="category" id="updateitem-category-<?php echo e($subCategory->id); ?>" 
                          value="<?php echo e($subCategory->category_id); ?>">
                <?php $__currentLoopData = App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($category->id == $subCategory->category_id): ?>
                    <option value="<?php echo e($category->id); ?>" selected="selected"><?php echo e($category->name); ?></option>
                  <?php endif; ?>
                  <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>                     
            </label>
          </div>
  				<div class="row text-center">
  					<input type="submit" class="button update-category" 
  					data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" id="<?php echo e($subCategory->id); ?>" value="Update">
  				</div>
  			</div>
		</form>
  <a href="/admin/products/categories " class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </a>
</div><?php /**PATH D:\Ecomsite\resources\views/admin/includes/updatesubCategory.blade.php ENDPATH**/ ?>