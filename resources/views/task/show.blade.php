@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>
                {{$task->title}}
            </h1>
        </div>
        <div class="fs-4">
            <p>
                <strong>Start:</strong> {{\Carbon\Carbon::parse($task->start_date)}}
            </p>
            <p>
                <strong>End:</strong> {{\Carbon\Carbon::parse($task->end_date)}}
            </p>
        </div>

        <div class="fs-4">
            <strong>Description:</strong>
            <br>
            {{$task->description}}
        </div>

        @if($time_now->diffInSeconds($task->start_date, false) > 0)
            <div class="pt-3">
                <div class="fs-4 border border-success border-3 text-center rounded-2">
                    Task will open at {{\Carbon\Carbon::parse($task->start_date)}}
                </div>
            </div>
        @elseif($time_now->diffInSeconds($task->end_date, false) < 0)
            <div class="pt-3">
                <div class="fs-4 border border-danger border-3 text-center rounded-2">
                    Task closed at {{\Carbon\Carbon::parse($task->end_date)}}
                </div>
            </div>

        @else

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
                @if($user->is_admin == false)
                    @if($task->is_premium == false || $user->invided_people >= 3 )
                        <form method="POST" action="{{ route('submission.store', ['task' => $task]) }}">
                            @csrf
                            <div class="d-flex col-3 fs-4 pt-4 align-items-center">
                                <label for="solution" class="col-form-label">Solution:</label>
                                <div class="px-3">
                                    <input id="solution" type="text"
                                           class="form-control @error('solution') is-invalid @enderror"
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
                    @else
                        <div class="pt-3">
                            <div class="fs-4 border border-danger border-3 text-center rounded-2">
                                You have to invite {{3 - $user->invited_people}} more people to have access to
                                submitting to premium tasks.
                            </div>
                        </div>

                    @endif
                @else
                    <div class="fs-3">
                        Admin cannot submit solution, remember it.
                    </div>
                @endif

            @endif


        @endif

        @if($has_submissions)
            @guest
                @if($time_now->diffInSeconds($task->end_date, false) < 0)
                    <div class="pt-3 fs-3 text-center">
                        <stron>Submissions</stron>
                    </div>
                    @foreach ($submissions as $submission)
                        <div class="py-2">
                            <div
                                class="border border-2 border-dark rounded-3 fs-3 justify-content-between d-lg-flex d-md-flex
                                @if($submission->solution == $task->solution)
                                    bg-success bg-opacity-25
                                @endif ">
                                <div class="ps-2">
                                    {{$submission->solution}}
                                </div>
                                <div class="pe-2">
                                    Time: {{\Carbon\Carbon::parse($submission->date)}}
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif
            @else
                <div class="pt-3 fs-3 text-center">
                    <strong>
                        @if($user->is_admin)
                            Submissions:
                        @else
                            Your submissions:
                        @endif
                    </strong>
                </div>
                @foreach ($submissions as $submission)
                    <div class="py-2">
                        <div
                            class="border border-2 border-dark rounded-3 fs-3 justify-content-between d-lg-flex d-md-flex
                            @if($submission->solution == $task->solution && ($time_now->diffInSeconds($task->end_date, false) < 0 || $user->is_admin))
                                bg-success bg-opacity-25
                            @endif ">
                            <div class="ps-2">
                                @if($user->is_admin)
                                    Answer:
                                @else
                                    Your answer:
                                @endif
                                {{$submission->solution}}
                            </div>
                            <div class="pe-2">
                                Time: {{\Carbon\Carbon::parse($submission->date)}}
                            </div>
                        </div>
                    </div>

                @endforeach
            @endguest
        @endif
    </div>



    <script>

    </script>
@endsection
