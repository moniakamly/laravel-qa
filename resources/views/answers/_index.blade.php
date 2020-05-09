
@if ($answersCount > 0) 

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                <h2>{{ $answersCount . " " . str_plural('Answer', $question->answers_count) }}</h2>
                </div>
                <hr>
                @include('layouts._messages')

                @foreach ($answers as $answer)
                    @include('answers._answers')
                @endforeach
            </div>
        </div>
    </div>
</div>

@endif