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
        <div class="col-lg-8 col-sm-12 mt-5 mb-5">
            <p class="fw-bold">▼<?php $user = Auth::user(); ?>{{ $user->department }}ののの週間提出状況</p>
            <table class="table table-bordered text-center">
                <thead class="table-bordered">
                    <tr>
                      <th scope="col">氏名</th>
                      <th scope="col">20（月）</th>
                      <th scope="col">21（火）</th>
                      <th scope="col">22（水）</th>
                      <th scope="col">23（木）</th>
                      <th scope="col">24（金）</th>
                      <th scope="col" class="table-secondary">25（土）</th>
                      <th scope="col" class="table-secondary">26（日）</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">金本</th>
                      <td><a href="#">◯</a></td>
                      <td>◯</td>
                      <td>◯</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row">市川</th>
                      <td>◯</td>
                      <td>◯</td>
                      <td>◯</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <th scope="row">青木</th>
                      <td>◯</td>
                      <td>◯</td>
                      <td>◯</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                        <th scope="row">深谷</th>
                        <td>◯</td>
                        <td>◯</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <th scope="row">佐野</th>
                        <td>◯</td>
                        <td class="table-danger"><span class="text-danger">△</span></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                  </tbody>

            </table>
            <p class="text-end small"><span style="color:#00FF2A">●</span> 出勤中 / <span style="color:#ccc">●</span> 退勤中 / <span style="color:red">●</span> 打刻忘れ</p>
            <p class="fw-bold mt-5">▼<?php $user = Auth::user(); ?>{{ $user->department }}のタイムライン</p>
<ul>
    <li>19:20:17 深谷洋介さんが日報を提出しました。</li>
    <li>09:20:28 佐野祐介さんが出勤しました。</li>
    <li>09:01:36 青木琴音さんが出勤しました。</li>
</ul>
<form method="GET" action="" onsubmit="return false">
<input type="text" class="efo">
<button type="submit" id="wordbtn">send</button>
</form>


<form method="GET" action="" onsubmit="return false">
    <input type="text" class="telform_classname" name="telform">
    <button type="submit" class="telformbtn">送信</button>
</form>
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

var EFOvals = {
    '20': function(val, regex) { // 正規表現と一致
        try { // 11 ここが問題
            if(val.match(regex)) return true; // 12　一致した！！trueを返す→4へGO！（しかし、13へ行った。一致しなかった？console反映されてない）
            console.log(val);
            console.log(regex);
        } catch(err) {} // 13
        return false; // 14
    }
};

function NgWords (val, words) {
    var bool = true;
    try { // 1
        words = words.split('|'); // 2
        $.each(words, function (index, elem){ // 3
            if(EFOvals['20'](val, words[index])) {  // 4 trueを受け取って、そのまま→5へ↓
                bool = false;  // 5
                console.log(bool);
                return false;  // 6
            }  // 7
            console.log(bool);
        }); // 8
    } catch(err) {} // 9
    return bool; // 10
};

$('#wordbtn').click(function() {

    var val = $('.efo').val();
    var words = "\,|'|\"|\\\\";    // 3番目の「\\」がmatchしない
    let html = NgWords(val, words);

    alert(html);

});

//-----------正規表現-----------//
$('.telformbtn').click(function() {
		var telform = $(this).parent().children('.telform_classname').val();
		if (telform.match( /^[a-zA-Z0-9!-/:-@¥[-`{-~ +]*$/ )) {
			alert("OK");
		} else {
			alert("NO");
		};
	});

</script>
@endsection
