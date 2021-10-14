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
							<form action="{{ url('profile/update') }}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<section class="creditly-wrapper wthree, w3_agileits_wrapper">
									<div class="credit-card-wrapper">
										<div class="first-row form-group">
											<div class="controls">
												<label class="control-label">名前</label>
												<input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
											</div>
											<div class="controls">
												<label class="control-label">電話番号</label>
												<input class="form-control" type="text" name="tel" id="tel" value="{{ $user->tel }}">
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