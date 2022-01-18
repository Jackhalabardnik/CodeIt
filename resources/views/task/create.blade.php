@extends('layouts.app')

@section('content')
    <div class="container fs-4">
        <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
            @csrf

            <div>
                <div class="col-3">
                    <label for="title" class="col-form-label">New title</label>
                    <div class="pb-3">
                        <input id="title" type="text" value="{{$user->title}}"
                               class="form-control @error('title') is-invalid @enderror"
                               name="title" required autocomplete="title" autofocus>
                    </div>

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>Title cannot be empty</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-3">
                    <label for="start_date" class="col-form-label">New birthdate (just in case)</label>
                    <div class="pb-3">
                        <input id="start_date" type="datetime-local" value="{{$user->start_date}}"
                               class="form-control @error('start_date') is-invalid @enderror"
                               name="start_date" required autocomplete="name" autofocus>
                    </div>

                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>Start date cannot be from past</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-3">
                    <label for="end_date" class="col-form-label">New birthdate (just in case)</label>
                    <div class="pb-3">
                        <input id="end_date" type="datetime-local" value="{{$user->end_date}}"
                               class="form-control @error('end_date') is-invalid @enderror"
                               name="end_date" required autocomplete="name" autofocus>
                    </div>

                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>End date cannot be before start date</strong>
                    </span>
                    @enderror
                </div>

                <div class="pt-3">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection
