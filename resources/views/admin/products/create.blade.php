@extends('admin.layout.base')

@section('title', 'Create Product')

@section('pageid', 'adminProducts')

@section('content')
	<div class="product admin_shared">
		<div class="grid-container">
			<div class="grid-x grid-padding-x">
				<div class="cell medium-11">
					<h2>Add Inventory Item</h2> <hr />
				</div>
			</div>					
			@include('includes.messages')
			<form enctype="multipart/form-data" method="post" action="/admin/products/create">
					<div class="grid-x grid-padding-x">
						<div class="cell small-12 medium-6">
			        		<label for="name">Product Name
			          			<input type="text" name="name" placeholder="Product Name" 
			          					value="{{App\Classes\Request::input('name')}}">
			        		</label>
						</div>
						<div class="cell small-12 medium-4">
			        		<label for="price">Product Price
			          			<input type="text" name="price" placeholder="Product Price" 
			          					value="{{App\Classes\Request::input('price')}}">
			        		</label>
						</div>
					</div>
					<div class="grid-x grid-padding-x">
						<div class="cell small-12 medium-6">
			        		<label for="category">Product Category
			          			<select name="category" id="product-category">
			          				<option value="">
			          					Select Category</option>
			          				@foreach(App\Models\Category::all() as $category)
			          					<option value="{{$category->id}}">{{$category->name}}</option>
			          				@endforeach
			          			</select>			          			
			        		</label>
						</div>
						<div class="cell small-12 medium-4">
			        		<label for="name">Product Subcategory
			          			<select name="subcategory" id="product-subcategory">
			          				<option value="">
			          					Select Subcategory
			          				</option>
			          			</select>
			        		</label>
						</div>
					</div>
					<div class="grid-x grid-padding-x">
						<div class="cell small-12 medium-6">
			        		<label for="stock">Product Stock
			          			<select name="stock">
			          				<option value="{{App\Classes\Request::input('stock')}}">
			          					{{App\Classes\Request::input('stock')??'Select Stock'}}
			          				</option>
			          				@for($i=1; $i <= 50; $i++)
			          					<option value="{{$i}}">{{$i}}</option>
			          				@endfor
			          			</select>			          			
			        		</label>
						</div>
						<div class="cell small-12 medium-5">
							<br />
			        		<div class="input-group">
			        			<span class="input-group-label">
			        				Product Image
			        			</span>
			        			<input type="file" name="productImage" class="input-group-field">
			        		</div>
						</div>
					</div>
					<div class="grid-x grid-padding-x">
						<div class="cell small-12 medium-10">
			        		<label>Description
			          			<textarea name="description" placeholder="Description">{{App\Classes\Request::input('description')}}</textarea>          			
			        		</label>
			        		<input type="hidden" name="token" value="{{App\Classes\CSRFHandler::getToken()}}">
			        		<button class="button alert" type="reset">Reset</button>
			        		<input class="button success float-right" type="submit" name="submit"
			        		 value="Save Product">
						</div>						
					</div>
			</form>		
		</div>
	</div>

@endsection