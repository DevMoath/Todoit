@if($lists->count())
    @foreach($lists as $list)
        <a class="list-group-item list-group-item-action{{ $loop->first ? ' active ' : ' ' }}text-muted rounded-0 border-left-0 border-right-0 border-top-0 mb-2"
           data-toggle="tab" role="tab"
           href="#list_{{ $list->id }}">
            <div class="d-flex">
                <div class="mr-3 my-auto">
                    <i class="fas fa-circle scale-1-5"
                       style="color: {{ $list->color }}"></i>
                </div>
                <div>
                    <h5 class='mb-1'>{{ $list->name }}</h5>
                    <small>{{ $list->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </a>
    @endforeach
@else
    @include('app.empty_alert', ["message" => "You don't have list.", "element" => "add_list_button", 'width' => 'full'])
@endif