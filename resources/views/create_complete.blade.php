@extends('layouts.app')
@section('title', '提出完了')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> <a href="{{ url('/create') }}">日報作成</a> <i class="bi bi-chevron-right"></i> 確認画面 <i class="bi bi-chevron-right"></i> 提出完了</small>
            <h4 class="fw-bold mt-2">提出完了</h4>
<div class="bg-white p-5 mt-4 text-center">
    <h1 class="text-success"><i class="bi bi-check-circle-fill"></i></h1>
            <h5 class="fw-bold mt-4">提出が完了しました。</h5>
            <p>本日はお疲れ様でした！</p>
            <p><a href="{{ url('/list') }}">提出履歴</a></p>
            </div>
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
        <div class="col-lg-2 col-sm-12"></div>
    </div>
</div>
@endsection
