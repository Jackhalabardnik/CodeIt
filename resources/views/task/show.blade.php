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
                Start: {{$task->startDate}}
            </p>
            <p>
                End: {{$task->endDate}}
            </p>
        </div>

        {{$task->description}}

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

    </div>
@endsection
