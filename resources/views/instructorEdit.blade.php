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
							<form action="{{ url('instructor/update') }}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<section class="creditly-wrapper wthree, w3_agileits_wrapper">
									<div class="credit-card-wrapper">
										<div class="first-row form-group">
											<div class="controls">
												<label class="control-label">名前</label>
												<input class="form-control" type="text" name="name" id="name" value="{{ $instructor->name }}">
											</div>
											<!-- <div class="controls">
												<label class="control-label">性別</label>
												<select class="form-control" id="gender" name="gender">
													<option value="">-</option>
													<option value="0">男性</option>
													<option value="1">女性</option>
													<option value="2">その他</option>
												</select>
											</div> -->
											<div class="controls">
												<label class="control-label">年齢</label>
												<input class="form-control" type="text" name="age" id="age" value="{{ $instructor->age }}">
											</div>
											<div class="controls">
												<label class="control-label">自己紹介</label>
											</div>
											<div class="controls">
												<textarea name="introduction" required="">{{ $instructor->introduction }}</textarea>
											</div>
											<div class="controls">
												<label class="control-label">経歴</label>
											</div>
											<div class="controls">	
												<textarea name="career" required="">{{ $instructor->career }}</textarea>
											</div>
											<div class="controls">
												<label class="control-label">TwitterID</label>
												<input class="form-control" type="text" name="twitter_id" id="twitter_id" value="{{ $instructor->twitter_id }}">
											</div>
											<div class="controls">
												<label class="control-label">InstagramID</label>
												<input class="form-control" type="text" name="instagram_id" id="instagram_id" value="{{ $instructor->instagram_id }}">
											</div>
											<div class="controls">
												<label class="control-label">画像</label>
												<input class="form-control" type="file" name="img_file_name" id="img_file_name" accept="image/*">
												<img id="preview" style="width:60%; height:60%">
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

@section('script')
	<script>
		$('#img_file_name').on('change', function (e) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$("#preview").attr('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files[0]);
		});
	</script>
@endsection('script')