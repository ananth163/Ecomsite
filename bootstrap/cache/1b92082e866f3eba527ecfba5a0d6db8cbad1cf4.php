<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo e(getenv('APP_NAME')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" type="text/css" href="/css/all.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">  
</head>
<body data-pageid="<?php echo $__env->yieldContent('pageid'); ?>">
  
  <!-- Navigation -->
    <?php echo $__env->make('includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
  <!-- Sitewrapper -->
  <div class="site-wrapper">
    <?php echo $__env->yieldContent('content'); ?>
  </div>

  <!-- Footer -->
  <?php echo $__env->yieldContent('footer'); ?>

  
  <script type="text/javascript" src="/js/all.js" async></script>
</body>
</html><?php /**PATH D:\Ecomsite\resources\views/layouts/base.blade.php ENDPATH**/ ?>