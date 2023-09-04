<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    //ログイン画面を表示
    public function showLogin(){
        return view('employee.login');
    }
    public function exeLogin(Request $request) {
        
        $credentials = $request->only('number', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            return redirect()->route('user.toppage')->with('login_success', 'ログインが成功しました。');
        } else {
            // ログイン失敗時に直接リダイレクト
            return redirect()->back()->withErrors(['number' => 'ログイン情報が正しくありません']);
        }
    }
       
    
    //トップページを表示
    public function showTop(){
        $user=auth()->user();
       
        if (!$user) {
            return redirect()->route('login');
        }
        if($user->authority === 0){
            return view('system.toppage');
        }else{
            return view('employee.toppage');
        }
        
    }

    //ユーザー登録画面の表示
    public function showMake_user(){
        return view('system.make_user');
    }
    //ユーザー登録の実行
    public function exeMake_user(UserRequest $request){
        
        Member::create([
            'number' => $request->input('number'),
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'authority' => $request->input('authority'),
        ]);
        return view('system.make_user');
    
    }
    //パスワードリセット画面を表示
    public function showReset(){
        return view('system.reset');
    }
    //パスワードリセットを実行
    public function exeReset(UserRequest $request){
        $request->validate([
            'number' => 'required|exists:users,number',
            'password' => ['required', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/', 'max:100'],
        ]);
        $number = $request->input('number');
        $newPassword = $request->input('password');
        
        $user = Member::where('number', $number)->first();
        if ($user) {
            $user->password = Hash::make($newPassword);
            $user->save();
            return redirect()->route('login')->with('success', 'パスワードが更新されました。');
        }
        return back()->withErrors(['number' => '該当するユーザーが存在しません。']);
    }

    //社員一覧の表示
    public function showList_user(){
        $users=Member::all();
        return view('system.list_user',['users' => $users]);

    }
    //社員編集画面の表示
    public function showUser_edit($id){
        $user = Member::find($id);
        return view('system.user_edit',['user'=>$user]);
    }
    //社員情報の編集
    public function exeUpdate_user(Request $request) {
        if ($request->isMethod('POST')) {
        $request->validate([
            'number' => 'required|exists:users,number|max:20',
            'name' => 'required|max:50',
            'role' => 'required|max:20',
        ]);
        $inputs = $request->all();
        \Log::info('exeUser_update: Inputs', $inputs); // 追加
    
        \DB::beginTransaction();
        try {
            $user = Member::find($inputs['id']);
    
            $user->fill([
                'number' => $inputs['number'],
                'name' => $inputs['name'],
                'role' =>$inputs['role'],
                'authority' => $inputs['authority'],
            ]);
    
            $user->save();
            \DB::commit();
        } catch(\Throwable $e) {
            \DB::rollback();
            \Log::error('exeUser_update: Error', ['error' => $e->getMessage()]); 
            abort(500);
        }
        return redirect()->route('list_user');
    }
        return redirect()->route('list_user');
    }
    //社員情報を削除
    public function exeUser_delete($id){
        if ($request->isMethod('POST')) {
        try{
            $user = Member::find($id);
            if($user){
                $user->update(['del_flg' => 1]);
            }
        } catch(\Throwable $e){
            dd($e->getMessage());
            abort(500);
        }
        return redirect()->route('list_user'); 
    }
        return redirect()->route('list_user'); 
    }
    //ログアウト
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login')->with('logout_message', 'ログアウトしました。');
    }
}
