@extends('layouts.blog')
@section('title', '| Manage Kings Category')
@section('content')
    <div class="row">
      <div class="col-md-8">
        <h2 class="title">Manage kings Categories</h2>
      </div>

      <div class="col-md-4">
        <div class="well">
        <button class="btn btn-info pull-right" data-toggle="collapse" data-target="#content"><i class="fa fa-pencil m-r-10"></i> Create New King Category</button>
        <br>
  <div class="collapse" id="content">
  
  <form method="POST" action="{{ route('king_categories.store')}}" style="border-right: 3px black;">
    {{ csrf_field() }}
<br>
<p></p>
<label>Category name :</label>
 <input type="text" name="category" class="form-control" placeholder="Type category name" />
<br>
 <label>Category Description :</label>
 <input type="text" name="description" class="form-control" placeholder="Type brief description" style=" margin-top: 5px;" />
 <button type="submit" class="btn btn-success form-control" style=" margin-top: 5px;">Save King Category</button>
 </form>

 </div>
</div>

      </div>
    </div>
    <hr class="m-t-0">
    <div class="row">
      @foreach ($categories as $category)
        <div class="col-lg-4">
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="content">
                  <h3 class="title">{{ $category->category}}</h3>
                
                  <p>
                    {{$category->description}}
                  </p>
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <a href="{{ route('king_categories.show', $category->id)}}" class="btn btn-primary fullwidth">Details</a>
                  </div>
                  <div class="col-md-3">
                    <a href="{{ route('king_categories.edit', $category->id)}}" class="btn btn-default fullwidth">Edit</a>
                  </div>
                </div>
              </div>
          </div>
        </div>
      @endforeach
    </div>

    
@endsection
