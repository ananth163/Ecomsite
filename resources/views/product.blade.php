@extends('layouts.base')

@section('title')
	{{$product->name}}
@endsection

@section('pageid', 'products')

@section('content')
	<div class="display-products" data-token="{{App\Classes\CSRFHandler::getToken()}}" id="products">
			<div class="grid-x">
				<div class="cell">
					<section class="product-details">
						<div class="grid-x grid-padding-x">
							<div class="cell">
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
						<div class="grid-x grid-padding-x">
							<div class="cell small-12 medium-5 large-4">
								<div>
									<img src="/{{$product->image_path}}" width="300" height="200">
								</div>
							</div>
							<div class="cell small-12 medium-7 large-8">
								<div class="product-details">
									<h2>{{$product->name}}</h2>
									<p>{{$product->description}}</p>
									<h2>{{$product->price}}$</h2>
									<button @click.prevent="addToCart({{$product->id}})" class="button alert">Add to Cart</button>
								</div>								
							</div>
						</div>				
					</section>										
				</div>
			</div>
			<div class="grid-x grid-padding-x">
				<div class="cell">
					<section class="similar-products">
						<h2>Similar Products</h2>
						<div class="product-slider orbit" role="region" aria-label="Similar Products" data-orbit>
  							<ul class="orbit-container">
    							<button class="orbit-previous">
    								<span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;
    							</button>
    							<button class="orbit-next">
    								<span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;
    							</button>
    							@foreach($similarProducts->chunk(4) as $chunk)
    								<li class="is-active orbit-slide">
    									<div class="grid-x grid-padding-x small-up-2 medium-up-4">
    										@foreach($chunk as $item)
    											<div class="cell">
    												<div class="product-card">
    													<div class="product-card-thumbnail">
    														<a href="#">
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
              												<a @click.prevent="addToCart({{$item->id}})" class="button alert">
              													Add to Cart
              												</a>              
            											</div>
    												</div>
    											</div>
    										@endforeach
    									</div>
    								</li>
    							@endforeach   							
 							</ul>
  							<nav class="orbit-bullets">
    							<button class="is-active" data-slide="0">
    								<span class="show-for-sr">First slide details.</span>
    								<span class="show-for-sr">Current Slide</span>
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
@endsection