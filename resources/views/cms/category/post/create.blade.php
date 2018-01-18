@extends('cms.layout.master')

@section('post')
class="active"
@endsection


@section('content')

<h1 class="page-header">Post</h1>
@if($option == true)
<div class="col-lg-12">
    <div class="panel panel-default">
          <div class="panel-heading">
                           
                </div>
                 <div class="panel-body">
                          <div class="row">
           <div class="col-lg-8">
  <form action="/cms/publish" enctype="multipart/form-data" method="post">
  {{ csrf_field() }}
	
	<div class="form-group">
		<label>Title:</label>
		<input name="title" class="form-control" type="text">
	</div>
	<div class="form-group">
		<label>Text:</label>
		<textarea name="text" class="form-control"></textarea>
	</div>
	
	
</div>
    <div class="col-lg-4">
    <div class="form-group">
    <label>Cover:</label>
    <input class="btn btn-default" name="image[]" type="file" accept=".jpg,.JPG, .png, .PNG, .gif, .GIF">
	</div>
   <div class="form-group">
   <label>Status:</label>
   <select name="visible" class="form-control">
                      <option value="1">Visible</option>
                      <option value="2">Invisible</option>
                                              
           </select>
		</div>
<div class="form-group">
<label>Category:</label>
<select multiple="" name="category[]" class="form-control">

@foreach($category as $c)

		<option value="{{$c->id}}">{{$c->title}}</option>


@endforeach


	</select>
		</div>
<input class="btn btn-default" value="Create" type="submit">
   </form>
								</div>

								
                                <!-- /.col-lg-6 (nested) -->

                            </div>
                            
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>  
                    
                 </div>
@else
<div class="col-lg-12">
    <div class="panel panel-default">
          <div class="panel-heading">
                           
                </div>
                 <div class="panel-body">
                          <div class="row">
           <div class="col-lg-8">
  <form action="/cms/publish/{{$edit->id}}" enctype="multipart/form-data" method="post">
  {{ csrf_field() }}
	
	<div class="form-group">
		<label>Title:</label>
		<input name="title" value="{{$edit->title}}" class="form-control" type="text">
	</div>
	<div class="form-group">
		<label>Text:</label>
		<textarea name="text" class="form-control">{{$edit->text}}</textarea>
	</div>
	
	
</div>
    <div class="col-lg-4">
    <div class="form-group">
    <label>Cover:</label>
    <input class="btn btn-default" name="image[]" type="file" accept=".jpg,.JPG, .png, .PNG, .gif, .GIF">
	</div>
   <div class="form-group">
   <label>Status:</label>
   <select name="visible" class="form-control">
     <option value="1" @if($edit->visible == 1) selected="selected" @endif >Visible</option>
	  <option value="2" @if($edit->visible == 2) selected="selected" @endif >Invisible</option>
                                              
           </select>
		</div>
<div class="form-group">
<label>Category:</label>
<select multiple="" name="category[]" class="form-control">

@foreach($category as $c) 
	  <option @foreach($edit->category as $p) @if($p->pivot->category_id == $c->id) selected="selected" @endif @endforeach value="{{$c->id}}">
		  {{$c->title}}</option>
@endforeach


	</select>
		</div>
<input class="btn btn-default" value="Update" type="submit">
   </form>
								</div>

								
                                <!-- /.col-lg-6 (nested) -->

                            </div>
                            
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>  
                    
                 </div>
@endif
                 
                
@endsection