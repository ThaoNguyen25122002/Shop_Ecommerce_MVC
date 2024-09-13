@extends('frontend.layouts.master')

@section('main-content')

<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ url('account') }}">account</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ url('my-product') }}">My product</a></h4>
								</div>
							</div>
							
						</div><!--/category-products-->
					
						
					</div>
				</div>
				<div class="col-sm-9">
					<div class="blog-post-area">
					@if(session('success'))
						<div class="alert alert-success" style="color: green;">
							{{ session('success') }}
						</div>
					@endif
						<h2 class="title text-center">Update user</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{ url('updateAccount') }}" method="post" enctype="multipart/form-data">
							@csrf
							@method('put')
							<input type="text"  name="name" placeholder="Name" value="{{ $user->name }}"/>
							<input type="email"  name="email" placeholder="Email Address" value="{{ $user->email }}"/>
							<input type="password"  name="password" placeholder="Password"/>
							<input type="text"  name="phone" placeholder="Phone" value="{{ $user->phone }}"/>
							<input type="text"  name="address" placeholder="Address" value="{{ $user->address }}"/>
							<input type="file"  name="avatar" placeholder="Avatar"/>
							<button type="submit" class="btn btn-default">Update</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection