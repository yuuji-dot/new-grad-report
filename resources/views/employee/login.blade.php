@extends('layout')
@section('title', 'ログインページ')
@section('content')
<div class="container">
<h2>Login</h2>
    <form method="post" action="{{route('top')}}" >
    @csrf
    <div class="input_text">
        <label for="number">社員番号</label><br>
            <input  type="text" id="number" name="number"  placeholder="社員番号の入力" value="{{ old('', session('')) }}"><br>
                @if ($errors->has('number'))
                    <div class="err">
                        {{ $errors->first('number') }}
                    </div>
                @endif
    </div>
    <div class="input_text">
        <label for="password">パスワード</label><br>
            <input  type="password" id="password" name="password"  placeholder="password"  value="{{ old('', session('')) }}"><br>
                @if ($errors->has('password'))
                    <div class="err">
                        {{ $errors->first('password') }}
                    </div>
                @endif
    </div>
    <button type="submit" id="btnSubmit" class="btn btn--orange btn--radius">ログイン</button><br>

    </form>
    <div class="add_text">
        <a href="{{route('reset')}}">パスワードリセット</a>
    </div>
</div>
@endsection