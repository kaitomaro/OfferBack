@extends('layouts.app')

@section('pageCss')
<link rel="stylesheet" href="/css/store/services/show_service.css">
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
				<div class="menus">
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
					<h3>個別メニュー割引</h3>
					<div class="menu">
						<table class="table table-striped">
							<tr>
								<th>画像</th>
								<th>メニュー名</th>
								<th>価格</th>
								<th></th>
							</tr>
							@foreach ($services as $service)
							@if ($service->service_type == 0)
								<tr>
									<td><img id="img_{{$service->id}}" src="{{config('filesystems.disks.s3.url').$service->image_path}}" class="menu_img"></td>
									<td id="name_{{$service->id}}">{{ $service->name }}</td>
									<td  id="price_{{$service->id}}">{{ $service->price }}</td>
									<td class="font_icon"><button class="edit_button show_update_menu_modal" type="button" id="{{$service->id}}"><i class="fas fa-edit"></i></button></td>
								</tr>
							@endif
							@endforeach
						</table>
						<div class="add_button_position">
							<button class="btn btn-success" id="show_create_menu_modal">
								<i class="fas fa-plus-circle">
									メニュー追加
								</i>
							</button>
						</div>
						<div id="menu_editor_frame">
							<form method="post" action="{{'/store/services/create'}}" enctype='multipart/form-data'>
								{{ csrf_field() }}
								@csrf 
								<div class="menu">
									<div class="text-right">
										<button class="delete_button btn" id="close_menu_editor" onclick="CloseCreateMenuFrame();" type="button">
											閉じる
										</button>
									</div>
									<div class="fix_frame_width">
										<div class="menu_content frame_content">
											<div class="menu_name menu_element">
												<label class="required">メニュー名</label>
												<input type="text" name="name" class="form-control" placeholder="例. チャーハン, 食べ放題コース">
											</div>
											<div class="menu_price menu_element">
												<label class="optional">本来価格</label>
												<input type="text" name="price" class="form-control" placeholder="記入例. 100, 1000, 1500, 2500">
												<input type="hidden" name="service_type" value="0">
												<p>＊クーポン設定の際に割引額（円）を設定してください。</p>
											</div>
											<br>
											<label class="required">写真</label>
											<div class="menu_price menu_element input-group">
												<input id="file" class="image" type="file" name="menu_file" accept="image/*" autofocus>
												<input type="hidden" name="menu_image_x" class="menu_image_x" value="0">
												<input type="hidden" name="menu_image_y" class="menu_image_y" value="0">
												<input type="hidden" name="menu_image_height" class="menu_image_height" value="0">
												<input type="hidden" name="menu_image_width" class="menu_image_width" value="0">
												<div class="preview_frame">
													<img class="preview">
												</div>
											</div>
										</div>
										<div class="button_position">
											<input type="submit" class="btn btn-primary submit_button" value="追加" name="edit_service">
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="menu_update_frame">
							<form method="post" action="{{'/store/services/update'}}" enctype='multipart/form-data'>
								{{ csrf_field() }}
								@csrf 
								<div class="menu">
									<div class="text-right">
										<button class="delete_button btn" id="close_menu_editor" onclick="CloseUpdateMenuFrame();" type="button">
											閉じる
										</button>
									</div>
									<div class="fix_frame_width">
										<div class="menu_content frame_content">
											<div class="menu_name menu_element">
												<label class="required">メニュー名</label>
												<input type="text" name="name" class="form-control" placeholder="例. チャーハン, 食べ放題コース">
											</div>
											<div class="menu_price menu_element">
												<label class="optional">本来価格</label>
												<input type="text" name="price" class="form-control" placeholder="記入例. 100, 1000, 1500, 2500">
												<input type="hidden" name="service_type" value="0">
												<input type="hidden" name="id" value="0">
												<p>＊クーポン設定の際に割引額（円）を設定してください。</p>
											</div>
											<br>
											<label class="required">写真</label>
											<div class="menu_price menu_element input-group">
												<input id="file" class="image" type="file" name="menu_file" accept="image/*" autofocus>
												<input type="hidden" name="menu_image_x" class="menu_image_x" value="0">
												<input type="hidden" name="menu_image_y" class="menu_image_y" value="0">
												<input type="hidden" name="menu_image_height" class="menu_image_height" value="0">
												<input type="hidden" name="menu_image_width" class="menu_image_width" value="0">
												<div class="preview_frame">
													<img class="preview">
												</div>
											</div>
										</div>
										<div class="button_position">
											<input type="submit" class="btn btn-primary submit_button" value="更新" name="edit_service">
											<input type="submit" class="btn btn-danger delete_button" value="削除" name="delete">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<h3>無料券</h3>
					<div class="service">
						<table class="table table-striped">
							<tr>
								<th>画像</th>
								<th>サービス名</th>
								<th>価格</th>
								<th></th>
							</tr>
							@foreach ($services as $service)
							@if ($service->service_type ==1)
								<tr>
									<td><img id="img_{{$service->id}}" src="{{config('filesystems.disks.s3.url').$service->image_path}}" class="menu_img"></td>
									<td id="name_{{$service->id}}">{{ $service->name }}</td>
									<td  id="price_{{$service->id}}">{{ $service->price }}</td>
									<td class="font_icon">
										<button class="edit_button show_update_service_modal" type="button" id="{{$service->id}}">
											<i class="fas fa-edit"></i>
										</button>
									</td>
								</tr>
							@endif
							@endforeach
						</table>
						<div class="add_button_position">
							<button class="btn btn-success" id="show_create_service_modal">
								<i class="fas fa-plus-circle">
									無料券追加
								</i>
							</button>
						</div>
						<div id="service_editor_frame">
							<form method="post" action="{{'/store/services/create'}}" enctype='multipart/form-data'>
								{{ csrf_field() }}
								@csrf 
								<div class="menu">
									<div class="text-right">
										<button class="delete_button btn" id="close_service_editor" onclick="CloseCreateServiceFrame();" type="button">
											閉じる
										</button>
									</div>
									<div class="fix_frame_width">
										<div class="menu_content frame_content">
											<div class="menu_name menu_element">
												<label class="required">無料券の名称</label>
												<input type="text" name="name" class="form-control" placeholder="例. ワンドリンク無料券, 大盛り無料">
											</div>
											<div class="menu_price menu_element">
												<label class="optional">本来価格</label>
												<input type="text" name="price" class="form-control" placeholder="記入例. 100, 1000, 1500, 2500">
												<input type="hidden" name="service_type" value="1">
											</div>
											<br>
											<label class="required">写真</label>
											<div class="menu_price menu_element input-group">
												<input id="file" class="image" type="file" name="menu_file" accept="image/*" autofocus>
												<input type="hidden" name="menu_image_x" class="menu_image_x" value="0">
												<input type="hidden" name="menu_image_y" class="menu_image_y" value="0">
												<input type="hidden" name="menu_image_height" class="menu_image_height" value="0">
												<input type="hidden" name="menu_image_width" class="menu_image_width" value="0">
												<div class="preview_frame">
													<img class="preview">
												</div>
											</div>
										</div>
										<div class="button_position">
											<input type="submit" class="btn btn-primary submit_button" value="追加" name="edit_service">
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="service_update_frame">
							<form method="post" action="{{'/store/services/update'}}" enctype='multipart/form-data'>
								{{ csrf_field() }}
								@csrf 
								<div class="menu">
									<div class="text-right">
										<button class="delete_button btn" id="close_sevice_editor" onclick="CloseUpdateServiceFrame();" type="button">
											閉じる
										</button>
									</div>
									<div class="fix_frame_width">
										<div class="menu_content frame_content">
											<div class="menu_name menu_element">
												<label class="required">無料券の名称</label>
												<input type="text" name="name" class="form-control" placeholder="例. ワンドリンク無料券, 大盛り無料">
											</div>
											<div class="menu_price menu_element">
												<label class="optional">本来価格</label>
												<input type="text" name="price" class="form-control" placeholder="記入例. 100, 1000, 1500, 2500">
												<input type="hidden" name="service_type" value="1">
												<input type="hidden" name="id" value="0">
											</div>
											<br>
											<label class="required">写真</label>
											<div class="menu_price menu_element input-group">
												<input id="file" class="image" type="file" name="menu_file" accept="image/*" autofocus>
												<input type="hidden" name="menu_image_x" class="menu_image_x" value="0">
												<input type="hidden" name="menu_image_y" class="menu_image_y" value="0">
												<input type="hidden" name="menu_image_height" class="menu_image_height" value="0">
												<input type="hidden" name="menu_image_width" class="menu_image_width" value="0">
												<div class="preview_frame">
													<img class="preview">
												</div>
											</div>
										</div>
										<div class="button_position">
											<input type="submit" class="btn btn-primary submit_button" value="更新" name="edit_service">
											<input type="submit" class="btn btn-danger delete_button" value="削除" name="delete">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<h3>お会計から割引</h3>
					<div class="menu">
						<table class="table table-striped">
							<tr>
								<th>画像</th>
								<th>メニュー名</th>
								<th></th>
								<th></th>
							</tr>
							@foreach ($services as $service)
							@if ($service->service_type == 2)
								<tr>
								<td><img id="img_{{$service->id}}" src="{{config('filesystems.disks.s3.url').$service->image_path}}" class="menu_img"></td>
									<td id="name_{{$service->id}}">{{ $service->name }}</td>
									<td  id="price_{{$service->id}}"></td>
									<td class="font_icon">
										<button class="edit_button show_update_takeout_modal" type="button" id="{{$service->id}}">
											<i class="fas fa-edit"></i>
										</button>
									</td>
								</tr>
							@endif
							@endforeach
						</table>
						<div class="add_button_position">
							<button class="btn btn-success" id="show_create_takeout_modal">
								<i class="fas fa-plus-circle">
									メニュー追加
								</i>
							</button>
						</div>
						<div id="takeout_editor_frame">
							<form method="post" action="{{'/store/services/create'}}" enctype='multipart/form-data'>
								{{ csrf_field() }}
								@csrf 
								<div class="menu">
									<div class="text-right">
										<button class="delete_button btn" id="close_takeout_editor" onclick="CloseCreateTakeoutFrame();" type="button">
											閉じる
										</button>
									</div>
									<div class="fix_frame_width">
										<div class="menu_content frame_content">
											<div class="menu_name menu_element">
												<label class="required">メニュー名</label>
												<input type="text" name="name" class="form-control" placeholder="例. 会計割引, ランチ割引">
												<p>＊クーポン設定の際に割引額（円）または割引率（%）を設定してください。</p>
											</div>
											<div class="menu_price menu_element">
												<input type="text" name="price" class="form-control hidden_price" value={{0}}>
												<input type="hidden" name="service_type" value="2">
											</div>
											<br>
											<label class="required ">写真</label>
											<div class="menu_price menu_element input-group">
												<input id="file" class="image" type="file" name="menu_file" accept="image/*" autofocus>
												<input type="hidden" name="menu_image_x" class="menu_image_x" value="0">
												<input type="hidden" name="menu_image_y" class="menu_image_y" value="0">
												<input type="hidden" name="menu_image_height" class="menu_image_height" value="0">
												<input type="hidden" name="menu_image_width" class="menu_image_width" value="0">
												<div class="preview_frame">
													<img class="preview">
												</div>
											</div>
										</div>
										<div class="button_position">
											<input type="submit" class="btn btn-primary submit_button" value="追加" name="edit_service">
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="takeout_update_frame">
							<form method="post" action="{{'/store/services/update'}}" enctype='multipart/form-data'>
								{{ csrf_field() }}
								@csrf 
								<div class="menu">
									<div class="text-right">
										<button class="delete_button btn" id="close_takeout_editor" onclick="CloseUpdateTakeoutFrame();" type="button">
											閉じる
										</button>
									</div>
									<div class="fix_frame_width">
										<div class="menu_content frame_content">
											<div class="menu_name menu_element">
												<label class="required">メニュー名</label>
												<input type="text" name="name" class="form-control" placeholder="例. 会計割引, ランチ割引">
											</div>
											<div class="menu_price menu_element">
												<label class="optional">本来価格</label>
												<input type="text" name="price" class="form-control hidden_price" placeholder="記入例. 100, 1000, 1500, 2500">
												<input type="hidden" name="service_type" value="2">
												<input type="hidden" name="id" value="0">
												<p>＊クーポン設定の際に割引額（円）または割引率（%）を設定してください。</p>
											</div>
											<br>
											<label class="required">写真</label>
											<div class="menu_price menu_element input-group">
												<input id="file" class="image" type="file" name="menu_file" accept="image/*" autofocus>
												<input type="hidden" name="menu_image_x" class="menu_image_x" value="0">
												<input type="hidden" name="menu_image_y" class="menu_image_y" value="0">
												<input type="hidden" name="menu_image_height" class="menu_image_height" value="0">
												<input type="hidden" name="menu_image_width" class="menu_image_width" value="0">
												<div class="preview_frame">
													<img class="preview">
												</div>
											</div>
										</div>
										<div class="button_position">
											<input type="submit" class="btn btn-primary submit_button" value="更新" name="edit_service">
											<input type="submit" class="btn btn-danger delete_button" value="削除" name="delete">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
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
        aspectRatio: 2.3,
		crop(event) {
			cropperData = cropper.getData();
			console.log(event.detail.x);
			console.log(event.detail.y);
			console.log(event.detail.width);
			console.log(event.detail.height);
			$(".menu_image_x").val(Math.floor(cropperData.x));
			$(".menu_image_y").val(Math.floor(cropperData.y));
			$(".menu_image_width").val(Math.floor(cropperData.width));
			$(".menu_image_height").val(Math.floor(cropperData.height));
		},
    });
}).on('hidden.bs.modal', function () {
   cropper.destroy();
   cropper = null;
});

$('#crop').click( function () {
	console.log($("#menu_image_x").val());
	console.log($("#menu_image_y").val());
	console.log($("#menu_image_width").val());
	console.log($("#menu_image_height").val());
	$modal.modal('hide');
});


$('#show_create_menu_modal').click(function() {
	if ($('#menu_editor_frame').css('display') == 'block') {
		$('#menu_editor_frame').css({'display': 'none'});
	}
	if ($('#service_editor_frame').css('display') == 'block') {
		$('#service_editor_frame').css({'display': 'none'});
	}
	if ($('#takeout_editor_frame').css('display') == 'block') {
		$('#takeout_editor_frame').css({'display': 'none'});
	}
	if ($('#menu_update_frame').css('display') == 'block') {
		$('#menu_update_frame').css({'display': 'none'});
	}
	if ($('#service_update_frame').css('display') == 'block') {
		$('#service_update_frame').css({'display': 'none'});
	}
	if ($('#takeout_update_frame').css('display') == 'block') {
		$('#takeout_update_frame').css({'display': 'none'});
	}
	var name_val = $('input[name="name"]');
	var price_val = $('input[name="price"]');
	name_val.val("");
	price_val.val("");
	$(".preview").attr('src', "");
	$('#menu_editor_frame').css({'display':'block'});
});

$('#show_create_service_modal').click(function() {
	if ($('#menu_editor_frame').css('display') == 'block') {
		$('#menu_editor_frame').css({'display': 'none'});
	}
	if ($('#service_editor_frame').css('display') == 'block') {
		$('#service_editor_frame').css({'display': 'none'});
	}
	if ($('#takeout_editor_frame').css('display') == 'block') {
		$('#takeout_editor_frame').css({'display': 'none'});
	}
	if ($('#menu_update_frame').css('display') == 'block') {
		$('#menu_update_frame').css({'display': 'none'});
	}
	if ($('#service_update_frame').css('display') == 'block') {
		$('#service_update_frame').css({'display': 'none'});
	}
	if ($('#takeout_update_frame').css('display') == 'block') {
		$('#takeout_update_frame').css({'display': 'none'});
	}
	var name_val = $('input[name="name"]');
	var price_val = $('input[name="price"]');
	name_val.val("");
	price_val.val("");
	$(".preview").attr('src', "");
	$('#service_editor_frame').css({'display':'block'});
});

$('#show_create_takeout_modal').click(function() {
	if ($('#menu_editor_frame').css('display') == 'block') {
		$('#menu_editor_frame').css({'display': 'none'});
	}
	if ($('#service_editor_frame').css('display') == 'block') {
		$('#service_editor_frame').css({'display': 'none'});
	}
	if ($('#takeout_editor_frame').css('display') == 'block') {
		$('#takeout_editor_frame').css({'display': 'none'});
	}
	if ($('#menu_update_frame').css('display') == 'block') {
		$('#menu_update_frame').css({'display': 'none'});
	}
	if ($('#service_update_frame').css('display') == 'block') {
		$('#service_update_frame').css({'display': 'none'});
	}
	if ($('#takeout_update_frame').css('display') == 'block') {
		$('#takeout_update_frame').css({'display': 'none'});
	}
	var name_val = $('input[name="name"]');
	var price_val = $('input[name="price"]');
	name_val.val("");
	price_val.val(0);
	$(".preview").attr('src', "");
	$('#takeout_editor_frame').css({'display':'block'});
});

$('.show_update_menu_modal').on('click', function() {
	var id =  $(this).attr("id");
	if ($('#menu_editor_frame').css('display') == 'block') {
		$('#menu_editor_frame').css({'display': 'none'});
	}
	if ($('#service_editor_frame').css('display') == 'block') {
		$('#service_editor_frame').css({'display': 'none'});
	}
	if ($('#takeout_editor_frame').css('display') == 'block') {
		$('#takeout_editor_frame').css({'display': 'none'});
	}
	if ($('#menu_update_frame').css('display') == 'block') {
		$('#menu_update_frame').css({'display': 'none'});
	}
	if ($('#service_update_frame').css('display') == 'block') {
		$('#service_update_frame').css({'display': 'none'});
	}
	if ($('#takeout_update_frame').css('display') == 'block') {
		$('#takeout_update_frame').css({'display': 'none'});
	}
	$('#menu_update_frame').css({'display':'block'});

	var name = $('#name_'+id).text();
	var img = $('#img_'+id).attr('src');
	var price = $('#price_'+id).text();
	var id_val = $('input[name="id"]');
	var name_val = $('input[name="name"]');
	var price_val = $('input[name="price"]');
	id_val.val(id);
	name_val.val(name);
	price_val.val(price);
	$(".preview").attr('src', img);
});
$('.show_update_service_modal').on('click', function() {
	var id =  $(this).attr("id");
	if ($('#menu_editor_frame').css('display') == 'block') {
		$('#menu_editor_frame').css({'display': 'none'});
	}
	if ($('#service_editor_frame').css('display') == 'block') {
		$('#service_editor_frame').css({'display': 'none'});
	}
	if ($('#takeout_editor_frame').css('display') == 'block') {
		$('#takeout_editor_frame').css({'display': 'none'});
	}
	if ($('#menu_update_frame').css('display') == 'block') {
		$('#menu_update_frame').css({'display': 'none'});
	}
	if ($('#service_update_frame').css('display') == 'block') {
		$('#service_update_frame').css({'display': 'none'});
	}
	if ($('#takeout_update_frame').css('display') == 'block') {
		$('#takeout_update_frame').css({'display': 'none'});
	}
	$('#service_update_frame').css({'display':'block'});

	var name = $('#name_'+id).text();
	var img = $('#img_'+id).attr('src');
	var price = $('#price_'+id).text();
	var id_val = $('input[name="id"]');
	var name_val = $('input[name="name"]');
	var price_val = $('input[name="price"]');
	id_val.val(id);
	name_val.val(name);
	price_val.val(price);
	$(".preview").attr('src', img);
});

$('.show_update_takeout_modal').on('click', function() {
	var id =  $(this).attr("id");
	if ($('#menu_editor_frame').css('display') == 'block') {
		$('#menu_editor_frame').css({'display': 'none'});
	}
	if ($('#service_editor_frame').css('display') == 'block') {
		$('#service_editor_frame').css({'display': 'none'});
	}
	if ($('#takeout_editor_frame').css('display') == 'block') {
		$('#takeout_editor_frame').css({'display': 'none'});
	}
	if ($('#menu_update_frame').css('display') == 'block') {
		$('#menu_update_frame').css({'display': 'none'});
	}
	if ($('#service_update_frame').css('display') == 'block') {
		$('#service_update_frame').css({'display': 'none'});
	}
	if ($('#takeout_update_frame').css('display') == 'block') {
		$('#takeout_update_frame').css({'display': 'none'});
	}
	$('#takeout_update_frame').css({'display':'block'});

	var name = $('#name_'+id).text();
	var img = $('#img_'+id).attr('src');
	var price = $('#price_'+id).text();
	var id_val = $('input[name="id"]');
	var name_val = $('input[name="name"]');
	var price_val = $('input[name="price"]');
	id_val.val(id);
	name_val.val(name);
	price_val.val(0);
	
	$(".preview").attr('src', img);
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