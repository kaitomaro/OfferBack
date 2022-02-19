@extends('layouts.app')

@section('pageCss')
<link rel="stylesheet" href="/css/store/menus/menu_index.css">
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
					<h3>掲載用メニュー</h3>
					<div class="menu">
                        <form method="POST" action="{{'/store/menus/create'}}">
                            @csrf
						    <table class="table table-striped set_width">
                                <tr>
                                    <th width="45%">メニュー名</th>
                                    <th width="20%">価格</th>
                                    <th width="35%"></th>
                                </tr>
                                <tr>
                                    <th>飲み物</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($drink_menus as $drink_menu)
                                    <tr>
                                        <td width="45%" class="shown_name for_show_{{$drink_menu->id}}" id="name_{{$drink_menu->id}}">{{$drink_menu->name}}</td>
                                        <td width="20%" class="shown_price for_show_{{$drink_menu->id}}" id="price_{{$drink_menu->id}}">￥{{ $drink_menu->price }}</td>
                                        <td width="35%" class="shown_button for_show_{{$drink_menu->id}}"><button class="edit_button" type="button" id="{{$drink_menu->id}}"><i class="fas fa-edit"></i></button></td>
                                        <td width="45%" class="name for_edit_{{$drink_menu->id}}"><input type="text" name="name[{{$drink_menu->id}}]" value="{{$drink_menu->name}}" class="form-control"></td>
                                        <td  width="20%" class="price for_edit_{{$drink_menu->id}}">
                                            <input type="text" name="price[{{$drink_menu->id}}]" value="{{$drink_menu->price}}" class="form-control">
                                            <input type="hidden" name="id" value="{{$drink_menu->id}}" id="id_{{$drink_menu->id}}" disabled>
                                        </td>
                                        <td width="35%" class="submit_button for_edit_{{$drink_menu->id}} button_frame">
                                            <input type="submit" name="update_drink_menu" class="btn btn-primary" value="更新">
                                            <button type="submit" name="delete_menu" class="btn btn-danger danger_position" value="{{$drink_menu->id}}">削除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <input type="text" name="drink_name" class="form-control" placeholder="例. 生ビール, コーラ, 日本酒">
                                    </td>
                                    <td>
                                        <input type="text" name="drink_price" class="form-control" placeholder="例. 100, 290, 390, 500">
                                    </td>
                                    <td class="add_frame">
                                        <button class="btn btn-primary add_button" type="submit" name="add_drink_button" value="1"><i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>食べ物</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($food_menus as $food_menu)
                                <tr>
                                    <td width="45%" class="shown_name for_show_{{$food_menu->id}}" id="name_{{$food_menu->id}}">{{$food_menu->name}}</td>
                                    <td width="20%" class="shown_price for_show_{{$food_menu->id}}" id="price_{{$food_menu->id}}">￥{{ $food_menu->price }}</td>
                                    <td width="35%" class="shown_button for_show_{{$food_menu->id}}"><button class="edit_button" type="button" id="{{$food_menu->id}}"><i class="fas fa-edit"></i></button></td>
                                    <td width="45%" class="name for_edit_{{$food_menu->id}}"><input type="text" name="name[{{$food_menu->id}}]" value="{{$food_menu->name}}" class="form-control"></td>
                                    <td  width="20%" class="price for_edit_{{$food_menu->id}}">
                                        <input type="text" name="price[{{$food_menu->id}}]" value="{{$food_menu->price}}" class="form-control">
                                        <input type="hidden" name="id" value="{{$food_menu->id}}" id="id_{{$food_menu->id}}" disabled>
                                    </td>
                                    <td width="35%" class="submit_button for_edit_{{$food_menu->id}} button_frame">
                                        <input type="submit" name="update_food_menu" class="btn btn-primary" value="更新">
                                        <button type="submit" name="delete_menu" class="btn btn-danger danger_position" value="{{$food_menu->id}}">削除</button>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <input type="text" name="food_name" class="form-control" placeholder="例. ハンバーグ, もつ煮込み, ポテトサラダ">
                                    </td>
                                    <td>
                                        <input type="text" name="food_price" class="form-control" placeholder="例. 490, 590, 800, 1200">
                                    </td>
                                    <td class="add_frame">
                                        <button class="btn btn-primary add_button" type="submit" name="add_food_button" value="1"><i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>ランチメニュー</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($lunch_menus as $lunch_menu)
                                    <tr>
                                        <td width="45%" class="shown_name for_show_{{$lunch_menu->id}}" id="name_{{$lunch_menu->id}}">{{$lunch_menu->name}}</td>
                                        <td width="20%" class="shown_price for_show_{{$lunch_menu->id}}" id="price_{{$lunch_menu->id}}">￥{{ $lunch_menu->price }}</td>
                                        <td width="35%" class="shown_button for_show_{{$lunch_menu->id}}"><button class="edit_button" type="button" id="{{$lunch_menu->id}}"><i class="fas fa-edit"></i></button></td>
                                        <td width="45%" class="name for_edit_{{$lunch_menu->id}}"><input type="text" name="name[{{$lunch_menu->id}}]" value="{{$lunch_menu->name}}" class="form-control"></td>
                                        <td  width="20%" class="price for_edit_{{$lunch_menu->id}}">
                                            <input type="text" name="price[{{$lunch_menu->id}}]" value="{{$lunch_menu->price}}" class="form-control">
                                            <input type="hidden" name="id" value="{{$lunch_menu->id}}" id="id_{{$lunch_menu->id}}" disabled>
                                        </td>
                                        <td width="35%" class="submit_button for_edit_{{$lunch_menu->id}} button_frame">
                                            <input type="submit" name="update_lunch_menu" class="btn btn-primary" value="更新">
                                            <button type="submit" name="delete_menu" class="btn btn-danger danger_position" value="{{$lunch_menu->id}}">削除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <input type="text" name="lunch_name" class="form-control" placeholder="例. ランチセットA, ロコモコ">
                                    </td>
                                    <td>
                                        <input type="text" name="lunch_price" class="form-control" placeholder="例. 100, 290, 390, 500">
                                    </td>
                                    <td class="add_frame">
                                        <button class="btn btn-primary add_button" type="submit" name="add_lunch_button" value="1"><i class="fas fa-plus"></i></button>
                                    </td>
                                </tr>
						    </table>
                        </form>
					</div>
                    <div>
                        <div class="course_title">
                            <h6>コース料理</h6>
                        </div>
                        <form method="POST" action="{{'/store/menus/create'}}" enctype="multipart/form-data">
                            @csrf
                            <div class="course_menus_frame">
                                <div class="course_title_container">
                                    <div class="course_title_frame">
                                        <strong><p class="name_title">コース名</p></strong>
                                        <strong><p class="price_title">価格</p></strong>
                                    </div>
                                </div>
                                @foreach ($course_menus as $key => $menu)
                                    @if ($key % 2 == 0)
                                    <div class="white">
                                    <div class="course_name_frame shown_name for_show_course_inline_{{$menu->id}}" id="name_{{$menu->id}}">
                                        <p>{{$menu->name}}</p>
                                    </div>
                                    <div class="cource_price_frame shown_price for_show_course_inline_{{$menu->id}}" id="price_{{$menu->id}}">
                                        <p>￥{{$menu->price}}</p>
                                    </div>
                                    <div class="course_button_frame shown_button for_show_course_inline_{{$menu->id}}">
                                        <button class="btn edit_button" type="button" name="edit_course_button" value="1" id="{{$menu->id}}"><i class="fas fa-edit"></i></button>
                                    </div>
                                    <div class="cource_detail_frame shown_detail for_show_course_block_{{$menu->id}}">
                                        <p>
                                            {{$menu->detail}}
                                        </p>
                                    </div>
                                    <div class="course_name_frame for_edit_{{$menu->id}} edit_course_name_{{$menu->id}} course_edit">
                                        <input type="text" name="name[{{$menu->id}}]" value="{{$menu->name}}" class="form-control" placeholder="例. 3000円コース, 満腹コース, 飲み放題２時間">
                                    </div>
                                    <div class="cource_price_frame for_edit_{{$menu->id}} edit_course_price_{{$menu->id}} course_edit">
                                        <input type="text" name="price[{{$menu->id}}]" value="{{$menu->price}}" class="form-control" placeholder="例. 2500, 3000, 5000">
                                    </div>
                                    <div class="cource_detail_frame for_edit_{{$menu->id}} edit_course_detail_{{$menu->id}} course_edit">
                                        <textarea　wrap="hard" name="detail[{{$menu->id}}]" id="" class="form-control" placeholder="例.&#13;【コース内容】&#13;飲み放題２時間&#13;ラストオーダー90分&#13;お料理7品">{{$menu->detail}}</textarea>
                                    </div>
                                    <div class="cource_submit_button for_edit_{{$menu->id}} edit_course_button_{{$menu->id}} course_edit">
                                        <input type="hidden" name="id" value="{{$menu->id}}" id="id_{{$menu->id}}" disabled>
                                        <button type="submit" class="btn btn-primary" name="update_course_menu" value="1">更新</button>
                                        <button type="submit" class="btn btn-danger danger_position" name="delete_menu" value="{{$menu->id}}">削除</button>
                                    </div>
                                </div>    
                                    @else
                                        <div class="gray">
                                            <div class="course_name_frame shown_name for_show_course_inline_{{$menu->id}}" id="name_{{$menu->id}}">
                                                <p>{{$menu->name}}</p>
                                            </div>
                                            <div class="cource_price_frame shown_price for_show_course_inline_{{$menu->id}}" id="price_{{$menu->id}}">
                                                <p>￥{{$menu->price}}</p>
                                            </div>
                                            <div class="course_button_frame shown_button for_show_course_inline_{{$menu->id}}">
                                                <button class="btn edit_button" type="button" name="edit_course_button" value="1" id="{{$menu->id}}"><i class="fas fa-edit"></i></button>
                                            </div>
                                            <div class="cource_detail_frame shown_detail for_show_course_block_{{$menu->id}}">
                                                <p>
                                                    {{$menu->detail}}
                                                </p>
                                            </div>
                                            <div class="course_name_frame for_edit_{{$menu->id}} edit_course_name_{{$menu->id}} course_edit">
                                                <input type="text" name="name[{{$menu->id}}]" value="{{$menu->name}}" class="form-control" placeholder="例. 3000円コース, 満腹コース, 飲み放題２時間">
                                            </div>
                                            <div class="cource_price_frame for_edit_{{$menu->id}} edit_course_price_{{$menu->id}} course_edit">
                                                <input type="text" name="price[{{$menu->id}}]" value="{{$menu->price}}" class="form-control" placeholder="例. 2500, 3000, 5000">
                                            </div>
                                            <div class="cource_detail_frame for_edit_{{$menu->id}} edit_course_detail_{{$menu->id}} course_edit">
                                                <textarea　wrap="hard" name="detail[{{$menu->id}}]" id="" class="form-control" placeholder="例.&#13;【コース内容】&#13;飲み放題２時間&#13;ラストオーダー90分&#13;お料理7品">{{$menu->detail}}</textarea>
                                            </div>
                                            <div class="cource_submit_button for_edit_{{$menu->id}} edit_course_button_{{$menu->id}} course_edit">
                                                <input type="hidden" name="id" value="{{$menu->id}}" id="id_{{$menu->id}}" disabled>
                                                <button type="submit" class="btn btn-primary" name="update_course_menu" value="1">更新</button>
                                                <button type="submit" class="btn btn-danger danger_position" name="delete_menu" value="{{$menu->id}}">削除</button>
                                            </div>
                                        </div>    
                                    @endif
                                @endforeach
                                @if (count($course_menus) % 2 == 1)
                                <div class="gray add">
                                    <div class="course_name_frame">
                                        <input type="text" name="course_name" class="form-control" placeholder="例. 3000円コース, 満腹コース, 飲み放題２時間">
                                    </div>
                                    <div class="cource_price_frame">
                                        <input type="text" name="course_price" class="form-control" placeholder="例. 2500, 3000, 5000">
                                    </div>
                                    <div class="cource_detail_frame">
                                        <textarea wrap="hard" name="course_detail" id="" class="form-control" placeholder="例.&#13;【コース内容】&#13;飲み放題２時間&#13;ラストオーダー90分&#13;お料理7品">
                                        </textarea>
                                    </div>
                                    <div class="course_button_frame">
                                        <button class="btn btn-primary add_button" type="submit" name="add_course_button" value="1"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>  
                                @else
                                <div class="white add">
                                    <div class="course_name_frame">
                                        <input type="text" name="course_name" class="form-control" placeholder="例. 3000円コース, 満腹コース, 飲み放題２時間">
                                    </div>
                                    <div class="cource_price_frame">
                                        <input type="text" name="course_price" class="form-control" placeholder="例. 2500, 3000, 5000">
                                    </div>
                                    <div class="cource_detail_frame">
                                        <textarea　wrap="hard" name="course_detail" id="" class="form-control" placeholder="例.&#13;【コース内容】&#13;飲み放題２時間&#13;ラストオーダー90分&#13;お料理7品">
                                        </textarea>
                                    </div>
                                    <div class="course_button_frame">
                                        <button class="btn btn-primary add_button" type="submit" name="add_course_button" value="1"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </form>  
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="module">

$('.edit_button').on('click',function(){
    console.log($(this).attr('id'));
    for (var i=0; i < $('.shown_name').length; i++) {
        let name_element = $('.shown_name')[i];
        let price_element = $('.shown_price')[i];
        let button_element = $('.shown_button')[i];
        let cssStyleDeclaration = getComputedStyle(name_element, null);
        var is_hide_name = cssStyleDeclaration.getPropertyValue("display")
        if (is_hide_name === "none") {
            console.log(name_element.id);
            let got_id = name_element.id.split('_');
            got_id = got_id[1];
            $('.for_show_'+got_id).css('display', 'table-cell');
            $('.for_show_course_inline_'+got_id).css('display', 'inline-block');
            $('.for_show_course_block_'+got_id).css('display', 'block');
            $('#id_'+got_id).prop('disabled', true);
            $('.for_edit_'+got_id).css('display', 'none');
        }   
    }
    $('.for_show_'+$(this).attr('id')).css('display', 'none');
    $('.for_show_course_inline_'+$(this).attr('id')).css('display', 'none');
    $('.for_show_course_block_'+$(this).attr('id')).css('display', 'none');
    $('.for_edit_'+$(this).attr('id')).css('display', 'table-cell');
    $('.edit_course_name_'+$(this).attr('id')).css('display', 'inline-block');
    $('.edit_course_price_'+$(this).attr('id')).css('display', 'inline-block');
    $('.edit_course_detail_'+$(this).attr('id')).css('display', 'block');
    $('.edit_course_button_'+$(this).attr('id')).css('display', 'block');
    $('#id_'+$(this).attr('id')).prop('disabled', false);
})

$("input").on("keydown",function(ev){
    if ((ev.which && ev.which === 13) ||(ev.keyCode && ev.keyCode === 13)){
      return false;
    } else {
      return true;
    }
});
</script>
@endsection