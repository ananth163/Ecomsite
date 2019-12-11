<?php $__env->startSection('title', 'Create Product'); ?>

<?php $__env->startSection('pageid', 'adminProducts'); ?>

<?php $__env->startSection('content'); ?>
	<div class="product admin_shared">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell medium-11">
					<h2>Add Inventory Item</h2> <hr />
				</div>
			</div>					
			<?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<form enctype="multipart/form-data" method="post" action="/admin/products/create">
					<div class="grid-x grid-padding-x">
						<div class="cell small-12 medium-6">
			        		<label for="name">Product Name
			          			<input type="text" name="name" placeholder="Product Name" 
			          					value="<?php echo e(App\Classes\Request::input('name')); ?>">
			        		</label>
						</div>
						<div class="cell small-12 medium-4">
			        		<label for="price">Product Price
			          			<input type="text" name="price" placeholder="Product Price" 
			          					value="<?php echo e(App\Classes\Request::input('price')); ?>">
			        		</label>
						</div>
					</div>
					<div class="grid-x grid-padding-x">
						<div class="cell small-12 medium-6">
			        		<label for="category">Product Category
			          			<select name="category" id="product-category">
			          				<option value="">
			          					Select Category</option>
			          				<?php $__currentLoopData = App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			          					<option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
			          				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			          			</select>			          			
			        		</label>
						</div>
						<div class="cell small-12 medium-4">
			        		<label for="name">Product Subcategory
			          			<select name="subcategory" id="product-subcategory">
			          				<option value="">
			          					Select Subcategory
			          				</option>
			          			</select>
			        		</label>
						</div>
					</div>
					<div class="grid-x grid-padding-x">
						<div class="cell small-12 medium-6">
			        		<label for="stock">Product Stock
			          			<select name="stock">
			          				<option value="<?php echo e(App\Classes\Request::input('stock')); ?>">
			          					<?php echo e(App\Classes\Request::input('stock')??'Select Stock'); ?>

			          				</option>
			          				<?php for($i=1; $i <= 50; $i++): ?>
			          					<option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
			          				<?php endfor; ?>
			          			</select>			          			
			        		</label>
						</div>
						<div class="cell small-12 medium-5">
							<br />
			        		<div class="input-group">
			        			<span class="input-group-label">
			        				Product Image
			        			</span>
			        			<input type="file" name="productImage" class="input-group-field">
			        		</div>
						</div>
					</div>
					<div class="grid-x grid-padding-x">
						<div class="cell small-12 medium-10">
			        		<label>Description
			          			<textarea name="description" placeholder="Description"><?php echo e(App\Classes\Request::input('description')); ?></textarea>          			
			        		</label>
			        		<input type="hidden" name="token" value="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>">
			        		<button class="button alert" type="reset">Reset</button>
			        		<input class="button success float-right" type="submit" name="submit"
			        		 value="Save Product">
						</div>						
					</div>
			</form>		
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/admin/products/create.blade.php ENDPATH**/ ?>