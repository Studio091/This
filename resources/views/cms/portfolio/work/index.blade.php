@extends('cms.layout.master')

@section('category')
class="active"
@endsection

@section('content')
<h1 class="page-header">Works</h1> 
<div class="col-lg-12">
                	<div class="panel panel-default">
                        <div class="panel-heading">
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">
                                @if($option == true)
<form action="/cms/work" enctype="multipart/form-data" method="post">
 {{ csrf_field() }}
	
	<div class="form-group">
		<label>Title:</label>
		<input name="title" class="form-control" type="text">
	</div>
	<div class="form-group">
		<label>Text:</label>
		<textarea name="text" class="form-control"></textarea>
	</div>
	  <div class="form-group">
	  <label>Status:</label>
   <select name="visible" class="form-control">
                      <option value="1">Visible</option>
                      <option value="2">Invisible</option>
                                              
           </select>
		</div>
	
</div>
    <div class="col-lg-4">
    <div class="form-group">
    <label>Cover:</label>
    <input class="btn btn-default" required name="image[]" type="file" accept=".jpg,.JPG, .png, .PNG, .gif, .GIF">
	</div>
 
<div class="form-group">
<label>Author:</label>
<select multiple name="author[]" class="form-control">
@foreach($user as $c)

		<option value="{{$c->id}}">{{$c->name}}</option>


@endforeach
	</select>
		</div>

<div class="form-group">
<label>Category:</label>
<select name="portfolio_id" class="form-control">
@foreach($category as $c)

		<option value="{{$c->id}}">{{$c->title}}</option>


@endforeach
	</select>
		</div>
<input class="btn btn-default" value="create" type="submit">
</form>   
								</div>
@else 
<form action="/cms/work/{{$edit->id}}" enctype="multipart/form-data" method="post">
 {{ csrf_field() }}
	
	<div class="form-group">
		<label>Title:</label>
		<input name="title" value="{{$edit->title}}" class="form-control" type="text">
	</div>
	<div class="form-group">
		<label>Text:</label>
		<textarea name="text" class="form-control">{{$edit->text}}</textarea>
	</div>
	<div class="form-group">
   <select name="visible" class="form-control">
	  <option value="1" @if($edit->visible == 1) selected="selected" @endif >Visible</option>
	  <option value="2" @if($edit->visible == 2) selected="selected" @endif >Invisible</option>
                                              
           </select>
		</div>
	
</div>
    <div class="col-lg-4">
    <div class="form-group">
    <input required class="btn btn-default" name="image[]" type="file" accept=".jpg,.JPG, .png, .PNG, .gif, .GIF">
	</div>
   
<div class="form-group">
<select multiple name="author[]" class="form-control">
@foreach($user as $c) 
	  <option @foreach($edit->user as $p) @if($p->pivot->user_id == $c->id) selected="selected" @endif @endforeach value="{{$c->id}}">
		  {{$c->name}}</option>
@endforeach
	</select>
		</div>
<div class="form-group">
<select name="portfolio_id" class="form-control">
@foreach($category as $c) 
	  <option value="{{$c->id}}" @if($edit->visible == $c->id) selected="selected" @endif >{{$c->title}}</option>
@endforeach
	</select>
		</div>
<input class="btn btn-default" value="Update" type="submit">
</form>   
								</div>
@endif

								
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>  
                    
                 </div>
                   <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          Posts
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Visible</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($work as $p)
                                        <tr>
                                            <td><a href="/cms/work/{{$p->id}}">{{$p->title}}</a></td>
                                            <td>{{$p->visible}}</td>
                                            <td>{{$p->created_at}}</td>
                                            
                                            <td><a href="/cms/work/delete/{{$p->id}}">Delete</a></td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
</div>
@endsection