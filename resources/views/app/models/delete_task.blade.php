<div class="modal fade" tabindex="-1" role="dialog" id="delete_task">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto">@lang('Delete Task')</h5>
                <button type="button" class="btn btn-danger rounded animate action-button shadow" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form data-type="delete-task">
                <input type="hidden" id="task_id_to_delete" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label>
                            @lang('Are you sure you want to delete')
                            <kbd></kbd>
                            @lang('Task ?')
                        </label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn text-primary btn-hover px-3 mx-2 rounded action-button animate"
                                data-dismiss="modal">
                            @lang('No')
                        </button>
                        <button type="submit" class="btn btn-danger px-3 mx-2 rounded action-button animate">
                            @lang('Yes')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
