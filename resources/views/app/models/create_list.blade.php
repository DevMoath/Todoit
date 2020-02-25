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
<script>
    document.querySelector("#list_color").addEventListener("focus", e => {
        document.querySelector("#color_picker").focus();
    });
    document.querySelector("#add_list form").addEventListener("submit", e => {
        e.preventDefault();

        let user_id = parseInt({{ auth()->id() }});
        let name    = document.querySelector("#new_list_name").value;
        let color   = document.querySelector("#list_color").value;
        fetch('{{ route('list.store') }}', {
            method: "post",
            headers: {
                "Accept": "application/json, text/plain, */*",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: "{{ csrf_token() }}",
                user_id: user_id,
                name: name,
                color: color
            })
        }).then(response => {
            if (String(response.status)[0] === "2") {
                $("#add_list").modal("hide");
                document.querySelector("#new_list_name").value = "";
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: "@lang('List created')"
                });
                return response.json();
            } else {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "error",
                    title: "@lang("List can't be created, Try again")"
                });
            }
        }).then(response => {
            if (response) {
                let empty_message = document.querySelector(`#list-tab .alert-dismissible`);
                if (empty_message) {
                    empty_message.remove();
                }
                let listTab    = document.getElementById("list-tab");
                let tabContent = document.getElementById("nav-tabContent");
                let child      = tabContent.children[0];
                if (child.classList.contains("alert-dismissible")) {
                    child.remove();
                }
                let isFirst = listTab.children.length === 0;
                let tabHtml = `
                    <a class="list-group-item list-group-item-action text-muted rounded-0 border-left-0 border-right-0 border-top-0 mb-2" data-toggle="tab"
                       href="#list_${response.list.id}" role="tab">
                        <div class="d-flex">
                            <div class="mr-3 my-auto">
                                <i class="fas fa-circle scale-1-5" style="color: ${response.list.color}"></i>
                            </div>
                            <div>
                                <h5 class='mb-1'>${response.list.name}</h5>
                                <small>${response.list.created}</small>
                            </div>
                        </div>
                    </a>
                `;
                listTab.innerHTML += tabHtml;
                // tabContent.innerHTML += response.html.replace("$isFirst", isFirst ? "show active" : "");
                tabContent.innerHTML += response.html;
                if (isFirst) {
                    document.querySelector(`a[href='#list_${response.list.id}']`).click();
                }
            }
        });
    });
</script>
