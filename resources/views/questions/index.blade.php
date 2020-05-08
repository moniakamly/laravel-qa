@extends('layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <div class="d-flex align-items-center">
                        <h2> All Questions </h2>
                            <div class="ml-auto">
                            <a href="{{route('questions.create')}}" class="btn btn-outline-secondary">Ask Question</a>
                            </div>
                       
                   </div>
                </div>

                <div class="card-body">
                    @include ('layouts._messages')
                    @foreach ($questions as $question)
                        <div class="media">
                            <div class=" d-flex flex-column counters">
                                <div class="vote">
                                <strong> {{$question->votes_count}}</strong> {{str_plural('vote', $question->votes_count)}}
                                </div>
                                <div class="status {{$question->status}}">
                                    <strong> {{$question->answers_count}}</strong> {{str_plural('answer', $question->answers_count)}}
                                </div>
                                <div class="view">
                                     {{$question->views . " " . str_plural('view', $question->views)}}
                                </div>
                            </div>

                            <div class="media-body">
                                <div class="d-flex aligh-items-center">
                                    <h4 class="mt-0"><a href="{{ $question->url }}"> {{ $question->title}}</a></h4>

                                    <div class="ml-auto">
                                        @auth
                                            @if (Auth::user()->can('update-question', $question))
                                                <a href="{{route('questions.edit', $question->id)}}" class="btn btn-sm btn-outline-info">Edit</a>
                                            @endif

                                            @if (Auth::user()->can('delete-question', $question))
                                                <form class="form-delete" action="{{route('questions.destroy', $question->id)}}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type='submit' class='btn btn-sm btn-outline-danger' onclick="return confirm('Are you sure you want to delete ?')">Delete</button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                               </div>

                                    <p class="lead">
                                        Asked by 
                                    <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                                    <small class="text-muted"> {{$question->created_date}}</small>
                                    </p>
                                    <div class="excerpt">
                                        {{ $question->excerpt(300) }}
                                    </div>     
                            </div>
                        </div>
                        <hr>
                    @endforeach
                        <div class="mx-auto">
                            {{ $questions->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
