<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function newtask()
    {
        return view('newtask');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'duedate' => 'date|after_or_equal:today',
            'priority' => 'in:low,medium,high',
            'description' => 'nullable',
        ]);

        $task = new Task([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'duedate' => $request->input('duedate'),
            'user_email' => Auth::user()->email,
            'status' => 'incomplete',
            'priority' => $request->input('priority'),
            'days' => now()->diffInDays($request->input('duedate')),
        ]);

        $task->save();

        return redirect()->route('home')->with('success', 'Task created successfully.');
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('home')->with('error', 'Task not found.');
        }

    
        if ($task->user_email !== Auth::user()->email) {
            return redirect()->route('home')->with('error', 'Unauthorized to delete this task.');
        }

        $task->delete();

        return redirect()->route('home')->with('success', 'Task deleted successfully.');
    }

    public function edit(Task $task){
        return view('edittask',['task'=>$task]);
    }

    public function update(Task $task, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'duedate' => 'date|after_or_equal:today',
            'priority' => 'in:low,medium,high',
            'description' => 'nullable',
            'status' => 'in:incomplete,complete',
        ]);

        
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->duedate = $request->input('duedate');
        $task->user_email = Auth::user()->email;
        $task->status = $request->input('status');
        $task->priority = $request->input('priority');
        $task->days = now()->diffInDays($request->input('duedate'));

        $task->save();

        return redirect('index')->with('success', 'Task updated successfully');
    }


    public function getHighPriorityTasks()
    {
        $tasks = Task::where('priority', 'high')->get();
        return view('high', compact('tasks'));
    }

    public function getLowPriorityTasks()
    {
        $tasks = Task::where('priority', 'low')->get();
        return view('low', compact('tasks'));
    }

    public function getMediumPriorityTasks()
    {
        $tasks = Task::where('priority', 'medium')->get();
        return view('medium', compact('tasks'));
    }

}

