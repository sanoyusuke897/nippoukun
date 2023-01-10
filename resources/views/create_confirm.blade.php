@extends('layouts.app')
@section('title', '日報作成の確認画面')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('/daily') }}">日報</a> <i class="bi bi-chevron-right"></i> <a href="{{ url('/create') }}">日報作成</a> <i class="bi bi-chevron-right"></i> 確認画面</small>
            <h4 class="fw-bold mt-2">確認画面</h4>
<div class="bg-white p-5 mt-4">
    <form action="{{route('create_complete')}}" method="POST">
        @csrf
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label fw-bold">提出者</label>
                <div class="col-sm-10">
                    <p class="mt-1">{{ $daily->user->name }}</p>
                  <input type="hidden" value="<?php $user = Auth::user(); ?>{{ $user->id }}" name="user_id">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label fw-bold">提出日付</label>
                <div class="col-sm-10">
                    <p class="mt-1">{{ $daily->created_at }}</p>
                    <input type="hidden" value="{{ $daily->created_at }}" name="created_at">
                </div>
              </div>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label fw-bold">業務内容</label>
                <div class="col-sm-10">
                    <p class="mt-1">{{ $daily->report }}</p>
                    <input type="hidden" value="{{ $daily->report }}" name="report">
                </div>
              </div>
              {{-- <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label fw-bold">打刻</label>
                <div class="col-sm-10">

                    @if ($daily->clocking !== null)
                    退勤する
                    @else
                    退勤しない
                    @endif
                    <input type="hidden" value="{{ $daily->clocking }}" name="clocking">
                </div>
              </div> --}}
              <div class="text-center">
              <button type="submit" class="btn btn-primary">提出</button>
              <button type="button" class="btn btn-secondary" onClick="history.back()">前へ戻る</button>
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
