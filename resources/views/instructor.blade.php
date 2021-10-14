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
							<form action="{{ url('instructor/submit') }}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input class="form-control" type="hidden" name="line_id" id="line_id" value="{{ $user->line_id }}">
								<section class="creditly-wrapper wthree, w3_agileits_wrapper">
									<div class="credit-card-wrapper">
										<div class="first-row form-group">
											<div class="controls">
												<label class="control-label">名前</label>
												<input class="form-control" type="text" name="name" id="name">
											</div>
											<div class="controls">
												<label class="control-label">性別</label>
												<select class="form-control" id="gender" name="gender">
													<option value="">-</option>
													<option value="0">男性</option>
													<option value="1">女性</option>
													<option value="2">その他</option>
												</select>
											</div>
											<div class="controls">
												<label class="control-label">年齢</label>
												<input class="form-control" type="text" name="age" id="age">
											</div>
											<div class="controls">
												<label class="control-label">自己紹介</label>
												<textarea name="introduction" required=""></textarea>
											</div>
											<div class="controls">
												<label class="control-label">経歴</label>
												<textarea name="career" required=""></textarea>
											</div>
											<div class="controls">
												<label class="control-label">TwitterID</label>
												<input class="form-control" type="text" name="twitter_id" id="twitter_id" value="">
											</div>
											<div class="controls">
												<label class="control-label">InstagramID</label>
												<input class="form-control" type="text" name="instagram_id" id="instagram_id" value="">
											</div>
											<div class="controls">
												<label class="control-label">画像</label>
												<input class="form-control" type="file" name="img_file_name" id="img_file_name">
											</div>
										</div>
										<button class="submit"><span>登録</span></button>
									</div>
								</section>
							</form>
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