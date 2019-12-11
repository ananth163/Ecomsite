<?php $__env->startSection('title', 'Manage Orders'); ?>

<?php $__env->startSection('pageid', 'adminOrders'); ?>

<?php $__env->startSection('content'); ?>
	<div class="orders admin_shared">
		<div class="grid-x ">
				<h2>Manage Orders</h2>
				<hr />
		</div>
		<?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-6">
				<form action="" method="post">
			        <div class="input-group">
			          <input type="text" class="input-group-field" placeholder="Search by ID">
		          	  <div class="input-group-button">
			          	<input type="submit" class="button" value="Search">
		          	  </div>
			        </div>
				</form>
			</div>			
		</div>
		<div class="grid-x grid-padding-x">
			<?php if(count($orders) == 0): ?>
				<h2>No Orders available to display</h2>
			<?php else: ?>
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>Customer</th>
      							<th>Order No.</th>
      							<th># of Items</th>
      							<th>Amount</th>
      							<th>Status</th>
      							<th>Added</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  								<tr>
  									<td><?php echo e($order->username); ?></td>
  									<td><?php echo e($order->orderNumber); ?></td>
  									<td><?php echo e(count($order->products)); ?></td>
  									<td>
  										₹<?php echo e($order->amount); ?>

  									</td>
  									<td>
  										<?php echo e($order->status); ?>

  									</td>
  									<td><?php echo e($order->placedAt); ?></td>
  									<td>  
  										<a href="/admin/orders/<?php echo e($order->orderNumber); ?>"><i class="fas fa-edit"></i></a>										
  										<a data-open="deleteitem-<?php echo e($order->orderNumber); ?>">
  											<i class="fas fa-trash"></i>
  										</a>
  										<?php echo $__env->make('includes.deletemodal', ['id'   => $order->orderNumber, 
  																				'name' => $order->orderNumber,
  																				'item' => 'order'] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  									</td>
  								</tr>  								
  							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  						</tbody>					
					</table>
					<?php echo e($orders->links('pagination.pagination', 
													['paginator' => $orders])); ?>

				</div>
				
			<?php endif; ?>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/admin/orders.blade.php ENDPATH**/ ?>