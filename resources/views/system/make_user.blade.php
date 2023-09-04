@extends('layout')
@section('title', 'ユーザー登録画面')
@section('content')
@include('header')
<h2>ユーザー登録画面</h2>
<form method="post" action="{{route('create_user')}}" onSubmit="return checkSubmit()" >
@csrf
<div class="user_ed">
    <label for="number">社員番号</label><br>
        <input class="user_ed_text" type="text" id="number" name="number"  placeholder="1" value="{{ old('', session('')) }}"><br>
            @error('number')
                <div class="err">
                    {{ $message }}
                </div>
            @enderror    
    <label for="name">氏名</label><br>
        <input class="user_ed_text" type="text" id="name" name="name"  placeholder="山田太郎" value="{{ old('', session('')) }}"><br>
            @error('name')
                <div class="err">
                    {{ $message }}
                </div>
            @enderror 
    <label for="password">パスワード</label><br>
        <input class="user_ed_text" type="password" id="password" name="password"   value="{{ old('', session('')) }}"><br>
            @error('password')
                <div class="err">
                    {{ $message }}
                </div>
            @enderror 
    <label for="role">役職</label><br>
        <input class="user_ed_text" type="text" id="role" name="role"   value="{{ old('', session('')) }}"><br>
            @error('role')
                <div class="err">
                    {{ $message }}
                </div>
            @enderror
    <input type="radio" name="authority" value="0" checked>システム管理者
    <input type="radio" name="authority" value="1">一般<br>
<a class="btn btn--orange--a btn--radius" href="{{ route('user.toppage') }}">戻る</a>
<button type="submit" id="btnSubmit" class="btn btn--orange--a btn--radius">登録</button>
</form>
</div>

@endsection