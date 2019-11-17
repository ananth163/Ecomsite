@extends('admin.layout.base')

@section('title', 'Dashboard')

@section('pageid', 'adminCategories')

@section('content')
	<div class="category">
		<div class="grid-x">
			<h2>Product Categories</h2>
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
				<form action="/admin/products/categories" method="post">
			        <div class="input-group">
			          <input type="text" class="input-group-field" name="name" placeholder="Category Name">
			          <input type="hidden" name="token" value="{{App\Classes\CSRFHandler::getToken()}}">
		          	  <div class="input-group-button">
			          	<input type="submit" class="button" value="Create">
		          	  </div>
			        </div>
				</form>
			</div>
		</div>
		<div class="grid-x grid-padding-x">
			@if(count($categories) == 0)
				<h2>No Categories available to display</h2>
			@else
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th>Name</th>
      							<th>Slug</th>
      							<th>Last Updated</th>
      							<th>Action</th>
    						</tr>
  						</thead>
  						<tbody>
  							@foreach($categories as $category)
  								<tr>
  									<td>{{$category->name}}</td>
  									<td>{{$category->slug}}</td>
  									<td>{{$category->updated_at->toFormattedDateString()}}</td>
  									<td>
  										<a class = "load-category" id="{{$category->id}}"><i class="fas fa-edit"></i></a>
  										<a data-open="deleteitem-{{$category->id}}"><i class="fas fa-trash"></i></a>
  										@include('admin.includes.createmodal', ['id' => $category->id, 
  																				'name' => $category->name] )
  										@include('admin.includes.updatemodal')
  										@include('admin.includes.deletemodal', ['id'   => $category->id, 
  																				'name' => $category->name,
  																				'item' => 'category'] )
  									</td>
  								</tr>  								
  							@endforeach
  						</tbody>					
					</table>
					{{ $categories->links('pagination.categories', 
													['paginator' => $categories]) }}
				</div>
				
			@endif
		</div>

	</div>

@endsection