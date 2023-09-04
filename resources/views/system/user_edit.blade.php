
@extends('layout')
@section('title', '社員情報編集画面')
@section('content')
@include('header')
<h2>社員情報編集画面</h2>
<div class="user_ed">
    <form method="post" action="{{route('user_update')}}" onSubmit="return checkSubmit()">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}"><br>
    <h3 class="user_h3">社員番号</h3>
        <input type="text" class="user_ed_text" name="number" id="number" value="{{ $user->number }}"><br>
            @if ($errors->has('number'))
                <div class="err">
                    {{ $errors->first('number') }}
                </div>
            @endif
    <h3 class="user_h3">氏名</h3>
        <input type="text" class="user_ed_text" name="name" id="name" value="{{ $user->name }}"><br>
        @if ($errors->has('name'))
                <div class="err">
                    {{ $errors->first('name') }}
                </div>
            @endif 
    <h3 class="user_h3">役割</h3>
        <input type="text" class="user_ed_text" name="role" id="role" value="{{ $user->role }}"><br>
            @if ($errors->has('role'))
                <div class="err">
                    {{ $errors->first('role') }}
                </div>
            @endif 
    <h3 class="user_h3">権限</h3>
        <input type="radio" name="authority" value="0" {{ $user->authority === 0 ? 'checked' : '' }}>システム管理者
        <input type="radio" name="authority" value="1" {{ $user->authority === 1 ? 'checked' : '' }}>一般<br>
    <div class="btns6">
        <button type="submit" class="btn btn--orange btn--radius">更新</button>
        <a class="btn btn--orange--a btn--radius" href="{{ route('list_user') }}">戻る</a>
    </div>
    </form>
</div>
<script>
    function checkSubmit(){
    if(window.confirm('更新してよろしいですか？')){
        return true;
    } else {
        return false;
    }
}
</script>
@endsection

