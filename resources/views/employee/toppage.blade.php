@include('header')
@extends('layout')
@section('title', 'トップページ')
@section('content')
<h2>一般ユーザー用トップページ</h2>
<div class="employee_top">
<h2></h2>
        <button type="submit" id="btnSubmit" class="btn_top"><a href="{{route('task_register')}}">タスク登録</button><br>
        <button type="submit" id="btnSubmit" class="btn_top"><a href="{{route('task_list')}}">タスク一覧</button><br>
        <button type="submit" id="btnSubmit" class="btn_top"><a href="{{route('status_list')}}">進捗一覧</button>
</div>
@endsection