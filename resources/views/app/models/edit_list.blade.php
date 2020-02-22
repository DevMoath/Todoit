<div class="modal" tabindex="-1" role="dialog" id="edit_list_{{ $list->id }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto">Edit List</h5>
                <button type="button" class="btn btn-danger rounded animate action-button shadow" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="edit_list_name">List Name</label>
                        <input type="text" class="form-control bg-transparent" placeholder="List Name"
                               id="edit_list_name_{{ $list->id }}" name="name" value="{{ $list->name }}">
                    </div>
                    <div class="form-group">
                        <label for="edit_list_color">List Color</label>
                        <div id="cp2" class="input-group">
                            <input type="text" class="form-control" id="edit_list_color_{{ $list->id }}" name="color"
                                   value="{{ $list->color ?? '#000' }}" readonly>
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
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary rounded animate action-button px-3 mx-2 shadow">
                        Update list
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector("#edit_list_color_{{ $list->id }}").addEventListener("focus", e => {
        document.querySelector("#edit_color_picker").focus();
    });
    document.querySelector("#edit_list_{{ $list->id }} form").addEventListener("submit", e => {
        e.preventDefault();
        let name  = document.querySelector("#edit_list_name_{{ $list->id }}").value;
        let color = document.querySelector("#edit_list_color_{{ $list->id }}").value;
        let url   = "{{ route('list.update', $list->id) }}";
        fetch(url, {
            method: "put",
            headers: {
                "Accept": "*/*",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: "{{ csrf_token() }}",
                user_id: parseInt({{ auth()->id() }}),
                name: name,
                color: color
            })
        }).then(response => {
            if (response.ok) {
                $("#edit_list_{{ $list->id }}").modal("hide");
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: "List updated"
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
                    title: "List can't be updated, Try again"
                });
            }
        }).then(json => {
            if (json) {
                document.querySelector('#list_{{ $list->id }} h1').innerText        = name;
                document.querySelector("#list-tab a.active h5").innerText           = name;
                document.querySelector("#list-tab a.active .fa-circle").style.color = color;
            }
        }).catch(error => console.error(error));
    });
</script>