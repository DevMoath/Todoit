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
                        <label>Are you sure you want to delete <kbd>{{ $list->name }}</kbd> List ?</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn text-primary btn-hover px-3 mx-2 rounded action-button animate"
                                data-dismiss="modal">
                            No
                        </button>
                        <button type="submit" class="btn btn-danger px-3 mx-2 rounded action-button animate">
                            Yes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector("#delete_list_{{ $list->id }} form").addEventListener("submit", e => {
        e.preventDefault();
        let url = "{{ route('list.destroy', $list->id) }}";
        fetch(url, {
            method: "delete",
            headers: {
                "Accept": "*/*",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: "{{ csrf_token() }}"
            })
        }).then(response => {
            if (response.ok) {
                $("#delete_list_{{ $list->id }}").modal("hide");
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: "List deleted"
                });
                document.querySelector('#list_{{ $list->id }}').remove();
                document.querySelector("#list-tab a.active").remove();
                let listTab = document.querySelector("#list-tab");
                if (listTab.children.length === 0) {
                    document.querySelector("#nav-tabContent").innerHTML =
                        "<div class='text-center mx-auto w-75 alert shadow-lg my-3 alert-dismissible fade show shadow'" +
                        "     role='alert' id=''>" +
                        "    <div class='card-body'>" +
                        "        <button class='btn close float-right btn-hover rounded animate action-button' data-dismiss='alert'>" +
                        "            <i class='fa fa-times fa-fw'></i>" +
                        "        </button>" +
                        "        <h5 class='card-title'>Ooops</h5>" +
                        "        <p class='card-text'>You don't have list.</p>" +
                        "        <button type='button' onclick='document.getElementById(\"add_list_button\").click()'" +
                        "                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>" +
                        "            Create One Now!" +
                        "        </button>" +
                        "    </div>" +
                        "</div>";
                    listTab.innerHTML                                   =
                        "<div class='text-center mx-auto w-100 alert shadow-lg my-3 alert-dismissible fade show shadow'" +
                        "     role='alert' id=''>" +
                        "    <div class='card-body'>" +
                        "        <button class='btn close float-right btn-hover rounded animate action-button' data-dismiss='alert'>" +
                        "            <i class='fa fa-times fa-fw'></i>" +
                        "        </button>" +
                        "        <h5 class='card-title'>Ooops</h5>" +
                        "        <p class='card-text'>You don't have list.</p>" +
                        "        <button type='button' onclick='document.getElementById(\"add_list_button\").click()'" +
                        "                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>" +
                        "            Create One Now!" +
                        "        </button>" +
                        "    </div>" +
                        "</div>";
                } else {
                    listTab.children[0].click();
                }
            } else {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "error",
                    title: "List can't be deleted, Try again"
                });
            }
        }).catch(error => console.error(error));
    });
</script>
