<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Task_status;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{   
    //タスク登録画面の表示
    public function showTask_register(){
        return view('employee.task_register');
    }
    //タスク登録の実行
    public function exeTask(TaskRequest $request){
        $user = Auth::user();
        $user_id = $user->id;
        $tasks = $request->input('tasks'); 
        \DB::beginTransaction();
        try {
            foreach ($tasks as $taskText) {
                Task::create([
                    'user_id' => $user_id,
                    'task' => $taskText,
                    'del_flg' => 0, 
                ]);
            }
            \DB::commit();
            } catch (\Throwable $e) {
                \Log::error('An error occurred: ' . $e->getMessage());
                \DB::rollback();
                abort(500);

            }
    
            return redirect()->route('task_register');

    }
    //タスク一覧画面の表示
    public function showTask_list(){
        $user = Auth::user();
        $user_id = $user->id; 
        $tasks = Task::where('user_id', $user_id)->get(); 
        return view('employee.task_list', ['tasks' => $tasks]);
    }
    //タスク編集画面の表示
    public function showtask_edit($id){
        $task = Task::find($id);

        return view('employee.task_edit',['task'=>$task]);
    }
    //タスク更新
    public function exeTask_update(TaskRequest $request){
        
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
        $task = Task::find($inputs['id']);
        $task->fill([
            'task' => $inputs['tasks']['0']
        ]);
        $task->save();
        \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            dd($e->getMessage());
            abort(500);
        }
        return redirect()->route('task_list');
    }

        public function exeDelete($id){
            try{
                $taskStatus = Task_status::where('task_id', $id)->first();
                
                if ($taskStatus) {
                    $taskStatus->update(['del_flg' => 1]);
                }
                $task = Task::find($id);
                if($task){
                    $task->update(['del_flg' => 1]);
                }
            } catch(\Throwable $e){
                dd($e->getMessage());
                abort(500);
            }
            return redirect()->route('task_list');
        }
    public function showStatus_register($id){
        $task = Task::find($id);
        return view('employee.status_register',['task'=>$task]);
    }

}

