<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="settings" id="settings"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto">@lang('Settings')</h5>
                <button type="button" class="btn btn-danger rounded animate action-button shadow" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body mt-0 py-0" style="min-height: 400px">
                <div class="row">
                    <div class="col-3 border-right py-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" style="min-height: 400px"
                             aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                               role="tab" aria-controls="v-pills-home" aria-selected="true">
                                @lang('Profile Information')
                            </a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                               role="tab" aria-controls="v-pills-profile" aria-selected="false">@lang('Security')</a>
                            {{--<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                               role="tab" aria-controls="v-pills-messages" aria-selected="false">appearance</a>--}}
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content py-3" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel">
                                <form action="{{ route("user.update", auth()->id()) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">@lang('Name')</label>
                                        <input type="text" class="form-control" id="name" name="name" required
                                               value="{{auth()->user()->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="col-form-label">@lang('Username')</label>
                                        <input type="text" class="form-control" id="username" name="username" required
                                               value="{{ auth()->user()->username }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">@lang('Email')</label>
                                        <input type="text" class="form-control" id="email" name="email" required
                                               value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn btn-primary px-3 mx-2 rounded action-button animate float-right">
                                            @lang('Update')
                                        </button>
                                    </div>
                                </form>
                                <form action="{{ route("user.destroy", auth()->id()) }}" id="delete_form" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="delete_button"
                                            class="btn btn-hover text-danger mr-auto px-3 rounded action-button animate">
                                        <i class="far fa-trash-alt fa-fw mr-1"></i> @lang('Delete Account')
                                    </button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                 aria-labelledby="v-pills-profile-tab">
                                <form action="{{ route("user.updatePassword", auth()->id()) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="password" class="col-form-label">@lang('Old Password')</label>
                                        <input id="password" type="password" placeholder="*******" minlength="8"
                                               required class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password" class="col-form-label">@lang('New Password')</label>
                                        <input id="new_password" type="password" placeholder="*******" minlength="8"
                                               required class="form-control" name="new_password">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn btn-primary px-3 mx-2 rounded action-button animate float-right">
                                            @lang('Update')
                                        </button>
                                    </div>
                                </form>
                            </div>
                            {{--<div class="tab-pane fade" id="v-pills-messages" role="tabpanel">
                                <div class="form-group">
                                    <div class="custom-control custom-switch ml-2">
                                        <input type='checkbox' class='custom-control-input' id='dark'>
                                        <label class="custom-control-label" for="dark">@lang('Dark Theme')
                                            <i class="fas fa-moon fa-fw"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector("#delete_button").addEventListener("click", e => {
        e.preventDefault();
        Swal.fire({
            title: "@lang("Are you sure?")",
            text: "@lang("You won't be able to revert this!")",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: "animate action-button shadow",
                cancelButton: "animate action-button shadow"
            },
            confirmButtonColor: "#c51f1a",
            confirmButtonText: "@lang('Yes, delete it!')"
        }).then((result) => {
            if (result.value)
                document.querySelector("#delete_form").submit();
        });
    });
</script>
