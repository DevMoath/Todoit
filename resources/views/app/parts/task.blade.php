@if($task)
    <div class='input-group my-4 mx-auto border-bottom pb-3'>
        <div class='input-group-prepend mr-2'>
            <div class='input-group-text bg-transparent border-0'>
                <input type='checkbox' class="check-box" data-id="{{ $task->id }}"
                        {{ $task->completed ? 'checked' : '' }}>
            </div>
        </div>
        <input type='text' value='{{$task->name}}'
               class='task-name form-control bg-transparent border-0 rounded {{$task->completed ? 'checked' : ''}}'>
        <div class='input-group-append'>
            <button class='btn rounded-pill text-danger mx-1' type='button'>
                <i class='far fa-trash-alt fa-fw scale-1-2'></i>
            </button>
        </div>
    </div>
@endif
