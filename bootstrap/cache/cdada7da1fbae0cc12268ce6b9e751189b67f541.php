<?php $__env->startSection('title', 'Homepage'); ?>

<?php $__env->startSection('pageid', 'homepage'); ?>

<?php $__env->startSection('content'); ?>
	<div class="home">
			<div class="grid-x">
				<div class="cell">
					<section class="hero">
						<div class="hero-slider">
							<div><img src="/images/sliders/slide_1.jpg" alt="<?php echo e(getenv('APP_NAME')); ?>"></div>
							<div><img src="/images/sliders/slide_2.jpg" alt="<?php echo e(getenv('APP_NAME')); ?>"></div>
							<div><img src="/images/sliders/slide_3.jpg" alt="<?php echo e(getenv('APP_NAME')); ?>"></div>
						</div>
					</section> 
				</div>
			</div>
			<div class="grid-x">
				<div class="cell">
					<section>
						<div id="featured">
							
						</div>
					</section>
				</div>
			</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/home.blade.php ENDPATH**/ ?>