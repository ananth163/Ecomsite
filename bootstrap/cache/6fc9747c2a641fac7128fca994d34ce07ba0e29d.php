  <div class="payment-fail" style="margin-top: 2rem;">
    <div class="grid-x grid-padding-x expanded align-center">
      <div class="cell small-12 medium-8">
        <div class="card">          
          <div class="card-section text-center">
            <i class="fas fa-exclamation-triangle fa-5x" style="color:red"></i>
            <h2>Transaction Failed</h2>
            <p>Reason: <?php echo e($message); ?></p>
            <p>Please <a href="/cart">Click here</a> to make the payment again</p>
          </div>
        </div>
      </div>
    </div>
  </div> <?php /**PATH D:\Ecomsite\resources\views/orders/fail.blade.php ENDPATH**/ ?>