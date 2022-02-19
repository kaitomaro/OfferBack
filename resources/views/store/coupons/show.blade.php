@extends('layouts.app')

@section('pageCss')
<link rel="stylesheet" href="/css/store/coupons/show_coupons.css">
@endsection

@section('content')

<div class="container">
	@if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="raw">
		<div class="col-sm-12 col-md-10 change_position">
			<div class="store_info">
				<div class="menus">
					<div class="coupons">
					<form action="{{'/store/coupons/'.$time_type.'/'.$time_id.'/update'}}" method="post">
						@csrf
						@foreach ($services as $service)
						<div class="form-check">
							@if ($service->coupon_id != null)
							<input class="form-check-input menus_checkbox" type="checkbox" value={{$service->service_id}} id="menu_{{$service->service_id}}" name="menus[]" checked = "checked">
							<label class="form-check-label" for="menu_{{$service->service_id}}">
								@if ($service->service_type == 2)
								{{ $service->name }}
								@else
								{{ $service->name }} {{$service->price }}円
								@endif
							</label>
							<button class="btn drop_dawn_button" type="button" id="button_{{$service->service_id}}"><i class="fas fa-caret-down" value="{{$service->service_id}}"></i></button>
							@else
							<input class="form-check-input menus_checkbox" type="checkbox" value={{$service->service_id}} id="menu_{{$service->service_id}}" name="menus[]">	
							<label class="form-check-label" for="menu_{{$service->service_id}}">
								@if ($service->service_type == 2)
								{{ $service->name }}
								@else
								{{ $service->name }} {{$service->price }}円
								@endif
							</label>
							@endif

							@if ($service->service_type == 0)
							<div class="form-group checked_menu" id="hide_and_show{{$service->service_id}}">
								<label for="discount_{{$service->service_id}}">割引額</label>
								@if ($service->coupon_id != null)
								<input type="number" class="form-control discount" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="{{$service->discount}}" min="10" max="{{$service->price}}" pattern="[1-9][0-9]*" title="1以上の半角数字・定価以下で入力して下さい。" required>
								@else
								<input type="number" class="form-control discount" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="{{$service->discount}}" disabled  min="10" max="{{$service->price}}" pattern="[1-9]*" title="1以上の半角数字のみで入力して下さい。">
								@endif
								<div>
									@if ($service->first_time_discount == 1)
									<input type="checkbox" value="1" id="first_time_discount_{{$service->service_id}}" name="first_time_discount_{{$service->service_id}}" checked="checked">
									<label for="first_time_discount_{{$service->service_id}}">初回限定</label>
									@else
									<input type="checkbox" value="1" id="first_time_discount_{{$service->service_id}}" name="first_time_discount_{{$service->service_id}}">	
									<label for="first_time_discount_{{$service->service_id}}">初回限定</label>
									@endif
								</div>
								<div>
									@if ($service->telephone_reservation == 1)
									<input type="checkbox" value="1" name="telephone_reservation_{{$service->service_id}}" id="telephone_reservation_{{$service->service_id}}" checked="checked">
									<label for="telephone_reservation_{{$service->service_id}}">事前の電話予約必須</label>
									@else
									<input type="checkbox" value="1" name="telephone_reservation_{{$service->service_id}}" id="telephone_reservation_{{$service->service_id}}">
									<label for="telephone_reservation_{{$service->service_id}}">事前の電話予約必須</label>
									@endif
								</div>
							</div>
							@elseif($service->service_type == 1)	
							<div class="checked_menu" id="hide_and_show{{$service->service_id}}">
								無料券: -{{$service->price}}円引
								@if ($service->coupon_id != null)
								<input type="hidden" class="form-control discount" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="{{$service->price}}" min="1" pattern="[1-9]" title="1以上の半角数字のみで入力して下さい。" required>
								@else
								<input type="hidden" class="form-control discount" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="{{$service->price}}" disabled min="1" pattern="[1-9]" title="1以上の半角数字のみで入力して下さい。" required>
								@endif
								<div>
									@if ($service->first_time_discount == 1)
									<input type="checkbox" value="1" id="first_time_discount_{{$service->service_id}}" name="first_time_discount_{{$service->service_id}}" checked="checked">
									<label for="first_time_discount_{{$service->service_id}}">初回限定</label>
									@else
									<input type="checkbox" value="1" id="first_time_discount_{{$service->service_id}}" name="first_time_discount_{{$service->service_id}}">	
									<label for="first_time_discount_{{$service->service_id}}">初回限定</label>
									@endif
								</div>
								<div>
									@if ($service->telephone_reservation == 1)
									<input type="checkbox" value="1" name="telephone_reservation_{{$service->service_id}}" id="telephone_reservation_{{$service->service_id}}" checked="checked">
									<label for="telephone_reservation_{{$service->service_id}}">事前の電話予約必須</label>
									@else
									<input type="checkbox" value="1" name="telephone_reservation_{{$service->service_id}}" id="telephone_reservation_{{$service->service_id}}">
									<label for="telephone_reservation_{{$service->service_id}}">事前の電話予約必須</label>
									@endif
								</div>
							</div>
							@elseif($service->service_type == 2)
							<div class="form-group checked_menu" id="hide_and_show{{$service->service_id}}">
								<label for="discount_1">割引額</label>
								@if ($service->discount_type == 1)
									<label for="discount_yen_{{$service->service_id}}" class="select_way_discounting">円</label>
									<input class="charge_way" type="radio" name="discount_way{{$service->service_id}}" id="discount_yen_{{$service->service_id}}" value="0" min="1" pattern="[1-9]" title="1以上の半角数字のみで入力して下さい。" required placeholder="円で入力 例:10,100,1000">
									<label for="discount_per_{{$service->service_id}}" class="select_way_discounting">%</label>
									<input class="charge_way" type="radio" name="discount_way{{$service->service_id}}" id="discount_per_{{$service->service_id}}" value="1" checked min="1" pattern="[1-9]" title="1以上の半角数字のみで入力して下さい。" required placeholder="%で入力 例:3,5,10">
								@else
									<label for="discount_yen_{{$service->service_id}}" class="select_way_discounting">円</label>
									<input class="charge_way" type="radio" name="discount_way{{$service->service_id}}" id="discount_yen_{{$service->service_id}}" value="0" checked min="1" pattern="[1-9]" title="1以上の半角数字のみで入力して下さい。" required placeholder="円で入力 例:10,100,1000">
									<label class="charge_way" for="discount_per_{{$service->service_id}}" class="select_way_discounting">%</label>
									<input class="charge_way" type="radio" name="discount_way{{$service->service_id}}" id="discount_per_{{$service->service_id}}" value="1" min="1" pattern="[1-9]" title="1以上の半角数字のみで入力して下さい。" required placeholder="%で入力 例:3,5,10">
								@endif
								@if ($service->coupon_id != null)
									@if ($service->discount_type == 1)
									<input type="number" class="form-control discount yen_{{$service->service_id}}" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="" min="10" pattern="[1-9][0-9]*" title="1以上の半角数字で入力して下さい。" required disabled placeholder="円で入力 例:10,100,1000">
									<input type="number" class="form-control discount per_{{$service->service_id}}" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="{{$service->discount}}" min="1" max="100" pattern="[1-9][0-9]*" title="1~100以下の半角数字で入力して下さい。" placeholder="%で入力 例:3,5,10">
									@else
									<input type="number" class="form-control discount yen_{{$service->service_id}}" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="{{$service->discount}}" min="10" pattern="[1-9][0-9]*" title="1以上の半角数字で入力して下さい。" required placeholder="円で入力 例:10,100,1000">
									<input type="number" class="form-control discount per_{{$service->service_id}}" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="" min="1" max="100" pattern="[1-9][0-9]*" title="1~100以下の半角数字で入力して下さい。" disabled placeholder="%で入力 例:3,5,10">
									@endif
								@else
								<input type="number" class="form-control discount yen_{{$service->service_id}}" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="" disabled   min="10" pattern="[1-9][0-9]*" title="1以上の半角数字で入力して下さい。" required placeholder="円で入力 例:10,100,1000">
								<input type="number" class="form-control discount per_{{$service->service_id}}" name="discount_[{{$service->service_id}}]" id="discount_{{$service->service_id}}" value="" disabled   min="1" max="100" pattern="[1-9][0-9]*" title="1~100の半角数字で入力して下さい。" disabled placeholder="%で入力 例:3,5,10">
								@endif
								<div>
									@if ($service->first_time_discount == 1)
									<input type="checkbox" value="1" id="first_time_discount_{{$service->service_id}}" name="first_time_discount_{{$service->service_id}}" checked="checked">
									<label for="first_time_discount_{{$service->service_id}}">初回限定</label>
									@else
									<input type="checkbox" value="1" id="first_time_discount_{{$service->service_id}}" name="first_time_discount_{{$service->service_id}}">	
									<label for="first_time_discount_{{$service->service_id}}">初回限定</label>
									@endif
								</div>
								<div>
									@if ($service->telephone_reservation == 1)
									<input type="checkbox" value="1" name="telephone_reservation_{{$service->service_id}}" id="telephone_reservation_{{$service->service_id}}" checked="checked">
									<label for="telephone_reservation_{{$service->service_id}}">事前の電話予約必須</label>
									@else
									<input type="checkbox" value="1" name="telephone_reservation_{{$service->service_id}}" id="telephone_reservation_{{$service->service_id}}">
									<label for="telephone_reservation_{{$service->service_id}}">事前の電話予約必須</label>
									@endif
								</div>
							</div>
							@endif
						</div>
						@endforeach
						<div class="switch_frame">
							<label>クーポンの公開・非公開</label>

							@isset($services[0])
							@if ($services[0]->display == 1)
							<div class="toggle-switch">
								<input id="toggle" class="toggle-input" type='checkbox' name="display" checked="checked">
								<label for="toggle" class="toggle-label"></label>
							</div> 	
							@else
							<div class="toggle-switch">
								<input id="toggle" class="toggle-input" type='checkbox' name="display">
								<label for="toggle" class="toggle-label"></label>
							</div> 	
							@endif	
							@endisset
						</div>
						<input type="submit" class="btn btn-primary btn_position" value="クーポンを設定">
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="module">
    $('.form-check-input').on('change', function (e) {
		if($(this).is(':checked')){
			$('#hide_and_show'+$(this).val()).css('display', 'block');
			$('#discount_' + $(this).val()).prop("disabled", false);
		}else{
			$('#hide_and_show'+$(this).val()).css('display', 'none');
			$('#discount_' + $(this).val()).prop("disabled", true);
		}
	});

	$('.charge_way').on('change', function(){
		var way = $(this).attr('id').split('_');
		// console.log($(this));
		// console.log(way[1]);
		// console.log(way[2]);
		if(way[1] == "yen"){
			
			$('.yen_'+way[2]).prop("disabled", false);
			$('.per_'+way[2]).prop("disabled", true);
			
		} else if(way[1] == "per"){
			$('.yen_'+way[2]).prop("disabled", true);
			$('.per_'+way[2]).prop("disabled", false);
		}
	});

	$('.drop_dawn_button').on('click', function() {

		var got_element = $(this).attr('id').split('_');
		$('#hide_and_show'+got_element[1]).css('display', 'block');
		
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