@extends('layouts.app')

@section('pageCss')
<link href="https://cdn.jsdelivr.net/npm/wickedpicker@0.4.3/dist/wickedpicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/store/basic/basic.css">
@endsection

@section('content')
<div class="container">
	<div class="raw">
		<div class="col-sm-12 col-md-10 change_position">
			<div class="store_info">
				@if ($errors->any())
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
				<form method="post" action="{{'/store/basic/update'}}" enctype="multipart/form-data" name="post_basic">
					{{ csrf_field() }}
					<div class="opened_switch_position">
						<p>
							クーポン表示切替スイッチ
							<br>
							<br>
							臨時休業などの場合はこちらのスイッチをオフにして下さい。
							全てのクーポンが非表示になります。
							<br>
							営業開始時にスイッチをオンにして下さい。
							最下部の「保存・更新」で反映されます。
						</p>
						@isset($shop)
						@if ($shop->opened == 0)
						<div class="toggle-switch">
							<input id="toggle" class="toggle-input" type='checkbox' name="opened">
							<label for="toggle" class="toggle-label"></label>
						</div>
						@else
						<div class="toggle-switch">
							<input id="toggle" class="toggle-input" type='checkbox' name="opened" checked="checked">
							<label for="toggle" class="toggle-label"></label>
						</div> 
						@endif	
						@endisset
					</div>
					<div class="store_info_border">
						<div class="store_info_content">
							<label class="required">営業時間</label>
							<div class="time_blocks">
								<div class="time_block_1">
									<div class="selecting_days">
										<div class="select_day">
											@if ($time3 == null)
												@if ($time2 == null)
												<label>月</label><input type="checkbox" class="Monday week" name="monday1" id="Monday1" checked>
												@else
													@if ($time2->monday == 1)
													<label>月</label><input type="checkbox" class="Monday week" name="monday1" id="Monday1" checked>	
													@else
													<label>月</label><input type="checkbox" class="Monday week" name="monday1" id="Monday1">	
													@endif
												@endif
											@else
												@if ($time1->monday == 1)
												<label>月</label><input type="checkbox" class="Monday week" name="monday1" id="Monday1" checked>	
												@else
												<label>月</label><input type="checkbox" class="Monday week" name="monday1" id="Monday1">	
												@endif
											@endif
										</div>
										<div class="select_day">
											@if ($time1 == null)
												@if ($time2 == null)
												<label>火</label><input type="checkbox" class="Tsuesday week" name="tsuesday1" id="Tsuesday1" checked>
												@else
													@if ($time2->tsuesday == 1)
													<label>火</label><input type="checkbox" class="Tsuesday week" name="tsuesday1" id="Tsuesday1" checked>	
													@else
													<label>火</label><input type="checkbox" class="Tsuesday week" name="tsuesday1" id="Tsuesday1">
													@endif
												@endif
											@else
												@if ($time1->tsuesday == 1)
												<label>火</label><input type="checkbox" class="Tsuesday week" name="tsuesday1" id="Tsuesday1" checked>
												@else
												<label>火</label><input type="checkbox" class="Tsuesday week" name="tsuesday1" id="Tsuesday1">
												@endif
											@endif
										</div>
										<div class="select_day">
											@if ($time1 == null)
												@if ($time2 == null)
												<label>水</label><input type="checkbox" class="Wednesday week" name="wednesday1" id="Wednesday1" checked>
												@else
													@if ($time2->wednesday == 1)
													<label>水</label><input type="checkbox" class="Wednesday week" name="wednesday1" id="Wednesday1" checked>
													@else
													<label>水</label><input type="checkbox" class="Wednesday week" name="wednesday1" id="Wednesday1">
													@endif
												@endif
											@else
												@if ($time1->wednesday == 1)
												<label>水</label><input type="checkbox" class="Wednesday week" name="wednesday1" id="Wednesday1" checked>
												@else
												<label>水</label><input type="checkbox" class="Wednesday week" name="wednesday1" id="Wednesday1">
												@endif
											@endif
										</div>
										<div class="select_day">
											@if ($time1 == null)
												@if ($time2 == null)
												<label>木</label><input type="checkbox" class="Thursday week" name="thursday1" id="Thursday1" checked>
												@else
													@if ($time2->thursday == 1)
													<label>木</label><input type="checkbox" class="Thursday week" name="thursday1" id="Thursday1" checked>
													@else
													<label>木</label><input type="checkbox" class="Thursday week" name="thursday1" id="Thursday1">
													@endif
												@endif
											@else
												@if ($time1->thursday == 1)
												<label>木</label><input type="checkbox" class="Thursday week" name="thursday1" id="Thursday1" checked>
												@else
												<label>木</label><input type="checkbox" class="Thursday week" name="thursday1" id="Thursday1">
												@endif
											@endif
										</div>
										<div class="select_day">
											@if ($time1 == null)
												@if ($time2 == null)
												<label>金</label><input type="checkbox" class="Friday week" name="friday1" id="Friday1" checked>
												@else
													@if ($time2->friday == 1)
													<label>金</label><input type="checkbox" class="Friday week" name="friday1" id="Friday1" checked>
													@else
													<label>金</label><input type="checkbox" class="Friday week" name="friday1" id="Friday1">
													@endif
												@endif
											@else
												@if ($time1->friday == 1)
												<label>金</label><input type="checkbox" class="Friday week" name="friday1" id="Friday1" checked>
												@else
												<label>金</label><input type="checkbox" class="Friday week" name="friday1" id="Friday1">
												@endif
											@endif
										</div>
										<div class="select_day">
											@if ($time1 == null)
												@if ($time2 == null)
												<label>土</label><input type="checkbox" class="Saturday week" name="saturday1" id="Saturday1" checked>
												@else
													@if ($time2->saturday == 1)
													<label>土</label><input type="checkbox" class="Saturday week" name="saturday1" id="Saturday1" checked>
													@else
													<label>土</label><input type="checkbox" class="Saturday week" name="saturday1" id="Saturday1">
													@endif
												@endif
											@else
												@if ($time1->saturday == 1)
												<label>土</label><input type="checkbox" class="Saturday week" name="saturday1" id="Saturday1" checked>
												@else
												<label>土</label><input type="checkbox" class="Saturday week" name="saturday1" id="Saturday1">
												@endif
											@endif
										</div>
										<div class="select_day">
											@if ($time1 == null)
												@if ($time2 == null)
												<label>日</label><input type="checkbox" class="Sunday week" name="sunday1" id="Sunday1" checked>
												@else
													@if ($time2->sunday == 1)
													<label>日</label><input type="checkbox" class="Sunday week" name="sunday1" id="Sunday1" checked>
													@else
													<label>日</label><input type="checkbox" class="Sunday week" name="sunday1" id="Sunday1">
													@endif
												@endif
											@else
												@if ($time1->sunday == 1)
												<label>日</label><input type="checkbox" class="Sunday week" name="sunday1" id="Sunday1" checked>
												@else
												<label>日</label><input type="checkbox" class="Sunday week" name="sunday1" id="Sunday1" >
												@endif
											@endif
											
										</div>
									</div>
									<div class="left_time_block">
										<label>開始時間(昼)</label>
										@if ($time1 != null)
										<input type="time" name="first_start_time" step="1800" value="{{$time1->start_time}}" placeholder="11:00" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@else
										<input type="time" name="first_start_time" step="1800" value="" placeholder="11:00" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@endif
										<label>開始時間(夜)</label>
										@if ($time2 != null)
										<input type="time" name="second_start_time" step="1800" value="{{$time2->start_time}}"  placeholder="17:00" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@else
										<input type="time" name="second_start_time" step="1800" value="" placeholder="17:00" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@endif

									</div>
									<div class="right_time_block">
										<label >終了時間</label>
										@if ($time1 != null)
										<input type="time" name="first_end_time" step="1800" value="{{$time1->end_time}}" placeholder="13:30" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@else
										<input type="time" name="first_end_time" step="1800" value="" placeholder="13:30" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@endif
										<div class="clear_button_block">
											<input type="button" id="clear_1" value="クリア">
										</div>
										<label>終了時間</label>
										@if ($time2 != null)
										<input type="time" name="second_end_time" step="1800" value="{{$time2->end_time}}" placeholder="23:30" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@else
										<input type="time" name="second_end_time" step="1800" value="" placeholder="23:30" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@endif
										<div class="clear_button_block">
											<input type="button" id="clear_2" value="クリア">
										</div>
									</div>
								</div>
								<div class="time_block_2">
									<div class="selecting_days">
										<div class="select_day is_monday_selected">
											@if ($time3 == null)
												@if ($time4 == null)
												<label>月</label><input type="checkbox" class="Monday2" name="monday2">
												@else
													@if ($time4->monday == 1)
													<label>月</label><input type="checkbox" class="Monday2" name="monday2" checked>
													@else
													<label>月</label><input type="checkbox" class="Monday2" name="monday2">
													@endif
												@endif
											@else
												@if ($time3->monday == 1)
												<label>月</label><input type="checkbox" class="Monday2" name="monday2" checked>
												@else
												<label>月</label><input type="checkbox" class="Monday2" name="monday2">
												@endif
											@endif
										</div>
										<div class="select_day is_tsuesday_selected">
											@if ($time3 == null)
												@if ($time4 == null)
												<label>火</label><input type="checkbox" class="Tsuesday2" name="tsuesday2">
												@else
													@if ($time4->tsuesday == 1)
													<label>火</label><input type="checkbox" class="Tsuesday2" name="tsuesday2" checked>
													@else
													<label>火</label><input type="checkbox" class="Tsuesday2" name="tsuesday2">
													@endif
												@endif
											@else
												@if ($time3->tsuesday == 1)
												<label>火</label><input type="checkbox" class="Tsuesday2" name="tsuesday2" checked>
												@else
												<label>火</label><input type="checkbox" class="Tsuesday2" name="tsuesday2">
												@endif
											@endif
										</div>
										<div class="select_day is_wednesday_selected">
											@if ($time3 == null)
												@if ($time4 == null)
												<label>水</label><input type="checkbox" class="Wednesday2" name="wednesday2">
												@else
													@if ($time4->wednesday == 1)
													<label>水</label><input type="checkbox" class="Wednesday2" name="wednesday2" checked>
													@else
													<label>水</label><input type="checkbox" class="Wednesday2" name="wednesday2">
													@endif
												@endif
											@else
												@if ($time3->wednesday == 1)
												<label>水</label><input type="checkbox" class="Wednesday2" name="wednesday2" checked>
												@else
												<label>水</label><input type="checkbox" class="Wednesday2" name="wednesday2">
												@endif
											@endif
										</div>
										<div class="select_day is_thursday_selected">
											@if ($time3 == null)
												@if ($time4 == null)
												<label>木</label><input type="checkbox" class="Thursday2" name="thursday2">
												@else
													@if ($time4->thursday == 1)
													<label>木</label><input type="checkbox" class="Thursday2" name="thursday2" checked>
													@else
													<label>木</label><input type="checkbox" class="Thursday2" name="thursday2">
													@endif
												@endif
											@else
												@if ($time3->thursday == 1)
												<label>木</label><input type="checkbox" class="Thursday2" name="thursday2" checked>
												@else
												<label>木</label><input type="checkbox" class="Thursday2" name="thursday2">
												@endif
											@endif
										</div>
										<div class="select_day is_friday_selected">
											@if ($time3 == null)
												@if ($time4 == null)
												<label>金</label><input type="checkbox" class="Friday2" name="friday2">
												@else
													@if ($time4->friday == 1)
													<label>金</label><input type="checkbox" class="Friday2" name="friday2" checked>
													@else
													<label>金</label><input type="checkbox" class="Friday2" name="friday2">
													@endif
												@endif
											@else
												@if ($time3->friday == 1)
												<label>金</label><input type="checkbox" class="Friday2" name="friday2" checked>
												@else
												<label>金</label><input type="checkbox" class="Friday2" name="friday2">
												@endif
											@endif
										</div>
										<div class="select_day is_saturday_selected">
											@if ($time3 == null)
												@if ($time4 == null)
												<label>土</label><input type="checkbox" class="Saturday2" name="saturday2">
												@else
													@if ($time4->saturday == 1)
													<label>土</label><input type="checkbox" class="Saturday2" name="saturday2" checked>
													@else
													<label>土</label><input type="checkbox" class="Saturday2" name="saturday2">
													@endif
												@endif
											@else
												@if ($time3->saturday == 1)
												<label>土</label><input type="checkbox" class="Saturday2" name="saturday2" checked>
												@else
												<label>土</label><input type="checkbox" class="Saturday2" name="saturday2">
												@endif
											@endif
										</div>
										<div class="select_day is_sunday_selected">
											@if ($time3 == null)
												@if ($time4 == null)
												<label>日</label><input type="checkbox" class="Sunday2" name="sunday2">
												@else
													@if ($time4->sunday == 1)
													<label>日</label><input type="checkbox" class="Sunday2" name="sunday2" checked>
													@else
													<label>日</label><input type="checkbox" class="Sunday2" name="sunday2">
													@endif
												@endif
											@else
												@if ($time3->sunday == 1)
												<label>日</label><input type="checkbox" class="Sunday2" name="sunday2" checked>
												@else
												<label>日</label><input type="checkbox" class="Sunday2" name="sunday2">
												@endif
											@endif
										</div>
									</div>
									<div class="left_time_block">
										<label>開始時間(昼)</label>
										@if ($time3 != null)
										<input type="time" name="third_start_time" step="1800" value="{{$time3->start_time}}" placeholder="11:00" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">	
										@else
										<input type="time" name="third_start_time" step="1800" value="" placeholder="11:00" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@endif
										<label>開始時間(夜)</label>
										@if ($time4 != null)
										<input type="time" name="fourth_start_time" step="1800" value="{{$time4->start_time}}"  placeholder="17:00" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@else
										<input type="time" name="fourth_start_time" step="1800" value="" placeholder="17:00" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@endif
									</div>
									<div class="right_time_block">
										<label >終了時間</label>
										@if ($time3 != null)
										<input type="time" name="third_end_time" step="1800" value="{{$time3->end_time}}" placeholder="13:30" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@else
										<input type="time" name="third_end_time" step="1800" value="" placeholder="13:30" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@endif
										<div class="clear_button_block">
											<input type="button" id="clear_3" value="クリア">
										</div>
										<label>終了時間</label>
										@if ($time4 != null)
										<input type="time" name="fourth_end_time" step="1800" value="{{$time4->end_time}}" placeholder="23:30" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@else
										<input type="time" name="fourth_end_time" step="1800" value="" placeholder="23:30" pattern="\d{2}:\d{2}" title="〇〇:〇〇のように記入してください。(半角数字)">
										@endif
										<div class="clear_button_block">
											<input type="button" id="clear_4" value="クリア">
										</div>
									</div>
								</div>
							</div>
							<div class="seat_amount form-group">
								<label class="optional">定休日</label>
								<input class="form-control" type="text" placeholder="例.） 日曜日・月曜日・祝日等" name="holiday" value="{{$shop->holiday}}" min="0">
							</div>
							<div class="seat_amount form-group">
								<label class="optional">ランチ予算</label>
								<input class="" type="number" placeholder="例.）1000" name="lunch_estimated_bottom_price" value="{{$shop->lunch_estimated_bottom_price}}" min="0">
								 〜 
								<input class="" type="number" placeholder="例.） 2000" name="lunch_estimated_high_price" value="{{$shop->lunch_estimated_high_price}}" min="0">
							</div>
							<div class="seat_amount form-group">
								<label class="optional">ディナー予算</label>
								<input class="" type="number" placeholder="例.）5000" name="dinner_estimated_bottom_price" value="{{$shop->dinner_estimated_bottom_price}}" min="0">
								 〜 
								<input class="" type="number" placeholder="例.） 20000" name="dinner_estimated_high_price" value="{{$shop->dinner_estimated_high_price}}" min="0">
							</div>
							<div class="seat_amount form-group">
								<label class="required">座席数</label>
								<input class="form-control" type="number" placeholder="例.） 25" name="number_of_seats" value="{{$shop->number_of_seats}}" min="0" title="半角数字で記入してください。">
							</div>
							<div class="seat_amount form-group">
								<label class="required">支払い方法</label>
								<input class="form-control" type="text" placeholder="例.) 現金, VISA, Master, JCB, PayPay, LINEPay, 楽天Pay" name="payment_options" value="{{ $shop->payment_options }}">
							</div>
							<div class="seat_amount form-group">
								<label class="optional">店舗HP</label>
								<input class="form-control" type="text" placeholder="例.) https://www.eatap.co.jp" name="hp" value="{{ $shop->hp }}">
							</div>
							<div class="seat_amount form-group">
								<label class="optional">Twitter</label>
								<input class="form-control" type="text" placeholder="例.)  https://twitter.com/XXX" name="twitter" value="{{ $shop->twitter }}">
							</div>
							<div class="seat_amount form-group">
								<label class="optional">Facebook</label>
								<input class="form-control" type="text" placeholder="例.)  https://www.facebook.com/XXXX" name="facebook" value="{{ $shop->facebook }}">
							</div>
							<div class="seat_amount form-group">
								<label class="optional">Instagram</label>
								<input class="form-control" type="text" placeholder="例.)  https://www.instagram.com/XXXX" name="instagram" value="{{ $shop->instagram }}">
							</div>
							<div class="seat_amount form-group">
								<label class="optional">その他のSNS</label>
								<input class="form-control" type="text" placeholder="例.)  https://xxxxx.xxxx/xxxxx" name="sns" value="{{ $shop->sns }}">
							</div>
							<div class="categories form-group">
								<label class="required">店舗カテゴリ</label>
								@if ($shop->category_1 != null)
								<select name="category_1" id="" value="{{$shop->category_1}}" required title="選択してください">
									<option value="">-- 選択 --</option>
									@if($shop->category_1 == 1)
									<option value="1" selected>和食</option>
									@else
									<option value="1">和食</option>
									@endif
									@if($shop->category_1 == 2)
									<option value="2" selected>洋食</option>
									@else
									<option value="2">洋食</option>
									@endif
									@if($shop->category_1 == 3)
									<option value="3" selected>中華</option>
									@else
									<option value="3">中華</option>
									@endif
									@if($shop->category_1 == 4)
									<option value="4" selected>その他</option>
									@else
									<option value="4">その他</option>
									@endif
									@if($shop->category_1 == 5)
									<option value="5" selected>カフェ・喫茶店</option>
									@else
									<option value="5">カフェ・喫茶店</option>
									@endif
									@if($shop->category_1 == 6)
									<option value="6" selected>バー・居酒屋</option>
									@else
									<option value="6">バー・居酒屋</option>
									@endif
								</select>
								@else
								<select name="category_1" id="" value="">
									<option value="">-- 選択 --</option>
									<option value="1">和食</option>
									<option value="2">洋食</option>
									<option value="3">中華</option>
									<option value="4">その他</option>
									<option value="5">カフェ・喫茶店</option>
									<option value="6">バー・居酒屋</option>
								</select>
								@endif
								@if ($shop->category_2 != null)
								<select name="category_2" id="" value="{{$shop->category_2}}">
									<option value="">-- 選択 --</option>
									@if($shop->category_2 == 1)
									<option value="1" selected>和食</option>
									@else
									<option value="1">和食</option>
									@endif
									@if($shop->category_2 == 2)
									<option value="2" selected>洋食</option>
									@else
									<option value="2">洋食</option>
									@endif
									@if($shop->category_2 == 3)
									<option value="3" selected>中華</option>
									@else
									<option value="3">中華</option>
									@endif
									@if($shop->category_2 == 4)
									<option value="4" selected>その他</option>
									@else
									<option value="4">その他</option>
									@endif
									@if($shop->category_2 == 5)
									<option value="5" selected>カフェ・喫茶店</option>
									@else
									<option value="5">カフェ・喫茶店</option>
									@endif
									@if($shop->category_2 == 6)
									<option value="6" selected>バー・居酒屋</option>
									@else
									<option value="6">バー・居酒屋</option>
									@endif
								</select>
								@else
								<select name="category_2" id="" value="">
									<option value="">-- 選択 --</option>
									<option value="1">和食</option>
									<option value="2">洋食</option>
									<option value="3">中華</option>
									<option value="4">その他</option>
									<option value="5">カフェ・喫茶店</option>
									<option value="6">バー・居酒屋</option>
								</select>
								@endif
							</div>
							<div class="about_store">
								<label class="required">店舗紹介</label>
								<textarea class="form-control" placeholder="お店を紹介する文を記載してください。(300字以内)" name="sentence" required>{{ $shop->sentence }}</textarea>
							</div>
							<div class="store_img">
								<label class="required">店舗トップ画像</label>
								<input type="file" name="image" class="image">
								<img id="cropped_image">
								<input type="hidden" name="top_image_x" id="top_image_x" value="0">
								<input type="hidden" name="top_image_y" id="top_image_y" value="0">
								<input type="hidden" name="top_image_height" id="top_image_height" value="0">
								<input type="hidden" name="top_image_width" id="top_image_width" value="0">
							</div>
							<img src="{{config('filesystems.disks.s3.url').$shop->top_image}}" class="preview">
							<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">×</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="img-container">
												<img id="image">
											</div>
											<div class="cropper-container cropper-bg">
												
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
											<button type="button" class="btn btn-primary" id="crop">OK</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="button_position">
						<input type="submit" class="btn btn-primary submit_button" value="保存・更新する" name="edit_basic">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="module">
var $modal = $('#modal');
var image = document.getElementById('image');
var cropper;
var cropperData;
var file;

$('#clear_1').on('click', function(){
	$('input[name="first_start_time"]').val('');
	$('input[name="first_end_time"]').val('');
});
$('#clear_2').on('click', function(){
	$('input[name="second_start_time"]').val('');
	$('input[name="second_end_time"]').val('');
});
$('#clear_3').on('click', function(){
	$('input[name="third_start_time"]').val('');
	$('input[name="third_end_time"]').val('');
});
$('#clear_4').on('click', function(){
	$('input[name="fourth_start_time"]').val('');
	$('input[name="fourth_end_time"]').val('');
});
$(".image").on("change", function(e){
    var files = e.target.files;
    var done = function (url) {
      image.src = url;
      $modal.modal('show');
    };
    var reader;
    var url;

    if (files && files.length > 0) {
      file = files[0];
      if (URL) {
        done(URL.createObjectURL(file));
      } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
          done(reader.result);
        };
        reader.readAsDataURL(file);
      }
    }
});

$modal.on('shown.bs.modal', function () {
    cropper = new Cropper(image, {
        viewMode: 0,
        dragMode: 'none',
        autoCropArea: 1,
        restore: false,
        modal: true,
        guides: true,
        highlight: false,
        cropBoxMovable: true,
        zoomOnWheel: false,
        aspectRatio: 1.0,
		crop(event) {
			cropperData = cropper.getData();
			console.log(event.detail.x);
			console.log(event.detail.y);
			console.log(event.detail.width);
			console.log(event.detail.height);
			$("#top_image_x").val(Math.floor(cropperData.x));
			$("#top_image_y").val(Math.floor(cropperData.y));
			$("#top_image_width").val(Math.floor(cropperData.width));
			$("#top_image_height").val(Math.floor(cropperData.height));
		},
    });
}).on('hidden.bs.modal', function () {
   cropper.destroy();
   cropper = null;
});

$('#crop').click( function () {
	console.log($("#top_image_x").val());
	console.log($("#top_image_y").val());
	console.log($("#top_image_width").val());
	console.log($("#top_image_height").val());
	$modal.modal('hide');
});

if (
	$('#Monday1').is(':checked') && 
	$('#Tsuesday1').is(':checked') && 
	$('#Wednesday1').is(':checked') && 
	$('#Thursday1').is(':checked') && 
	$('#Friday1').is(':checked') && 
	$('#Saturday1').is(':checked') &&
	$('#Sunday1').is(':checked')
){
	$('.time_block_2').css('display', 'none');
} else{
	$('.time_block_2').css('display', 'block')
	if ($('#Monday1').is(':checked')){
		$('.is_monday_selected').css('opacity', '0.4');
		$(".Monday2").prop('disabled', true);
	}
	if ($('#Tsuesday1').is(':checked')){
		$('.is_tsuesday_selected').css('opacity', '0.4');
		$(".Tsuesday2").prop('disabled', true);
	}
	if ($('#Wednesday1').is(':checked')){
		$('.is_wednesday_selected').css('opacity', '0.4');
		$(".Wednesday2").prop('disabled', true);
	}
	if ($('#Thursday1').is(':checked')){
		$('.is_thursday_selected').css('opacity', '0.4');
		$(".Thursday2").prop('disabled', true);
	}
	if ($('#Friday1').is(':checked')){
		$('.is_friday_selected').css('opacity', '0.4');
		$(".Friday2").prop('disabled', true);
	}
	if ($('#Saturday1').is(':checked')){
		$('.is_saturday_selected').css('opacity', '0.4');
		$(".Saturday2").prop('disabled', true);
	} else{
		console.log("土曜日");
		$('.is_saturday_selected').css('opacity', '1.0');
		$(".Saturday2").prop('disabled', false);
	}
	if ($('#Sunday1').is(':checked')){
		$('.is_sunday_selected').css('opacity', '0.4');
		$(".Sunday2").prop('disabled', true);
	}
}


$('.week').on('change', function (e) {
	if($(this).is(':checked')){
		if (
			$('#Monday1').is(':checked') && 
			$('#Tsuesday1').is(':checked') && 
			$('#Wednesday1').is(':checked') && 
			$('#Thursday1').is(':checked') && 
			$('#Friday1').is(':checked') && 
			$('#Saturday1').is(':checked') &&
			$('#Sunday1').is(':checked')
		){
			$('.time_block_2').css('display', 'none')
		}else{
			$('.time_block_2').css('display', 'block')
			if ($('#Monday1').is(':checked')){
				$('.is_monday_selected').css('opacity', '0.4');
				$(".Monday2").prop('disabled', true);
			}
			if ($('#Tsuesday1').is(':checked')){
				$('.is_tsuesday_selected').css('opacity', '0.4');
				$(".Tsuesday2").prop('disabled', true);
			}
			if ($('#Wednesday1').is(':checked')){
				$('.is_wednesday_selected').css('opacity', '0.4');
				$(".Wednesday2").prop('disabled', true);
			}
			if ($('#Thursday1').is(':checked')){
				$('.is_thursday_selected').css('opacity', '0.4');
				$(".Thursday2").prop('disabled', true);
			}
			if ($('#Friday1').is(':checked')){
				$('.is_friday_selected').css('opacity', '0.4');
				$(".Friday2").prop('disabled', true);
			}
			if ($('#Saturday1').is(':checked')){
				$('.is_saturday_selected').css('opacity', '0.4');
				$(".Saturday2").prop('disabled', true);
			} else{
				console.log("土曜日");
				$('.is_saturday_selected').css('opacity', '1.0');
				$(".Saturday2").prop('disabled', false);
			}
			if ($('#Sunday1').is(':checked')){
				$('.is_sunday_selected').css('opacity', '0.4');
				$(".Sunday2").prop('disabled', true);
			}
		}
	}else{
		if (
			$('#Monday1').is(':checked') && 
			$('#Tsuesday1').is(':checked') && 
			$('#Wednesday1').is(':checked') && 
			$('#Thursday1').is(':checked') && 
			$('#Friday1').is(':checked') && 
			$('#Saturday1').is(':checked') &&
			$('#Sunday1').is(':checked')
		){
			$('.time_block_2').css('display', 'none')
		}else{
			$('.time_block_2').css('display', 'block')
			if ($('#Monday1').is(':checked')){
				$('.is_monday_selected').css('opacity', '0.4');
				$(".Monday2").prop('disabled', true);
			} else {
				$('.is_monday_selected').css('opacity', '1.0');
				$(".Monday2").prop('disabled', false);
			}

			if ($('#Tsuesday1').is(':checked')) {
				$('.is_tsuesday_selected').css('opacity', '0.4');
				$(".Tsuesday2").prop('disabled', true);
			} else {
				$('.is_tsuesday_selected').css('opacity', '1.0');
				$(".Tsuesday2").prop('disabled', false);
			}

			if ($('#Wednesday1').is(':checked')) {
				$('.is_wednesday_selected').css('opacity', '0.4');
				$(".Wednesday2").prop('disabled', true);
			} else {
				$('.is_wednesday_selected').css('opacity', '1.0');
				$(".Wednesday2").prop('disabled', false);
			}

			if ($('#Thursday1').is(':checked')) {
				$('.is_thursday_selected').css('opacity', '0.4');
				$(".Thursday2").prop('disabled', true);
			} else {
				$('.is_thursday_selected').css('opacity', '1.0');
				$(".Thursday2").prop('disabled', false);
			}

			if ($('#Friday1').is(':checked')) {
				$('.is_friday_selected').css('opacity', '0.4');
				$(".Friday2").prop('disabled', true);
			} else {
				$('.is_friday_selected').css('opacity', '1.0');
				$(".Friday2").prop('disabled', false);
			}

			if ($('#Saturday1').is(':checked')){
				$('.is_saturday_selected').css('opacity', '0.4');
				$(".Saturday2").prop('disabled', true);
			} else {
				$('.is_saturday_selected').css('opacity', '1.0');
				$(".Saturday2").prop('disabled', false);
			}

			if ($('#Sunday1').is(':checked')){
				$('.is_sunday_selected').css('opacity', '0.4');
				$(".Sunday2").prop('disabled', true);
			} else {
				$('.is_sunday_selected').css('opacity', '1.0');
				$(".Sunday2").prop('disabled', false);
			}
		}
	}
});

$("input").on("keydown",function(ev){
    if ((ev.which && ev.which === 13) ||(ev.keyCode && ev.keyCode === 13)){
      return false;
    } else {
      return true;
    }
});
</script>
@endsection