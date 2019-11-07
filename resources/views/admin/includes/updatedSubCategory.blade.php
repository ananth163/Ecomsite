
  <td id="subCategoryName-{{$subCategory->id}}">{{$subCategory->name}}</td>
  <td>{{$subCategory->slug}}</td>
  <td >
    <select name="category" id="subCategoryGroup-{{$subCategory->id}}"
        data-category="{{$subCategory->category_id}}"
        data-categoryId="{{$subCategory->category_id}}">
      @foreach(App\Models\Category::all() as $category)
        @if($category->id == $subCategory->category_id)
          <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
        @endif
        <option value="{{$category->id}}">{{$category->name}}</option>
      @endforeach
    </select>
  </td>
  <td>{{$subCategory->updated_at->toFormattedDateString()}}</td>
  <td>
    <a class="update-subCategory" id="edit-{{$subCategory->id}}"><i class="fas fa-edit"></i><a>
    <a id="delete-{{$subCategory->id}}"><i class="fas fa-trash"></i></a>
    <a class="save" id="save-{{$subCategory->id}}" 
      data-token="{{App\Classes\CSRFHandler::getToken()}}"><i class="fas fa-save"></i></a>
  </td>
