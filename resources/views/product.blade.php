@extends('layouts.base')

@section('title')
	{{$product->name}}
@endsection

@section('pageid', 'products')

@section('content')
	<div class="display-products" data-token="{{App\Classes\CSRFHandler::getToken()}}" id="products">
				<section class="product-navigation">
					<div class="grid-x grid-margin-x expanded">
						<div class="cell small-12 large-offset-1">
							<nav aria-label="You are here:" role="navigation">
  								<ul class="breadcrumbs">
  								  <li><a href="/">Home</a></li>
  								  <li><a href="#">{{$product->category->name}}</a></li>
  								  <li><a href="#">{{$product->subcategory->name}}</a></li>
  								  <li>
  								    <span class="show-for-sr">Current: </span> {{$product->name}}
  								  </li>
  								</ul>
							</nav>
						</div>							
					</div>
				</section>
				<div class="grid-x expanded ">
					<div class="cell small-12 medium-5 large-3">
						<div>
							<img src="/{{$product->image_path}}" width="300" height="200">
						</div>
					</div>
					<div class="cell small-12 medium-7 large-6">
						<div class="product">
							<h2>{{$product->name}}</h2>
							<p>{{$product->description}}</p>
							<h2>{{$product->price}}$</h2>
							@if($product->stock > 0)
								<button @click.prevent="addToCart({{$product->id}})" class="button alert">Add to Cart</button>
							@else
								<button class="button alert" disabled>Out of Stock</button>
							@endif
						</div>								
					</div>
				</div>								
			<div class="grid-x expanded">
				<div class="cell small-12">
					<section class="similar-products">
						<h2>Similar Products</h2>
						<div class="product-slider orbit" role="region" aria-label="Similar Products" data-orbit>
							<div class="orbit-wrapper">
  							<ul class="orbit-container">
    							<div class="orbit-controls">
      								<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
      								<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
    							</div>
    							@foreach($similarProducts->chunk(4) as $chunk)
    								@if ($loop->first)
    								 <li class="is-active orbit-slide">
    								@else
    								 <li class="orbit-slide">
    								@endif
    									<div class="grid-x grid-padding-x small-up-2 medium-up-4">
    										@foreach($chunk as $item)
    											<div class="cell">
    												<div class="product-card">
    													<div class="product-card-thumbnail">
    														<a href="/product/{{$item->id}}">
              													<img src="/{{$item->image_path}}" width="100%" />
              												</a>
    													</div>
    													<h2 class="product-card-title"><a href="#">{{$item->name}}</a></h2>
    													<span class="product-card-desc">{{substr($item->description,0,80) . '...'}}</span>
    													<span class="product-card-price">${{$item->price}}</span>
    													<div class="product-card-colors text-center">
              												<a href="/product/{{$item->id}}" class="button">
              													See More
              												</a>
              												@if($item->stock > 0)
              												<a @click.prevent="addToCart({{$item->id}})" class="button alert">
              													Add to Cart
              												</a>
              												@else
              												<button class="button alert" disabled>Out of Stock</button> @endif             
            											</div>
    												</div>
    											</div>
    										@endforeach
    									</div>
    								</li>
    							@endforeach   							
 							</ul>								
							</div>
  							<nav class="orbit-bullets">
    							<button class="is-active" data-slide="0">
    								<span class="show-for-sr">First slide details.</span>
    								<span class="show-for-sr" data-slide-active-label>Current Slide</span>
    							</button>
    							<button data-slide="1">
    								<span class="show-for-sr">Second slide details.</span>
    							</button>
  							</nav>
						</div>
					</section> 
				</div>
			</div>				
		</div>
	</div>
@endsection