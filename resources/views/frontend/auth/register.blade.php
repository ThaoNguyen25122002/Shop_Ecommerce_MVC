@extends('frontend.layouts.master')

@section('main-content')



<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4" style="margin-left: 37%;">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Register!</h2>
						<form action="{{ url('register') }}" method="post">
							@csrf
							<input type="text" placeholder="Name" name="name" value="{{old('name')}}"/>
							@error('name')
							<span style="color: red">{{ $message }}</span>
							@enderror

							<input type="text" placeholder="Email Address" name="email" value="{{old('email')}}"/>
							@error('email')
							<span style="color: red">{{ $message }}</span>
							@enderror

							<input type="password" placeholder="Password" name="password" value="{{old('password')}}"/>
							@error('password')
							<span style="color: red">{{ $message }}</span>
							@enderror

							<input type="password" placeholder="Password Confirm" name="password_confirmation"/>

							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
</section><!--/form-->
	

@endsection