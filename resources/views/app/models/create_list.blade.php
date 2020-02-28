<div class="modal fade" tabindex="-1" role="dialog" id="add_list">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto">@lang('Create List')</h5>
                <button type="button" class="btn btn-danger rounded animate action-button shadow" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_list_name">@lang('List Name')</label>
                        <input type="text" class="form-control bg-transparent" placeholder="List Name"
                               id="new_list_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="list_color">@lang('List Color')</label><br>
                        <div id="cp1" class="input-group">
                            <input type="text" class="form-control" id="list_color" name="color" value="#000000">
                            <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon" id="color_picker">
                                    <i></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-primary btn-hover px-3 mx-2 rounded action-button animate"
                            data-dismiss="modal">@lang('Close')
                    </button>
                    <button type="submit" class="btn btn-primary rounded animate action-button px-3 mx-2 shadow">
                        @lang('Create List')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
