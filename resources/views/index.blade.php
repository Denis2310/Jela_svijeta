@extends('includes.header')

@section('content')

        <nav class="navbar navbar-light bg-secondary fixed-top">
            <a class="navbar-brand" href="{{route('index')}}">World Meals</a>
        </nav>
        
        <div class="container-fluid">
            <div class="row app-content">

                <!--Glavni sadržaj sa prikazom jela-->
                <div class="col-md-9 left-container">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="pagination pagination-sm">
                                <div class="ml-auto">{{$meals->appends(request()->input())->links()}}</div>
                            </div>

                        @if(Session::has('message'))                   
                            <h6>Filtered by <span>{{Session::get('message')}} </span> </h6>  
                            {{Session::flush()}}
                        @else
                            <h6>Showing all meals</h6>
                        @endif

                        @if(count($meals)>0)

                            @foreach ($meals as $meal)

                            <div class="meal-container-item">

                                <h3 class="text-center">{{$meal->title}}</h3>
                                <hr>

                                <p><strong>Ingredients: </strong>
                                @if(count($meal->ingredients)>0)
                                
                                    @foreach($meal->ingredients as $ingredient)
                                    &bull; {{$ingredient->title}}
                                    @endforeach

                                @endif</p>
                        
                                <p class="description"><strong>Description: </strong>{{$meal->description}}</p>
                                
                                <p><strong>Created at: </strong>{{$meal->created_at->format('d.m.Y')}}</p>
                                
                                <p><strong>Category: </strong>@if($meal->category){{$meal->category->title}} @endif</p>
                                
                                @if(count($meal->tags)>0)

                                <div class="tags-container text-right">
                                    @foreach($meal->tags as $tag)
                                    <span class="badge badge-secondary">#{{$tag->title}}</span>
                                    @endforeach
                                </div>

                                @endif
                            </div>    
                            <hr>

                            @endforeach
                        
                        @else
                        
                            @if($meals->currentPage() > $meals->lastPage())

                            <h3 class="text-center mt-100 mb-50">You have requested larger page number than the maximum number of pages.</h3>
                            
                            @else
                            
                                <h3 class="text-center">No results!</h3>
                            
                            @endif

                        @endif

                            <div class="pagination pagination">
                                <div class="ml-auto mr-auto">{{$meals->appends(request()->input())->links()}}</div>
                            </div>

                        </div>

                    </div>
                </div>

                <!--Sadržaj filtera-->
                <div class="col-md-3 right-container fixed-top offset-md-9">
                    
                    <h5 class="filter-heading text-center font-weight-bold">Filter Results</h5>
                    <hr>

                    <!--Filter form-->
                    <form method="get" action="{{route('filter_data')}}">
                       
                        @csrf

                        <!--Items per page Container -->
                        <div class="row filter-per-page-container">
                            <div class="form-group form-inline col-md-12">
                                <label class="font-weight-bold" for="per_page"> Items per page: </label>
                                <input class="form-control col-md-2 per-page-input" type="text" name="per_page" id="per_page"></input>
                            </div>

                            <div class="form-group form-inline col-md-12">
                                <label class="font-weight-bold" for="page"> Page number: </label>
                                <input class="form-control col-md-2 page-input" type="text" name="page" id="page"></input>
                            </div>                   
                        </div>

                        <!--Categories Container -->
                        <p class="font-weight-bold">Categories:</p>
                        <div class="row filter-categories-container">
                            
                            @if(count($filter_categories)>0)     

                                @foreach($filter_categories as $category)
                                    <div class="category-holder col-md-6">
                                        <input class="category-checkbox" type="checkbox" name="category[]" value="{{$category->id}}">{{$category->title}}</input>
                                    </div>
                                @endforeach

                            @endif

                            <div class="category-holder col-md-6">
                                <input class="category-checkbox" onclick="disableOthers(this)" type="checkbox" name="category[]" value="null">Without Category</input>
                            </div>

                            <div class="category-holder col-md-6">
                                <input class="category-checkbox" onclick="disableOthers(this)" type="checkbox" name="category[]" value="!null">With Category</input>
                            </div>  
                        </div>

                        <!--Tags Container -->
                        <p class="font-weight-bold">Tags:</p>
                        <div class="row filter-tags-container">
                            
                            @if(count($filter_tags)>0)                        
                                
                                @foreach($filter_tags as $tag)
                                    <div class="tag-holder col-md-6">
                                        <input class="tag-checkbox" type="checkbox" name="tags[]" value="{{$tag->id}}">{{$tag->title}}</input>
                                    </div>
                                @endforeach

                            @endif

                        </div>

                        <!--Submit Form Button-->
                         <input class="btn btn-secondary" type="submit" name="submit" value="Filter"></input>

                    </form>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div> 

            </div>
        </div>
        
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
@endsection
