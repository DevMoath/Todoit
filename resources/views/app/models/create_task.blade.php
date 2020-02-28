<div class="modal fade" tabindex="-1" role="dialog" id="add_task">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto">@lang('Add Task')</h5>
                <button type="button" class="btn btn-danger rounded animate action-button shadow" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="list_id" id="list_id" value="1">
                        <label for="task_name">@lang('Task Name')</label>
                        <input type="text" class="form-control bg-transparent" placeholder="Task Name" id="task_name"
                               name="name" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn text-primary btn-hover px-3 mx-2 rounded action-button animate"
                                data-dismiss="modal">@lang('Close')
                        </button>
                        <button type="submit" class="btn btn-primary rounded animate action-button px-3 mx-2 shadow">
                            @lang('Add Task')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
