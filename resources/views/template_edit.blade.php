@extends('layouts.app')
@section('title', 'テンプレート作成')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> <a href="{{ url('/template') }}">テンプレート管理</a> <i class="bi bi-chevron-right"></i> テンプレート編集</small>
            <h4 class="fw-bold mt-2">{{ $template->template_title }} のテンプレート編集</h4>
<div class="bg-white p-5 mt-4">
    <form method="GET" action="{{ route('template_edit_result', $template->id) }}">
        @csrf
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label fw-bold">テンプレート名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="template_title" value="{{ old('template_title', $template->template_title) }}">
                    <input type="hidden" value="1" name="user_id">
                </div>
            </div>


              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label fw-bold">テンプレート内容</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="floatingTextarea2" style="height: 400px" name="template_content">{{ old('template_content', $template->template_content) }}</textarea>
                </div>
              </div>
              <div class="text-center">
              <button type="submit" class="btn btn-primary">更新</button>
              </div>
    </form>
            </div>
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
        <div class="col-lg-2 col-sm-12"></div>
    </div>
</div>
@endsection
