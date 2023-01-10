@extends('layouts.app')
@section('title', '管理画面')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-2 col-sm-12"></div>
        <div class="col-lg-8 col-sm-12">
            @if (Auth::check())
            <small><a href="{{ url('daily') }}">管理画面</a> <i class="bi bi-chevron-right"></i> ダッシュボード</small>
            <h4 class="fw-bold mt-2">管理画面</h4>


            <div class="bg-white p-5 mt-4" id="formarea">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button
                        class="nav-link active"
                        id="nav-home-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-home"
                        type="button"
                        role="tab"
                        aria-controls="nav-home"
                        aria-selected="true"
                      >
                      <i class="bi bi-person-fill"></i> ユーザー管理
                      </button>
                      <button
                        class="nav-link"
                        id="nav-profile-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#nav-profile"
                        type="button"
                        role="tab"
                        aria-controls="nav-profile"
                        aria-selected="false"
                      >
                      <i class="bi bi-people-fill"></i> 部署管理
                      </button>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div
                      class="tab-pane fade show active"
                      id="nav-home"
                      role="tabpanel"
                      aria-labelledby="nav-home-tab"
                    >


                    <!-- ユーザー管理エリア -->
                    <div class="row mt-5">
                        <div class="col-8">
                            <a type="button" class="btn btn-dark btn-sm" href="{{ url('/template_create') }}"><i class="bi bi-plus-square"></i> ユーザー追加</a>
                        </div>
                        <div class="col-4 text-end">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="検索" aria-label="Example input with button-sm addon">
                                <button class="btn btn-dark btn-sm" type="button"><i class="bi bi-search"></i></button>
                              </div>
                        </div>
                    </div>
                    <table class="table mt-4">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">名前</th>
                            <th scope="col">部署</th>
                            <th scope="col" class="text-end">操作</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                          <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td class="fw-bolder">{{ $user->name }}</td>
                            <td>{{ $user->department }}</td>
                            <td class="text-end">編集 | 削除</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="nav-profile"
                      role="tabpanel"
                      aria-labelledby="nav-profile-tab"
                    >
                    <!-- 部署管理エリア -->
                    <div class="row mt-5">
                        <div class="col-8">
                            <a type="button" class="btn btn-dark btn-sm" href="{{ url('/admin_department_add') }}"><i class="bi bi-plus-square"></i> 部署追加</a>
                        </div>
                        <div class="col-4 text-end">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" placeholder="検索" aria-label="Example input with button-sm addon">
                                <button class="btn btn-dark btn-sm" type="button"><i class="bi bi-search"></i></button>
                              </div>
                        </div>
                    </div>
                    <table class="table mt-4">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">部署名</th>
                            <th scope="col" class="text-end">操作</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                          <tr>
                            <th scope="row">{{ $department->id }}</th>
                            <td class="fw-bolder">{{ $department->department_name }}</td>
                            <td class="text-end">編集 | 削除</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
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
    $('#templete').change(function() {
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
