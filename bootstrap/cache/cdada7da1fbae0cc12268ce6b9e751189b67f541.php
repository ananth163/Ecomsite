<?php $__env->startSection('title', 'Homepage'); ?>

<?php $__env->startSection('pageid', 'homepage'); ?>

<?php $__env->startSection('content'); ?>
	<div class="home">
			<div class="grid-x">
				<div class="cell">
					<section class="hero">
						<div class="hero-slider">
							<div><img src="/images/sliders/slide_1.jpg" alt="<?php echo e(getenv('APP_NAME')); ?>"></div>
							<div><img src="/images/sliders/slide_2.jpg" alt="<?php echo e(getenv('APP_NAME')); ?>"></div>
							<div><img src="/images/sliders/slide_3.jpg" alt="<?php echo e(getenv('APP_NAME')); ?>"></div>
						</div>
					</section> 
				</div>
			</div>
			<div class="grid-x">
				<div class="cell">
					<section class="display-products" data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" id="products">
						<h2>Featured Products</h2>
						<div class="grid-x grid-padding-x small-up-2 medium-up-4" data-equalizer>
							<div class="cell" v-cloak v-for="feature in featured">
								<a :href="'/product/' + feature.id">
									<div class="card" data-equalizer-watch>
										<img v-bind:src="'/' + feature.image_path" width="100%" >
										<div class="card-section">
											<p class="text-center">{{stringLimit(feature.name, 18)}}</p>
											<p class="text-center">{{feature.price}}$</p>
											<a @click.prevent="addToCart(feature.id)" class="button expanded">Add to Cart</a>
										</div>
									</div>
								</a>
							</div>							
						</div>
						<h2>Product Picks</h2>
						<div class="grid-x grid-padding-x small-up-2 medium-up-4" data-equalizer>
							<div class="cell" v-cloak v-for="product in products">
								<a href="'/product/' + product.id">
									<div class="card" data-equalizer-watch>
										<img v-bind:src="'/' + product.image_path" width="100%" >
										<div class="card-section">
											<p class="text-center">{{stringLimit(product.name, 18)}}</p>
											<p class="text-center">{{product.price}}$</p>
											<a @click.prevent="addToCart(product.id)" class="button expanded">Add to Cart</a>
										</div>
									</div>
								</a>
							</div>
						</div>
						<div class="text-center">
							<i v-show="loading" class="fa fa-spinner fa-spin loading"></i>
						</div>
					</section>					
				</div>
			</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/home.blade.php ENDPATH**/ ?>