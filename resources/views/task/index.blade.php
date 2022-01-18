@extends('layouts.app')

@section('content')
    <div class="container">

        @guest
            Want to try to code it? Log in to submit solutions!
        @else
        @if(Auth::user()->is_admin)
            <div class="row pb-3">
                <div class="col-2">
                    <a class="nav-link fs-4 rounded-1 bg-success text-white" href="{{route('task.create')}}">
                        Create new task
                    </a>
                </div>
            </div>
        @endif
        @endguest
        <div class="row"></div>
        @forelse ($tasks as $task)
            <li>
                <a href="/task/{{ $task->id }}"> {{ $task->title }} </a>
            </li>
        @empty
            <p>No tasks</p>
        @endforelse

    </div>
@endsection
