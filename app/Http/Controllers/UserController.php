<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        $user = auth()->user();

        return view('user.show', [
            "user" => $user,
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('user.edit', [
            "user" => $user,
        ]);
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);

        return view('user.delete', [
            "user" => $user,
        ]);
    }

    public function update(User $user)
    {
        $this->authorize('update', $user);
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'birth_date' => ['required', 'date_format:Y-m-d', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')]
        ]);

        $user = auth()->user();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->birth_date = $data['birth_date'];

        $user->save();

        return view('user.show', [
            "user" => $user,
        ]);
    }

    public function remove(User $user)
    {
        $this->authorize('delete', $user);

        auth()->logout();

        $user->delete();

        return redirect(route('task.index'));
    }
}
