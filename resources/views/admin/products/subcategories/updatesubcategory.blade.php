<!-- Update Category -->
<div class="reveal reveal-update" id="updateitem-{{$subCategory->id}}" data-reveal data-close-on-click="false"
													data-close-on-esc="false">
  <div class="notification callout"></div>
  <h3>Update Sub Category</h3>
  		<form action="/admin/products/subcategories/{{$subCategory->id}}/edit" method="post">
  			<div class="row">
  				<input type="text" id="updateitem-name-{{$subCategory->id}}" name="name" value="{{$subCategory->name}}">
          <div class="row">
            <label>Move this to
              <select name="category" id="updateitem-category-{{$subCategory->id}}" 
                          value="{{$subCategory->category_id}}">
                @foreach(App\Models\Category::all() as $category)
                  @if($category->id == $subCategory->category_id)
                    <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
                  @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endif
                @endforeach
              </select>                     
            </label>
          </div>
  				<div class="row text-center">
  					<input type="submit" class="button update-category" 
  					data-token="{{App\Classes\CSRFHandler::getToken()}}" id="{{$subCategory->id}}" value="Update">
  				</div>
  			</div>
		</form>
  <a href="/admin/products/categories " class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </a>
</div>