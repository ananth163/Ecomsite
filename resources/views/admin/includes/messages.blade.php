<div class="grid-x grid-margin-x">
	@if(isset($errors))	
	<div class="cell small-5 large-offset-2">
		<div class="callout small alert" data-closable>
			<h5>Important!</h5>
			@foreach($errors as $error)
				<p>{{ $error }}</p>
			@endforeach
			<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    			<span aria-hidden="true">&times;</span>
  			</button>				
		</div>	
	</div>		
	@endif
	@if(isset($success))
	<div class="cell small-5 large-offset-2">
		<div class="callout small success" data-closable="slide-out-right">
			<h5>Success!</h5>
			<p>{{ $success }}</p>
			<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    			<span aria-hidden="true">&times;</span>
  			</button>				
		</div>
	</div>
	@endif
	@if(App\Classes\Session::hasKey('success'))
	<div class="cell small-5 large-offset-2">
		<div class="callout small success" data-closable="slide-out-right">
			<h5>Success!</h5>
			<p>{{ App\Classes\Session::flush('success') }}</p>
			<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
    			<span aria-hidden="true">&times;</span>
  			</button>				
		</div>
	</div>
	@endif
</div>