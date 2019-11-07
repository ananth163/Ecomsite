<div class="grid-x grid-padding-x">
    <h3>Sub Categories</h3>
</div>
<div class="grid-x grid-padding-x">
  @if(count($subCategories) == 0)
    <h4>No Sub Categories available to display</h4>
  @else
      <div class="cell small-12 medium-12">
          <table class="hover">
            <thead>
                <tr>
                    <th >Name</th>
                    <th >Slug</th>
                    <th >Category</th>
                    <th >Last Updated</th>
                    <th >Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subCategories as $subCategory)
                  <div >
                  <tr id="subCategory-{{$subCategory->id}}">
                    <td id="subCategoryName-{{$subCategory->id}}">{{$subCategory->name}}</td>
                    <td>{{$subCategory->slug}}</td>
                    <td >
                      <select name="category" id="subCategoryGroup-{{$subCategory->id}}"
                            data-category="{{$subCategory->category_id}}">
                        @foreach(App\Models\Category::all() as $category)
                          @if($category->id == $subCategory->category_id)
                            <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
                          @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                          @endif
                        @endforeach
                      </select>
                    </td>
                    <td>{{$subCategory->updated_at->toFormattedDateString()}}</td>
                    <td>
                      <a class="update-subCategory" id="edit-{{$subCategory->id}}"><i class="fas fa-edit"></i></a>
                      <a class="delete-subCategory" id="delete-{{$subCategory->id}}"
                        data-token="{{App\Classes\CSRFHandler::getToken()}}" 
                        data-categoryid="{{$subCategory->category_id}}">
                        <i class="fas fa-trash"></i>
                      </a>
                      <a class="save" id="save-{{$subCategory->id}}"
                        data-token="{{App\Classes\CSRFHandler::getToken()}}"><i class="fas fa-save"></i></a>
                    </td>
                  </tr>  
                  </div>               
                @endforeach
              </tbody>          
          </table>
          {{ $subCategories->links('pagination.categories',
                                     ['paginator' => $subCategories]) }}
      </div>
  @endif
</div>