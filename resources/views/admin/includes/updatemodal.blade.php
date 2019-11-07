<!-- Update Category -->
<div class="reveal reveal-update" id="updateitem-{{$category->id}}" data-reveal data-close-on-click="false"
													data-close-on-esc="false">
  <div class="notification callout"></div>
  <div class="updateCategory">
  <h3>Update Category</h3>
  		<form action="/admin/products/categories/{{$category->id}}/edit" method="post">
  			<div class="input-group">
  				<input type="text" id="updateitem-name-{{$category->id}}" name="name" value="{{$category->name}}">
  				<div>
  					<input type="submit" class="button update-category" 
  					data-token="{{App\Classes\CSRFHandler::getToken()}}" id="{{$category->id}}" value="Update">
  				</div>
  			</div>
		  </form>
    </div>
    <div class="createSubCategory">
      <h3>Create Subcategory</h3>
      <form action="/admin/products/subcategories/{{$category->id}}/create" method="post">
        <div class="input-group">
          <input type="text" id="create-{{$category->id}}" name="name" >
          <div>
            <input type="submit" class="button create-subcategory" 
            data-token="{{App\Classes\CSRFHandler::getToken()}}" id="{{$category->id}}" value="Create">
          </div>
        </div>
    </form>
    </div>
    <div class="reveal-subCategories" id="category-{{$category->id}}">
 
    </div>
  <a href="/admin/products/categories " class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </a>
</div>