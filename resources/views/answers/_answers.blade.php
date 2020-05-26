<answer :answer="{{ $answer}}" inline-template>

    <div class="media post">
        @include('shared._vote', [
            'model' => $answer
        ])
    
        <div class="media-body">
            <form v-if="editing">Edit answer form
                <button type="button" v-on:click="editing = false">Update</button>
            </form>
            
            <div v-else>

                {!! $answer->body_html !!}
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            @auth
                                @if (Auth::user()->can('update', $answer))
                                    <a v-on:click.prevent="editing = true" class="btn btn-sm btn-outline-info">Edit</a>
                                @endif
        
                                @if (Auth::user()->can('delete', $answer))
                                    <form class="form-delete" action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type='submit' class='btn btn-sm btn-outline-danger' onclick="return confirm('Are you sure you want to delete ?')">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="col-4">
        
                    </div>
        
                    <div class="col-4">
                            {{-- @include('shared._author', [
                            'model' => $answer, 
                            'label' => 'Answered'  
                            ]) --}}
                    <user-info :model="{{ $answer }}" label="Answered"></user-info>
                    </div>
                </div> 
            </div>
        </div>
    </div>


</answer>