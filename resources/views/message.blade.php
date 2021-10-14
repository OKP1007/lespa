@extends('layouts.template')
@section('content')
	<!-- top Products -->
	<div class="ads-grid_shop">
		<div class="shop_inner_inf">
			<div class="privacy about">
				<h3>{{ $title }}</h3>
				<!--/tabs-->
				<div class="responsive_tabs">
					<div class="resp-tabs-container">
						<!--//tab_one-->
						<div class="pay_info">
							<section class="creditly-wrapper wthree, w3_agileits_wrapper">
								<div class="credit-card-wrapper">
									<div class="first-row form-group">
										<div class="controls">
											<label>{{ $message }}</label>
										</div>
									</div>
								</div>
							</section>
							<form action="{{ url('/') }}" method="get" enctype="multipart/form-data">
								<button class="submit"><span>TOPへ戻る</span></button>
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