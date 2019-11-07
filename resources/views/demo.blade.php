@foreach($subCategory as $sub)
<h1>{{$sub->name}}</h1>
@endforeach


{{App\Models\Category::find(26)
                ->subcategories()
                ->paginate(3)
                ->links('pagination.categories',
                                          ['paginator' => App\Models\Category::find(26)->subcategories()->paginate(3)
                                                                    ])}}