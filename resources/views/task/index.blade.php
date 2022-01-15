@extends('layouts.app')

@section('content')
<div class="container">

    @forelse ($tasks as $task)
        <li>
            <a href="/task/{{ $task->id }}"> {{ $task->title }} </a>
        </li>
    @empty
        <p>No posts</p>
    @endforelse

</div>
@endsection
