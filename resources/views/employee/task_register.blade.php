@extends('layout')
@section('title', 'タスク登録画面')
@section('content')
@include('header')
<h2>タスク登録画面</h2>
<div class="sand">
    <form method="post" action="{{route('task')}}" onSubmit="return checkSubmit()">
    @csrf
    <div class="task_regi">
        <p>タスク１</p>
        <textarea class="task-text" id="task1" name="tasks[]"></textarea><br>
        @error('tasks.*')
            <div class="err">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- タスク追加ボタン -->
    <div class="btns">
    <button type="button" class="btn btn--aqua btn--radius add-task-btn">+タスクの追加はこちら</button><br> 

    
        <button type="submit" class="btn btn--orange btn--radius">登録</button>
        <a class="btn btn--orange--a btn--radius" href="{{ route('user.toppage') }}">戻る</a>
    </div>
    </form>
</div>

<!-- JavaScriptコードをここに追加 -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    let taskCounter = 2; 

    // タスク追加ボタンがクリックされたときの処理
    document.querySelector(".add-task-btn").addEventListener("click", function () {
        const taskRegi = document.querySelector(".task_regi"); // タスク入力フィールドを含む要素

        // 新しいタスク入力フィールドを生成
        const newTaskField = document.createElement("div");
        newTaskField.innerHTML = `
            <p>タスク${taskCounter}</p>
            <textarea class="task-text" id="task${taskCounter}" name="tasks[]"></textarea><br>
            <div class="err" id="task${taskCounter}-error"></div>
        `;

        taskRegi.appendChild(newTaskField); // フォームに追加

        taskCounter++; // タスク番号を増加
    });

    // フォームの送信前にバリデーションを行う処理
    document.querySelector("form").addEventListener("submit", function (event) {
        let isValid = true;

        for (let i = 1; i < taskCounter; i++) {
            const taskTextarea = document.querySelector(`#task${i}`);
            const taskErrorDiv = document.querySelector(`#task${i}-error`);

            if (!taskTextarea.value) {
                taskErrorDiv.textContent = "タスク内容を入力してください。";
                isValid = false;
            } else {
                taskErrorDiv.textContent = "";
            }
        }

        if (!isValid) {
            event.preventDefault(); // フォームの送信をキャンセル
        }
    });
});
</script>
@endsection