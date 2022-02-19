@extends('layouts.app')

@section('pageCss')
<link rel="stylesheet" href="/css/store/home.css">
@endsection
@section('content')
    
<div class="container">
	<div class="raw">
		<div class="col-sm-12">
			<h3 class="store_name">{{ $shop->name}} 様</h3>
			<div class="store_info">
				<div class="store_basic">
					<ul>
						<li>{{ $shop->name}}</li>
						<li>
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
						@else
							@if ($time2 != null)
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
							@endif
						@endif
							<br>
							@if ($first_start_time != null)
								{{$first_start_time[0]}}:{{$first_start_time[1]}}~{{$first_end_time[0]}}:{{$first_end_time[1]}}
							@endif
							 @if ($second_start_time != null)
							 	@if ($first_start_time != null)
								, {{$second_start_time[0]}}:{{$second_start_time[1]}}~{{$second_end_time[0]}}:{{$second_end_time[1]}}	 
								@else
								{{$second_start_time[0]}}:{{$second_start_time[1]}}~{{$second_end_time[0]}}:{{$second_end_time[1]}}
								@endif
								
							 @endif
						</li>
						<li>
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
						@else
							@if ($time4 != null)
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
							@endif
						@endif
							<br>
							@if ($third_start_time != null)
								{{$third_start_time[0]}}:{{$third_start_time[1]}}~{{$third_end_time[0]}}:{{$third_end_time[1]}}
							@endif
							 @if ($fourth_start_time != null)
								@if ($third_start_time == null)
								{{$fourth_start_time[0]}}:{{$fourth_start_time[1]}}~{{$fourth_end_time[0]}}:{{$fourth_end_time[1]}}
								@else
								 , {{$fourth_start_time[0]}}:{{$fourth_start_time[1]}}~{{$fourth_end_time[0]}}:{{$fourth_end_time[1]}}	 
								@endif
								
							 @endif
						</li>
						<li>
							定休日: 
							{{ $shop->holiday }}
						</li>
						<li>〒{{ $shop->zip_code}} {{ $shop->address}}</li>
						<li>{{ $shop->email }}</li>
						<li>{{ $shop->phone }}</li>
						@if ($shop->number_of_seats != null)
							<li>席数: {{ $shop->number_of_seats }}</li>	
						@endif
						<li>お支払い方法: {{ $shop->payment_options }}</li>
						<li>お昼の予算: {{ $shop->lunch_estimated_bottom_price }} 〜 {{ $shop->lunch_estimated_high_price }}</li>
						<li>夜の予算: {{ $shop->dinner_estimated_bottom_price }} 〜 {{ $shop->dinner_estimated_high_price }}</li>
						<li>ホームページ: {{ $shop->hp }}</li>
						<li>Twitter: {{ $shop->twitter }}</li>
						<li>Instagram: {{ $shop->instagram }}</li>
						<li>facebook: {{ $shop->facebook }}</li>
						<li>その他SNS: {{ $shop->sns }}</li>
						<li>{{ $shop->sentence }}</li>
						@if (isset($shop->top_image))
							<img class="img_width" src="{{ config('filesystems.disks.s3.url').$shop->top_image}}">
						@endif
					</ul>
					<a class="edit_basic" href="{{ url('/store/basic') }}">
						<i class="fas fa-plus-circle"></i>編集
					</a>
				</div>
				<div class="img_info">
					<div class="image_info_border">
						<div class="image_title_container">
							<div class="image_title">
								<p class="image">紹介写真</p>
							</div>
							<div class="image_edit_icon">
								<a href="{{ url('/store/images/') }}" class="edit_image_icon"><i class="fas fa-edit"></i></a>
							</div>
						</div>
						<div class="image_content">
							<div class="images_frame">
								@foreach ($images as $image)
									<img class="img_width" src="{{config('filesystems.disks.s3.url').$image->image_name}}">
								@endforeach
							</div>
						</div>
					</div>
					<a class="edit_image" href="{{ url('/store/images/') }}"><i class="fas fa-plus-circle"></i>編集</a>
				</div>
				<div class="service_info">
					<div class="service_info_border">
						<div class="service_title_container">
							<div class="service_title">
								<p class="service">割引メニュー</p>
							</div>
							<div class="service_edit_icon">
								<a href="{{ url('/store/services') }}" class="edit_service_icon"><i class="fas fa-edit"></i></a>
							</div>
						</div>
						<ul class="service_list">
						@foreach ($services as $service)
							@if ($service->price != null)
								<li>{{ $service->name }} {{ $service->price }}円</li>
							@else
								<li>{{ $service->name }}</li>
							@endif
						@endforeach
						</ul>
					</div>
					<a class="edit_service" href="{{ url('/store/services') }}"><i class="fas fa-plus-circle"></i>編集</a>
				</div>
				<div class="coupon_info">
					<div class="coupon_title_container">
						<div class="coupon_title">
							<p class="coupon">クーポン</p>
						</div>
						<div class="coupon_edit_icon">
							<a href="{{url('/store/coupons')}}" class="edit_coupon_icon"><i class="fas fa-edit"></i></a>
						</div>
					</div>
					<div class="coupon_info_border">
						<ul class="coupon_list">
							@if ($first_start_time != null)
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
							@for ($i = intval($first_start_time[0]); $i <= intval($first_end_time[0]); $i++)
								<li>
									@if ($i == intval($first_start_time[0]))
									{{ $i }}:{{ $first_start_time[1] }} ~ {{ $i + 1}}:00 発行数：{{$coupons_first[$i]}}
									@elseif ($i == intval($first_end_time[0]))
										@if ($first_end_time[1] == "30")
											{{ $i }}:00 ~ {{ $i }}:30 発行数：{{$coupons_first[$i]}}
										@endif
									@else
										{{ $i }}:00 ~ {{ $i + 1}}:00 発行数：{{$coupons_first[$i]}}
									@endif
								</li>
							@endfor
							<br>
							@endif
							@if ($second_start_time != null)
								@if ($first_start_time == null)
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
								@endif
								@for ($i = intval($second_start_time[0]); $i <= intval($second_end_time[0]); $i++)
									<li>
										@if ($i == intval($second_start_time[0]))
										{{ $i }}:{{ $second_start_time[1] }} ~ {{ $i + 1}}:00 発行数：{{$coupons_second[$i]}}
										@elseif ($i == intval($second_end_time[0]))
											@if ($second_end_time[1] == "30")
											{{ $i }}:00 ~ {{ $i }}:30 発行数：{{$coupons_second[$i]}}
											@endif
										@else
											{{ $i }}:00 ~ {{ $i + 1}}:00 発行数：{{$coupons_second[$i]}}
										@endif
									</li>
								@endfor
							@endif
							<br>
							@if ($third_start_time != null)
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
							@for ($i = intval($third_start_time[0]); $i <= intval($third_end_time[0]); $i++)
								<li>
									@if ($i == intval($third_start_time[0]))
									{{ $i }}:{{ $third_start_time[1] }} ~ {{ $i + 1}}:00 発行数：{{$coupons_third[$i]}}
									@elseif ($i == intval($third_end_time[0]))
										@if ($third_end_time[1] == "30")
											{{ $i }}:00 ~ {{ $i }}:30 発行数：{{$coupons_third[$i]}}
										@endif
									@else
										{{ $i }}:00 ~ {{ $i + 1}}:00 発行数：{{$coupons_third[$i]}}
									@endif
								</li>
							@endfor
							@endif
							@if ($fourth_start_time != null)
							@if ($third_start_time == null)
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
							@endif
							<br>
							@for ($i = intval($fourth_start_time[0]); $i <= intval($fourth_end_time[0]); $i++)
								<li>
									@if ($i == intval($fourth_start_time[0]))
									{{ $i }}:{{ $fourth_start_time[1] }} ~ {{ $i + 1}}:00 発行数：{{$coupons_fourth[$i]}}
									@elseif ($i == intval($fourth_end_time[0]))
										@if ($fourth_end_time[1] == "30")
											{{ $i }}:00 ~ {{ $i }}:30 発行数：{{$coupons_fourth[$i]}}
										@endif
									@else
										{{ $i }}:00 ~ {{ $i + 1}}:00 発行数：{{$coupons_fourth[$i]}}
									@endif
								</li>
							@endfor
							@endif

					</div>
					<a class="edit_coupon" href="{{ url('/store/coupons') }}"><i class="fas fa-plus-circle"></i>編集</a>
				</div>
				<div class="menu_info">
					<div class="menu_info_border">
						<div class="menu_title_container">
							<div class="menu_title">
								<p class="menu">掲載用メニュー(任意)</p>
							</div>
							<div class="menu_edit_icon">
								<a href="{{ url('/store/menus') }}" class="edit_menu_icon"><i class="fas fa-edit"></i></a>
							</div>
						</div>
						<ul class="menu_list">
							@foreach ($menus as $menu)
								<li>{{$menu->name}} {{$menu->price}}</li>	
							@endforeach
						</ul>
					</div>
					<a class="edit_menu" href="{{ url('/store/menus') }}"><i class="fas fa-plus-circle"></i>編集</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
