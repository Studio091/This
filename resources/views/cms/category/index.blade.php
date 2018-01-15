@extends('cms.layout.master')

@section('category')
class="active"
@endsection

@section('content') 
<h1 class="page-header">Category</h1>

                    <div class="col-lg-4">
                    <div class="chat-panel panel panel-default">
              <div class="panel-heading">
                           
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                               @foreach($category as $c)
			<li>
				<div class="chat-body clearfix">
					<div class="header">
						<strong class="primary-font">{{$c->title}}</strong>
						<small class="pull-right text-muted">
							<i class="fa fa-clock-o fa-fw"></i> {{$c->created_at}}
						</small>
					</div>
					<p>
                                            {{$c->text}}<br>
                        @if($c->id != 8)
<a href="/cms/category/delete/{{$c->id}}">Delete</a>
@endif | <a href="/cms/category/{{$c->id}}">Edit</a>
                                        </p>
                                    </div>
                                </li>
                                @endforeach
                                
                                
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <div class="col-lg-8">
                	<div class="panel panel-default">
                        <div class="panel-heading">
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                 
                                       @if($option == true)
<form action="/cms/category" method="post">
 {{ csrf_field() }}
	 <div class="form-group">
		<label>Title:</label>
		<input name="title" class="form-control" type="text">
	</div>
	<div class="form-group">
		<label>Text:</label>
		<textarea name="text" class="form-control"></textarea>
	</div>
	<button type="submit" class="btn btn-default">Create</button>
	
</form>
@else
<form action="/cms/category/{{$edit->id}}" method="post">
 {{ csrf_field() }}
	 <div class="form-group">
		<label>Title:</label>
		<input name="title" value="{{$edit->title}}" class="form-control" type="text">
	</div>
	<div class="form-group">
		<label>Text:</label>
		<textarea name="text" class="form-control">{{$edit->text}}</textarea>
	</div>
	<button type="submit" class="btn btn-default">Create</button>
	
</form>
@endif
                                        </div>
                                        
						
                                    
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>

@endsection