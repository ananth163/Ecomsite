@php
	$categories = App\Models\Category::with('subcategories')->get();
@endphp
<header class="navigation">
	<div class="show-for-small-only">
		<div class="title-bar" data-responsive-toggle="responsive-menu" data-hide-for="medium">
			<button class="menu-icon" type="button" data-toggle="responsive-menu"></button>
			<div class="title-bar-title">Menu</div>
		</div>
		<div id="responsive-menu">
			<ul class="drilldown vertical menu" data-drilldown data-auto-height="true" data-animate-height="true">
      			<li>
      				<a href="/">{{getenv('APP_NAME')}}</a>
      			</li>
      			<li><a href="#0">Products</a></li>
      			<li class="has-submenu">
        			<a href="#0">Categories</a>
        			<ul class="submenu menu vertical" data-submenu>
        				@foreach($categories as $category)
        					<li>
        						<a href="#0">{{$category->name}}</a>        						
        						@if(count($category->subcategories))
                      <ul class="submenu menu vertical" id="{{count($category->subcategories)}}" data-submenu>
        							@foreach($category->subcategories as $subcategory)
        								<li><a href="#0">{{$subcategory->name}}</a></li>
        							@endforeach
                      </ul>
        						@endif
        					</li>
        				@endforeach
        			</ul>
      			</li>
      			<li><a href="#">SignIn</a></li>
      			<li><a href="#">Register</a></li>
      			<li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Cart</a></li>      			
    		</ul>
		</div>
	</div>

	<div class="show-for-medium">
    <div data-sticky-container>
		  <div class="top-bar" data-sticky data-options="marginTop:0;" id="main-menu">
  	 		<div class="top-bar-left">
      			<ul class="dropdown menu" data-dropdown-menu>
        				<li>
        					<a href="/">{{getenv('APP_NAME')}}</a>
        				</li>
        				<li><a href="#0">Products</a></li>
        				<li class="has-submenu">
          				<a href="#0">Categories</a>
          				<ul class="submenu menu vertical" data-submenu>
          					@foreach($categories as $category)
          						<li>
          							<a href="#0">{{$category->name}}</a>        							
          							@if(count($category->subcategories))
                          <ul class="submenu menu vertical" data-submenu>
          								@foreach($category->subcategories as $subcategory)
          									<li><a href="#0">{{$subcategory->name}}</a></li>
          								@endforeach
                          </ul>
          							@endif
          						</li>
          					@endforeach
          				</ul>
        				</li>      			
      			</ul>
  	 		</div>
  	 		<div class="top-bar-right">
      			<ul class="dropdown menu" data-dropdown-menu>
        				<li class="menu-text">Username</li>
        				<li><a href="#">SignIn</a></li>
        				<li><a href="#">Register</a></li>
        				<li><a href="/cart" class="cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Cart</a></li>
      			</ul>
  	 		</div>
		  </div>
  </div>
	</div>
</header>