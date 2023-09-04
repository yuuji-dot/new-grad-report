@include('header')
@extends('layout')
@section('title', 'タスク一覧画面')
@section('content')


<h2>タスク一覧</h2>
@foreach ($tasks as $index => $task)
@auth
@if (auth()->user()->authority === 1 && $task->del_flg === 0)
<div class="task">
<p>タスク{{ $index + 1 }}</p>
    <div class="task-container">
    
        <p class="task_text" id="message" name="body">{!! nl2br(e($task->task)) !!}</p>
        <div class="btns2">
            <div class="btn-group">
                <button type="button" class="btn btn--orange-small btn--radius" onclick="location.href='{{ route('task_edit', ['id' => $task->id]) }}'"><span class="tex">編集</span></button>
            </div>
            <div class="btn-group">
                <form method="post" action="{{ route('delete', ['id' => $task->id]) }}" onSubmit="return checkDelete()">
                    @csrf
                    <button type="submit" class="btn btn--orange-small btn--radius">
                        <span class="tex">削除</span>
                    </button>
                </form>
                <form method="post" action="{{ route('status_register', ['id' => $task->id]) }}">
                    @csrf
                    <button type="submit" class="btn btn--orange-small btn--radius">
                        <span class="tex">報告</span>
                    </button>
                </form>
            </div>
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