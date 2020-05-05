<div class="media post">
    @include('shared._vote',['model'=>$answer])
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
                <user-info :model="{{$answer}}" label="Answered"></user-info>
            </div>
        </div>

    </div>
</div>