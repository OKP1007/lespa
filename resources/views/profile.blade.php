@extends('layouts.template')
@section('content')
	<!-- top Products -->
	<div class="ads-grid_shop">
		<div class="shop_inner_inf">
			<div class="privacy about">
				<h3>プロフィール</h3>
				<!--/tabs-->
				<div class="responsive_tabs">
					<div class="resp-tabs-container">
						<!--//tab_one-->
						<div class="pay_info">
							<form action="{{ url('profile/edit') }}" method="get" enctype="multipart/form-data">
								<section class="creditly-wrapper wthree, w3_agileits_wrapper">
									<div class="credit-card-wrapper">
										<div class="first-row form-group">
											<div class="controls">
												<label class="control-label">名前</label>
												<label>{{ $user->name }}</label>
											</div>
											<div class="controls">
												<label class="control-label">電話番号</label>
												<label>{{ $user->tel }}</label>
											</div>
											<div class="controls">
												<!-- <label class="control-label">画像</label> -->
												<!-- <input class="form-control" type="file" name="img_file_path_1" id="img_file_path_1"> -->
											</div>
										</div>
										<button class="submit"><span>編集</span></button>
									</div>
								</section>
							</form>
							<form action="{{ url('logout') }}" method="get" enctype="multipart/form-data">
								<button class="button add"><span>ログアウト</span></button>
							</form>
							@if (!empty($instructor))
								<form action="{{ url('instructor/edit') }}" method="get" enctype="multipart/form-data">
									<button class="button add"><span>インストラクター情報編集</span></button>
								</form>
							@else
								<form action="{{ url('instructor') }}" method="get" enctype="multipart/form-data">
									<button class="button add"><span>インストラクター登録</span></button>
								</form>
							@endif
						</div>
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