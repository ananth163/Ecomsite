<?php $__env->startSection('title', 'Order Summary'); ?>

<?php $__env->startSection('pageid', 'cart'); ?>

<?php $__env->startSection('content'); ?>

  <div class="order-summary" id="cart">
    <div class="grid-x grid-padding-x">
      <div class="cell">
        <h1>Shopping Cart</h1>

        <div class="shopping-cart">

          <div class="column-labels">
            <label class="product-image">Image</label>
            <label class="product-details">Product</label>
            <label class="product-price">Price</label>
            <label class="product-quantity">Quantity</label>
            <label class="product-removal">Remove</label>
            <label class="product-line-price">Total</label>
          </div>

          <?php if(count($products) == 0): ?>
            <h3 class="text-center">Your Shopping Cart is Empty</h3>
          <?php endif; ?>

          <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product">
              <div class="product-image">
                <img src="/<?php echo e($product->image_path); ?>" width="100" height="100">
              </div>
              <div class="product-details">
                <div class="product-title"><a href="/product/<?php echo e($product->id); ?>"><?php echo e($product->name); ?></a></div>
                <div class="product-description"><?php echo e((strlen($product->description) > 110) ? substr($product->description,0,110) . '...' : $product->description); ?></div>
                <?php if($product->stock > 0): ?>
                  <div class="product-description" style="color: green;">In Stock</div>
                <?php else: ?>
                  <div class="product-description" style="color: red;">Out of Stock</div>
                <?php endif; ?>
              </div>
              <div class="product-price"><?php echo e($product->price); ?></div>
              <div class="product-quantity">
                <input type="number" value="<?php echo e($product->quantity); ?>" min="1" max="<?php echo e($product->stock); ?>" data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" data-id="<?php echo e($product->id); ?>">
              </div>
              <div class="product-removal">
                <button class="remove-product" data-token="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" data-id="<?php echo e($product->id); ?>">
                  Remove
                </button>
              </div>
              <div class="product-line-price"><?php echo e(($product->price) * ($product->quantity)); ?></div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
          <?php if(count($products) > 0): ?>
            <div class="totals">
              <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal"><?php echo e(Cart()->getSubTotal()); ?></div>
              </div>
              <div class="totals-item">
                <label>Tax (5%)</label>
                <div class="totals-value" id="cart-tax"><?php echo e(Cart()->getTax()); ?></div>
              </div>
              <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping">15.00</div>
              </div>
              <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total"><?php echo e(Cart()->getFormattedAmount()); ?></div>
              </div>
            </div>
            <div class="text-right">
              <a href="/" class="button secondary"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Continue Shopping</a>
              <?php if(isAuthenticated()): ?>
                <a href="/cart/payment" class="button success"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;Checkout</a>
              <?php else: ?>
                <a href="/login" class="button success"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;Checkout</a>
              <?php endif; ?>
            </div>                     
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/orders/cart.blade.php ENDPATH**/ ?>