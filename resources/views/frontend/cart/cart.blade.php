@extends('frontend.layouts.master')

@section('main-content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
				@if(session('message'))
					<div class="alert alert-success" style="color: green;">
						{{ session('message') }}
					</div>
				@endif
				@if(session('cart'))
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
						$totalAll = 0;
						@endphp
						@foreach(session()->get('cart') as $key=>$value)
							@php
							$totalPrice = $value['qty'] * $value['price'];
							$totalAll += $totalPrice;
							@endphp
						<tr data-id='{{ $key }}'>
							<td class="cart_product">
								<a href=""><img src="{{$value['image']}}" alt="" style="max-width: 150px;"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $value['name'] }}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>$<span>{{ $value['price'] }}</span></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" > + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $value['qty'] }}" autocomplete="off" size="2">
									<a class="cart_quantity_down" > - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">$<span class="total-price">{{ $value['qty']* $value['price'] }}</span></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
	
						
						
					</tbody>
				@else	
				<h1 style="text-align:center;">Cart is empty</h1>
				@endif
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$<span class="total-all">{{ session("cart") ? $totalAll : 0 }}</span></span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{ url('checkout') }}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection


@section('jquery')

	<script>
		$(document).ready(function(){
			var totalAll = $('.total-all').text();
			var sum = parseInt(totalAll);
			var checkLogin = "{{ Auth::Check() }}";
			if(checkLogin){

			
				$(".cart_quantity_up, .cart_quantity_down").click(function(e){
					e.preventDefault();
					var input = $(this).closest("td").find(".cart_quantity_input");
					var id = $(this).closest('tr').data('id');
					var price = $(this).closest('tr').find('.cart_price span').text();
					var newQty = 0;
					// alert(sum);
					if($(this).hasClass('cart_quantity_up')){
						sum+=parseInt(price);
						newQty = parseInt(input.val()) + 1;
						// alert(sum);
						$('.total-all').text(sum);
					}else if($(this).hasClass('cart_quantity_down')){
						sum-=parseInt(price);
						newQty = parseInt(input.val()) - 1;
						// alert(sum);
						$('.total-all').text(sum);
					};
					if(newQty>0){
						input.val(newQty);
						var newTotal = (newQty * price);
						$(this).closest("tr").find(".total-price").text(newTotal);

					}else if(newQty === 0){
						$(this).closest("tr").remove();
					}
					$.ajax({
						method: 'post',
						url: '{{ url("/cart") }}',
						data:{
							_token: '{{ csrf_token() }}',
							'id':id,
							'newQty' : newQty,
						},
						success: function(response){
							// $('.cart-quantity').text(response.totalQty);
							console.log(response.success);
						}
						});
				});
			}else{
				alert("Login de add to cart");
			}
		});
	</script>

@endsection