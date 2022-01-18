@extends('layouts.app')

@section('content')
    <div class="container fs-4">
        <form method="POST" action="{{ route('task.update', ['task' => $task]) }}">
            @csrf

            <div>
                <div class="col-3">
                    <label for="title" class="col-form-label">New title</label>
                    <div class="pb-3">
                        <input id="title" type="text" value="{{$task->title}}"
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
                    <label for="description" class="col-form-label">New description</label>
                    <div class="pb-3">
                        <textarea id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  name="description" required autocomplete="description"
                                  autofocus> {{$task->description}} </textarea>
                    </div>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>Title cannot be empty</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-3">
                    <label for="start_date" class="col-form-label">Start date</label>
                    <div class="pb-3">
                        <input id="start_date" type="datetime-local" value="{{$task->start_date}}"
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
                    <label for="end_date" class="col-form-label">End date</label>
                    <div class="pb-3">
                        <input id="end_date" type="datetime-local" value="{{$task->end_date}}"
                               class="form-control @error('end_date') is-invalid @enderror"
                               name="end_date" required autocomplete="name" autofocus>
                    </div>

                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>End date cannot be before start date</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-3">
                    <label for="solution" class="col-form-label">Solution</label>
                    <div class="pb-3">
                        <input id="solution" type="text" value="{{$task->solution}}"
                               class="form-control @error('solution') is-invalid @enderror"
                               name="solution" required autocomplete="name" autofocus>
                    </div>

                    @error('solution')
                    <span class="invalid-feedback" role="alert">
                        <strong>End cannot be empty</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-3 d-flex">
                    <label for="is_premium" class="col-form-label pe-2">Is premium</label>
                    <div class="pb-3" style="padding-top: 6px">
                        <input id="is_premium" type="checkbox" name="is_premium" autocomplete="name"
                               @if($task->is_premium)
                               checked
                               @endif
                               autofocus>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="btn btn-primary">
                        Edit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
