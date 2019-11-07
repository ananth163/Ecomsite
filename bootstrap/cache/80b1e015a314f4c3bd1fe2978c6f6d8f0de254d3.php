
  <td id="subCategoryName-<?php echo e($subCategory->id); ?>"><?php echo e($subCategory->name); ?></td>
  <td><?php echo e($subCategory->slug); ?></td>
  <td >
    <select name="category" id="subCategoryGroup-<?php echo e($subCategory->id); ?>"
        data-category="<?php echo e($subCategory->category_id); ?>"
        data-categoryId="<?php echo e($subCategory->category_id); ?>">
      <?php $__currentLoopData = App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($category->id == $subCategory->category_id): ?>
          <option value="<?php echo e($category->id); ?>" selected="selected"><?php echo e($category->name); ?></option>
        <?php endif; ?>
        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </td>
  <td><?php echo e($subCategory->updated_at->toFormattedDateString()); ?></td>
  <td>
    <a class="update-subCategory" id="edit-<?php echo e($subCategory->id); ?>"><i class="fas fa-edit"></i><a>
    <a id="delete-<?php echo e($subCategory->id); ?>"><i class="fas fa-trash"></i></a>
    <a class="save" id="save-<?php echo e($subCategory->id); ?>" 
      data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>"><i class="fas fa-save"></i></a>
  </td>
<?php /**PATH D:\Ecomsite\resources\views/admin/includes/updatedSubCategory.blade.php ENDPATH**/ ?>