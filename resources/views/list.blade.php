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
    <p class="small">過去12ヶ月分の記録が表示できます。</p>

    <?php
    $thisDate = date("Y年m月");
    $thisDatevalue = date("Y-m");

    //表示用
    $lastMonth01 = date('Y年m月', strtotime('-1 month'));
    //value用
    $lastMonth01Value = date('Y-m', strtotime('-1 month'));


    $lastMonth02 = date('Y年m月', strtotime('-2 month'));
    $lastMonth02Value = date('Y-m', strtotime('-2 month'));
    $lastMonth03 = date('Y年m月', strtotime('-3 month'));
    $lastMonth03Value = date('Y-m', strtotime('-3 month'));
    $lastMonth04 = date('Y年m月', strtotime('-4 month'));
    $lastMonth04Value = date('Y-m', strtotime('-4 month'));
    $lastMonth05 = date('Y年m月', strtotime('-5 month'));
    $lastMonth05Value = date('Y-m', strtotime('-5 month'));
    $lastMonth06 = date('Y年m月', strtotime('-6 month'));
    $lastMonth06Value = date('Y-m', strtotime('-6 month'));
    $lastMonth07 = date('Y年m月', strtotime('-7 month'));
    $lastMonth07Value = date('Y-m', strtotime('-7 month'));
    $lastMonth08 = date('Y年m月', strtotime('-8 month'));
    $lastMonth08Value = date('Y-m', strtotime('-8 month'));
    $lastMonth09 = date('Y年m月', strtotime('-9 month'));
    $lastMonth09Value = date('Y-m', strtotime('-9 month'));
    $lastMonth10 = date('Y年m月', strtotime('-10 month'));
    $lastMonth10Value = date('Y-m', strtotime('-10 month'));
    $lastMonth11 = date('Y年m月', strtotime('-11 month'));
    $lastMonth11Value = date('Y-m', strtotime('-11 month'));
    $lastMonth12 = date('Y年m月', strtotime('-12 month'));
    $lastMonth12Value = date('Y-m', strtotime('-12 month'));
    ?>

    <div id="selectMonth" class="mt-3">
        <select class="form-select" aria-label="Default select example" id="DateSelect" name="DateSelect">
            <option selected value="<?php echo ($thisDatevalue); ?>"><?php echo ($thisDate); ?>の提出履歴</option>
            <option value="{{ $lastMonth01Value }}"><?php echo ($lastMonth01); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth02Value); ?>"><?php echo ($lastMonth02); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth03Value); ?>"><?php echo ($lastMonth03); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth04Value); ?>"><?php echo ($lastMonth04); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth05Value); ?>"><?php echo ($lastMonth05); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth06Value); ?>"><?php echo ($lastMonth06); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth07Value); ?>"><?php echo ($lastMonth07); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth08Value); ?>"><?php echo ($lastMonth08); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth09Value); ?>"><?php echo ($lastMonth09); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth10Value); ?>"><?php echo ($lastMonth10); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth11Value); ?>"><?php echo ($lastMonth11); ?>の提出履歴</option>
            <option value="<?php echo ($lastMonth12Value); ?>"><?php echo ($lastMonth12); ?>の提出履歴</option>
        </select>
    </div>




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

    // function addOptionLastMonth () {
    //     let select = document.getElementById("DateSelect");

    //     let dt = new Date();
    //     let year = dt.getFullYear();
    //     let month = dt.getMonth()+1;

    //     //一ヶ月前
    //     let lastMonth = dt.setMonth(month -2);
    //     var lastmonth = dt.getMonth()+1;

    //     console.log(lastmonth);

    // }

    // addOptionLastMonth();

    //-------年/月自動生成------//
    // function addOption() {
    //     let select = document.getElementById("DateSelect");

    //     let thisyear = new Date();
    //     let year =thisyear.getFullYear();
    //     let month =thisyear.getMonth()+1;
    //     let fragment = document.createDocumentFragment();

    //     console.log( year + '年' + month + '月');


    //    console.log("-----------");

       //let last_month = thisyear.getFullYear(), thisyear.getMonth()-1, thisyear.getDate();
       //console.log(last_month);

        // for (let i=12; i >= 1; i--) {
        //     //console.log(i);
        //     let option = document.createElement("option");
        //     option.text = year + "年"+ i +"月の提出履歴";

        //     //console.log(option); //2022年1月の提出履歴
        //     fragment.appendChild(option);
        //     //console.log(fragment);
        //     //console.log(i, fragment.firstChild.outerHTML); //2022年12月の提出履歴

        //     //select.appendChild(fragment);
        // }
        // console.log("-----------");


    //     select.appendChild(fragment);
    // }

    // addOption();


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
                    <th scope="row">{{ $daily->created_at}}</th>
                    <td><span class="badge rounded-pill bg-success">提出済み</span></td>
                    <td>{{ $daily->created_at}}</td>
                    <td class="text-end"><a href="{{route('daily_detail', [$daily['id']])}}">詳細</a> | <a href="{{route('copy_create', [$daily['id']])}}">コピーして作成</a></td>
                </tr>
                @endforeach
                <tbody>
            </table>
        `;
    }

    //-------月別を取得------//
    // var ct = new Date();
    // var res = ct.getMonth()+1;

    // console.log(res);

    // function MonthDefault (){
    //     $("[name=month]").val(res);
    // }

    // console.log(MonthDefault);

    // MonthDefault();

    //------月別提出履歴（デフォルト）✅✅✅✅✅✅✅✅✅-----//
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

        $.ajax({
            type:'POST',
            url:'{{ route('list_date') }}',
            dataType:'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{
                date:$('#DateSelect').val(),
            },

        })
        .done(function(data){

            console.log(data);
            //console.log("data");
            //console.log(JSON.stringify(data));
            let dailies = data.dailies;
            console.log(dailies);

        if (dailies.length === 0) {
            console.log('提出履歴がありません。');
            let html = `<p class='mt-4 fw-bolder'>提出履歴がありません。</p>`

            html += "";
            daily_list_add (html);
        } else {

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
                html += "<td>" + item.created_at + "</td>";
                html += `<td><span class="badge rounded-pill bg-success">提出済み</span></td>`;
                html += "<td>" + item.created_at + "</td>";
                html += `<td class="text-end"><a href="daily_detail/${item.id}">詳細</a> | <a href="copy_create/${item.id}">コピーして作成</a></td>`;
                html += "</tr>";
            }

            html += "<tbody></table>";
            daily_list_add (html);
        }
        })
        .fail(function(data){
            alert("error");
        })
    });





});
</script>
@endsection
