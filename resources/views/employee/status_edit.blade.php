@include('header')
@extends('layout')
@section('title', '進捗編集画面')
@section('content')
<h2>進捗編集画面</h2>
<div class="sand_status_edit">
    <h3 class="status_h3">タスク</h3>
    <p class="task_content" id="message"  name="body">{{  $statuses->task->task }}</p>
    <form method="post" action="{{route('status_update')}}" onSubmit="return checkSubmit()">
    @csrf
    <input type="hidden" name="id" value="{{$statuses->id}}">
    <div class="status">
        <h3 class="status_h3">進捗率</h3>
        <div class="media_edit">
            <input class="progress_edit" type="text" id="progress" name="progress" placeholder="タスク進捗率は何％？　数字のみ入力してください。" value="{{$statuses->progress}}"><p class="parsent">%</p><br>
                    @error('progress')
                        <div class="err">
                            {{ $message }}
                        </div>
                    @enderror
        </div>
    </div>
    <h3 class="status_h3">コメント</h3>
    <textarea class="task_comment" id="comment"  name="comment">{{$statuses->comment}}</textarea>
        @error('comment')
            <div class="err">
                {{ $message }}
            </div>
        @enderror
    <div class="btns4">
        <button type="submit" class="btn btn--orange btn--radius" onclick="">更新</button></td>
        <a class="btn btn--orange--a btn--radius" href="{{ route('status_list') }}">戻る</a>
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