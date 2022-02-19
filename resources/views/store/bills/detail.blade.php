@extends('layouts.app')

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
                                <th width="25%">使用時刻</th>
                                <th width="25%">クーポン名</th>
                                <th width="25%">人数(人)</th>
                                <th width="25%">組合計（円）</th>
                            </tr>
                            @foreach ($earnings as $earning)
                            <tr>
                                <th width="25%">{{$earning->created_at}}</th>
                                <th width="25%">{{$earning->name}}</th>
                                <th width="25%">{{$earning->people}}</th>
                                <th width="25%">{{$earning->people * 30}}</th>
                            </tr>
                            @endforeach
                            <tr>
                                <th width="25%">計</th>
                                <th width="25%"></th>
                                <th width="25%">{{$earnings->sum('people')}}</th>
                                @if ($year_and_month == "2021年07月" || $year_and_month == "2021年08月" || $year_and_month == "2021年09月" || $year_and_month == "2021年10月")
                                    <th width="25%">0({{$earnings->sum('people') * 30}})</th>    
                                @else
                                    @if ($shop->is_vip == 1)
                                        <th width="25%">0({{$earnings->sum('people') * 30}})</th>
                                    @else
                                        <th width="25%">{{$earnings->sum('people') * 30}}</th>
                                    @endif
                                @endif
                            </tr>
                            {{-- <tr class="add_border">
                                <th>2日</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>30</th>
                                <th>120</th>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>80</th>
                                <th>80</th>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>80</th>
                                <th>80</th>
                            </tr>
                            <tr class="add_border">
                                <th>4日</th><th></th><th></th>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>30</th>
                                <th>120</th>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>80</th>
                                <th>80</th>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>80</th>
                                <th>80</th>
                            </tr>
                            <tr class="add_border">
                                <th>5日</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>30</th>
                                <th>120</th>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>80</th>
                                <th>80</th>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>80</th>
                                <th>80</th>
                            </tr> --}}

                        </table>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection