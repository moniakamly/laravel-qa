@extends('layouts.app')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <div class="d-flex align-items-center">
                        <h1> {{$question->title}} </h1>
                            <div class="ml-auto">
                            <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">Back to all Questions</a>
                            </div>
                       
                   </div>
                </div>

                <div class="card-body">
                {!! $question->body_html !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
