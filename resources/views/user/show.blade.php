@extends('layouts.app')

@section('content')
    <div class="container fs-4">
        <div> Your name is: <strong>{{$user->name}}</strong> </div>
        <div> Your email is: <strong>{{$user->email}}</strong> </div>
        <div> Your were born: <strong>{{$user->birth_date}}</strong> </div>
        <div>
            Your invite code: <strong>{{$user->invite_code}}</strong>
            <p>
                @if($user->invited_people < 3)
                    You still need <strong>{{3 - $user->invited_people}}</strong> people to register from your invitation link to get premium!
                @else
                    Congratulations! As a prize for inviting {{$user->invited_people}} people you have access to premium tasks!
                @endif
            </p>
        </div>
        <div class="d-flex align-items-center">
            <div class="bg-light border border-1 border-dark rounded-2">
                <a class="nav-link text-dark" href="{{ route('user.edit', ['user' => $user->id]) }}">
                    Edit data
                </a>
            </div>
            <div class="px-2"></div>
            <div class="bg-danger border border-1 border-danger rounded-2">
                <a class="nav-link text-white" href="{{ route('user.delete', ['user' => $user->id]) }}">
                    Delete your account
                </a>
            </div>
        </div>

    </div>
@endsection
