@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="btn btn-danger rounded animate action-button shadow float-right"
                data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="btn btn-danger rounded animate action-button shadow float-right"
                data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <button type="button" class="btn btn-danger rounded animate action-button shadow float-right"
                data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <button type="button" class="btn btn-danger rounded animate action-button shadow float-right"
                data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="btn btn-danger rounded animate action-button shadow float-right"
                data-dismiss="alert" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
        <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item bg-transparent border-0 py-1">* {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
