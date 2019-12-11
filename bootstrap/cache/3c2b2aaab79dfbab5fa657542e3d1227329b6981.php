<?php $__env->startSection('title', 'Order History'); ?>

<?php $__env->startSection('pageid', 'orders'); ?>

<?php $__env->startSection('content'); ?>

  <div class="order-summary" id="cart">
    <div class="grid-x grid-padding-x">
      <div class="cell">
        <h1>Order History</h1>
        <div class="shopping-cart">
          <div class="orders-history">
            <div class="grid-x grid-padding-x expanded">
              <div class="cell small-12 medium-10">
                <?php if(count($orders) > 0): ?>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="order">                  
                    <div class="grid-x">
                    <div class="cell small-8" style="border: 1px solid #e6e6e6;">
                      <div class="grid-x">
                        <div class="cell small-8">
                          <h6 style="margin-left: 0.8rem;">Order#<?php echo e($order->orderNumber); ?></h6>                          
                        </div>
                        <div class="cell small-2">
                          <h10><?php echo e($order->status); ?></h10>
                        </div>
                      </div>
                      <hr /> 
                      <div class="grid-x">
                        <div class="cell small-8" style="border: 1px solid #e6e6e6;">
                          <div class="grid-x grid-margin-x small-up-2 medium-offest-1">
                            <div class="cell">
                              <img src="/<?php echo e($order->products[0]->image_path); ?>" width="50" height="50">
                              <?php if(count($order->products) > 1): ?>
                                <img src="/<?php echo e($order->products[1]->image_path); ?>" width="50" height="50">
                              <?php endif; ?>
                            </div>                            
                          </div>
                        </div>
                        <div class="cell small-4 text-center">
                          <h6>Order Placed: <?php echo e($order->placedAt); ?></h6>
                          <hr />
                          <h6>Order Total: <?php echo e($order->amount); ?></h6>
                        </div>
                      </div>                     
                    </div>
                    <div class="cell small-4" style="margin-top: 0.8rem;">
                      <div class="grid-x align-center">
                        <div class="cell">
                          <div class="stacked button-group">
                            <a href="/orders/<?php echo e($order->orderNumber); ?>" class="button">View order details</a>
                            <a class="button alert">Get Invoice</a>
                          </div>                           
                        </div>                           
                      </div>                                      
                    </div>
                    </div>                  
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                  <h2>No Orders Available to Display</h2>
                <?php endif; ?>                 
              </div>
            </div>
          </div>                      
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/orders/all.blade.php ENDPATH**/ ?>