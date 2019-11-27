@extends('layouts.base')

@section('title', 'Homepage')

@section('pageid', 'homepage')

@section('content')
	<div class="home">
			<div class="grid-x">
				<div class="cell">
					<section class="hero">
						<div class="hero-slider">
							<div><img src="/images/sliders/slide_1.jpg" alt="{{getenv('APP_NAME')}}"></div>
							<div><img src="/images/sliders/slide_2.jpg" alt="{{getenv('APP_NAME')}}"></div>
							<div><img src="/images/sliders/slide_3.jpg" alt="{{getenv('APP_NAME')}}"></div>
						</div>
					</section> 
				</div>
			</div>
			<div class="grid-x">
				<div class="cell">
					<section>
						<div id="featured">
							
						</div>
					</section>
				</div>
			</div>
	</div>
@endsection