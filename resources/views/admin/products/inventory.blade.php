@extends('admin.layout.base')

@section('title', 'Manage Inventory')

@section('pageid', 'adminProducts')

@section('content')
	<div class="products">
		<div class="grid-x ">
				<h2>Manage Inventory</h2>
				<hr />
		</div>
		@include('admin.includes.messages')
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-6">
				<form action="" method="post">
			        <div class="input-group">
			          <input type="text" class="input-group-field" placeholder="Search by Name">
		          	  <div class="input-group-button">
			          	<input type="submit" class="button" value="Search">
		          	  </div>
			        </div>
				</form>
			</div>
			<div class="cell small-12 medium-4">
				<a href="/admin/products/create" class="button float-right">
					<i class="fas fa-plus"></i>
					Add Product
				</a>
			</div>
		</div>
		<div class="grid-x grid-padding-x">
			@if(count($products) == 0)
				<h2>No Products available to display</h2>
			@else
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>Image</th>
      							<th>Name</th>
      							<th>Price</th>
      							<th>Quantity</th>
      							<th>Category</th>
      							<th>Subcategory</th>
      							<th>Last Updated</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							@foreach($products as $product)
  								<tr>
  									<td><img src="/{{$product->image_path}}" alt="{{$product->name}}" height="30" width="30"></td>
  									<td>{{$product->name}}</td>
  									<td>{{$product->price}}</td>
  									<td>{{$product->quantity}}</td>
  									<td>
  										{{App\Models\Product::find($product->id)->category->name ?? null}}
  									</td>
  									<td>
  										{{App\Models\Product::find($product->id)->subCategory->name ?? null}}
  									</td>
  									<td>{{$product->updated_at->toFormattedDateString()}}</td>
  									<td>
  										<a href="/admin/products/{{$product->id}}/edit">
  											<i class="fas fa-edit"></i>
  										</a>
  										<a data-open="deleteitem-{{$product->id}}">
  											<i class="fas fa-trash"></i>
  										</a>
  										@include('admin.includes.deletemodal', ['id'   => $product->id, 
  																				'name' => $product->name,
  																				'item' => 'product'] )
  									</td>
  								</tr>  								
  							@endforeach
  						</tbody>					
					</table>
					{{ $products->links('pagination.categories', 
													['paginator' => $products]) }}
				</div>
				
			@endif
		</div>
	</div>

@endsection