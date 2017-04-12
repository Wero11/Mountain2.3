@extends('layout.default')
	@section('content')
	<div class="col-sm-10 col-md-10 col-lg-11 col-offset-110">
		@section('breadcrumb')
			@include($breadcrumb)
		@show
		<div class="col-md-12" id="mountain_list" >  			  
	        @include($component)
	    </div>	
	</div>
	@if(isset($popup))
	@foreach ($popup as $item)
		@include($item)
    @endforeach
    @endif
@endsection

   
    

