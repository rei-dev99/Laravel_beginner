<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $min_age = 20;
        $max_age = 50;
        $users = User::where('age', '>=', $min_age)->where('age', '<=', $max_age)->orderBy('age', 'desc')->get();
        $index_title = 'ユーザー一覧';

        return view(
            'users.index',
            compact('users', 'index_title')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'age' => 'required|integer',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->age = $request->age;
        $user->tel = $request->tel;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('users.show', $user))->with('success', 'ユーザーを新規登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $show_title = 'ユーザー詳細';
        return view('users.show', compact('user', 'show_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $validated = $request->validate([
            'age' => 'required|integer',
        ]);
        $data = $request->all();
        $user = User::find($id);
        $user->fill($data)->save();
        if(isset($data['password']) && !is_null($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return redirect(route('users.show', $user))->with('success', 'ユーザー情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect(route('users.index'))->with('success', 'ユーザー情報を削除しました');
    }
}
