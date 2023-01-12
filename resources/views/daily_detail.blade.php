@extends('layouts.app')
@section('title', '日報詳細')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> <a href="{{ url('/list') }}">提出履歴</a> <i class="bi bi-chevron-right"></i> 日報詳細</small>
            <h4 class="fw-bold mt-2">日報詳細</h4>
<div class="bg-white p-5 mt-4">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label fw-bold">提出者</label>
                <div class="col-sm-10">
                    {{ $daily->user->name }}
                </div>
              </div>
              <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label fw-bold">提出日時</label>
                <div class="col-sm-10">
                    {{ $daily->created_at }}
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label fw-bold">業務内容</label>
                <div class="col-sm-10">
                    <p>{{ $daily->report }}</p>
                </div>
              </div>
              {{-- <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label fw-bold">打刻</label>
                <div class="col-sm-10">
                    {{ $daily->clocking }} 退勤する
                </div>
              </div> --}}
              <hr>
              @if (count($likes) === 0)
              <button type="button" class="btn btn-outline-dark btn-sm" id="like_btn"><i class="bi bi-heart"></i> いいね！</button>
              @else
              <button type="button" class="btn btn-outline-dark btn-sm" id="like_cancel_btn"><i class="bi bi-heart-fill text-danger"></i> いいね！</button>
              @endif
              <input type="hidden" value="{{ $daily->id }}" class="daily_id">
              <button type="button" class="btn btn-outline-dark btn-sm" id="comment_btn"><i class="bi bi-chat-dots"></i> コメント</button>

              <div class="comment_area mt-5">

                <form method="POST" action="{{ route('daily_comment') }}" id="comment_input" onsubmit="return false">
                    <h6 class="fw-bold">コメント</h6>
                    <input type="hidden" value="{{ $daily->id }}" id="daily_id">
                    <?php $user = Auth::user(); ?>
                    <input type="hidden" value="{{ $user->id }}" id="user_id">
                    <textarea class="form-control" id="comment" data="templates" name="comment" style="height: 100px" type="text">{{ old('report') }}</textarea>
                    <div class="text-end mt-3"><a class="btn btn-dark btn-sm" id="send_btn">送信</a></div>
                </form>
                <div id="commentList">
                @foreach ($comments as $comment)
                    <div class="comment_list mt-5">
                        <p><i class="bi bi-chat-dots"></i> <span class="fw-bold">{{ $comment->user->name }}</span> <span class="text-black-50 small">（{{ $comment->user->department }}）</span> <span class="small">{{ $comment->created_at }} にコメントしました：</span></p>
                        <p>{{ $comment->comment }}</p>
                    </div>
                @endforeach
            </div>
              </div>
              <div class="text-center mt-5">
              <button type="button" class="btn btn-secondary pre_btn" onClick="history.back()">前へ戻る</button>
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
let offset = 0;

function user_data (data) {
    user_id = data[1].name;
    department = data[1].department;
}

function comment_data (data) {
	created_at = data[0].created_at;
    comment = data[0].comment;
}

function comment_add (html){
	$('#commentList').prepend(html);
	offset += 1;
}

    $('#comment_input').hide();
    var daily_id = $('#daily_id').val();

    //-----コメント欄表示-----//
    $('#comment_btn').click(function() {
        $('#comment_input').show();
        let ostTop = $('#comment_input').offset().top;
        $('html,body').animate({scrollTop: ostTop}, 100);
    });

    //-----いいね！ボタン-----//
    $(document).on('click', '#like_btn', function(){
        $.ajax({
            type:'POST',
            url:'{{ route('daily_like') }}',
            dataType:'json',
            data:{
                'daily_id':daily_id,
                'user_id':$('#user_id').val(),
                'like':1,
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(data){
            $('#like_btn').attr("id","like_cancel_btn").html('<i class="bi bi-heart-fill text-danger"></i> いいね！');
        })
        .fail(function(data){
            alert('error');
        })
    })

    //-----いいね！取り消しボタン-----//
    $(document).on('click', '#like_cancel_btn', function(){
        $.ajax({
            type:'POST',
            url:'{{ route('daily_like_delete') }}',
            dataType:'json',
            data:{
                "daily_id":daily_id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(data){
            $('#like_cancel_btn').attr("id","like_btn").html('<i class="bi bi-heart"></i> いいね！');
        })
        .fail(function(data){
            alert('error');
        })
    })

    //-----コメント投稿-----//
    $('#send_btn').click(function() {
        console.log("aaa");
        $.ajax({
            type: 'POST',
            url:'{{ route('daily_comment') }}',
            dataType: 'json',
            data:{
                "user_id":$("#user_id").val(),
                "daily_id":daily_id,
                "comment":$("#comment").val()
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(data){

            user_data(data);
            comment_data(data)

            let html = `
            <div class="alert alert-info mt-3" role="alert"><i class="bi bi-check-circle"></i> コメントしました！</div>
            <div class="comment_list mt-5">
                <p><i class="bi bi-chat-dots"></i> <span class="fw-bold">${user_id}</span> <span class="text-black-50 small">（${department}）</span> <span class="small">${created_at} にコメントしました：</span></p>
                <p>${comment}</p>
            </div>
            `;

            comment_add (html);
            $('#comment_input')[0].reset();

            setTimeout(function(){
                $('.alert').fadeOut();
            }, 2000);


        })
        .fail(function(data){
            alert('コメント失敗しました');
        })
    });
});
</script>
@endsection

