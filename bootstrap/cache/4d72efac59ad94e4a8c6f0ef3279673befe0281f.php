<div class="grid-x grid-padding-x">
    <h3>Sub Categories</h3>
</div>
<div class="grid-x grid-padding-x">
  <?php if(count($subCategories) == 0): ?>
    <h4>No Sub Categories available to display</h4>
  <?php else: ?>
      <div class="cell small-12 medium-12">
          <table class="hover">
            <thead>
                <tr>
                    <th >Name</th>
                    <th >Slug</th>
                    <th >Category</th>
                    <th >Last Updated</th>
                    <th >Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div >
                  <tr id="subCategory-<?php echo e($subCategory->id); ?>">
                    <td id="subCategoryName-<?php echo e($subCategory->id); ?>"><?php echo e($subCategory->name); ?></td>
                    <td><?php echo e($subCategory->slug); ?></td>
                    <td >
                      <select name="category" id="subCategoryGroup-<?php echo e($subCategory->id); ?>"
                            data-category="<?php echo e($subCategory->category_id); ?>">
                        <?php $__currentLoopData = App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($category->id == $subCategory->category_id): ?>
                            <option value="<?php echo e($category->id); ?>" selected="selected"><?php echo e($category->name); ?></option>
                          <?php else: ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </td>
                    <td><?php echo e($subCategory->updated_at->toFormattedDateString()); ?></td>
                    <td>
                      <a class="update-subCategory" id="edit-<?php echo e($subCategory->id); ?>"><i class="fas fa-edit"></i></a>
                      <a class="delete-subCategory" id="delete-<?php echo e($subCategory->id); ?>"
                        data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" 
                        data-categoryid="<?php echo e($subCategory->category_id); ?>">
                        <i class="fas fa-trash"></i>
                      </a>
                      <a class="save" id="save-<?php echo e($subCategory->id); ?>"
                        data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>"><i class="fas fa-save"></i></a>
                    </td>
                  </tr>  
                  </div>               
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>          
          </table>
          <?php echo e($subCategories->links('pagination.categories',
                                     ['paginator' => $subCategories])); ?>

      </div>
  <?php endif; ?>
</div><?php /**PATH D:\Ecomsite\resources\views/admin/products/subcategories.blade.php ENDPATH**/ ?>