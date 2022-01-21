<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all()->sort(function (Task $a, Task $b) {
            return $a->end_date < $b->end_date;
        })->sort(
            function (Task $a, Task $b) {
                return $this->get_task_status($a) - $this->get_task_status($b);
            });
        $time_now = Carbon::now();
        return view('task.index', [
            'tasks' => $tasks,
            'time_now' => $time_now
        ]);
    }

    private function get_task_status(Task $task): int
    {
        $time_now = Carbon::now();
        if ($time_now->diffInSeconds($task->start_date, false) > 0) {
            return 1;
        } else if ($time_now->diffInSeconds($task->end_date, false) < 0) {
            return 2;
        } else {
            return 0;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTaskRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);

        $data = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'after:' . Carbon::now()],
            'end_date' => ['required', 'after:' . 'start_date'],
            'solution' => ['required', 'string', 'max:255'],
            'is_premium' => ['nullable'],
        ]);

        Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'solution' => $data['solution'],
            'is_premium' => array_key_exists('is_premium', $data),
        ]);

        return redirect(route('task.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $user = auth()->user();
        $time_now = Carbon::now();

        $submissions = $task->submissions()->take(10)->get();
        if ($user) {
            if ($user->is_admin) {
                $submissions = $task->submissions()->get();
            } else {
                $submissions = $task->submissions()->where('user_id', '=', $user->id)->get();
            }
        }

        return view('task.show', [
            "task" => $task,
            "user" => $user,
            "time_now" => $time_now,
            "submissions" => $submissions,
            "has_submissions" => $submissions->isEmpty() == false,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        return view('task.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTaskRequest $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $data = request()->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'after:' . Carbon::now()],
            'end_date' => ['required', 'after:' . 'start_date'],
            'solution' => ['required', 'string', 'max:255'],
            'is_premium' => ['nullable'],
        ]);

        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->start_date = $data['start_date'];
        $task->end_date = $data['end_date'];
        $task->solution = $data['solution'];
        $task->is_premium = array_key_exists('is_premium', $data);
        $task->save();

        return redirect(route('task.index'));
    }

    /**
     * Show delete view.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function delete(Task $task)
    {
        $this->authorize('delete', $task);

        return view('task.delete', [
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect(route('task.index'));
    }
}
