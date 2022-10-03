@extends('layouts.app')
@section('title', '保存完了')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> <a href="{{ url('/template') }}">テンプレート</a> <i class="bi bi-chevron-right"></i> 保存完了</small>
            <h4 class="fw-bold mt-2">保存完了</h4>
<div class="bg-white p-5 mt-4 text-center">
    <h1 class="text-success"><i class="bi bi-check-circle-fill"></i></h1>
            <h5 class="fw-bold mt-4"><span class="text-success">{{ $template->template_title }}</span> が保存されました。</h5>
            <p><a href="{{ url('/template') }}">テンプレート管理</a></p>
            </div>
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
        <div class="col-lg-2 col-sm-12"></div>
    </div>
</div>
@endsection
