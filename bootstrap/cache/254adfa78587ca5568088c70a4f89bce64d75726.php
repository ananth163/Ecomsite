<?php $__env->startSection('title', 'Manage Payments'); ?>

<?php $__env->startSection('pageid', 'adminPayments'); ?>

<?php $__env->startSection('content'); ?>
	<div class="payments admin_shared">
		<div class="grid-x ">
				<h2>Manage Payments</h2>
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
			<?php if(count($payments) == 0): ?>
				<h2>No Payments available to display</h2>
			<?php else: ?>
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>Customer</th>
      							<th>Payment ID</th>
      							<th>Amount</th>
      							<th>Status</th>
      							<th>Added</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							<?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  								<tr>
  									<td><?php echo e($payment->user->username); ?></td>
  									<td><?php echo e(substr($payment->client_secret,3,24)); ?></td>
  									<td>
  										₹<?php echo e($payment->amount/100); ?>

  									</td>
  									<td>
  										<?php echo e($payment->status); ?>

  									</td>
  									<td><?php echo e($payment->updated_at->toFormattedDateString()); ?></td>
  									<td>  										
  										<a data-open="deleteitem-<?php echo e($payment->id); ?>">
  											<i class="fas fa-trash"></i>
  										</a>
  										<?php echo $__env->make('includes.deletemodal', ['id'   => $payment->id, 
  																				'name' => $payment->name,
  																				'item' => 'payment'] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  									</td>
  								</tr>  								
  							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  						</tbody>					
					</table>
					<?php echo e($payments->links('pagination.pagination', 
													['paginator' => $payments])); ?>

				</div>
				
			<?php endif; ?>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/admin/payments.blade.php ENDPATH**/ ?>