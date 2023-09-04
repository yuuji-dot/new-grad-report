@extends('layout')
@section('title', '社員一覧画面')
@section('content')
@include('header')
<h2>社員一覧</h2>
@foreach($users as $index=>$user)
@auth
@if (auth()->user()->authority === 0 && $user->del_flg === 0)
<div class="user_list">
    <div class="user">
        <p>社員{{ $index+ 1 }}</p>
        <p class="user_list_info">社員番号:{{ $user->number }}</p>
        <p class="user_list_info">氏名：{{ $user->name }}</p>
        <p class="user_list_info">役職：{{ $user->role }}</p>
        <p class="user_list_info">権限：   
            @if($user->authority === 0)
                システム管理者
            @elseif($user->authority === 1)
                一般
            @endif
        </p>
    </div>
    <div class="btns5">
                <div class="btn-group">
                    <button type="button" class="btn btn--orange btn--radius" onclick="location.href='{{ route('user_edit', ['id' => $user->id]) }}'"><span class="tex">編集</span></button>
                </div>
                <div class="btn-group">
                    <form method="post" action="{{ route('user_delete', ['id' => $user->id]) }}" onSubmit="return checkDelete()">
                        @csrf
                        <button type="submit" class="btn btn--orange btn--radius">
                            <span class="tex">削除</span>
                        </button>
                    </form>
                </div>
    </div>
</div>
@endif
@endauth
@endforeach
<button type="submit" class="btn btn--orange btn--radius">
    <a href="{{ route('user.toppage') }}">トップに戻る</a>
</button>
<script>
    function checkDelete(){
        if(window.confirm('削除してよろしいですか？')){
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection