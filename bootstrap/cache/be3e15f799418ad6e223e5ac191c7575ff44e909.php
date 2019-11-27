<!DOCTYPE html>
<html>
<head>
	<title>Admin - <?php echo $__env->yieldContent('title'); ?></title>
	<link rel="stylesheet" type="text/css" href="/css/all.css">
	<!-- Font Awesome CDN -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>
<body data-pageid="<?php echo $__env->yieldContent('pageid'); ?>">
  
  <!-- Sidebar -->
  <?php echo $__env->make('includes.admin-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="off-canvas-content admin_title_bar" data-off-canvas-content>
    <!-- Your page content lives here -->
    <div class="title-bar">
  		<div class="title-bar-left">
    		<button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
    		<span class="title-bar-title"><?php echo e(getenv('APP_NAME')); ?></span>
  		</div>
  	</div>

    <?php echo $__env->yieldContent('content'); ?>
    
  </div>

<script type="text/javascript" src="/js/all.js" async></script>
</body>
</html><?php /**PATH D:\Ecomsite\resources\views/admin/layout/base.blade.php ENDPATH**/ ?>