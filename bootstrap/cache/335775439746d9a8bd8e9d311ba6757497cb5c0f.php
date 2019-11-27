<?php
	$categories = App\Models\Category::with('subcategories')->get();
?>
<header class="navigation">
	<div class="show-for-small-only">
		<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
			<button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
			<div class="title-bar-title">Menu</div>
		</div>
		<div id="responsive-menu">
			<ul class="drilldown vertical menu" data-drilldown data-auto-height="true" data-animate-height="true">
      			<li>
      				<a href="/"><?php echo e(getenv('APP_NAME')); ?></a>
      			</li>
      			<li><a href="#0">Products</a></li>
      			<li class="has-submenu">
        			<a href="#0">Categories</a>
        			<ul class="submenu menu vertical" data-submenu>
        				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        					<li>
        						<a href="#0"><?php echo e($category->name); ?></a>
        						<ul class="submenu menu vertical" data-submenu>
        						<?php if(count($category->subcategories)): ?>
        							<?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        								<li><a href="#0"><?php echo e($subcategory->name); ?></a></li>
        							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        						<?php endif; ?>
        						</ul>
        					</li>
        				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        			</ul>
      			</li>
      			<li><a href="#">SignIn</a></li>
      			<li><a href="#">Register</a></li>
      			<li><a href="#">Cart</a></li>      			
    		</ul>
		</div>
	</div>

	<div class="show-for-medium">
		<div class="top-bar" id="main-menu">
  			<div class="top-bar-left">
    			<ul class="dropdown menu" data-dropdown-menu>
      				<li>
      					<a href="/"><?php echo e(getenv('APP_NAME')); ?></a>
      				</li>
      				<li><a href="#0">Products</a></li>
      				<li class="has-submenu">
        				<a href="#0">Categories</a>
        				<ul class="submenu menu vertical" data-submenu>
        					<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        						<li>
        							<a href="#0"><?php echo e($category->name); ?></a>
        							<ul class="submenu menu vertical" data-submenu>
        							<?php if(count($category->subcategories)): ?>
        								<?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        									<li><a href="#0"><?php echo e($subcategory->name); ?></a></li>
        								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        							<?php endif; ?>
        							</ul>
        						</li>
        					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        				</ul>
      				</li>      			
    			</ul>
  			</div>
  			<div class="top-bar-right">
    			<ul class="dropdown menu" data-dropdown-menu>
      				<li class="menu-text">Username</li>
      				<li><a href="#">SignIn</a></li>
      				<li><a href="#">Register</a></li>
      				<li><a href="#">Cart</a></li>
    			</ul>
  			</div>
		</div>
	</div>
</header><?php /**PATH D:\Ecomsite\resources\views/includes/nav.blade.php ENDPATH**/ ?>