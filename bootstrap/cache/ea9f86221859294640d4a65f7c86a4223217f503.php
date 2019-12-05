<?php $__env->startSection('title', 'Sign Up'); ?>

<?php $__env->startSection('pageid', 'register'); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="login-box">
  		<div class="grid-x grid-padding-x expanded text-center">
  		  <div class="cell small-12 medium-6 small-order-2 medium-order-1">
  		    <div class="login-box-form-section">
  		      <h1 class="login-box-title">Sign up</h1>
  		      <form action="/sign-up" method="post">
  		      	<input class="login-box-input" type="text" name="username" placeholder="Username" value="<?php echo e(App\Classes\Request::input('username')); ?>" />
  		      	<input class="login-box-input" type="email" name="email" placeholder="E-mail" value="<?php echo e(App\Classes\Request::input('email')); ?>" />
  		      	<input class="login-box-input" type="password" name="password" placeholder="Password" />
  		      	<input class="login-box-input" type="password" name="password2" placeholder="Retype password" />
  		      	<input type="hidden" name="token" value="<?php echo e(App\Classes\CSRFHandler::getToken()); ?>" />
  		      	<input class="login-box-submit-button" type="submit" name="signup_submit" value="Sign me up" />
  		      </form>
  		    </div>
  		    <div class="or">OR</div>
  		  </div>
  		  <div class="cell small-12 medium-6 small-order-1 medium-order-2 login-box-social-section">
  		    <div class="login-box-social-section-inner">
  		      <span class="login-box-social-headline">Sign in with<br />your social network</span>
  		      <a class="login-box-social-button-facebook">Log in with facebook</a>
  		      <a class="login-box-social-button-twitter">Log in with Twitter</a>
  		      <a class="login-box-social-button-google">Log in with Google+</a>
  		    </div>
  		  </div>
  		</div>
	</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Ecomsite\resources\views/user/register.blade.php ENDPATH**/ ?>