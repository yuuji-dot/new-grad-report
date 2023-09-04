@extends('layout')
@section('title', 'ユーザー登録画面')
@section('content')
<h2>パスワードリセット</h2>
<form method="post" action="{{route('pass_reset')}}" onSubmit="return checkSubmit()" >
@csrf
<div class="pass_reset">
    <label for="number">社員番号</label><br>
        <input class="reset_text" type="text" id="number" name="number"  placeholder="1" value="{{ old('', session('')) }}"><br>
            @if ($errors->has('number'))
                <div class="err">
                    {{ $errors->first('number') }}
                </div>
            @endif
    <label for="password">パスワード</label><br>
        <input class="reset_text" type="text" id="password" name="password" placeholder="新規のパスワードを入力してください"><br>
            @if ($errors->has('password'))
                <div class="err">
                    {{ $errors->first('password') }}
                </div>
            @endif
    <div class="reset_btn">
        <button type="submit" id="btnSubmit" class="btn btn--orange btn--radius" >更新</button><br>
    </div>
</div>
</form>   