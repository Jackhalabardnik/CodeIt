@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>
                {{$task->title}}
            </h1>
        </div>
        <div>
            <p>
                Start: {{$task->start_date}}
            </p>
            <p>
                End: {{$task->end_date}}
            </p>
        </div>

        {{$task->description}}

        @guest
            <div class="d-flex align-items-center">
                <div class="text-dark align-content-center pe-2">
                    To submit your solution
                </div>

                <div class="bg-light border border-1 border-dark rounded-2">
                    <a class="nav-link text-dark" href="{{ route('login') }}">Log in</a>
                </div>

                <div class="text-dark align-content-center px-2">
                    Or
                </div>

                <div class="bg-dark border border-1 border-dark rounded-2">
                    <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
                </div>
            </div>
        @else
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="d-flex col-3">
                    <label for="solution" class="col-form-label">Solution</label>
                    <div class="px-3">
                        <input id="solution" type="text" class="form-control @error('solution') is-invalid @enderror"
                               name="solution" required autocomplete="name" autofocus>
                    </div>

                    @error('solution')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        @endguest

    </div>
@endsection
