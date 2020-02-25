<div class="modal fade" tabindex="-1" role="dialog" id="edit_list">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto">@lang('Edit List')</h5>
                <button type="button" class="btn btn-danger rounded animate action-button shadow" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form data-type="edit">
                <div class="modal-body">
                    <input type="hidden" id="list_id_to_edit">
                    <div class="form-group">
                        <label for="list_name_to_edit">@lang('List Name')</label>
                        <input type="text" class="form-control bg-transparent" placeholder="@lang('List Name')"
                               id="list_name_to_edit" name="name">
                    </div>
                    <div class="form-group">
                        <label for="list_color_to_edit">@lang('List Color')</label>
                        <div id="cp2" class="input-group">
                            <input type="text" class="form-control" id="list_color_to_edit" value="#000000"
                                   name="color">
                            <span class="input-group-append">
                                <span class="input-group-text colorpicker-input-addon" id="edit_color_picker">
                                    <i></i>
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn text-primary btn-hover px-3 mx-2 rounded action-button animate"
                            data-dismiss="modal">
                        @lang('Close')
                    </button>
                    <button type="submit" class="btn btn-primary rounded animate action-button px-3 mx-2 shadow">
                        @lang('Update')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
