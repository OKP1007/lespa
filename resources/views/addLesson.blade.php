@extends('layouts.template')
@section('content')
	<!-- top Products -->
	<div class="ads-grid_shop">
		<div class="shop_inner_inf">
			<div class="privacy about">
				<h3>レッスン登録</h3>
				<!--/tabs-->
				<div class="responsive_tabs">
					<div class="resp-tabs-container">
						<!--//tab_one-->
						<div class="pay_info">
							<form action="{{ url('addLesson/create') }}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<section class="creditly-wrapper wthree, w3_agileits_wrapper">
									<div class="credit-card-wrapper">
										<div class="first-row form-group">
											<div class="controls">
												<label class="control-label">地域</label>
												<input class="form-control" type="text" name="area" id="area" value="">
											</div>
											<div class="controls">
												<label class="control-label">スタジオ</label>
												<input class="form-control" type="text" name="studio_id" id="studio_id" value="">
											</div>
											<div class="controls">
												<label class="control-label">ジャンル</label>
												<select class="form-control" type="select" name="genre_id" id="genre_id">
													@foreach($genres as $genre)
														<option value="{{ $genre->id }}">{{ $genre->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="controls">
												<label class="control-label">難易度</label>
												<select class="form-control" type="select" name="level_id" id="level_id">
													@foreach($levels as $level)
														<option value="{{ $level->id }}">{{ $level->name }}</option>
													@endforeach
												</select>
											</div>
											<div class="controls">
												<label class="control-label">価格</label>
												<input class="form-control" type="text" name="price" id="price" value="">
											</div>
											<div class="controls">
												<label class="control-label">レッスン日</label>
												<input class="form-control" type="date" name="lesson_date" id="lesson_date" value="">
											</div>
											<div class="controls">
												<label class="control-label">開始時刻</label>
												<input class="form-control" type="time" name="lesson_start_time" id="lesson_start_time" value="">
											</div>
											<div class="controls">
												<label class="control-label">終了時刻</label>
												<input class="form-control" type="time" name="lesson_end_time" id="lesson_end_time" value="">
											</div>
											<div class="controls">
												<label class="control-label">申し込み締め切り日</label>
												<input class="form-control" type="date" name="deadline_dt" id="deadline_dt" value="">
											</div>
											<div class="controls">
												<label class="control-label">人数上限</label>
												<input class="form-control" type="number" name="capacity" id="capacity" value="">
											</div>
											<div class="controls">
												<label class="control-label">概要</label>
												<textarea class="form-control" name="outline" id="outline"></textarea>
											</div>
											<div class="controls">
												<label class="control-label">画像</label>
												<input class="form-control" type="file" name="img_file_path_1" id="img_file_path_1">
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