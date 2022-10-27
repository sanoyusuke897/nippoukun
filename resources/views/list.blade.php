@extends('layouts.app')
@section('title', '提出履歴')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> 提出履歴</small>
            <h4 class="fw-bold mt-2">提出履歴</h4>
<div class="bg-white p-5 mt-4">

    <select class="form-select" aria-label="Default select example" id="month" name="month">
        <option selected value="10">2022年10月の提出履歴</option>
        <option value="9">2022年9月の提出履歴</option>
        <option value="8">2022年8月の提出履歴</option>
        <option value="7">2022年7月の提出履歴</option>
        <option value="6">2022年6月の提出履歴</option>
      </select>


        <div id="daily_list">

        </div>

        </div>
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
        <div class="col-lg-2 col-sm-12"></div>
    </div>
</div>
<script>
$(function() {

    //-------月別を取得------//



    //-------コピーして作成------//
    function urllink (id){
	dailyidUrl = 'copy_create/' + id;
    dailydetailurl = 'daily_detail/' + id;
    }

    function daily_list (urllink) {
        return `
        <table class="table mt-5">
                <thead>
                <tr>
                    <th scope="col">日付</th>
                    <th scope="col">ステータス</th>
                    <th scope="col">提出日時</th>
                    <th scope="col" class="text-end">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dailies as $daily)
                <tr>
                    <th scope="row">{{ $daily->id}} 日</th>
                    <td><span class="badge rounded-pill bg-success">提出済み</span></td>
                    <td>{{ $daily->created_at}}</td>
                    <td class="text-end"><a href="{{route('daily_detail', [$daily['id']])}}">詳細</a> | <a href="{{route('copy_create', [$daily['id']])}}">コピーして作成</a></td>
                </tr>
                @endforeach
                <tbody>
            </table>
        `;
    }

    //------月別提出履歴（デフォルト）-----//
    function ListDefault (){
        $.ajax({
            type:'POST',
            url:'{{ route('list_default') }}',
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function (data) {
            console.log("default OK!");
            let html = daily_list();
            $('#daily_list').html(html);
        })
        .fail(function (data) {
            alert("error");
        })
    };

    ListDefault();



    //------月別提出履歴-----//
    function daily_list_add (html) {
        $('#daily_list').html(html);
    }

    $('select').change(function() {
        console.log($('#month').val());
        $.ajax({
            type:'POST',
            url:'{{ route('list_default') }}',
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                month:$('#month').val(),
            },
        })
        .done(function(data){

            //console.log(data);
            //console.log("data");
            console.log(JSON.stringify(data));


            let dailies = data.dailies;

            let html = `
            <table class="table mt-5">
                <thead>
                <tr>
                    <th scope="col">日付</th>
                    <th scope="col">ステータス</th>
                    <th scope="col">提出日時</th>
                    <th scope="col" class="text-end">操作</th>
                </tr>
                </thead>
                <tbody>
            `;

            for (let item of dailies) {

                console.log(item.date)
                html += "<tr>";
                html += "<td>" + item.id + "日</td>";
                html += `<td><span class="badge rounded-pill bg-success">提出済み</span></td>`;
                html += "<td>" + item.created_at + "</td>";
                html += `<td class="text-end"><a href="daily_detail/${item.id}">詳細</a> | <a href="copy_create/${item.id}">コピーして作成</a></td>`;
                html += "</tr>";
            }

            html += "<tbody></table>";
            daily_list_add (html);

        })
        .fail(function(data){
            alert("error");
        })
    });





});
</script>
@endsection
