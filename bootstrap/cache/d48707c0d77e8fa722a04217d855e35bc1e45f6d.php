<?php if($paginator->hasPages()): ?>
<nav aria-label="Pagination">
    <ul class="pagination text-center" role="navigation" aria-label="Pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="pagination-previous disabled">Previous</li>
        <?php else: ?>
            <li class="pagination-previous">
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" aria-label="Previous page">Previous</a>
            </li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="disabled"><span><?php echo e($element); ?></span></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="current"><span class="show-for-sr"><?php echo e($page); ?></span><?php echo e($page); ?></li>
                    <?php else: ?>
                        <li><a href="<?php echo e($url); ?>">
                        <?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        
        <?php if($paginator->hasMorePages()): ?>
            <li class="pagination-next"><a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="Next page">Next</a></li>
        <?php else: ?>
            <li class="pagination-next disabled"><span>Next</span></li>
        <?php endif; ?>
    </ul>
</nav>
<?php else: ?>
<?php endif; ?><?php /**PATH D:\Ecomsite\resources\views/pagination/pagination.blade.php ENDPATH**/ ?>