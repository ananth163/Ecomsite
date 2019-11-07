<!-- Create SubCategory -->
<div class="reveal reveal-update" id="createitem-{{$id}}" data-reveal data-close-on-click="false"
													data-close-on-esc="false">
  <div class="notification callout"></div>
  <h3>Create Subcategory</h3>
  <h2>  for the {{$name}} Category</h2>
  		<form action="/admin/products/subcategories/{{$id}}/create" method="post">
  			<div class="input-group">
  				<input type="text" id="createitem-name-{{$id}}" name="name" >
  				<div>
  					<input type="submit" class="button create-subcategory" 
  					data-token="{{App\Classes\CSRFHandler::getToken()}}" id="{{$id}}" value="Create">
  				</div>
  			</div>
		</form>
  <a href="/admin/products/categories " class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </a>
</div>