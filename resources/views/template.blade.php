@extends('layouts.app')
@section('title', '日報')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> テンプレート管理</small>
            <h4 class="fw-bold mt-2">テンプレート管理</h4>
<div class="bg-white p-5 mt-4">
    <a type="button" class="btn btn-outline-dark btn-sm" href="{{ url('/template_create') }}"><i class="bi bi-plus-square"></i> テンプレートを作成</a>

<table class="table mt-3">

    </thead>
    <tbody>
        @if ($templates->count() > 0)
        @foreach($templates as $template)
        <thead>
            <tr>
              <th scope="col">テンプレート名</th>
              <th scope="col" class="text-end">操作</th>
            </tr>
      <tr>
        <td>{{ $template->template_title }}</td>
        <td class="text-end"><a href="{{ route('template_detail', $template->id) }}">詳細</a> | <a href="{{ route('template_edit', $template->id) }}">編集</a> | <a href="{{ route('template_delete', $template->id) }}">削除</a></td>
      </tr>
      @endforeach
      @else
      <p class="mt-3">テンプレートがありません。</p>
      @endif
    </tbody>
  </table>
            </div>
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
        <div class="col-lg-2 col-sm-12"></div>
    </div>
</div>
@endsection
