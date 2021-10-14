@extends('layouts.template')
@section('style')
<style>
.line_button { 
  color: #EEE;
  font-size: 15px;
  background-color: #00C300;
  width: 50%
}

.line_button:hover {
  color: #EEEEE;
  background-color: #00E000
}

.line_button:active {
  background-color: #00B300
}
</style>
@endsection('style')
@section('content')
	<!-- top Products -->
	<div class="ads-grid_shop">
		<div class="shop_inner_inf">
			<div class="privacy about">
				<h3>登録 / ログイン</h3>
				<!--/tabs-->
				<div class="responsive_tabs">
					<label class="control-label">会員登録されていない場合、下記LINEでログインボタンで新規会員登録が行われます。</label>
				</div>
				<div class="responsive_tabs">
					<!--//tab_one-->
					<div class="line_button_area">
						<a href="{{ url('lineLogin') }}" id="line-button" class="btn btn-block btn-social line_button">
							<img src="{{ asset('images/btn_base.png') }}" />LINEでログイン
						</a>
					</div>
				</div>
				<!--//tabs-->
			</div>

		</div>
		<!-- //payment -->

		<div class="clearfix"></div>
			<div class="clearfix"> </div>
			<!-- /new_arrivals -->
			<!--//new_arrivals-->

		</div>
	</div>
	<!-- //top products -->
@endsection('content')