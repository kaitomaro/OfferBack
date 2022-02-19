@extends('layouts.admin.app')
@section('pageCss')
<link rel="stylesheet" href="/css/store/bills/bill_detail.css">
@endsection

@section('content')

<div class="container">
	<div class="raw">
		<div class="col-sm-12 col-md-10 change_position">
			<div class="store_info">
                <div class="menu">
                    <h3>{{$year_and_month}}</h3>
                    <form method="POST" action="{{'/'}}">
                        @csrf
                        <table class="table set_width">
                            <tr>
                                <th width="20%">使用時刻</th>
                                <th width="20%">店舗名</th>
                                <th width="20%">クーポン名</th>
                                <th width="20%">人数(人)</th>
                                <th width="20%">組合計（円）</th>
                            </tr>
                            @foreach ($earnings as $earning)
                            <tr>
                                <th width="20%">{{$earning->created_at}}</th>
                                <th width="20%">{{ $earning->name }}</th>
                                <th width="20%">{{$earning->coupon_name}}</th>
                                <th width="20%">{{$earning->people}}</th>
                                <th width="20%">{{$earning->people * 30}}</th>
                            </tr>
                            @endforeach
                            <tr>
                                <th width="20%">計</th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="20%">{{$earnings->sum('people')}}</th>
                                @if ($year_and_month == "2021年07月" || $year_and_month == "2021年08月" || $year_and_month == "2021年09月" || $year_and_month == "2021年10月")
                                <th width="20%">0({{$earnings->sum('people') * 30}})</th>    
                                @else
                                <th width="20%">{{$earnings->sum('people') * 30}}</th>
                                @endif
                            </tr>
                        </table>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection