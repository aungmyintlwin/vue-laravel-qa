@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{$question->title}}</h1>
                            <div class="ml-auto">
                                <a href="{{route('questions.index')}}" class="btn btn-outline-secondary">
                                    Back To All Question
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This question is Useful" class="vote-up {{Auth::guest() ? 'off': ''}}"
                            onClick="event.preventDefault();document.getElementById('vote-up-question-{{$question->id}}').submit();"
                            >
                                <i class="fas fa-caret-up fa-3x" aria-hidden="true"></i>
                            </a>
                            <form id="vote-up-question-{{$question->id}}" action="/questions/{{$question->id}}/vote" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>
                            <span class="votes-count">{{$question->votes_count}}</span>
                            <a title="This question is not useful" class="vote-dwon {{Auth::guest() ? 'off':''}}"
                            onClick="event.preventDefault();document.getElementById('vote-down-question-{{$question->id}}').submit();"
                            >
                                <i class="fas fa-caret-down fa-3x" aria-hidden="true"></i>
                            </a>
                            <form id="vote-down-question-{{$question->id}}" action="/questions/{{$question->id}}/vote" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>
                            <a title="Click to mark as Favorite Question (Click anagin to undo)" class="favorite mt-2 {{ Auth::guest() ? 'off': ($question->is_favorited ? 'favorited' : '')}}"
                                onClick="event.preventDefault();document.getElementById('favorite-question-{{$question->id}}').submit();"
                                >
                                <i class="fas fa-star fa-2x" aria-hidden="true"></i>
                                <span class="favorites-count">{{$question->favorites_count}}</span>
                            </a>
                            <form id="favorite-question-{{$question->id}}" action="/questions/{{$question->id}}/favorites" method="POST" style="display: none;">
                                @csrf
                                @if($question->is_favorited)
                                    @method('DELETE')
                                @endif
                            </form>
                        </div>
                        <div class="media-body">
                            @parsedown($question->body)
                            <div class="float-right">
                                <span class="text-muted">Answeres {{ $question->created_date}}</span>
                                <div class="media mt-2">
                                    <a href="{{$question->user->url}}" class="pr-2">
                                        <img src="{{$question->user->avatar}}" alt="">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    @include('answers._index',[
        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
    ])
    @include('answers._create')
</div>
@endsection
