<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

	<h1>Dashboard</h1>
	<?php echo App\Classes\CSRFHandler::getToken(); ?>

	<br>
	
	<?php echo $_SESSION['token']; ?>

	<?php if(App\Classes\CSRFHandler::validateToken('abc')): ?>
	<h1>Validation success</h1>
	<?php else: ?>
	<h1>Validation Failed</h1>
	<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>