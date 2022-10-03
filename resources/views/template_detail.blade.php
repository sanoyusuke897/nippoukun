@extends('layouts.app')
@section('title', 'テンプレート作成')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> <a href="{{ url('/template') }}">テンプレート管理</a> <i class="bi bi-chevron-right"></i> テンプレート詳細</small>
            <h4 class="fw-bold mt-2">テンプレート詳細</h4>
<div class="bg-white p-5 mt-4">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label fw-bold">テンプレート名</label>
                <div class="col-sm-10">
                    {{ $template->template_title }}
                </div>
            </div>


              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label fw-bold">テンプレート内容</label>
                <div class="col-sm-10">
                    <p>{{ $template->template_content }}</p>
                </div>
              </div>
              <div class="text-center">
              <button type="submit" class="btn btn-primary" onclick="location.href='{{ route('template_edit', $template->id) }}'">編集</button>
              <button type="submit" class="btn btn-danger" onclick="location.href='{{ route('template_delete', $template->id) }}'">削除</button>
              </div>
            </div>
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
        <div class="col-lg-2 col-sm-12"></div>
    </div>
</div>
@endsection
