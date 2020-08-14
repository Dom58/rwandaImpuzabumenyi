@extends('layouts.blog')

@section('title', '| Manage Rwanda Main Museum')

@section('stylesheets')
<script src="/js/tinymce/tinymce.min.js"></script>
<!--{{--  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>  --}}-->
@endsection
<!-- ++++++++++++++++++++++++++End stylesheet section ++++++++++++++++++++++ -->

  @section('content')

<div class="row">
      <div class="col-md-4">
        <h2>Manage National Museums <b style="color: brown;">{{$museums->count()}}</b></h2>
      </div>
      <div class="col-md-5" style="margin-top: 22px;">
      <div class="form-group">
        <input type="text" name="s" id="museumId" class="form-control" value="{{ isset($s) ? $s : ''}}" placeholder="Shakisha inzundangamurage...">
      </div>
       </div>
      <div class="col-md-2">
        <a href="{{route('museums.create')}}" class="btn btn-primary btn-h1-spacing"><i class="fa fa-pencil"></i> Create New Museum</a>
      </div>
      <div class="col-md-12">
        <hr>
      </div>
    </div>
<!-- +++++++++++++++++++++++++ End of Head ++++++++++++++++++++++++++++++++++++ -->
<div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
        <table class="table" id="museumTable">  
          <thead>
    <th>#</th>
      <th>Created_by </th>
      <th>Image</th>
      <th>Name </th>
      <th>Slug</th>
      <th> description </th>
      <th> Status </th>
      <th>Created_at</th>
      <th></th>
      <th></th>
      </thead>

      <tbody>
        <?php $no=1; ?>
        @foreach( $museums as $museum )
      <tr>
           <th>{{ $no++ }}</th>
           <td><b style="color: brown;">{{ $museum->user->username}} </b>&nbsp; {{ $museum->user->email }}</td>
           <td> <img src="/museums/{{$museum->file_name}}" width="100px;" class="img-responsive"></td>

           <td>{{ $museum ->name }} </td>
           <td>{{ $museum ->slug }} </td>

           <td>{{ substr(strip_tags($museum ->description),0,100) }} {{strlen(strip_tags($museum ->description)) >100 ? "..." : "" }} 
           </td>
           @role('superadmin|admin')
<td>
      <form method="POST" action="{{ url('/all/rwandan/approve_museum')}}">
      {{ csrf_field()}}

      @if( $museum ->status == 0) 
      <input <?php if( $museum->status == 0)  ?> type="hidden" name="status" value="1">
        <input type="hidden" name="museumId" value="{{$museum ->id}}">
        <button class="btn btn-warning btn-sm">UnPublished</button>
      @elseif ($museum ->status == 1 )
      <input <?php if( $museum->status == 1) {echo "checked";} ?> type="hidden" name="status" value="0">
        <input type="hidden" name="museumId" value="{{$museum ->id}}">
         <button  class="btn btn-primary btn-sm">Published</button>
    @endif
   </form>
</td> 
@endrole
          <td>{{ $museum ->created_at }} <br><br><b>{{ $museum ->created_at ->diffForHumans() }} </b>
          </td>
<td> 
  <a href="{{ route('museums.show',$museum->slug) }}" class="btn btn-primary"> <span class="fa fa-eye"></span></a>
   @role('superadmin|admin|')
  <a href="{{ route('museums.edit' ,$museum ->id)}}" class="btn btn-success" style="margin-top: 5px;"> <span class="fa fa-edit"></span></a> 
</td>
@endrole
  
        </tr>
          @endforeach
      </tbody>
    </table>
    <div class="text-center">
    {{ $museums->links() }}
     </div>
  </div>
</div>
</div>
  @endsection
         @section('scripts')
    <script>
$(document).ready(function(){
  $("#museumId").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#museumTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection
