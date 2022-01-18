@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="fs-4">
            Are you sure that you want to delete this task? This is not reversible.
        </div>

        <div class="align-content-center">
            <form method="POST" action="{{ route('task.remove', ['task' => $task->id]) }}">
                @csrf
                <div class="pt-3">
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </div>
            </form>

            <div class="pt-3 col-2 float-right">
                <div class="bg-success border border-1 rounded-2">
                    <a class="nav-link text-white" href="/">
                        No, get me out of here
                    </a>
                </div>
            </div>
        </div>


    </div>
@endsection
