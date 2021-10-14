@extends('layouts.template')
@section('content')
	<!-- top Products -->
	<div class="ads-grid_shop">
		<div class="shop_inner_inf">
			<div class="col-md-4 single-right-left ">
				<div class="grid images_3_of_2">
					<div class="flexslider">
						@if ($lesson->img_file_path_1 != '')
							<div class="thumb-image">
								<img src="{{ asset($lesson->img_file_path_1) }}" data-imagezoom="true" class="img-responsive">
							</div>
						@else
							@if ($lesson->instructor->img_file_name != '')
							<div class="thumb-image">
								<img src="{{ $lesson->instructor->img_file_name }}" data-imagezoom="true" class="img-responsive">
							</div>
							@endif
						@endif
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="col-md-8 single-right-left simpleCart_shelfItem">
				<h3>講師名：{{ $lesson->instructor->name }} ({{ $lesson->genre->name }})</h3>
				<p>
					<span class="item_price">開催日 : {{ \Carbon\Carbon::parse($lesson->lesson_start_dt)->format('Y年m月d日') }}</span>
					<span class="item_price">　　　　　{{ \Carbon\Carbon::parse($lesson->lesson_start_dt)->format('H:i') }} ~ {{ \Carbon\Carbon::parse($lesson->lesson_end_dt)->format('H:i') }}</span>
				</p>
				<p><span class="item_price">使用楽曲 : {{ $lesson->music ?? '未定' }}</span></p>
				<p><span class="item_price">レッスン価格 : ¥{{ number_format($lesson->price) }}</span></p>
				<p><span class="item_price">参加人数 : {{ number_format($lessonCount) }} / {{ number_format($lesson->capacity) }} 人</span>
				</p>
				<!-- <div class="rating1">
					<ul class="stars">
						<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
						<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
					</ul>
				</div> -->
			<!--/tabs-->
			<div class="responsive_tabs">
				<div id="horizontalTab">
					<ul class="resp-tabs-list">
						<li>レッスン概要</li>
						<li>講師紹介</li>
						<li>経歴</li>
						<!-- @if ($lesson->insta_url)
							<li>Instagram</li>
						@endif -->
						<!-- @if ($lesson->youtube_url)
							<li>Youtube</li>
						@endif -->
					</ul>
					<div class="resp-tabs-container">
						<!--/tab_one-->
						<div class="tab1">

							<div class="single_page">
								<!-- <h6></h6> -->
								<p>{!! nl2br(e($lesson->outline)) !!}</p>
							</div>
						</div>
						<!--//tab_one-->
						<div class="tab2">
							<div class="single_page">
								<!-- <h6></h6> -->
								<p>{!! nl2br(e($lesson->instructor->introduction)) !!}</p>
							</div>
						</div>
						<div class="tab３">

							<div class="single_page">
								<!-- <h6></h6> -->
								<p>{!! nl2br(e($lesson->instructor->career)) !!}</p>
							</div>
						</div>
						<!-- @if ($lesson->insta_url)
						<div class="tab4">
							<div class="single_page">
								<div class="youtube">
									<iframe width="90%" height="90%" src="{{ $lesson->insta_url }}" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>
						</div>
						@endif -->
						<!-- @if ($lesson->youtube_url)
						<div class="tab5">
							<div class="single_page">
								<div class="youtube">
								
								<iframe width="560" height="315" src="{{ e(htmlspecialchars($lesson->youtube_url, ENT_QUOTES, 'UTF-8')) }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								<iframe width="90%" height="90%" src="{{ $lesson->youtube_url }}" frameborder="0" allowfullscreen></iframe>
								</div>
							</div>
						</div>
						@endif -->
					</div>
				</div>
			</div>
			<!--//tabs-->
				<!-- <div class="description">
					<h5>Check delivery, payment options and charges at your location</h5>
					<form action="#" method="post">
						<input type="text" value="Enter pincode" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter pincode';}"
						    required="">
						<input type="submit" value="Check">
					</form>
				</div>
				<div class="color-quality">
					<div class="color-quality-right">
						<h5>Quality :</h5>
						<select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
								<option value="null">5 Qty</option>
								<option value="null">6 Qty</option> 
								<option value="null">7 Qty</option>					
								<option value="null">10 Qty</option>								
							</select>
					</div>
				</div> -->
				<!-- <div class="occasional">
					<h5>Types :</h5>
					<div class="colr ert">
						<label class="radio"><input type="radio" name="radio" checked=""><i></i>Casual Shoes</label>
					</div>
					<div class="colr">
						<label class="radio"><input type="radio" name="radio"><i></i>Sneakers </label>
					</div>
					<div class="colr">
						<label class="radio"><input type="radio" name="radio"><i></i>Formal Shoes</label>
					</div>
					<div class="clearfix"> </div> -->
				<!-- </div> -->
				<div class="occasion-cart">
					@if ($isInstructor)
						<div class="shoe single-item single_page_b" id="cancelButtonArea">
							<form action="{{ url('lessonEdit') }}" method="get"">
								<input type="submit" name="submit" value="編集する" class="button add">
								<!-- <a href="#" data-toggle="modal" data-target="#myModal1"></a> -->
							</form>
						</div>
					@else
						@if (!isset($status) || $status == 0)
						<div class="shoe single-item single_page_b" id="confirmButtonArea">
							<form action="{{ url('lessonConfirm') }}" method="post">
								{{ csrf_field() }}
								<input type="hidden" name="user_id" value="">
								<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
								<input type="submit" name="submit" value="受講申込み" class="button add">

								<!-- <a href="#" data-toggle="modal" data-target="#myModal1"></a> -->
							</form>
						</div>
						@elseif ($status == 1)
						<div class="shoe single-item single_page_b" id="cancelButtonArea">
							<form action="{{ url('lessonCancelConfirm') }}" method="post">
								{{ csrf_field() }}
								<input type="hidden" name="user_id" value="">
								<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
								<input type="submit" name="submit" value="キャンセル" class="button add">

								<!-- <a href="#" data-toggle="modal" data-target="#myModal1"></a> -->
							</form>
						</div>
						@elseif ($status == 2)
						<div class="shoe single-item single_page_b" id="cancelButtonArea">
							<form action="{{ url('/') }}" method="get"">
								<input type="submit" name="submit" value="キャンセル済です" class="button add">
								<!-- <a href="#" data-toggle="modal" data-target="#myModal1"></a> -->
							</form>
						</div>
						@endif
					@endif
				</div>
				<ul class="social-nav model-3d-0 footer-social social single_page">
					<li class="share">Share On : </li>
					<li>
						<a href="#" class="facebook">
							<div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
							<div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div>
						</a>
					</li>
					<li>
						<a href="#" class="twitter">
							<div class="front"><i class="fa fa-twitter" aria-hidden="true"></i></div>
							<div class="back"><i class="fa fa-twitter" aria-hidden="true"></i></div>
						</a>
					</li>
					<li>
						<a href="#" class="instagram">
							<div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
							<div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div>
						</a>
					</li>
				</ul>

			</div>
			<div class="clearfix"> </div>
			<!-- /new_arrivals -->
			<!-- <div class="new_arrivals">
				<h3>Featured Products</h3> -->
				<!-- /womens -->
				<!-- <div class="col-md-3 product-men women_two">
					<div class="product-shoe-info shoe">
						<div class="men-pro-item">
							<div class="men-thumb-item">
								<img src="{{ asset('images/s4.jpg') }}" alt="">
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="single.html" class="link-product-add-cart">Quick View</a>
									</div>
								</div>
								<span class="product-new-top">New</span>
							</div>
							<div class="item-info-product">
								<h4>
									<a href="single.html">Shuberry Heels </a>
								</h4>
								<div class="info-product-price">
									<div class="grid_meta">
										<div class="product_price">
											<div class="grid-price ">
												<span class="money ">$575.00</span>
											</div>
										</div>
										<ul class="stars">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
										</ul>
									</div>
									<div class="shoe single-item hvr-outline-out">
										<form action="#" method="post">
											<input type="hidden" name="cmd" value="_cart">
											<input type="hidden" name="add" value="1">
											<input type="hidden" name="shoe_item" value="Shuberry Heels">
											<input type="hidden" name="amount" value="575.00">
											<button type="submit" class="shoe-cart pshoe-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>

											<a href="#" data-toggle="modal" data-target="#myModal1"></a>
										</form>

									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 product-men women_two">
					<div class="product-shoe-info shoe">
						<div class="men-pro-item">
							<div class="men-thumb-item">
								<img src="{{ asset('images/s5.jpg') }}" alt="">
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="single.html" class="link-product-add-cart">Quick View</a>
									</div>
								</div>
								<span class="product-new-top">New</span>
							</div>
							<div class="item-info-product">
								<h4>
									<a href="single.html">Red Bellies </a>
								</h4>
								<div class="info-product-price">
									<div class="grid_meta">
										<div class="product_price">
											<div class="grid-price ">
												<span class="money ">$325.00</span>
											</div>
										</div>
										<ul class="stars">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
										</ul>
									</div>
									<div class="shoe single-item hvr-outline-out">
										<form action="#" method="post">
											<input type="hidden" name="cmd" value="_cart">
											<input type="hidden" name="add" value="1">
											<input type="hidden" name="shoe_item" value="Red Bellies">
											<input type="hidden" name="amount" value="325.00">
											<button type="submit" class="shoe-cart pshoe-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>

											<a href="#" data-toggle="modal" data-target="#myModal1"></a>
										</form>

									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 product-men women_two">
					<div class="product-shoe-info shoe">
						<div class="men-pro-item">
							<div class="men-thumb-item">
								<img src="{{ asset('images/s7.jpg') }}" alt="">
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="single.html" class="link-product-add-cart">Quick View</a>
									</div>
								</div>
								<span class="product-new-top">New</span>
							</div>
							<div class="item-info-product">
								<h4>
									<a href="single.html">Running Shoes</a>
								</h4>
								<div class="info-product-price">
									<div class="grid_meta">
										<div class="product_price">
											<div class="grid-price ">
												<span class="money ">$875.00</span>
											</div>
										</div>
										<ul class="stars">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
										</ul>
									</div>
									<div class="shoe single-item hvr-outline-out">
										<form action="#" method="post">
											<input type="hidden" name="cmd" value="_cart">
											<input type="hidden" name="add" value="1">
											<input type="hidden" name="shoe_item" value="Running Shoes">
											<input type="hidden" name="amount" value="875.00">
											<button type="submit" class="shoe-cart pshoe-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>

											<a href="#" data-toggle="modal" data-target="#myModal1"></a>
										</form>

									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 product-men women_two">
					<div class="product-shoe-info shoe">
						<div class="men-pro-item">
							<div class="men-thumb-item">
								<img src="{{ asset('images/s8.jpg') }}" alt="">
								<div class="men-cart-pro">
									<div class="inner-men-cart-pro">
										<a href="single.html" class="link-product-add-cart">Quick View</a>
									</div>
								</div>
								<span class="product-new-top">New</span>
							</div>
							<div class="item-info-product">
								<h4>
									<a href="single.html">Sukun Casuals</a>
								</h4>
								<div class="info-product-price">
									<div class="grid_meta">
										<div class="product_price">
											<div class="grid-price ">
												<span class="money ">$505.00</span>
											</div>
										</div>
										<ul class="stars">
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
										</ul>
									</div>
									<div class="shoe single-item hvr-outline-out">
										<form action="#" method="post">
											<input type="hidden" name="cmd" value="_cart">
											<input type="hidden" name="add" value="1">
											<input type="hidden" name="shoe_item" value="Sukun Casuals">
											<input type="hidden" name="amount" value="505.00">
											<button type="submit" class="shoe-cart pshoe-cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>

											<a href="#" data-toggle="modal" data-target="#myModal1"></a>
										</form>

									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div> -->

				<!-- //womens -->
				<!-- <div class="clearfix"></div>
			</div> -->
			<!--//new_arrivals-->


		</div>
	</div>
	<!-- //top products -->
@endsection('content')
@section('script')
	<script>
		//<![CDATA[ 
		$(window).load(function () {
			var userId = localStorage.getItem('userId');
			if (userId != null) {
				$('#userId').val(userId);
			}
		}); //]]>
	</script>
	<!-- //price range (top products) -->
@endsection('script')