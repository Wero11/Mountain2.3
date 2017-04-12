@extends('layout.default')
	@section('header')
	@show	

	@section('menu')
	@show
@section('content')

<div class="container-fluid">
	<div class="row">
		
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered" id="login_header"  >
		 <img src="{{ asset('public/images/login_header.png')}} " class="img_header"/>
		</div>
		
		<div  id="login-modal">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered">
				 <div class="wrapper">
				  	
				    <form class="form-signin" id="form-login">       
				      <h3 class="form-signin-heading">Login</h3>
				      <label class="form-user_name">Username or Email</label><a class="forget_lbl" href="" v-on="click: flip('email','login', $event)">Forgot Email?</a>
				      <input type="text" class="form-control" name="username" v-model="username" /> 
				      <label class="form-user_name">Password</label><a class="forget_lbl" href=""  v-on="click: flip('password','login', $event)">Forgot Password?</a>
				      <input type="password" class="form-control" name="password" v-model="password" />      
				      <label class="checkbox">
				        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Keep me signed in
				      </label>
				     	<button class="btn btn-lg btn-primary btn-block col-centered" type="submit" value="send" >Login</button> 
				    </form>
				  </div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered inactive" id="form-password">
				 <div class="wrapper">
				    <form class="form-signin" id="password_form">       
				      <h3 class="form-signin-heading">Forget Password</h3>
				      <label class="form-user_name">Password</label><a class="forget_lbl" href="">Login</a>
				      <input type="password" class="form-control" name="password" v-model="password" />      
				     	<button class="btn btn-lg btn-primary btn-block col-centered" type="submit" value="send">Reset Password</button> 
				    </form>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered inactive" id="form-email">
				 <div class="wrapper">
				    <form class="form-signin" id="email_form">       
				      <h3 class="form-signin-heading">Forget Email</h3>
				      <label class="form-user_name">Email</label><a class="forget_lbl" href="">Login</a>
				      <input type="password" class="form-control" name="username" v-model="username" />      
				     	<button class="btn btn-lg btn-primary btn-block col-centered" type="submit" value="send">Send</button> 
				    </form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

<script src="{{ asset('/public/js/site/login.js') }}"></script>