@extends('layouts.app')

@section('pageCss')
<link rel="stylesheet" href="/css/store/images/image_index.css">
@endsection
@section('content')
    
<div class="container">
	<div class="raw">
		<div class="col-sm-12">
			<div class="store_info">
                <div class="images_frame">
                    <div class="image_frame">
                        <form method="post" action="{{'/store/images'}}" enctype="multipart/form-data" id="submit_image">
                            @csrf
                            @for ($i = 0; $i < 5; $i++)
                            <label for="img_file{{$i}}">
                                <span class="filelabel" title="ファイルを選択">
                                    @if (isset($images[$i]))
                                        <img src="{{ config('filesystems.disks.s3.url').$images[$i]->image_name}}" alt="">    
                                        <input type="hidden" name="id_{{$i}}" value="{{$images[$i]->id}}">
                                        <input type="hidden" name="sort_id" value="{{ $i }}">
                                        <input type="file" name="img_file{{$i}}" id="img_file{{$i}}" accept="image/png,image/jpeg,image/">
                                        <div class="delete_button_frame">
                                          <input type="submit" class="btn btn-danger delete_button" value="削除" name="delete_{{$i}}">
                                        </div>
                                    @else
                                        @if(count($images) == $i)
                                            @if ($i == 0)
                                              <img src="/img/outside.png" alt="">
                                              <input type="hidden" name="id_{{$i}}" value="0">
                                              <input type="hidden" name="sort_id" value="{{ $i }}">
                                              <input type="file" name="img_file{{$i}}" id="img_file{{$i}}" accept="image/png,image/jpeg,image/">
                                            @elseif ($i == 1)
                                              <img src="/img/inside.png" alt="">
                                              <input type="hidden" name="id_{{$i}}" value="0">
                                              <input type="hidden" name="sort_id" value="{{ $i }}">
                                              <input type="file" name="img_file{{$i}}" id="img_file{{$i}}" accept="image/png,image/jpeg,image/">
                                            @else
                                              <img src="/img/menu.png" alt="">
                                              <input type="hidden" name="id_{{$i}}" value="0">
                                              <input type="hidden" name="sort_id" value="{{ $i }}">
                                              <input type="file" name="img_file{{$i}}" id="img_file{{$i}}" accept="image/png,image/jpeg,image/">
                                            @endif
                                        @else
                                          @if ($i == 0)
                                            <img src="/img/outside.png" class="disabled_image" alt="">
                                            <input type="hidden" name="id_{{$i}}" value="0">
                                            <input type="hidden" name="sort_id" value="{{ $i }}">
                                            <input type="file" name="img_file{{$i}}" id="img_file{{$i}}" accept="image/png,image/jpeg,image/">
                                          @elseif ($i == 1)
                                            <img src="/img/inside.png" class="disabled_image" alt="">
                                            <input type="hidden" name="id_{{$i}}" value="0">
                                            <input type="hidden" name="sort_id" value="{{ $i }}">
                                            <input type="file" name="img_file{{$i}}" id="img_file{{$i}}" accept="image/png,image/jpeg,image/">
                                          @else
                                            <img src="/img/menu.png" class="disabled_image" alt="">
                                            <input type="hidden" name="id_{{$i}}" value="0">
                                            <input type="hidden" name="sort_id" value="{{ $i }}">
                                            <input type="file" name="img_file{{$i}}" id="img_file{{$i}}" accept="image/png,image/jpeg,image/">
                                          @endif
                                        @endif
                                    @endif
                                </span>
                            </label>
                            @endfor
                            <input type="hidden" name="store_image_x" value="0" id="store_image_x">
                            <input type="hidden" name="store_image_y" value="0" id="store_image_y">
                            <input type="hidden" name="store_image_width" value="0" id="store_image_width">
                            <input type="hidden" name="store_image_height" value="0" id="store_image_height">
                        </form>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
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
<script type="module">
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;
    var cropperData;
    var file;
    
    $("#img_file0").on("change", function(e){
        $('input[name=sort_id').val("0");
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
    
    $("#img_file1").on("change", function(e){
        $('input[name=sort_id').val("1");
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

    
    $("#img_file2").on("change", function(e){
        $('input[name=sort_id').val("2");
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

    
    $("#img_file3").on("change", function(e){
        $('input[name=sort_id').val("3");
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

    
    $("#img_file4").on("change", function(e){
        $('input[name=sort_id').val("4");
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
            aspectRatio: 2.4,
            crop(event) {
                cropperData = cropper.getData();
                console.log(event.detail.x);
                console.log(event.detail.y);
                console.log(event.detail.width);
                console.log(event.detail.height);
                $("#store_image_x").val(Math.floor(cropperData.x));
                $("#store_image_y").val(Math.floor(cropperData.y));
                $("#store_image_width").val(Math.floor(cropperData.width));
                $("#store_image_height").val(Math.floor(cropperData.height));
            },
        });
    }).on('hidden.bs.modal', function () {
       cropper.destroy();
       cropper = null;
    });
    
    $('#crop').click( function () {

        console.log($("#store_image_x").val());
        console.log($("#store_image_y").val());
        console.log($("#store_image_width").val());
        console.log($("#store_image_height").val());
        $('#submit_image').submit();
        $modal.modal('hide');

    });
    
</script>
@endsection
