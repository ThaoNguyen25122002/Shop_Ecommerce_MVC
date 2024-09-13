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
					<!-- @if(session('success'))
						<div class="alert alert-success" style="color: green;">
							{{ session('success') }}
						</div>
					@endif -->
						<h2 class="title text-center">Update Product</h2>
						@if(session('success'))
							<div class="alert alert-success" >
								{{ session('success') }}
							</div>
						@endif
						 <div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="{{ route('user.updateProduct', $product->id) }}" method="post" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<input type="text"  name="name" placeholder="Name" value="{{ $product->name }}" />
							@error('name')
                                            <span style="color: red">{{ $message }}</span>
                            @enderror
							<input type="number"  name="price" placeholder="Price" value="{{ $product->price }}"/>
							@error('price')
                                            <span style="color: red">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label class="col-sm-12">Select Category</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="id_category">
                                                <option value="">Chọn Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
											@error('id_category')
                                            <span style="color: red">{{ $message }}</span>
                            				@enderror
                                        </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Brand</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="id_brand">
                                                <option value="">Chọn Brand</option>
                                                @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
											@error('id_brand')
                                            <span style="color: red">{{ $message }}</span>
                            				@enderror
                                        </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Sale</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line" name="option">
                                                <option value="1">Chọn New</option>
                                                <option value="2">Chọn Sale</option>
                                            </select>
                                        </div>
                            </div>
                            <div class="col-sm-12 ">
                                <input type="number" name="discount_percentage" min="0" max="100"  value="{{ $product->discount_percentage }}" placeholder="0" style="max-width: 50px;display: inline;"><span>%</span>
                            </div>
							@error('discount_percentage')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
							<input type="text"  name="company" placeholder="company" value="{{ $product->company }}" />
							@error('company')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
							<input type="file" name="images[]" id="images" multiple>
							@error('images')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
							<!-- Khu vực thông báo lỗi -->
							<div id="error-message" style="color: red"></div>

							<!-- Khu vực hiển thị preview ảnh -->
                            <div  style="display: flex;column-gap: 10px">
								@foreach(json_decode($product->images) as $key => $image)
								<div >
									<img src="{{ asset('frontend/images/products/'.$image) }}" style="max-width: 100px;">
									<input type="checkbox" name="images_to_remove[]" value="{{ $image }}" style="display: block;">
								</div>
								@endforeach
							</div>
							<div id="preview"></div>
							<label for="description">Detail:</label>
							<textarea name="detail" placeholder="Detail" rows="4" cols="50">{{ $product->detail }}
							</textarea>
							@error('detail')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
							<button type="submit" class="btn btn-default">Update Product</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection


@section('jquery')

	<script>
		$(document).ready(function() {
			$('#images').change(function() {
				var files = this.files;
				var isValid = true;
				var errorMessages = [];

				$('#error-message').empty();
				$('#preview').empty();
				
				// Kiểm tra số lượng file
				if (files.length > 3) {
					errorMessages.push("Bạn chỉ có thể upload tối đa 3 hình ảnh.");
					isValid = false;
				}

				// Kiểm tra từng file
				$.each(files, function(i, file) {
					// Kiểm tra dung lượng
					if (file.size > 1048576) {
						errorMessages.push("File '" + file.name + "' vượt quá 1MB.");
						isValid = false;
					}
					// Kiểm tra định dạng file
					if (!file.type.match('image.*')) {
						errorMessages.push("File '" + file.name + "' không phải là hình ảnh.");
						isValid = false;
					}
				});

				// Hiển thị thông báo lỗi
				if (errorMessages.length > 0) {
					$('#error-message').html(errorMessages.join("<br>"));
				}

				// Nếu tất cả các file đều hợp lệ, xử lý và hiển thị preview
				if (isValid) {
					$.each(files, function(i, file) {
						var reader = new FileReader();

						reader.onload = function(e) {
							var img = $('<img>', {
								src: e.target.result,
								css: {
									'max-width': '100px',
									'margin-right': '10px'
								}
							}).appendTo('#preview');
						};

						reader.readAsDataURL(file);
					});
				}
			});
		});


	</script>


@endsection