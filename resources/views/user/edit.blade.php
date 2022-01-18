@extends('layouts.app')

@section('content')
    <div class="container fs-4">
        <form method="POST" action="{{ route('user.update', ['user' => $user->id]) }}">
            @csrf

            <div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="name" class="col-form-label">New name</label>
                    <div class="pb-3">
                        <input id="name" type="text" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror"
                               name="name" required autocomplete="name" autofocus>
                    </div>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="email" class="col-form-label">New email</label>
                    <div class="pb-3">
                        <input id="email" type="email" value="{{$user->email}}" class="form-control @error('email') is-invalid @enderror"
                               name="email" required autocomplete="email" autofocus>
                    </div>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <label for="birth_date" class="col-form-label">New birthdate (just in case)</label>
                    <div class="pb-3">
                        <input id="birth_date" type="date" value="{{$user->birth_date}}" class="form-control @error('birth_date') is-invalid @enderror"
                               name="birth_date" required autocomplete="name" autofocus>
                    </div>

                    @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="pt-3">
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
