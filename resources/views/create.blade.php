@extends('layouts.app')
@section('title', '日報作成')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('daily') }}">日報</a> <i class="bi bi-chevron-right"></i> 日報作成</small>
            <h4 class="fw-bold mt-2">日報作成</h4>
            @if ($drafts === 0)
            @else
            <div class="alert alert-warning mt-4" id="draft-message" role="alert" data-draft="1">
                <i class="bi bi-lightbulb"></i> 前回の下書きから編集しますか？
                <?php $user = Auth::user(); ?>
                <input type="hidden" value="{{ $user->id }}" id="draftuserid" name="draftuserid">
                <a href="#" class="yes_edit">はい</a>　<a href="#" class="no_edit">いいえ</a>
            </div>
            @endif


            <div class="bg-white p-5 mt-4" id="formarea">
                <form method="GET">
                @csrf
                <div class="mb-3 row">
                    <label for="user_id" class="col-sm-2 col-form-label fw-bold">提出者</label>
                    <div class="col-sm-10">
                        <?php $user = Auth::user(); ?>{{ $user->name }}
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label fw-bold">提出日付</label>
                    <div class="col-sm-10">
                        <?php
                        $data = date('y年m月d日');
                        print_r($data);
                        ?>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label fw-bold">テンプレート</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" id="templete">
                            <option value="">使わない</option>
                            @foreach ($templates as $template)
                            <option value="{{ $template->template_content }}">{{ $template->template_title }}</option>
                            @endforeach
                        </select>
                        <p class="text-end small mt-2"><i class="bi bi-plus-square"></i>&nbsp;&nbsp;<a href="{{ url('/template') }}">テンプレート管理</a></p>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="report" class="col-sm-2 col-form-label fw-bold">業務内容</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="report" data="templates" name="report" style="height: 400px" type="text">{{ old('report') }}</textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label fw-bold">打刻</label>
                    <div class="col-sm-10">
                    <input class="form-check-input" type="checkbox" value="1" id="clocking" name="clocking" checked>
                    <label class="form-check-label" for="flexCheckChecked">退勤する</label>

                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" formaction="{{route('create_confirm')}}">確認画面へ</button>　　　
                    <a class="btn btn-secondary" id="draft_btn" onsubmit="return false">下書き保存</a> <!--ajaxならsubmitはダメ！-->
                </div>
                </form>
                <div class="alert alert-info mt-4" id="save-success" role="alert">
                    <i class="bi bi-check2-circle"></i> 下書き保存しました。
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

    //------ページを移動（離脱）するときにjQueryで警告を出す------
    $("textarea[type=text]").change(function() {
        $(window).on('beforeunload', function() {
            return '投稿が完了していません。このまま移動しますか？';
        });
    });

    $("button[type=submit]").click(function() {
        $(window).off('beforeunload');
    });


    //------下書きメッセージ------

    //「いいえ」を選択した場合
    $(document).on('click','.no_edit', function(){
        var draftuserid = $('#draftuserid').val();
        console.log(draftuserid);

        $('#draft-message').hide();
        $.ajax({
            url:"{{ route('draft_delete') }}",
            type:'POST',
            data:{'user_id':draftuserid},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(data){
            let ostTop = $('#formarea').offset().top;
            $('html,body').animate({scrollTop: ostTop}, 100);
        })
        .fail(function(data){
            console.log("error");
        })
        // → draftsのレコードをAjaxで削除する

    });

    //「はい」を選択した場合
    $(document).on('click','.yes_edit', function(){
        $('#draft-message').hide();
        // → draftsのレコードをAjaxで挿入する
        $.ajax({
            url:'{{ route('draft_add') }}',
            type:'GET',
            dataType:'json',
            data:{},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(data){
            var data_stringify = JSON.stringify(data);
            var data_json = JSON.parse(data_stringify);
            var data_id = data_json[0]["report"];
            $("#report").text(data_id);

            let ostTop = $('#formarea').offset().top;
            $('html,body').animate({scrollTop: ostTop}, 100);
        })
        .fail(function(data){
            console.log("error");
        })

    });

    //------テンプレート挿入------
    $('select').change(function() {
        var val = $(this).val();
        $('#report').val(val);
    });

    //------下書き保存------
    $('#save-success').hide();


    $(document).on('click','#draft_btn', function(){
        //draftにレコードがあるかどうかを判断
        //あったら保存不可

        console.log("aaaaa");

        $.ajax({
            type:'POST',
            url:'{{ route('draft_save') }}',
            dataType:'json',
            data:{
                "user_id":$("#profile_id").val(),
                "report":$("#report").val(),
                "clocking":$("#clocking").val()
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(data){
            //$('#save-success').show();
            //$('#save-success').fadeOut(3000);
            alert("下書き保存しました。");
        })
        .fail(function(data){
            console.log(e);
            alert('error');
        })
        //下書き保存したら、画面リロードしないようにしたい
    });

    //------提出後に下書きを削除------





});
</script>
@endsection
