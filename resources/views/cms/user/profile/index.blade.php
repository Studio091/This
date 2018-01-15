@extends('cms.layout.master')

@section('profile')
class="active"
@endsection


@section('content')
<h1 class="page-header">Welcome {{auth()->user()->name}}</h1>
<div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           About you
                        </div>
                        <div class="panel-body">
                          <center><img height="150" src="{{URL::to('/')}}/albuns/profile/{{auth()->user()->profile->image}}"/></center>
                           <br>
                            <p>{{auth()->user()->profile->phrase}}</p>
                           
                            <br>
                       
                            <address>
                                <strong>Social Media</strong>
                                <br> @if(!(is_null(auth()->user()->profile->twitter))) Twitter: {!!auth()->user()->profile->twitter!!} @endif
                                <br>@if(!(is_null(auth()->user()->profile->facebook))) Facebook: {!!auth()->user()->profile->facebook!!} @endif
                                <br>@if(!(is_null(auth()->user()->profile->instagram))) Instagram: {!!auth()->user()->profile->instagram!!} @endif
                               
                            </address>
                            <address>
                                <strong>Full name: {{auth()->user()->name}}</strong>
                                <br>
                                Email: <a href="mailto:#">{{auth()->user()->email}}</a>
                            </address>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-8">
                	<div class="panel panel-default">
                        <div class="panel-heading">
                           
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">
                                <form action="/cms/profile" enctype="multipart/form-data" method="post">
                                 {{ csrf_field() }}

	<div class="form-group">
		<label>Text:</label>
		<textarea name="text" class="form-control">@if(!(is_null(auth()->user()->profile))) {!!auth()->user()->profile->text!!} @endif</textarea>
		
	</div>
	<div class="form-group">
		<label>Phrase:</label>
		<input name="phrase" @if(!(is_null(auth()->user()->profile->phrase))) value="{!!auth()->user()->profile->phrase!!}" @endif class="form-control" type="text">
	</div>
	
	 <div class="form-group">
    <input required="" name="image[]" type="file" accept=".jpg,.JPG, .png, .PNG, .gif, .GIF">
	</div>

   </div>
    <div class="col-lg-4">
    <div class="form-group">
		<label>Twitter:</label>
		<input name="twitter" @if(!(is_null(auth()->user()->profile->twitter))) value="{!!auth()->user()->profile->twitter!!}" @endif class="form-control" type="text">
	</div>
    <div class="form-group">
		<label>Facebook:</label>
		<input name="facebook" @if(!(is_null(auth()->user()->profile->facebook))) value="{!!auth()->user()->profile->facebook!!}" @endif class="form-control" type="text">
	</div>
   <div class="form-group">
		<label>Instagram:</label>
		<input name="instagram" @if(!(is_null(auth()->user()->profile->instagram))) value="{!!auth()->user()->profile->instagram!!}" @endif class="form-control" type="text">
	</div>
   
	
<input class="btn btn-default" type="submit">
   </form>
								</div>

								
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>  
                    
                 </div>




@endsection