@extends('layouts.blog')

@section('title', '| Manage| Ahantu Nyaburanga')

@section('stylesheets')
<script src="/js/tinymce/tinymce.min.js"></script>
<!--{{--  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>  --}}-->
@endsection
<!-- ++++++++++++++++++++++++++End stylesheet section ++++++++++++++++++++++ -->

  @section('content')

<div class="row">
      <div class="col-md-4">
        <h2>Manage Ahantu Nyaburanga <b style="color: brown;">{{$ahantunyaburangas->count()}}</b></h2>
      </div>
      <div class="col-md-5" style="margin-top: 22px;">
      <div class="form-group">
        <input type="text" name="s" id="ahantunyaburangaId" class="form-control" value="{{ isset($s) ? $s : ''}}" placeholder="Shakisha Ahantu...">
      </div>
       </div>
      <div class="col-md-2">
        <a href="{{route('ahantu_nyaburanga.create')}}" class="btn btn-primary btn-h1-spacing"><i class="fa fa-pencil"></i> Create New Ahantu Nyaburanga</a>
      </div>
      <div class="col-md-12">
        <hr>
      </div>
    </div>
<!-- +++++++++++++++++++++++++ End of Head ++++++++++++++++++++++++++++++++++++ -->
<div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
        <table class="table" id="ahantunyaburangaTable">  
          <thead>
    <th>#</th>
      <th>Created_by </th>
      <th>Image</th>
      <th>Name </th>
      <th> description </th>
      <th> Status </th>
      <th>Created_at</th>
      <th></th>
      <th></th>
      </thead>

      <tbody>
        <?php $no=1; ?>
        @foreach( $ahantunyaburangas as $ahantunyaburanga )
      <tr>
           <th>{{ $no++ }}</th>
           <td><b style="color: brown;">{{ $ahantunyaburanga->user->username}} </b>&nbsp; {{ $ahantunyaburanga->user->email }}</td>
           <td> <img src="/Ahantunyaburanga/{{$ahantunyaburanga->file_name}}" width="100px;" class="img-responsive"></td>

           <td>{{ $ahantunyaburanga ->name }} </td>

           <td>{{ substr(strip_tags($ahantunyaburanga ->description),0,100) }} {{strlen(strip_tags($ahantunyaburanga ->description)) >100 ? "..." : "" }} 
           </td>
           @role('superadmin|admin')
<td>
      <form method="POST" action="{{ url('/amateka/all/approve_ahantunyaburanga')}}">
      {{ csrf_field()}}

      @if( $ahantunyaburanga ->status == 0) 
      <input <?php if( $ahantunyaburanga->status == 0)  ?> type="hidden" name="status" value="1">
        <input type="hidden" name="ahantunyaburangaId" value="{{$ahantunyaburanga ->id}}">
        <button class="btn btn-warning btn-sm">UnPublished</button>
      @elseif ($ahantunyaburanga ->status == 1 )
      <input <?php if( $ahantunyaburanga->status == 1) {echo "checked";} ?> type="hidden" name="status" value="0">
        <input type="hidden" name="ahantunyaburangaId" value="{{$ahantunyaburanga ->id}}">
         <button  class="btn btn-primary btn-sm">Published</button>
    @endif
   </form>
</td> 
@endrole
          <td>{{ $ahantunyaburanga ->created_at }} <br><br><b>{{ $ahantunyaburanga ->created_at ->diffForHumans() }} </b>
          </td>
<td> 
  <a href="{{ route('ahantu_nyaburanga.show',$ahantunyaburanga->name) }}" class="btn btn-primary"> <span class="fa fa-eye"></span></a>
   @role('superadmin|admin|')
  <a href="{{ route('ahantu_nyaburanga.edit' ,$ahantunyaburanga ->id)}}" class="btn btn-success" style="margin-top: 5px;"> <span class="fa fa-edit"></span></a> 
</td>
@endrole
  
        </tr>
          @endforeach
      </tbody>
    </table>
    <div class="text-center">
    {{ $ahantunyaburangas->links() }}
     </div>
  </div>
</div>
</div>
  @endsection
         @section('scripts')
    <script>
$(document).ready(function(){
  $("#ahantunyaburangaId").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#ahantunyaburangaTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection
