<div class="modal" tabindex="-1" role="dialog" id="add_task">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-auto">Add Task</h5>
                <button type="button" class="btn btn-danger rounded animate action-button shadow" data-dismiss="modal"
                        aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="list_id" id="list_id" value="1">
                        <label for="task_name">Task Name</label>
                        <input type="text" class="form-control bg-transparent" placeholder="Task Name" id="task_name"
                               name="name" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn text-primary btn-hover px-3 mx-2 rounded action-button animate"
                                data-dismiss="modal">Close
                        </button>
                        <button type="submit" class="btn btn-primary rounded animate action-button px-3 mx-2 shadow">Add
                            Task
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector("#add_task form").addEventListener("submit", e => {
        e.preventDefault();
        let list_id = document.querySelector("#list-tab a.active").href.split("_")[1];
        let name    = document.querySelector("#task_name").value;
        let url     = "{{ route('task.store') }}";
        fetch(url, {
            method: "post",
            headers: {
                "Accept": "application/json, text/plain, */*",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: "{{ csrf_token() }}",
                list_id: list_id,
                name: name
            })
        }).then(response => {
            if (response.ok) {
                $("#add_task").modal("hide");
                document.querySelector("#task_name").value = "";
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: "Task created"
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
                    title: "Task can't be created, Try again"
                });
            }
        }).then(json => {
            if (json) {
                let empty_message = document.querySelector(`#list_${list_id} .alert-dismissible`);
                if (empty_message) {
                    empty_message.remove();
                }
                document.querySelector(`#list_${list_id}`).innerHTML += json.html;
            }
        }).catch(error => console.error(error));
    });
</script>