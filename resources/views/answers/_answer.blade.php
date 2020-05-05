<answer :answer="{{$answer}}" inline-template>
    <div class="media post">
        @include('shared._vote',['model'=>$answer])
        <div class="media-body">
            <form v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <textarea class="form-control" rows="10" v-model="body"></textarea>
                </div>
                <button class="btn btn-primary" :disabled="inInvalid">Update </button>
                <button @click.prevent="cancle" class="btn btn-secondary">Cancle </button>
            </form>
            <div v-else>
                <div v-html="body"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                            {{-- @if(Auth::user()->can('update-question',$question)) --}}
                            @can('update',$answer)
                                <a @click.prevent="edit" class="btn btn-outline-info">
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
    </div>
</answer>