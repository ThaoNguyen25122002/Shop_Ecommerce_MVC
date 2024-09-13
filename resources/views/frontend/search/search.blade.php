@extends('frontend.layouts.app')

@section('main')
<style>
	
.filter-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f0f0f0;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.filter-input, .filter-select, .filter-button {
    padding: 8px;
    margin: 0 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f7f7f7;
    font-size: 14px;
}

.filter-input::placeholder {
    color: #999;
}

.filter-select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'16\' fill=\'%23333\' class=\'bi bi-caret-down-fill\' viewBox=\'0 0 16 16\'%3E%3Cpath d=\'M7.247 11.14l-4.796-5.481A.5.5 0 0 1 2.45 5h11.1a.5.5 0 0 1 .396.84l-4.796 5.48a.5.5 0 0 1-.703 0z\'/%3E%3C/svg%3E');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
}

.filter-select option {
    padding: 8px;
}
.filter-button {
	background-color: gold;
	color: white;
}
</style>
				<form action="{{ route('search.results') }}" method="GET">
					<div class="filter-container">
						<input type="text" class="filter-input" placeholder="Name" name="name" >
						<select class="filter-select" name="price">
							<option selected disabled>Choose price</option>
							<option value="0-100">0-100</option>
							<option value="100-200">100-200</option>
							<option value="200-300">200-300</option>
						</select>
						<select class="filter-select" name="category">
							<option selected disabled>Category</option>
							@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->category_name}}</option>
							@endforeach
							
						</select>
						<select class="filter-select" name="brand">
							<option selected disabled>Brand</option>
							@foreach($brands as $brand)
							<option value="{{$brand->id}}">{{$brand->brand_name}}</option>
							@endforeach

						</select>
						<select class="filter-select" name="option">
							<!-- <option selected disabled>Status</option> -->
							<option value="1">New</option>
							<option value="2">Sale</option>
						</select>
						<button type="submit" class="filter-button">Search</button>
					</div>
				</form>
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Search Products</h2>
                        @if($products->count())
                            @foreach($products as $product)
                                    @php
                                        $imagesArray = json_decode($product->images, true);
                                        $firstImage = $imagesArray[0]; 
                                    @endphp
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img class="image-product" src="{{ asset('frontend/images/products/'.$firstImage) }}" alt="" />
                                                <h2 class="price-product" data-price-product='{{ $product->price }}'>${{ $product->price }}</h2>
                                                <p class="name-product">{{ $product->name }}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            <div class="product-overlay" >
                                                <div class="overlay-content">
                                                    <h2>${{ $product->price }}</h2>
                                                    <p>{{ $product->name }}</p>
                                                    <a id="btn-add-to-cart" data-id-product ='{{ $product->id }}' class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="product-details/{{ $product->id }}"><i class="fa fa-plus-square"></i>Product Detail</a></li>
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="pagination-area" style="cursor: pointer;">
                                {{ $products->links() }}
                            </div>
                        @else
                            <h4>Không tìm thấy sản phẩm!!!</h4>
                        @endif
                        
						
					</div><!--features_items-->
					


					
					<div class="search_data" style="display: none;">
						<h2 class="title text-center ">Search for the word <q class="title-search"></q> </h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active item-search">	
									<!-- <div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="frontend/images/home/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div> -->
								</div>
								
							</div>
									
						</div>
					</div>

@endsection

@section('jquery')
<script>
    $(document).ready(function(){
		
		// alert(total);
		// ============ Add to cart ================ //
		total = '{{ $totalQTY }}';
		var checkLogin = '{{ Auth::Check() }}';
			$('.add-to-cart').click(function(e){
				// alert('haha');
				if(!checkLogin){
					e.preventDefault();
					alert('Login to Add to cart');
					exit;
				}
				$('.cart-quantity').text(++total);
				var product_id = $(this).data('id-product');
				var input = $(this).closest('.product-image-wrapper');
				var image = input.find('.image-product').attr('src');
				var price = input.find('.price-product').data('price-product');
				var name = input.find('.name-product').html();
				// var token = $('input[name="_token"]').val();
				// alert(token);
				
				$.ajax({
					method: 'post',
					url: '{{ url("/add-to-cart") }}',
					data:{
						_token: '{{ csrf_token() }}',
						'product_id':product_id,
						'qty' : 1,
						'image': image,
						'price': price,
						'name': name,
					},
					success: function(response){
						// $('.cart-quantity').text(response.totalQty);
						console.log(response.success);
					}
				});
			});
		
		// ============ Search By Name ================ //
		$('.search').on('keydown', function(event) {
			if (event.key === 'Enter') {
				var value = $(this).val();
				// alert(value);
				if(value){
					// alert('haha');
					$.ajax({
						method: 'get',
						url: '{{ url("/search") }}',
						data:{
							_token: '{{ csrf_token() }}',
							'search':value,
						},
						success: function(response){
							// console.log(response);
							$('.item-search').html(response);
							// console.log(response.success);
						}
					});
					$('.title-search').text(value);
					$('.features_items, .category-tab, .recommended_items').hide();
					$('.search_data').show();
				}else{
					$('.features_items, .category-tab, .recommended_items').show();
					$('.search_data').hide();
				}
				
			}
    	});

    });
</script>
@endsection
