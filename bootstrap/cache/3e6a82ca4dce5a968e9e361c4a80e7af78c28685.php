<div class="grid-x grid-margin-x">
	<?php if(isset($errors)): ?>	
	<div class="cell small-5 large-offset-2">
		<div class="callout small alert" data-closable>
			<h5>Important!</h5>
			<?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<p><?php echo e($error); ?></p>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    			<span aria-hidden="true">&times;</span>
  			</button>				
		</div>	
	</div>		
	<?php endif; ?>
	<?php if(isset($success)): ?>
	<div class="cell small-5 large-offset-2">
		<div class="callout small success" data-closable="slide-out-right">
			<h5>Success!</h5>
			<p><?php echo e($success); ?></p>
			<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    			<span aria-hidden="true">&times;</span>
  			</button>				
		</div>
	</div>
	<?php endif; ?>
</div><?php /**PATH D:\Ecomsite\resources\views/admin/includes/messages.blade.php ENDPATH**/ ?>