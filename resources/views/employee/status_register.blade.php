@extends('layout')
@section('title', '進捗報告画面')
@section('content')
@include('header')
<h2>進捗報告</h2>

<div class="sand_status">
    <h3 class="status_h3">タスク</h3>
    <p class="task_content" id="message"  name="body">{{ $task->task }}</p>
    <form method="post" action="{{route('status_post')}}" onSubmit="return checkSubmit()">
    @csrf
    <input type="hidden" class="task_id" name="id" value="{{$task->id}}">
    <div class="status">
        <h3 class="status_h3">進捗率</h3>
        <input class="progress" type="text" id="progress" name="progress" placeholder="タスク進捗率は何％？　数字のみ入力してください。"><br>
        @error('progress')
            <div class="err">
                {{ $message }}
            </div>
        @enderror
    </div>
    <h3 class="status_h3">コメント</h3>
    <textarea class="task_comment" id="comment"  name="comment"></textarea>
        @error('comment')
            <div class="err">
                {{ $message }}
            </div>
        @enderror
    
    <div class="task_comment" id="messageContainer"></div> <!-- メッセージ表示のためのコンテナ -->
    <br>
    <div class="buttons">
        <button type="submit" class="btn btn--orange btn--radius">投稿</button>
        <a class="btn btn--orange--a btn--radius" href="{{ route('task_list') }}">戻る</a>
    </div>
    </form>
</div>
<script>
    function checkSubmit(){
        if(window.confirm('投稿してよろしいですか？')){
            return true;
        } else {
            return false;
        }
    }

    const progressInput = document.getElementById('progress');
    const messageContainer = document.getElementById('messageContainer');

    progressInput.addEventListener('input', function() {
        const progress = parseInt(progressInput.value, 10); // 入力値を整数に変換

        if (progress <= 20) {
            messageContainer.textContent = '頑張りましょう';
        } else if (progress < 40) {
            messageContainer.textContent = 'もう少し頑張りましょう';
        } else if (progress < 60) {
            messageContainer.textContent = '頑張りました';
        } else if (progress < 80) {
            messageContainer.textContent = 'よく頑張りました';
        } else if (progress <= 100) {
            messageContainer.textContent = '素晴らしいです、これからも頑張りましょう！';
        }
    });
</script>
@endsection
