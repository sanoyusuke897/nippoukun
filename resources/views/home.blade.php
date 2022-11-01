@extends('layouts.app')
@section('title', 'ダッシュボード')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center">
            @if (Auth::check())
            <div id="datetime" class="h1"></div>
            <h3 class="fw-bolder mt-5"><?php $user = Auth::user(); ?>{{ $user->name }}</h3>
            <p class="text-black-50"><?php $user = Auth::user(); ?>{{ $user->department }}</p>
            <button type="button" class="btn btn-warning btn-lg mt-5 fw-bolder" onclick="location.href='{{ route('create') }}'" style="width: 300px; height:100px; font-size:40px;">日報作成</button>
        </div>

        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12 mt-5 mb-5 dateSlide">

            <p class="fw-bold">▼<?php $user = Auth::user(); ?>{{ $user->department }} 週間提出状況</p>
            <table class="table table-bordered text-center bg-white">
                <thead class="table-bordered">
                    <tr class="dateSlideList">
                      <td scope="col" class="fw-bolder">氏名</td>
                      <th scope="col" class="date01"><sub>（月）</sub></th>
                      <th scope="col" class="date02"><sub>（火）</sub></th>
                      <th scope="col" class="date03"><sub>（水）</sub></th>
                      <th scope="col" class="date04"><sub>（木）</sub></th>
                      <th scope="col" class="date05"><sub>（金）</sub></th>
                      <th scope="col" class="table-secondary date06"><sub>（土）</sub></th>
                      <th scope="col" class="table-secondary date07"><sub>（日）</sub></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($departmentusers as $departmentuser)
                    <tr class="repotlist">

                      <th scope="row">
                         {{ $departmentuser->name }}
                        </th>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td class="bg-light">-</td>
                      <td class="bg-light">-</td>
                    </tr>
                    @endforeach
                  </tbody>

            </table>
            <p class="text-end small"><span style="color:#00FF2A">●</span> 出勤中 / <span style="color:#ccc">●</span> 退勤中 / <span style="color:red">●</span> 打刻忘れ</p>

            <!--<p class="fw-bold mt-5">▼<?php $user = Auth::user(); ?>{{ $user->department }} のタイムライン</p>

<div class="list-group">
    <div class="list-group-item list-group-item-action">
      <div class="d-flex w-100 justify-content-between">
        <p class="mb-1"><i class="bi bi-person-fill"></i> 深谷洋介 さんが日報を提出しました。</p>
        <small class="text-muted">19:20:17</small>
      </div>
    </div>
    <div class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
          <p class="mb-1"><i class="bi bi-person-fill"></i> 佐野祐介 さんが出勤しました。</p>
          <small class="text-muted">19:20:17</small>
        </div>
      </div>
      <div class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
          <p class="mb-1"><i class="bi bi-person-fill"></i> 青木琴音 さんが出勤しました。</p>
          <small class="text-muted">09:01:36</small>
        </div>
      </div>
      <div href="#" class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
          <p class="mb-1"><i class="bi bi-person-fill"></i> 市川良樹 さんが出勤しました。</p>
          <small class="text-muted">08:50:36</small>
        </div>
      </div>
  </div>-->
<!--
<form method="GET" action="" onsubmit="return false">
<input type="text" class="efo">
<button type="submit" id="wordbtn">send</button>
</form>


<form method="GET" action="" onsubmit="return false">
    <input type="text" class="telform_classname" name="telform">
    <button type="submit" class="telformbtn">送信</button>
</form>
-->
        </div>
        <div class="col-lg-2 col-sm-12"></div>

        <div class="col-12">
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
    </div>
</div>

<script>
//-----------日付表示-----------//
$(function(){
  var now = new Date();
  var wd = ['日', '月', '火', '水', '木', '金', '土'];

  $('.dateSlideList th').text(function(){
    var m=now.getMonth()+1;
    var d=now.getDate();
    var w=wd[now.getDay()];
    now.setDate(now.getDate()+1);
    return m+"/"+d+"("+w+")";
  });
});

//-----------レポート表示-----------//

// let reports = reports;

// for (let item of reports) {
//     console.log(item)
// }

// function HomeReportDefault (){
//     $('.repotlist td').text(function(){
//         return "report!";
//     })
// }

// HomeReportDefault();

function HomeReportDefault (){
    $.ajax({
        type:'POST',
        url:'{{ route('home_default') }}',
        dataType:'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    })
    .done(function(data) {

        console.log("default OK!");
        let reports = data.reports;

        let html = `○`;

        for (let item of reports) {
            console.log(item.date)
        }


        $('.repotlist td').text(function(){
        return html;
        })
    })
    .fail(function (data) {
        alert("error");
    })
};

HomeReportDefault();

</script>
@endsection
