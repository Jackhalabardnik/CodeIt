@extends('layouts.app')

@section('content')
    <div class="container">

        @guest
            <div class="fs-4">
                Want to code it?
                <a href="{{route('login')}}">
                    Log in
                </a>
                to submit solutions!
            </div>
        @else
            @if(Auth::user()->is_admin)
                <div class="row pb-3">
                    <div class="col-lg-3 col-md-5 col-sm-12 text-center">
                        <a class="nav-link fs-4 rounded-1 bg-success text-white" href="{{route('task.create')}}">
                            Create new task
                        </a>
                    </div>
                </div>
            @endif
        @endguest
        <div class="row pt-2">
            <h1 class="text-center"> Tasks </h1>
            <div class="text-decoration-line-through"></div>
            @forelse ($tasks as $task)
                <div class="py-2">
                    <div
                        class="border border-2 border-dark rounded-3 fs-3 d-flex justify-content-between">
                        <a class="nav-link text-dark" href="{{ route('task.show', ['task'=> $task->id]) }}">
                            <strong>{{ $task->title }}</strong>
                            @if($task->is_premium)
                                *premium
                            @endif

                        </a>
                        @can('delete', $task)
                            <div class="d-flex p-2">
                                <div class="pe-2">
                                    <a class="bg-success rounded-2 nav-link text-white"
                                       href="{{ route('task.edit', ['task'=> $task->id]) }}">
                                        Edit </a>
                                </div>
                                <div>
                                    <a class="bg-danger rounded-2 nav-link text-white"
                                       href="{{ route('task.delete', ['task'=> $task->id]) }}">
                                        Delete </a>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            @empty
                <p>No tasks</p>
            @endforelse
        </div>

    </div>
@endsection
