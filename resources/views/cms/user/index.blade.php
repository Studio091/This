@extends('cms.layout.master')

@section('profile')
class="active"
@endsection


@section('content')
<h1 class="page-header">User</h1>

                    <div class="col-lg-4">
                    <div class="chat-panel panel panel-default">
              <div class="panel-heading">
                           
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                               @foreach($user as $u)
			<li>
				<div class="chat-body clearfix">
					<div class="header">
						<strong class="primary-font">{{$u->name}}</strong>
						<small class="pull-right text-muted">
							<i class="fa fa-clock-o fa-fw"></i> {{$u->created_at}}
						</small>
					</div>
					<p>
                                            {{$u->email}}<br>
                        @if($u->id != 8)
<a href="/cms/user/delete/{{$u->id}}">Delete</a>
@endif | <a href="/cms/user/{{$u->id}}">Edit</a>
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
<form action="/cms/user" method="post">
 {{ csrf_field() }}
	 <div class="form-group">
		<label>Name:</label>
		<input name="name" class="form-control" type="text">
	</div>
	 <div class="form-group">
		<label>Email:</label>
		<input name="email" class="form-control" type="email">
	</div>
	 <div class="form-group">
		<label>Password:</label>
		<input name="password" class="form-control" type="password">
	</div>
	<div class="form-group"><label for="password-confirm">Confirm Password</label> <input id="password-confirm" type="password" name="password_confirmation" required="required" class="form-control"></div>
	
	<button type="submit" class="btn btn-default">Create</button>
	
</form>
@else
<form action="/cms/user/{{$edit->id}}" method="post">
 {{ csrf_field() }}
	 <div class="form-group">
		<label>Name:</label>
		<input name="name" value="{{$edit->name}}" class="form-control" type="text">
	</div>
	 <div class="form-group">
		<label>Email:</label>
		<input name="email" value="{{$edit->email}}" class="form-control" type="email">
	</div>
	 <div class="form-group">
		<label>Password:</label>
		<input name="password" class="form-control" type="password">
	</div>
	<div class="form-group"><label for="password-confirm">Confirm Password</label> <input id="password-confirm" type="password" name="password_confirmation" required="required" class="form-control"></div>
	<button type="submit" class="btn btn-default">Update</button>
	
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