@if($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegement = 'questions'
    @endphp

@elseif($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegement = 'answers'
    @endphp
@endif

@php
    $formId = $name ."-".$model->id;
    $formAction= "/{$firstURISegement }/{$model->id}/vote";
@endphp



<div class="d-flex flex-column vote-controls">
    <a title="This {{ $name }} is Useful" class="vote-up {{Auth::guest() ? 'off': ''}}"
    onClick="event.preventDefault();document.getElementById('vote-up-{{ $formId}}').submit();"
    >
        <i class="fas fa-caret-up fa-3x" aria-hidden="true"></i>
    </a>
    <form id="vote-up-{{ $formId}}" action={{$formAction}} method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="votes-count">{{$model->votes_count}}</span>
    <a title="This {{ $name }} is not useful" class="vote-dwon {{Auth::guest() ? 'off':''}}"
    onClick="event.preventDefault();document.getElementById('vote-down-{{ $formId}}').submit();"
    >
        <i class="fas fa-caret-down fa-3x" aria-hidden="true"></i>
    </a>
    <form id="vote-down-{{ $formId}}" action={{$formAction}} method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if( $model instanceof App\Question)
        @include('shared._favorite',['model'=> $model])
    @elseif($model instanceof App\Answer)
        @include('shared._accept',['model'=> $model])
    @endif
</div>