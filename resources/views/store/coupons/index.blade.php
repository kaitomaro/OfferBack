@extends('layouts.app')

@section('pageCss')
	<link rel="stylesheet" href="/css/store/coupons/coupon_index.css">
@endsection

@section('content')

<div class="container">
	<div class="raw">
		<div class="col-sm-12 col-md-10 change_position">
			<div class="store_info">
				<div class="menus">
					<h3>クーポン</h3>
					<div class="menu">
						<table class="table">
							<tr>
								<th>発券時間</th>
								<th>メニュー</th>
								<th>公開状態</th>
								<th></th>
							</tr>
							@if ($first_start_time != null)
							@for ($i = intval($first_start_time[0]); $i <= intval($first_end_time[0]); $i++)
								@if ($i == intval($first_end_time[0]))
									@if ($first_end_time[1] != "30")
										@break
									@endif	
								@endif
								<tr>
									<td>
										@if ($i == intval($first_start_time[0]))
										@if ($time1 != null)
											@if ($time1->monday == 1)
												月
											@endif
											@if ($time1->tsuesday == 1)
												火
											@endif
											@if ($time1->wednesday == 1)
												水
											@endif
											@if ($time1->thursday == 1)
												木
											@endif
											@if ($time1->friday == 1)
												金
											@endif
											@if ($time1->saturday == 1)
												土
											@endif
											@if ($time1->sunday == 1)
												日
											@endif
										@endif
										<br>
										{{ $i }}: {{ $first_start_time[1] }} ~ {{ $i + 1}}:00
	
										@elseif ($i == intval($first_end_time[0]))
											@if ($first_end_time[1] == "30")
											{{ $i }}:00  ~ {{ $i }}:30
											@endif
										@else
											{{ $i }}:00 ~ {{ $i + 1}}:00
										@endif
									</td>
									<td>
									@foreach ($coupons_first[$i] as $coupon)
										@if ($coupon->discount_type == 1)
										{{$coupon->name}} -{{ $coupon->discount }}％<br>
										@else
										{{$coupon->name}} -{{ $coupon->discount }}円<br>
										@endif
									@endforeach
									</td>
									<td>
										@if (@isset($coupons_first[$i][0]->display))
											@if ($coupons_first[$i][0]->display == 1)
												<div class="toggle-switch">
													<input id="toggle" class="toggle-input" type='checkbox' disabled checked="checked">
													<label for="toggle" class="toggle-label">
												</div>
											@else
											<div class="toggle-switch">
												<input id="toggle" class="toggle-input" type='checkbox' disabled>
												<label for="toggle" class="toggle-label">
											</div> 
											@endif

										@else
										<div class="toggle-switch">
											<input id="toggle" class="toggle-input" type='checkbox' disabled>
											<label for="toggle" class="toggle-label">
										</div> 
										@endisset
									</td>
									<td class="font_icon"><a href="/store/coupons/1/{{$i}}"><i class="fas fa-edit"></i></a></td>
								</tr>
							@endfor
							@endif
							@if ($second_start_time != null)
							<br>
							@for ($i = intval($second_start_time[0]); $i <= intval($second_end_time[0]); $i++)
								@if ($i == intval($second_end_time[0]))
								@if ($second_end_time[1] != "30")
									@break
								@endif	
								@endif
								<tr>
									<td>
										@if ($i == intval($second_start_time[0]))
										@if ($time2 != null)
										@if ($time1 == null)
											@if ($time2->monday == 1)
												月
											@endif
											@if ($time2->tsuesday == 1)
												火
											@endif
											@if ($time2->wednesday == 1)
												水
											@endif
											@if ($time2->thursday == 1)
												木
											@endif
											@if ($time2->friday == 1)
												金
											@endif
											@if ($time2->saturday == 1)
												土
											@endif
											@if ($time2->sunday == 1)
												日
											@endif
											<br>
										@endif
										@endif
											{{ $i }}: {{ $second_start_time[1] }} ~ {{ $i + 1}}:00
										@elseif ($i == intval($second_end_time[0]))
											@if ($second_end_time[1] == "30")
											{{ $i }}:00  ~ {{ $i }}:30
											@else
											{{ $i }}:00  ~ {{ $i + 1 }}:00
											@endif
										@else
											{{ $i }}:00 ~ {{ $i + 1}}:00
										@endif
									</td>
									<td>
									@foreach ($coupons_second[$i] as $coupon)
										@if ($coupon->discount_type == 1)
										{{$coupon->name}} -{{ $coupon->discount }}％<br>
										@else
										{{$coupon->name}} -{{ $coupon->discount }}円<br>
										@endif
									@endforeach
									</td>
									<td>
										@if (@isset($coupons_second[$i][0]->display))
											@if ($coupons_second[$i][0]->display == 1)
												<div class="toggle-switch">
													<input id="toggle" class="toggle-input" type='checkbox' disabled checked="checked">
													<label for="toggle" class="toggle-label">
												</div>
											@else
											<div class="toggle-switch">
												<input id="toggle" class="toggle-input" type='checkbox' disabled>
												<label for="toggle" class="toggle-label">
											</div> 
											@endif

										@else
										<div class="toggle-switch">
											<input id="toggle" class="toggle-input" type='checkbox' disabled>
											<label for="toggle" class="toggle-label">
										</div> 
										@endisset
									</td>
									<td class="font_icon"><a href="/store/coupons/2/{{$i}}"><i class="fas fa-edit"></i></a></td>
								</tr>
							@endfor
							@endif
							@if ($third_start_time != null)
							<br>
							<br>
							@for ($i = intval($third_start_time[0]); $i <= intval($third_end_time[0]); $i++)
								@if ($i == intval($third_end_time[0]))
									@if ($third_end_time[1] != "30")
										@break
									@endif	
								@endif
								<tr>
									<td>
										@if ($i == intval($third_start_time[0]))
										@if ($time3 != null)
											@if ($time3->monday == 1)
												月
											@endif
											@if ($time3->tsuesday == 1)
												火
											@endif
											@if ($time3->wednesday == 1)
												水
											@endif
											@if ($time3->thursday == 1)
												木
											@endif
											@if ($time3->friday == 1)
												金
											@endif
											@if ($time3->saturday == 1)
												土
											@endif
											@if ($time3->sunday == 1)
												日
											@endif
										@endif
										<br>
										{{ $i }}: {{ $third_start_time[1] }} ~ {{ $i + 1}}:00
	
										@elseif ($i == intval($third_end_time[0]))
											@if ($third_end_time[1] == "30")
											{{ $i }}:00  ~ {{ $i }}:30
											@endif
										@else
											{{ $i }}:00 ~ {{ $i + 1}}:00
										@endif
									</td>
									<td>
									@foreach ($coupons_third[$i] as $coupon)
										@if ($coupon->discount_type == 1)
										{{$coupon->name}} -{{ $coupon->discount }}％<br>
										@else
										{{$coupon->name}} -{{ $coupon->discount }}円<br>
										@endif
									@endforeach
									</td>
									<td>
										@if (@isset($coupons_third[$i][0]->display))
											@if ($coupons_third[$i][0]->display == 1)
												<div class="toggle-switch">
													<input id="toggle" class="toggle-input" type='checkbox' disabled checked="checked">
													<label for="toggle" class="toggle-label">
												</div>
											@else
											<div class="toggle-switch">
												<input id="toggle" class="toggle-input" type='checkbox' disabled>
												<label for="toggle" class="toggle-label">
											</div> 
											@endif

										@else
										<div class="toggle-switch">
											<input id="toggle" class="toggle-input" type='checkbox' disabled>
											<label for="toggle" class="toggle-label">
										</div> 
										@endisset
									</td>
									<td class="font_icon"><a href="/store/coupons/3/{{$i}}"><i class="fas fa-edit"></i></a></td>
								</tr>
							@endfor
							@endif
							@if ($fourth_start_time != null)
							<br>
							@for ($i = intval($fourth_start_time[0]); $i <= intval($fourth_end_time[0]); $i++)
								@if ($i == intval($fourth_end_time[0]))
								@if ($fourth_end_time[1] != "30")
									@break
								@endif	
								@endif
								<tr>
									<td>
										@if ($i == intval($fourth_start_time[0]))
										@if ($time4 != null)
										@if ($time3 == null)
											@if ($time4->monday == 1)
												月
											@endif
											@if ($time4->tsuesday == 1)
												火
											@endif
											@if ($time4->wednesday == 1)
												水
											@endif
											@if ($time4->thursday == 1)
												木
											@endif
											@if ($time4->friday == 1)
												金
											@endif
											@if ($time4->saturday == 1)
												土
											@endif
											@if ($time4->sunday == 1)
												日
											@endif
											<br>
										@endif
										@endif
											{{ $i }}: {{ $fourth_start_time[1] }} ~ {{ $i + 1}}:00
										@elseif ($i == intval($fourth_end_time[0]))
											@if ($fourth_end_time[1] == "30")
											{{ $i }}:00  ~ {{ $i }}:30
											@else
											{{ $i }}:00  ~ {{ $i + 1 }}:00
											@endif
										@else
											{{ $i }}:00 ~ {{ $i + 1}}:00
										@endif
									</td>
									<td>
									@foreach ($coupons_fourth[$i] as $coupon)
										@if ($coupon->discount_type == 1)
										{{$coupon->name}} -{{ $coupon->discount }}％<br>
										@else
										{{$coupon->name}} -{{ $coupon->discount }}円<br>
										@endif
									@endforeach
									</td>
									<td>
										@if (@isset($coupons_fourth[$i][0]->display))
											@if ($coupons_fourth[$i][0]->display == 1)
												<div class="toggle-switch">
													<input id="toggle" class="toggle-input" type='checkbox' disabled checked="checked">
													<label for="toggle" class="toggle-label">
												</div>
											@else
											<div class="toggle-switch">
												<input id="toggle" class="toggle-input" type='checkbox' disabled>
												<label for="toggle" class="toggle-label">
											</div> 
											@endif

										@else
										<div class="toggle-switch">
											<input id="toggle" class="toggle-input" type='checkbox' disabled>
											<label for="toggle" class="toggle-label">
										</div> 
										@endisset
									</td>
									<td class="font_icon"><a href="/store/coupons/4/{{$i}}"><i class="fas fa-edit"></i></a></td>
								</tr>
							@endfor
							@endif
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection