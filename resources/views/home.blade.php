@extends('layouts.app')
@section('title', 'ダッシュボード')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            @if (Auth::check())
            <div id="datetime" class="h1"></div>
            <h3 class="fw-bolder mt-5"><?php $user = Auth::user(); ?>{{ $user->name }}</h3>
            <p class="text-black-50"><?php $user = Auth::user(); ?>{{ $user->department }}</p>
            <button type="button" class="btn btn-warning btn-lg mt-5 fw-bolder" onclick="location.href='{{ route('create') }}'" style="width: 300px; height:100px; font-size:40px;">日報作成</button>
        </div>

        @foreach ($departmentreports as $departmentname => $reportslists)

        <div class="col-lg-2 col-sm-12 mt-5"></div>
        <div class="col-lg-8 col-sm-12 mt-3 mb-3 dateSlide">

                    <p class="fw-bold">▼ {{$departmentname}}の週間提出状況</p>


            <table class="table table-bordered text-center bg-white mt-3">
                <thead class="table-bordered">
                    <tr class="dateSlideList">
                      <td scope="col" class="fw-bolder">氏名</td>
                      <?php
                        $today = date("md");
                      ?>

                        <th scope="col" {{ date('m/d') === date('m/d', strtotime('this week Monday')) ? 'class=date_background' : ''; }}>
                            <?php echo date("m/d", strtotime("this week Monday")); ?>
                            <sub>（月）</sub></span>
                        </th>
                        <th scope="col" {{ date('m/d') === date('m/d', strtotime('this week Tuesday')) ? 'class=date_background' : ''; }}>
                            <?php echo date("m/d", strtotime("this week Tuesday")); ?>
                            <sub>（火）</sub>
                        </th>
                        <th scope="col" {{ date('m/d') === date('m/d', strtotime('this week Wednesday')) ? 'class=date_background' : ''; }}>
                            <?php echo date("m/d", strtotime("this week Wednesday")); ?>
                            <sub>（水）</sub>
                        </th>
                        <th scope="col" {{ date('m/d') === date('m/d', strtotime('this week Thursday')) ? 'class=date_background' : ''; }}>
                            <?php echo date("m/d", strtotime("this week Thursday")); ?>
                            <sub>（木）</sub>
                        </th>
                        <th scope="col" {{ date('m/d') === date('m/d', strtotime('this week Friday')) ? 'class=date_background' : ''; }}>
                            <?php echo date("m/d", strtotime("this week Friday")); ?>
                            <sub>（金）</sub>
                        </th>
                        <th scope="col" class="table-secondary date06 saturday-th"><?php echo date("m/d", strtotime("this week Saturday")); ?><sub>（土）</sub></th>
                        <th scope="col" class="table-secondary date07 sunday-th"><?php echo date("m/d", strtotime("this week Sunday")); ?><sub>（日）</sub></th>
                    </tr>
                  </thead>

                  <tbody>

                    @foreach ( $reportslists as $name => $lists )
                    <tr class="repotlist">
                        <th scope="row">
                            {{ $name }}
                        </th>
                        <?php

                        //dd($reportslists);

                        $test=$lists->groupBy(function ($row) {
                            return $row->created_at->format('ymd');
                        });


                        $keys=$test->keys();

                        //dd($test, $keys);
                        //$test[date("ymd", strtotime("monday this week"))]->last();
                        //dd($test[221227]);
                        //$keys->all();
                        //dd($keys);
                        //dd($lists);

                        //$reports=$test->last();

                        //dd($reports);

                        //dd($lists);
                        //dd($lists->report);

                        //dd(date("md", strtotime("Tuesday this week")));
                        //dd($keys[0]->$reports);
                        ?>


                        <td {{ date('m/d') === date('m/d', strtotime('this week Monday')) ? 'class=datetd_background' : ''; }}>
                            @if (!$test->get(date("ymd", strtotime("Monday this week"))))
                            <span></span>
                            @else
                                @if ($test[date("ymd", strtotime("monday this week"))]->last()->report === 1)
                                <span><a href="../daily_detail/{{ $test[date("ymd", strtotime("monday this week"))]->last()->did }}">○</a></span>
                                @elseif($test[date("ymd", strtotime("monday this week"))]->last()->report === 0)
                                <span>×</span>
                                @endif
                            @endif
                        </td>

                        <td {{ date('m/d') === date('m/d', strtotime('this week tuesday')) ? 'class=datetd_background' : ''; }}>
                            @if (!$test->get(date("ymd", strtotime("tuesday this week"))))
                            <span></span>
                            @else
                                @if ($test[date("ymd", strtotime("tuesday this week"))]->last()->report === 1)
                                <span><a href="../daily_detail/{{ $test[date("ymd", strtotime("tuesday this week"))]->last()->did }}">○</a></span>
                                @elseif($test[date("ymd", strtotime("tuesday this week"))]->last()->report === 0)
                                <span>×</span>
                                @endif
                            @endif
                        </td>

                        <td {{ date('m/d') === date('m/d', strtotime('this week wednesday')) ? 'class=datetd_background' : ''; }}>
                            @if  (!$test->get(date("ymd", strtotime("wednesday this week"))))
                            <span></span>
                            @else
                                @if ($test[date("ymd", strtotime("wednesday this week"))]->last()->report === 1)
                                <span><a href="../daily_detail/{{ $test[date("ymd", strtotime("wednesday this week"))]->last()->did }}">○</a></span>
                                @elseif($test[date("ymd", strtotime("wednesday this week"))]->last()->report === 0)
                                <span>×</span>
                                @endif
                            @endif
                        </td>


                        <?php

                        if ($departmentname === '営業部') {
                            //dd($test->get(0));
                            //dd($test->get(date("ymd", strtotime("monday this week"))));
                            //dd($test[date("ymd", strtotime("thursday this week"))]);
                            //dd(array_keys($test->toArray()));
                            //dd(array_keys($test->toArray()));
                            //dd(array_filter(array_keys($test->toArray()), static function ($item) {return $item === date("ymd", strtotime("thursday this week"));}));
                        }
                        ?>


                        <td {{ date('m/d') === date('m/d', strtotime('this week thursday')) ? 'class=datetd_background' : ''; }}>
                            @if (!$test->get(date("ymd", strtotime("thursday this week"))))
                            <span></span>
                            @else
                                @if ($test[date("ymd", strtotime("thursday this week"))]->last()->report === 1)
                                <span><a href="../daily_detail/{{ $test[date("ymd", strtotime("thursday this week"))]->last()->did }}">○</a></span>
                                @elseif($test[date("ymd", strtotime("thursday this week"))]->last()->report === 0)
                                <span>×</span>
                                @endif
                            @endif
                        </td>



                        <td {{ date('m/d') === date('m/d', strtotime('this week friday')) ? 'class=datetd_background' : ''; }}>
                            @if(!$test->get(date("ymd", strtotime("friday this week"))))
                            <span></span>
                            @else
                                @if ($test[date("ymd", strtotime("friday this week"))]->last()->report === 1)
                                <span><a href="../daily_detail/{{ $test[date("ymd", strtotime("friday this week"))]->last()->did }}">○</a></span>
                                @elseif($test[date("ymd", strtotime("friday this week"))]->last()->report === 0)
                                <span>×</span>
                                @endif
                            @endif
                        </td>


                        <td class="bg-light">
                            -
                        </td>
                        <td class="bg-light">
                            -
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>


        </div>
        <div class="col-lg-2 col-sm-12"></div>
        @endforeach


        <div class="col-12">
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
    </div>
</div>

{{-- <script>
'use strict';

$(function(){
    const now = new Date();
    const month = now.getMonth()+1;
    const date = now.getDate();

    const today = month+'/'+date;
    const day = $(".dateValue").text();

    console.log(today);
    console.log(day);

    if (today === day && Month === thismonth) {
        $("th").addClass("date");
    } else {
        $("th").removeClass("date");
    }
});
</script>--}}
@endsection
