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
                            <a title="This Answer is Useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x" aria-hidden="true"></i>
                            </a>
                            <span class="votes-count">123</span>
                            <a title="This Answer is not useful" class="vote-dwon off">
                                <i class="fas fa-caret-down fa-3x" aria-hidden="true"></i>
                            </a>
                            <a title="Mars this answer as best answer" class="vote-accepted mt-2">
                                <i class="fas fa-check fa-2x" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="media-body">
                            @parsedown($answer->body)
                            <div class="float-right">
                                <span class="text-muted">Answeres {{ $answer->created_date}}</span>
                                <div class="media mt-2">
                                    <a href="{{$answer->user->url}}" class="pr-2">
                                        <img src="{{$answer->user->avatar}}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                    </div>
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