@extends('admin.layout.base')

@section('title', 'Dashboard')

@section('content')
	<div class="category">
		<div class="grid-x">
			<h3>Product Categories</h3>
		</div>
		@if(isset($message))
		<p>{{$message}}</p>
		@endif
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
			<div class="cell small-12 medium-5">
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
				<h3>No Categories available to display</h3>
			@else
				<div class="cell small-12 medium-10">
					<table class="hover">
						<thead>
    						<tr>
      							<th width="250">Category Name</th>
      							<th width="250">Category Slug</th>
      							<th width="150">Created at</th>
      							<th width="150">Updated at</th>
      							<th>Update</th>
    						</tr>
  						</thead>
  						<tbody>
  							@foreach($categories as $category)
  								<tr>
  									<td>{{$category->name}}</td>
  									<td>{{$category->slug}}</td>
  									<td>{{$category->created_at->toFormattedDateString()}}</td>
  									<td>{{$category->updated_at->toFormattedDateString()}}</td>
  									<td><a href="#"><i class="fas fa-edit"></i></a>
  										<a href="#"><i class="fas fa-trash"></i></a></td>
  								</tr>
  							@endforeach
  						</tbody>					
					</table>
				</div>
			@endif
		</div>


	</div>

@endsection