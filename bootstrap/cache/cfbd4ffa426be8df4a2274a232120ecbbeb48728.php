<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
	<div class="category">
		<div class="grid-x">
			<h3>Product Categories</h3>
		</div>
		<?php echo $__env->make('admin.includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-6">
				<form action="" method="post">
			        <div class="input-group">
			          <input type="text" class="input-group-field" placeholder="Search by Name">
		          	  <div class="input-group-button">
			          	<input type="submit" class="button" value="Search">
		          	  </div>
			        </div>
				</form>
			</div>
			<div class="cell small-12 medium-5">
				<form action="/admin/products/categories" method="post">
			        <div class="input-group">
			          <input type="text" class="input-group-field" name="name" placeholder="Category Name">
			          <input type="hidden" name="token" value="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>">
		          	  <div class="input-group-button">
			          	<input type="submit" class="button" value="Create">
		          	  </div>
			        </div>
				</form>
			</div>
		</div>
		<div class="grid-x grid-padding-x">
			<?php if(count($categories) == 0): ?>
				<h3>No Categories available to display</h3>
			<?php else: ?>
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th width="250">Category Name</th>
      							<th width="250">Category Slug</th>
      							<th width="150">Created at</th>
      							<th width="150">Updated at</th>
      							<th>Update</th>
    						</tr>
  						</thead>
  						<tbody>
  							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  								<tr>
  									<td><?php echo e($category->name); ?></td>
  									<td><?php echo e($category->slug); ?></td>
  									<td><?php echo e($category->created_at->toFormattedDateString()); ?></td>
  									<td><?php echo e($category->updated_at->toFormattedDateString()); ?></td>
  									<td><a href="#"><i class="fas fa-edit"></i></a>
  										<a href="#"><i class="fas fa-trash"></i></a></td>
  								</tr>
  							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  						</tbody>					
					</table>
					<?php echo e($categories->links('pagination.categories', ['paginator' => $categories])); ?>

				</div>
			<?php endif; ?>
		</div>
		

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/admin/products/categories.blade.php ENDPATH**/ ?>