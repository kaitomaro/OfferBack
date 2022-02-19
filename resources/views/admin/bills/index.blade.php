@extends('layouts.admin.app')

@section('pageCss')
<link rel="stylesheet" href="/css/store/bills/bill_index.css">
@endsection

@section('content')

<div class="container">
	<div class="raw">
		<div class="col-sm-12 col-md-10 change_position">
			<div class="store_info">
                <div class="menu">
                    <h3>{{$shop->name}}: ご利用金額</h3>
                    <table class="table table-striped set_width">
                        <tr>
                            <th width="20%">月</th>
                            <th width="20%">人数(人)</th>
                            <th width="20%">回数(回)</th>
                            <th width="20%">合計(円)</th>
                            <th width="20%">支払い（済・未）</th>
                        </tr>
                        @foreach ($earning as $item)
                        <tr>
                            <td><a href="/admin/show/{{$shop->id}}/bills/{{$item->yearmonth}}">{{ $item->yearmonth }}</a></td>
                            <td>{{ $item->people_sum }}</td>
                            <td>{{ $item->count }}</td>
                            @if ($item->yearmonth == "2021-07" || $item->yearmonth == "2021-08" || $item->yearmonth == "2021-09" || $item->yearmonth == "2021-10")
                                <td>0({{ $item->earning }})</td>
                                <td style="color: blue">済</td>
                            @else
                                <td>{{ $item->earning }}</td>
                                <td style="color: blue"></td>
                            @endif
                        </tr>
                        @endforeach
                            
                        {{-- <tr>
                            <td><a href="">9</a></td>
                            <td>24</td>
                            <td>12</td>
                            <td>{{ 30 * 24 }}</td>
                            <td style="color: blue">済</td>
                        </tr>
                        <tr>
                            <td><a href="">10</a></td>
                            <td>24</td>
                            <td>12</td>
                            <td>{{ 30 * 24 }}</td>
                            <td style="color: blue">済</td>
                        </tr>
                        <tr>
                            <td><a href="">11</a></td>
                            <td>24</td>
                            <td>12</td>
                            <td>{{ 30 * 24 }}</td>
                            <td style="color: blue">済</td>
                        </tr>
                        <tr>
                            <td><a href="">12</a></td>
                            <td>24</td>
                            <td>12</td>
                            <td>{{ 30 * 24 }}</td>
                            <td style="color: red">未</td>
                        </tr> --}}
                        
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection