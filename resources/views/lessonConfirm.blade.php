@extends('layouts.template')
@section('content')
	<!-- top Products -->
	<div class="ads-grid_shop">
		<div class="shop_inner_inf">
			<div class="col-md-4 single-right-left ">
				<div class="grid images_3_of_2">
					<div class="flexslider">

						<!-- <ul class="slides">
							<li data-thumb="{{ asset(sprintf('images/%s', $lesson->instructor->img_file_name)) }}">
								<div class="thumb-image"> <img src="{{ asset(sprintf('images/%s', $lesson->instructor->img_file_name)) }}" data-imagezoom="true" class="img-responsive"> </div>
							</li>
							<li data-thumb="https://liff-danceticket.s3.ap-northeast-1.amazonaws.com/tmp/1/FdX4es2k0x46uSJpVRt8brYTNx2e7x7WAruIxAVo.jpeg">
								<div class="thumb-image"> <img src="https://liff-danceticket.s3.ap-northeast-1.amazonaws.com/tmp/1/FdX4es2k0x46uSJpVRt8brYTNx2e7x7WAruIxAVo.jpeg" data-imagezoom="true" class="img-responsive"> </div>
							</li>
							<li data-thumb="{{ asset('images/d3.jpg') }}">
								<div class="thumb-image"> <img src="{{ asset('images/d3.jpg') }}" data-imagezoom="true" class="img-responsive"> </div>
							</li>
						</ul> -->
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
				<p><span class="item_price">使用楽曲 : {{ $lesson->music ?? '未定' }}</span>
				<p><span class="item_price">レッスン価格 : ¥{{ number_format($lesson->price) }}</span>
				</p>
				<div class="responsive_tabs">
					<label class="control-label">上記のレッスンの申し込みを確定します。<br />
												確定後、お客様のご都合によりキャンセルされる場合、キャンセル料を申し受ける場合がございます。ご了承の上、確定処理を行ってください。</label>
				</div>
				<div class="clearfix"></div>
				<div class="occasion-cart">
					<div class="shoe single-item single_page_b">
						<form action="{{ url('lessonConfirm/submit') }}" method="post">
    						{{ csrf_field() }}
							<input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
							<input type="hidden" id="userId" name="user_id" value="">
							<input type="submit" name="submit" value="申込み確定"" class="button add">
						</form>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
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
@endsection('script')