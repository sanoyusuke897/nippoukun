@extends('layouts.app')
@section('title', '日報')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small>日報</small>
            <h4 class="fw-bold mt-2">日報</h4>
<div class="bg-white p-5 mt-4">
<!--<a href="{{ url('/create') }}">日報作成</a><br>
<a href="{{ url('/template') }}">テンプレート</a><br>
<a href="{{ url('/list') }}">提出履歴</a>-->
<!--<div class="col-12 text-center"><img src="images/10223_color.svg" width="300" class="mb-5"></p>-->

<button type="button" class="btn btn-outline-dark btn-lg fw-bolder" onclick="location.href='{{ route('create') }}'" style="width: 30%; height:100px; font-size:30px; margin-right:4.3%;">日報作成</button>
<button type="button" class="btn btn-outline-dark btn-lg fw-bolder" onclick="location.href='{{ route('template') }}'" style="width: 30%; height:100px; font-size:30px; margin-right:4.3%;">テンプレート</button>
<button type="button" class="btn btn-outline-dark btn-lg fw-bolder" onclick="location.href='{{ route('list') }}'" style="width: 30%; height:100px; font-size:30px;">提出履歴</button>
            </div>
            @else
                <p>※ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
            @endif
        </div>
        <div class="col-lg-2 col-sm-12"></div>
    </div>
</div>
@endsection
