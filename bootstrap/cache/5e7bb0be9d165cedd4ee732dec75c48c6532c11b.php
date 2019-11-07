<?php $__currentLoopData = $subCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<h1><?php echo e($sub->name); ?></h1>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php echo e(App\Models\Category::find(26)->subcategories()->paginate(3)->links('pagination.categories',
                                          ['paginator' => App\Models\Category::find(26)->subcategories()->paginate(3)
                                                                    ])); ?><?php /**PATH D:\Ecomsite\resources\views/demo.blade.php ENDPATH**/ ?>