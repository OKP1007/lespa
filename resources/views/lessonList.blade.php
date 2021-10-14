@extends('layouts.template')
@section('style')
@endsection('style')
@section('content')
	<!-- top Products -->
	<div class="ads-grid_shop">
		<div class="shop_inner_inf">
			<!-- tittle heading -->

			<!-- //tittle heading -->
			<!-- product left -->
			<div class="side-bar col-md-3">
				<form action="{{ url('lessonList/search') }}" method="GET">
					<div class="search-hotel">
						<h3 class="agileits-sear-head">レッスン検索</h3>
						<input type="instractorName" class="form-control" placeholder="講師名" name="instractorName" value="{{ isset($request) ? $request->instractorName : '' }}">
					</div>
					<!-- price range -->
					<div class="range">
						<h3 class="agileits-sear-head">価格帯</h3>
						<ul class="dropdown-menu6">
							<li>
								<div id="slider-range"></div>
								<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
								<input type="hidden" id="priceRangeLow" name="priceRangeLow"/>
								<input type="hidden" id="priceRangeHigh" name="priceRangeHigh"/>
							</li>
						</ul>
					</div>
					<!-- //price range -->
					<!-- area -->
					<div class="left-side">
						<h3 class="agileits-sear-head">エリア</h3>
						<input type="text" class="form-control" placeholder="地域" name="area" value="{{ isset($request) ? $request->area : '' }}">
					</div>
					<!-- //area -->
					<!--ジャンル -->
					<div class="left-side">
						<h3 class="agileits-sear-head">ジャンル</h3>
						<select class="form-control" type="select" name="genreId" id="genreId">
							<option value="">--</option>
							@foreach($genres as $genre)
								<option value="{{ $genre->id }}" {{ isset($request) ? ($genre->id == $request->genreId ? 'selected' : '') : '' }}>{{ $genre->name }}</option>
							@endforeach
						</select>
					</div>
					<!-- // ジャンル -->
					<!-- 難易度 -->
					<div class="left-side">
						<h3 class="agileits-sear-head">難易度</h3>
						<select class="form-control" type="select" name="levelId" id="levelId">
							<option value="">--</option>
							@foreach($levels as $level)
								<option value="{{ $level->id }}" {{ isset($request) ? ($level->id == $request->levelId ? 'selected' : '') : '' }}>{{ $level->name }}</option>
							@endforeach
						</select>
					</div>
					<!-- //難易度 -->
					<!-- 開催日 -->
					<div class="left-side">
						<h3 class="agileits-sear-head">開催日</h3>
						<input type='date' class="form-control" name="lessonDate" id="lessonDate" value="{{ isset($request) ? $request->lessonDate : '' }}"/>
					</div>
					<!-- //開催日 -->
					<div class="left-side">
						<input type="submit" value=" 検 索 ">
					</div>
				</form>
				<!-- deals -->
				<!-- <div class="deal-leftmk left-side">
					<h3 class="agileits-sear-head">Special Deals</h3>
					<div class="special-sec1">
						<div class="col-xs-4 img-deals">
							<img src="images/s4.jpg" alt="">
						</div>
						<div class="col-xs-8 img-deal1">
							<h3>Shuberry Heels</h3>
							<a href="single.html">$180.00</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="special-sec1">
						<div class="col-xs-4 img-deals">
							<img src="images/s2.jpg" alt="">
						</div>
						<div class="col-xs-8 img-deal1">
							<h3>Chikku Loafers</h3>
							<a href="single.html">$99.00</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="special-sec1">
						<div class="col-xs-4 img-deals">
							<img src="images/s1.jpg" alt="">
						</div>
						<div class="col-xs-8 img-deal1">
							<h3>Bella Toes</h3>
							<a href="single.html">$165.00</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="special-sec1">
						<div class="col-xs-4 img-deals">
							<img src="images/s5.jpg" alt="">
						</div>
						<div class="col-xs-8 img-deal1">
							<h3>Red Bellies</h3>
							<a href="single.html">$225.00</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="special-sec1">
						<div class="col-xs-4 img-deals">
							<img src="images/s3.jpg" alt="">
						</div>
						<div class="col-xs-8 img-deal1">
							<h3>(SRV) Sneakers</h3>
							<a href="single.html">$169.00</a>
						</div>
						<div class="clearfix"></div>
					</div>
				</div> -->
				<!-- //deals -->

			</div>
			<!-- //product left -->
			<!-- product right -->
			<div class="left-ads-display col-md-9">
				<div class="wrapper_top_shop">
					<div class="col-md-6 shop_left">
						<img src="{{ asset('images/feature-clip3.jpg') }}" alt="">
						<h6>初心者向け</h6>
					</div>
					<div class="col-md-6 shop_right">
						<img src="{{ asset('images/feature-clip5.jpg') }}" alt="">
						<h6>ワークショップ</h6>
					</div>
					<div class="clearfix"></div>
					<!-- product-sec1 -->
					<div class="product-sec1">
						@foreach ($lessons as $lesson)
						<!--/mens-->
						<a href="{{ sprintf('/lesson/%s', $lesson->url_token) }}">
							<div class="col-md-12 col-sm-12 col-xs-12 product-men">
								<div class="product-shoe-info shoe">
									<div class="men-pro-item">
										<div class="col-md-3 col-sm-3 col-xs-12 men-thumb-item">
											<img src="{{ $lesson->instructor->img_file_name }}" alt="">
											<!-- <div class="men-cart-pro">
												<div class="inner-men-cart-pro">
													<a href="{{ sprintf('/lesson/%s', $lesson->id) }}" class="link-product-add-cart">Quick View</a>
												</div>
											</div> -->
											<span class="product-new-top">{{ $lesson->genre->name }}</span>
										</div>
										<div class="col-md-9 col-sm-9 col-xs-12 item-info-product">
											<h4>
												{{ $lesson->instructor->name }}
											</h4>
											<div class="info-product-price">
												<div class="grid_meta">
													<div class="product_price">
														<div class="grid-price ">
															<span class="money ">{{ \Carbon\Carbon::parse($lesson->lesson_start_dt)->format('Y年m月d日') }}</span>
															<span class="money ">{{ \Carbon\Carbon::parse($lesson->lesson_start_dt)->format('H:i') }} ~ {{ \Carbon\Carbon::parse($lesson->lesson_end_dt)->format('H:i') }}</span>
														</div>
													</div>
													<div class="product_price">
														<div class="grid-price ">
															<span class="money ">¥{{ number_format($lesson->price) }}</span>
														</div>
													</div>
													<div class="product_price">
														<div class="grid-price ">
															<span class="money ">{{ $lesson->level->name }}</span>
														</div>
													</div>
												</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</a>
						@endforeach
					</div>
					<!-- //product-sec1 -->
					<!-- <div class="col-md-6 shop_left shp">
						<img src="images/banner4.jpg" alt="">
						<h6>21% off</h6>
					</div>
					<div class="col-md-6 shop_right shp">
						<img src="images/banner1.jpg" alt="">
						<h6>31% off</h6>
					</div> -->
					<div class="clearfix"></div>
					<div class="paginate">
						{{ $lessons->appends(request()->input())->links() }}
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
@endsection('content')
@section('script')
	<!-- price range (top products) -->
	<script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script>
		//<![CDATA[ 
		$(window).load(function () {
			$("#slider-range").slider({
				range: true,
				min: 0,
				max: 5000,
				step: 100,
				values: [{{ $request->priceRangeLow ?? 0 }}, {{ $request->priceRangeHigh ?? 3000 }}],
				slide: function (event, ui) {
					$("#amount").val("¥" + ui.values[0] + " - ¥" + ui.values[1]);
					$("#priceRangeLow").val(ui.values[0]);
					$("#priceRangeHigh").val(ui.values[1]);
				}
			});
			$("#amount").val("¥" + $("#slider-range").slider("values", 0) + " - ¥" + $("#slider-range").slider("values", 1));
			$("#priceRangeLow").val($("#slider-range").slider("values", 0));
			$("#priceRangeHigh").val($("#slider-range").slider("values", 1));
		}); //]]>
	</script>
	<!-- //price range (top products) -->
@endsection('script')