@extends('layouts.app')
@section('title', '下書き')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> 下書き</small>
            <h4 class="fw-bold mt-2">下書き</h4>
<div class="bg-white p-5 mt-4">

<table class="table mt-5">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">ステータス</th>
        <th scope="col">保存日時</th>
        <th scope="col" class="text-end">操作</th>
      </tr>
    </thead>
    <tbody>
        @foreach($drafts as $draft)
      <tr>
        <th scope="row">{{ $draft->id}}</th>
        <td><span class="badge rounded-pill bg-danger">下書き</span></td>
        <td>{{ $draft->created_at}}</td>
        <td class="text-end"><a href="#">編集</a> | <a href="{{ url('/create') }}">削除</a></td>
      </tr>
      @endforeach
      {{--
      <tr>
        <th scope="row">2022-06-24（木）</th>
        <td><span class="badge rounded-pill bg-danger">未提出</span></td>
        <td>2022-06-25 18:50:00</td>
        <td class="text-end">詳細 | <a href="{{ url('/create') }}">作成</a></td>
      </tr>
      <tr>
        <th scope="row">2022-06-23（水）</th>
        <td><span class="badge rounded-pill bg-warning text-dark">下書き</span></td>
        <td>2022-06-25 18:50:00</td>
        <td class="text-end"><a href="{{ url('/create') }}">作成</a></td>
      </tr> --}}
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
