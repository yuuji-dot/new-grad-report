@extends('layout')
@section('title', '進捗一覧画面')
@section('content')
@include('header')
<h2>進捗一覧</h2>
@foreach ($statuses as $status)
@if ($status->del_flg == 0)
<div class="task_and_btn">
    <div class="task_status">
        <div class="status_list_container">
        <div class="status_list_column">
            <div class="status_list_info">社員番号：{{ $status->user->number }}</div>
            <div class="status_list_info">氏名：{{ $status->user->name }}</div>
        </div>
        <div class="status_list_column">
            <div class="status_list_info_2">日付：{{ $status->created_at }}</div>
        </div>
    </div>
    <h3 class="status_list_h3">タスク</h3>
        <p class="status_list_task" id="message" name="body">{{ $status->task->task }}</p>
    <h3 class="status_list_h3">コメント</h3>
        <p class="status_list_comment" id="comment" name="comment">{{ $status->comment }}</p>
    <div class="status_list_good" data-status-id="{{ $status->id }}">
        <button class="like-button">いいね</button>
        <span class="like-counter" id="like-counter-{{ $status->id }}">{{ $status->good }} いいね</span>
    </div>
    <h3 class="status_list_h3">進捗率</h3>
        <p class="status_list_progress" id="progress" name="body">{{ $status->progress }}%</p>
    </div>
    <div class="btn3">
        <div class="btn-group">
            <button type="button" class="btn btn--orange btn--radius" onclick="location.href='{{ route('status_edit', ['id' => $status->id]) }}'"><span class="tex">編集</span></button>
        </div>
        <div class="btn-group">
            <form method="post" action="{{ route('status_delete', ['id' => $status->id]) }}" onSubmit="return checkDelete()">
                @csrf
                <button type="submit" class="btn btn--orange btn--radius">
                    <span class="tex">削除</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endif
@endforeach

<button type="submit" class="btn btn--orange btn--radius">
    <a href="{{ route('user.toppage') }}">トップに戻る</a>
</button>
@endsection
<script>
    function checkDelete(){
        if(window.confirm('削除してよろしいですか？')){
            return true;
        } else {
            return false;
        }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const likeButtons = document.querySelectorAll(".like-button");

        likeButtons.forEach(button => {
            button.addEventListener("click", function () {
                const statusId = button.parentElement.getAttribute("data-status-id");
                increaseLikeCount(statusId);
            });
        });

        function increaseLikeCount(statusId) {
            fetch(`{{ route('increase-like', ['id' => '__ID__']) }}`.replace('__ID__', statusId), {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // CSRFトークンを追加
                    "Content-Type": "application/json"
                },
            })
            .then(response => response.json())
            .then(data => {
                // Update the like counter text
                const counterElement = document.querySelector(`#like-counter-${statusId}`);
                counterElement.textContent = data.likeCount + " いいね"; // Update with new like count
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    });
</script>

