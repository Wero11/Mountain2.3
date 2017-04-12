@extends('layout.default')
	@section('header')
	@show	

	@section('menu')
	@show
@section('content')

<div class="container-fluid">
	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered " id="login_header"  >
		 <img src="{{ asset('public/images/LoginHeaderBG-2.png')}} " class="img_header"/>
		</div>
		
		<div  id="login-modal">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered">
				 <div class="wrapper">
				 @if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li style="text-align:center">{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<script>
					jQuery("form-control").removeClass("error");
					</script>
				    <form class="form-signin" id="form-login" role="form" method="POST" action="{{ url('/adminlogin') }}"> 
					      <input type="hidden" name="_token" value="{{ csrf_token() }}">      
					      <h4 class="form-signin-heading">LOGIN</h4>
					      <div class="input_box"> <label class="form-user_name" style="font-weight: 900!important">User name</label><a class="forget_lbl" href="#" onclick="flipPage('email','login')" tabindex="4">Forgot User Name?</a>
					     <input type="text" class="form-control" name="user_name" value="{{ old('username') }}" id="user_name" tabindex="1"/></div>
					     <div class="input_box1" style="margin-top:20px">  <label class="form-user_name" style="font-weight: 900!important">Password</label><a class="forget_lbl" href="#" onclick="flipPage('email','login')" tabindex="5">Forgot Password?</a>
					      <input type="password" class="form-control" name="password" id="password" tabindex="2"/> </div>     
					      <label class="checkbox" style="font-weight: 900!important;margin-bottom:20px!important;">
					        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe" style="margin-right: 5px!important;" tabindex="6">  Keep me signed in
					      </label>
					     	<button class="btn btn-lg btn-primary btn-block col-centered" type="submit" value="send" style="width: 130px!important;
    border-radius: 0px;padding: 6px!important;font-size: 11px!important;" tabindex="3">Login</button> 
				    </form>
				  </div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered inactive" id="form-email">
				 <div class="wrapper">
				  
				    <form class="form-signin" id="email_form" role="form" method="POST" action="{{ url('/forgotpassword') }}">       
				      <h3 class="form-signin-heading">Forgot User Name/Password</h3>
				      <label class="form-user_name">Email</label><a class="forget_lbl" href="#" onclick="flipPage('login','email')">Login</a>
				      <input type="email" class="form-control" name="email" />      
				     	<button class="btn btn-lg btn-primary btn-block col-centered" type="submit" value="send" style="width: 130px!important;
    border-radius: 0px;padding: 6px!important;font-size: 11px!important;">Send</button> 
				    </form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

