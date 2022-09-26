<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\CategoryProduct;
use App\Country;
use App\Task;
use App\TaskComment;
use App\User;
use App\UserTask;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = Admin::role('marketer')->get();
        $countries = Country::all();
        $categories =CategoryProduct::whereNull('parent_id')->get();
        return view('admin.tasks.create', compact('countries','categories','users'));
    }
    public function users(Request $request)
    {
    if ($request->country !==null &&$request->category !== null ){
        $users = Admin::role('marketer')->where('country_id',$request->country)->whereHas('categories',
            function($query) use($request)
            {$query->where('category_id', $request->category);})->get();

    }elseif ($request->country !==null &&$request->category == null ){
        $users = Admin::role('marketer')->where('country_id',$request->country)->get();
    }elseif($request->country ==null &&$request->category !== null ){
        $users = Admin::role('marketer')->whereHas('categories', function($query) use($request) {
            $query->where('category_id', $request->category);
        })->get();
    }else{
        $users = Admin::role('marketer')->get();
    }

        return view('admin.tasks.users', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'deadline' => 'required|date',
            'users' => 'required',
        ]);
        $task =Task::Create([
           'name'=>$request->name,
           'deadLine'=>$request->deadline,
           'description'=>$request->description,

        ]);
        $task->users()->attach($request->users);
        return redirect()->route('admin.tasks.all')->with('success','Done');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('admin.tasks.show', compact('task'));
    }
    public function showUser(Task $task,Admin $user)
    {
        $userTask = UserTask::where(['task_id'=>$task->id,'user_id'=>$user->id])->first();
        return view('admin.tasks.comments', compact('task','user','userTask'));
    }
    public function myTask(Task $task)
    {
        $user =auth()->user();
        $userTask = UserTask::where(['task_id'=>$task->id,'user_id'=>$user->id])->first();
        $userTask->show = 1;
        $userTask->save();
        return view('admin.tasks.comments', compact('task','user','userTask'));
    }
    public function taskStatus(Task $task,$status)
    {
        $user =auth()->user();
        $userTask = UserTask::where(['task_id'=>$task->id,'user_id'=>$user->id])->first();
        $userTask->status = $status;
        $userTask->save();
        return redirect()->back()->with('success','Done');
    }
    public function myTasks()
    {
        $user =auth()->user();
        $tasks= $user->tasks;
        return view('admin.tasks.index', compact('tasks','user'));
    }
    public function addComment(Request $request)
    {
        TaskComment::Create([
            'user_id'=>auth()->user()->id,
            'user_task_id'=>$request->userTask,
            'comment'=>$request->comment
        ]);
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $users = $task->users;
        $countries = Country::all();
        $categories =CategoryProduct::whereNull('parent_id')->get();
        return view('admin.tasks.edit', compact('countries','categories','users','task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'deadline' => 'required|date',
            'users' => 'required',
        ]);
        $task->update([
            'name'=>$request->name,
            'deadLine'=>$request->deadline,
            'description'=>$request->description,

        ]);
        $task->users()->sync($request->users);
        return redirect()->route('admin.tasks.all')->with('success','Done');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('admin/tasks/all');
    }
}
