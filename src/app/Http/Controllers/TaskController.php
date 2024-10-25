<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        $index_title = 'タスク一覧';
        return view(
            'tasks.index',
            compact('tasks', 'index_title')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'tasks.create',
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);
        $task = new Task();
        $data = $request->all();
        $task->title = $request->title;
        $task->fill($data);
        $task->save();

        return redirect(route('tasks.show', $task->id))->with('success', 'タスクを新規作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $show_title = 'タスク詳細';
        return view('tasks.show', compact('task', 'show_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $tasks = Task::all();
        $edit_title = 'タスク一覧';
        return view('tasks.edit', compact('tasks', 'edit_title', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required',
        ]);

        $data = $request->all();
        $task->fill($data);
        $task->save();

        return redirect(route('tasks.show', $task->id))->with('success', 'タスクを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect(route('tasks.index'))->with('success', 'タスクを削除しました');
    }
}
