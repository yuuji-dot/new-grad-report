@extends('layout')
@section('title', 'システム管理者用トップページ')
@section('content')
@include('header')
<h2>システム管理者用トップページ</h2>
    <button type="submit" id="btnSubmit" class="btn_top"><a href="{{route('make_user')}}">ユーザー登録</button><br>
    <button type="submit" id="btnSubmit" class="btn_top"><a href="{{route('list_user')}}">全社員一覧</button>
@endsection