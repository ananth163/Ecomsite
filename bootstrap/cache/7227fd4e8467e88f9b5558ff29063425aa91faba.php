<?php $__env->startSection('title', 'Manage Inventory'); ?>

<?php $__env->startSection('pageid', 'adminProducts'); ?>

<?php $__env->startSection('content'); ?>
	<div class="products">
		<div class="grid-x ">
				<h2>Manage Inventory</h2>
				<hr />
		</div>
		<?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
			<div class="cell small-12 medium-4">
				<a href="/admin/products/create" class="button float-right">
					<i class="fas fa-plus"></i>
					Add Product
				</a>
			</div>
		</div>
		<div class="grid-x grid-padding-x">
			<?php if(count($products) == 0): ?>
				<h2>No Products available to display</h2>
			<?php else: ?>
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>Image</th>
      							<th>Name</th>
      							<th>Price</th>
      							<th>Stock</th>
      							<th>Category</th>
      							<th>Subcategory</th>
      							<th>Last Updated</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  								<tr>
  									<td><img src="/<?php echo e($product->image_path); ?>" alt="<?php echo e($product->name); ?>" height="30" width="30"></td>
  									<td><?php echo e($product->name); ?></td>
  									<td><?php echo e($product->price); ?></td>
  									<td><?php echo e($product->stock); ?></td>
  									<td>
  										<?php echo e(App\Models\Product::find($product->id)->category->name ?? null); ?>

  									</td>
  									<td>
  										<?php echo e(App\Models\Product::find($product->id)->subCategory->name ?? null); ?>

  									</td>
  									<td><?php echo e($product->updated_at->toFormattedDateString()); ?></td>
  									<td>
  										<a href="/admin/products/<?php echo e($product->id); ?>/edit">
  											<i class="fas fa-edit"></i>
  										</a>
  										<a data-open="deleteitem-<?php echo e($product->id); ?>">
  											<i class="fas fa-trash"></i>
  										</a>
  										<?php echo $__env->make('includes.deletemodal', ['id'   => $product->id, 
  																				'name' => $product->name,
  																				'item' => 'product'] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  									</td>
  								</tr>  								
  							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  						</tbody>					
					</table>
					<?php echo e($products->links('pagination.pagination', 
													['paginator' => $products])); ?>

				</div>
				
			<?php endif; ?>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/admin/products/inventory.blade.php ENDPATH**/ ?>