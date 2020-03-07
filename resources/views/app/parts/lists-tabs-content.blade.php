@if($lists->count())
    @foreach($lists as $list)
        <div class="tab-pane fade{{ $loop->first ? ' show active' : '' }} w-80 mx-auto" id="list_{{ $list->id }}"
             role="tabpanel">
            <div class="d-flex">
                <h1 class="flex-fill">
                    {{ $list->name }}
                </h1>
                <div>
                    <button class='btn btn-hover rounded animate action-button px-2 mx-0 mt-1' data-toggle='dropdown'
                            aria-haspopup='true' aria-expanded='false'>
                        <i class="fas fa-ellipsis-h fa-fw scale-1-5"></i>
                    </button>
                    <div class='dropdown-menu shadow mt-1' aria-labelledby='dropdownMenuButton'>
                        <button type='button' data-toggle="modal" data-target="#edit_list" data-id="{{ $list->id }}"
                                data-name="{{ $list->name }}" data-color="{{ $list->color }}"
                                class='dropdown-item mb-1 py-2 d-flex'>
                            <span>@lang('Edit')</span>
                            <i class='fas fa-pen fa-fw ml-auto my-auto'></i>
                        </button>
                        <button type='button' data-toggle="modal" data-target="#delete_list" data-id="{{ $list->id }}"
                                data-name="{{ $list->name }}" class='dropdown-item mb-1 py-2 text-danger d-flex'>
                            <span>@lang('Delete')</span>
                            <i class='far fa-trash-alt fa-fw ml-auto my-auto'></i>
                        </button>
                    </div>
                </div>
            </div>
            @if($list->tasks->count())
                @foreach($list->tasks as $task)
                    @include("app.parts.task", ['task' => $task])
                @endforeach
            @else
                @include('app.empty_alert', ["message" => "You don't have tasks.", "element" => 'add_task_button'])
            @endif
        </div>
    @endforeach
@else
    @include('app.empty_alert', ["message" => "You don't have list.", "element" => "add_list_button"])
@endif
