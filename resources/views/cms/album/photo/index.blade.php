@extends('cms.layout.master')

@section('album')
class="active"
@endsection

@section('content')
<h1 class="page-header">Album {{$album->title}}</h1> 

<form class="col-lg-3 form-inline" action="/cms/album/photo/{{$album->id}}" enctype="multipart/form-data" method="post">
 {{ csrf_field() }}

	<input class="form-control" required name="image[]" type="file" accept=".jpg,.JPG, .png, .PNG, .gif, .GIF" multiple>
<br>

		<input type="text" name="text" class="form-control mb-2 mr-sm-2" placeholder="Title">
	<input class="btn btn-default" type="submit">
	
</form>

@foreach($album->photo as $a)
{{$a->image}}
@endforeach
@endsection
