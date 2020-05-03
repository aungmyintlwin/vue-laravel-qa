@if($answersCount >0)
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>{{$answersCount." ".Str::plural('Answer',$answersCount)}}</h2>
                    </div>
                    <hr>
                    @include('layouts._messages')
                    @foreach($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="This answer is Useful" class="vote-up {{Auth::guest() ? 'off': ''}}"
                                onClick="event.preventDefault();document.getElementById('vote-up-answer-{{ $answer->id }}').submit();"
                                >
                                    <i class="fas fa-caret-up fa-3x" aria-hidden="true"></i>
                                </a>
                                <form id="vote-up-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>
                                <span class="votes-count">{{ $answer->votes_count}}</span>
                                <a title="This answer is not useful" class="vote-dwon {{Auth::guest() ? 'off':''}}"
                                onClick="event.preventDefault();document.getElementById('vote-down-answer-{{ $answer->id }}').submit();"
                                >
                                    <i class="fas fa-caret-down fa-3x" aria-hidden="true"></i>
                                </a>
                                <form id="vote-down-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                                {{-- @include('shared._vote') --}}
                            </div>
                            <div class="media-body">
                                @parsedown($answer->body)
                                <div class="row">
                                    <div class="col-4">
                                        <div class="ml-auto">
                                            {{-- @if(Auth::user()->can('update-question',$question)) --}}
                                            @can('update',$answer)
                                                <a href="{{route('questions.answers.edit',[$question->id,$answer->id])}}" class="btn btn-outline-info">
                                                    Edit
                                                </a>
                                                @endcan
                                            {{-- @endif --}}
                                            {{-- @if(Auth::user()->can('delete-question',$question)) --}}
                                            @can('delete',$answer)
                                                <form class="form-delete" action="{{route('questions.answers.destroy',[$question->id,$answer->id])}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Are you Sure to Delete')">
                                                        Delete
                                                    </button>
                                                </form>
                                                @endcan
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                    <div class="col-4">

                                    </div>
                                    <div class="col-4">
                                        @include('shared._author',[
                                            'model'=> $answer,
                                            'label' => 'Answer'
                                        ])
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif