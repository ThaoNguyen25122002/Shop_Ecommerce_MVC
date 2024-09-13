@extends('frontend.layouts.master')

@section('main-content')

<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Sportswear
										</a>
									</h4>
								</div>
								<div id="sportswear" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Nike </a></li>
											<li><a href="">Under Armour </a></li>
											<li><a href="">Adidas </a></li>
											<li><a href="">Puma</a></li>
											<li><a href="">ASICS </a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#mens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Mens
										</a>
									</h4>
								</div>
								<div id="mens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
											<li><a href="">Armani</a></li>
											<li><a href="">Prada</a></li>
											<li><a href="">Dolce and Gabbana</a></li>
											<li><a href="">Chanel</a></li>
											<li><a href="">Gucci</a></li>
										</ul>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#womens">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											Womens
										</a>
									</h4>
								</div>
								<div id="womens" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Kids</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Fashion</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Households</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Interiors</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Clothing</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Bags</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shoes</a></h4>
								</div>
							</div>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					</div>
				</div>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{ $blog->title }}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
								<div class="rate">
									<div class="vote">
										<form action="{{ url('blog/rate/ajax') }}" method="post" id="formRating">
											@csrf
											@for($i = 1 ; $i<=5 ; $i++)
											@if($i <= $aveRating)
											<div class="star_1 ratings_stars ratings_over"><input value="{{$i}}" type="hidden"></div>
											@else
											<div class="star_1 ratings_stars "><input value="{{$i}}" type="hidden"></div>
											@endif
											@endfor
											<input type="hidden" value="{{ $blog->id }}" name="id_blog">
											<input type="hidden" value=" {{ Auth::id() }} " name="id_user">
											<span class="rate-np">{{ $aveRating }}</span>
										</form>
										
									</div> 
            					</div>
							</div>
							<a href="">
								<img src="{{ url('admin/assets/blogs/'.$blog->image) }}" alt="">
							</a>
							<p>{{ $blog->content }}</p> <br>

							
							<div class="pager-area">
								<ul class="pager pull-right">
									@if($previous)
									<li><a href="{{ url('/blog-detail',$previous->id) }}">Pre</a></li>
									@endif
									@if($next)
									<li><a href="{{ url('/blog-detail',$next->id) }}">Next</a></li>
									@endif
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li class="color">(6 votes)</li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="images/blog/socials.png" alt=""></a>
					</div><!--/socials-share-->

					<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
					<div class="response-area">
						<h2>{{ $countCmt }} RESPONSES</h2>
						<ul class="media-list">
							@foreach($comments as $comment )
							<li class="media" id="comment-{{$comment->id}}">
								
								<a class="pull-left" href="#">
									<img class="media-object" src="{{ asset('admin/assets/avatar/'.$comment->avatar_user ) }}" alt="" style="max-width: 120px;max-height: 120px;object-fit: cover;">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{ $comment->name_user }}</li>
										<li><i class="fa fa-clock-o"></i> {{ $comment->created_at->toTimeString() }}</li>
										<li><i class="fa fa-calendar"></i> {{ $comment->created_at->toDateString() }}</li>
									</ul>
									<p>{{ $comment->comment }}</p>
									<a class="btn btn-primary btn-reply" data-parent-id="{{$comment->id}}"><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li>
							<div id="comment-form-{{$comment->id}}" style="display: none;" >
									<!-- Form content here -->
									<form action="{{ url('blog-detail',$blog->id) }}" id="post_comment" method="post">
									@csrf
									<input type="hidden" name="level" value="{{ $comment->id }}" id="reply-parent-id">
									<textarea name="comment" rows="4" style="background-color: white;border: 1px solid black;"></textarea>
									@error('comment')
                                            <strong style="color: red">{{ $message }}</strong>
											<br>
                                    @enderror
									<button type="submit" class="btn btn-primary btn-comment" >post reply comment</button>
									</form>
							</div>
							@if ($comment->children->isNotEmpty())
							@foreach ($comment->children as $child)
							<li class="media second-media">
								<a class="pull-left" href="#">
									<img class="media-object" src="{{ asset('admin/assets/avatar/'.$child->avatar_user) }}" alt="" style="max-width: 120px;max-height: 120px;object-fit: cover;">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{$child->name_user}}</li>
										<li><i class="fa fa-clock-o"></i> {{ $comment->created_at->toTimeString() }}</li>
										<li><i class="fa fa-calendar"></i> {{ $comment->created_at->toDateString() }}</li>
									</ul>
									<p>{{$child->comment}}</p>
									<!-- <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a> -->
								</div>
							</li>
							@endforeach
							@endif
							
							@endforeach
						</ul>

				
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								
								<div class="text-area">
									<div class="blank-arrow">
										<label>Your Name</label>
									</div>
									<span>*</span>
									<form action="{{ url('blog-detail',$blog->id) }}" id="post_comment" method="post" >
									@csrf
									<textarea name="comment" rows="4" ></textarea>
									@error('comment')
                                            <strong style="color: red">{{ $message }}</strong>
											<br>
                                    @enderror
									<button type="submit" class="btn btn-primary btn-comment" >post comment</button>
									</form>
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
				</div>	
			</div>
		</div>
	</section>

@endsection


@section('jquery')

	<script>
    	
    	$(document).ready(function(){
			
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
				var checkLogin = '{{ Auth::Check() }}';
				if(checkLogin){
					var star_rating =  $(this).find("input").val();
					var id_blog = $('input[name="id_blog"]').val();
					var id_user = $('input[name="id_user"]').val();
					// alert(star_rating);
					console.log('Star rating:', star_rating); 
					console.log('Blog ID:', id_blog); 
					console.log('User ID:', id_user); 
					if ($(this).hasClass('ratings_over')) {
						$('.ratings_stars').removeClass('ratings_over');
						$(this).prevAll().andSelf().addClass('ratings_over');
					} else {
						$(this).prevAll().andSelf().addClass('ratings_over');
					}
					$.ajax({
						url: "{{ url('blog/rate/ajax') }}",
						method: "POST",
						data: {
							_token: $('input[name="_token"]').val(),
							rating: star_rating,
							id_blog: id_blog,
							id_user: id_user
						},
						success: function (res) {
							console.log(res.success);
						},
					});
				}else{
					alert('Login to rate');
				}
		    });

			$('.btn-reply').click(function(e){
				var parentId = $(this).data('parent-id');
				// alert(parentId);
				$('#comment-form-'+parentId).slideToggle();
			});

			$('.btn-comment').click(function(e){
				// alert('tahnh cong');
				var checkLogin = '{{ Auth::Check() }}';
				if(!checkLogin){
					e.preventDefault();
					alert('Login to comment');
				}
		    });

			
		});
    </script>

	<!-- <script>
		$(document).ready(function() {
			$('.ratings_stars').click(function(e) { 
				e.preventDefault();

				var star_rating = $(this).find("input").val(); 
				var id_blog = $('input[name="id_blog"]').val(); 
				var id_user = $('input[name="id_user"]').val(); 

				console.log('Star rating:', star_rating); 
				console.log('Blog ID:', id_blog); 
				console.log('User ID:', id_user); 

				$.ajax({ 
					url: "{{ route('rating') }}", 
					method: "POST", 
					data: { 
						_token: $('input[name="_token"]').val(), 
						rating: star_rating, 
						id_blog: id_blog, 
						id_user: id_user 
					}, 
					success: function (res) { 
						console.log('Response:', res); // Để xem dữ liệu trả về sau khi POST
						alert('Đánh giá đã được cập nhật'); // Thông báo cho người dùng
					}, 
					error: function(xhr, status, error) {
						console.error('AJAX Error:', error); // Để debug lỗi AJAX
						alert('Có lỗi xảy ra khi cập nhật đánh giá'); // Thông báo lỗi cho người dùng
					}
				}); 
			});
		});

	</script> -->

@endsection