<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task_status;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Task_statusRequest;
use Illuminate\Http\JsonResponse;

class Task_statusController extends Controller
{
    //進捗報告
    public function exeStatus_post(Task_statusRequest $request)
    {
        if ($request->isMethod('POST')) {
            $user = Auth::user();
            $user_id = $user->id;
            $task_id = $request->input('id');
    
            $progress = $request->input('progress');
            $comment = $request->input('comment');
    
            \DB::beginTransaction();
            try {
                Task_status::create([
                    'user_id' => $user_id,
                    'task_id' => $task_id,
                    'progress' => $progress,
                    'comment' => $comment,
                ]);
                \DB::commit();
            } catch (\Throwable $e) {
                dd($e->getMessage());
                \DB::rollback();
                abort(500);
            }
            return redirect()->route('status_list');
        }
        return redirect()->route('task_list');
    }

    
    //進捗一覧を表示
    public function showStatus_list(){
        $statuses = Task_status::with(['user', 'task'])->get();
        return view('employee.status_list', ['statuses' => $statuses]);
    }

    //進捗削除
    public function exeStatus_delete($id){
       
        try{
            $statuses = Task_status::find($id);
            if($statuses){
                $statuses->update(['del_flg' => 1]);
            }
        } catch(\Throwable $e){
            dd($e->getMessage());
            abort(500);
        }
        return redirect()->route('status_list');
    
        return redirect()->route('status_list');
    }
    //編集画面の表示
    public function showStatus_edit($id){
        $statuses=Task_status::find($id);
        return view('employee.status_edit', ['statuses' => $statuses]);
    }
    //編集内容の更新
    public function exeStatus_update(Task_statusRequest $request){
        if ($request->isMethod('POST')) {
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
        $task_status = Task_status::find($inputs['id']);
        $task_status->fill([
            'progress' => $inputs['progress'],
            'comment' => $inputs['comment']
        ]);
        $task_status->save();
        \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            dd($e->getMessage());
            abort(500);
        }

        return redirect()->route('status_list');
    }
        return redirect()->route('status_list');
    }
    public function increaseLikeCount($id): JsonResponse
    {
        try {
            $taskStatus = Task_status::find($id);
            if ($taskStatus) {
                $taskStatus->increment('good');
                $likeCount = $taskStatus->good;
                return response()->json(['likeCount' => $likeCount]);
            } else {
                return response()->json(['error' => 'Task_status not found'], 404);
            }
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
}
