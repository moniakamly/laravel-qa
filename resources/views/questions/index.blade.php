@extends('layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Questions</div>

                <div class="card-body">
                    @foreach ($questions as $question)
                        <div class="media">
                            <div class="media-body">
                            <h4 class="mt-0"><a href="{{ $question->url }}"> {{ $question->title}}</a></h4>
                            <p class="lead">
                                Asked by 
                            <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                            <small class="text-muted"> {{$question->created_date}}</small>
                            </p>
                        {{ str_limit($question->body, 250) }}    
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
