@extends('frontend.layouts.master')

@section('main-content')


<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1" style="margin-left: 37%;">
				@if(session('success'))
					<div class="alert alert-success" style="color: green;">
						{{ session('success') }}
					</div>
				@endif
				@if(session('error'))
					<div class="alert alert-error" style="color: red;">
						{{ session('error') }}
					</div>
				@endif
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="{{ url('login') }}" method="post">
							@csrf
							<input type="text" placeholder="Email Address" name="email" value="{{ old('email') }}"/>
							<input type="password" placeholder="Password" name="password"/>
							<span>
								<input type="checkbox" class="checkbox" name="remember"> 
								Remember me
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	

@endsection