@extends('layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                ti bara rawa7 galet Laya Bara RAWA7 HA 
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                                <h1> {{$question->title}} </h1>
                                    <div class="ml-auto">
                                    <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back to all Questions</a>
                                    </div>
                        </div>
                    </div>

                    <hr>

                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a  title="This question is useful" class="vote-up">
                                <i class="fa fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1230</span>
                            <a title="This question is not useful" class="vote-down off">
                                <i class="fa fa-caret-down fa-3x"></i>
                            </a>
                            <a title="Click to mark as favorite question (click again to undo)" class="favorite mt-2 favorited">
                                <i class="fa fa-star fa-2x"></i>
                                <span class="favorites-count">123</span>
                            </a>
                        </div>
                        <div class="media-body ml-4">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">Asked {{ $question->created_date}}</span>
                                <div class="media mt-2">
                                    <a href="{{ $question->user->url }}" class="pr-2">
                                    <img src="{{ $question->user->avatar }}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{ $question->user->url}}">{{ $question->user->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
    ])
    @include('answers._create')
</div>
@endsection
