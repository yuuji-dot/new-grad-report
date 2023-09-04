@extends('layout')
@section('title', 'タスク編集画面')
@section('content')
@include('header')

<h2>タスク編集</h2>
<div class="task_ed">
    <form method="post" action="{{route('task_update')}}" onSubmit="return checkSubmit()" >
    @csrf
        <input type="hidden" name="id" value="{{$task->id}}">
        <h3 class="task_edit_h3">タスク内容</h3>
        <textarea class="task-ed" id="message"  name="tasks[]">{{ $task->task }}</textarea><br>
                    @error('tasks.*')
                        <div class="err">
                            {{ $message }}
                        </div>
                    @enderror
        <button type="submit" class="btn btn--orange btn--radius" onclick="">更新</button></td>
        <a class="btn btn--orange--a btn--radius" href="{{ route('task_list') }}">戻る</a>
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
