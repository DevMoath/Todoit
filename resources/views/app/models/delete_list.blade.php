<div class="modal" tabindex="-1" role="dialog" id="delete_list_{{ $list->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto">Delete List</h5>
                <button type="button" class="btn btn-danger rounded animate action-button shadow" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="post" action="{{ route('list.destroy', $list->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Are you sure you wants to delete <kbd>{{ $list->name }}</kbd> List ?</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn text-primary btn-hover px-3 mx-2 rounded action-button animate" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger px-3 mx-2 rounded action-button animate">Yes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>