@include('cms.layout.head')
@include('cms.layout.nav')
@include('cms.layout.side')
@foreach (['danger', 'warning', 'success', 'info'] as $key)
 @if(Session::has($key))
     <div class="col-lg-12">
		<br>
		<div class="alert alert-{{ $key }}">
	  		"{!! Session::get($key) !!}."
		</div>
	</div>
 @endif
@endforeach

@yield('content')
@include('cms.layout.footer')