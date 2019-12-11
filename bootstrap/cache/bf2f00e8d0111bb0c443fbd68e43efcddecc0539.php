<?php $__env->startSection('title', 'Manage Users'); ?>

<?php $__env->startSection('pageid', 'adminUsers'); ?>

<?php $__env->startSection('content'); ?>
	<div class="users admin_shared">
		<div class="grid-x ">
				<h2>Manage Users</h2>
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
			<?php if(count($users) == 0): ?>
				<h2>No users available to display</h2>
			<?php else: ?>
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>User ID</th>
      							<th>Username</th>
      							<th>Full Name</th>
                    <th>Email</th>
      							<th>Address</th>
      							<th>Role</th>
      							<th>Added</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  								<tr>
  									<td><?php echo e($user->id); ?></td>
  									<td><?php echo e($user->username); ?></td>
  									<td><?php echo e($user->fullname); ?></td>
  									<td><?php echo e($user->email); ?></td>
  									<td><?php echo e($user->address); ?></td>
  									<td><?php echo e($user->role); ?></td>
                    <td><?php echo e($user->created_at->toFormattedDateString()); ?></td>
  									<td>  										
  										<a data-open="deleteitem-<?php echo e($user->userNumber); ?>">
  											<i class="fas fa-trash"></i>
  										</a>
  										<?php echo $__env->make('includes.deletemodal', ['id'   => $user->id, 
  																				'name' => $user->username,
  																				'item' => 'user'] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  									</td>
  								</tr>  								
  							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  						</tbody>					
					</table>
					<?php echo e($users->links('pagination.pagination', 
													['paginator' => $users])); ?>

				</div>
				
			<?php endif; ?>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/admin/users.blade.php ENDPATH**/ ?>