$("#cp1").colorpicker();

document.querySelector("#list_color_to_edit").addEventListener("focus", e => {
    document.querySelector("#edit_color_picker").focus();
});
document.querySelector("#list_color").addEventListener("focus", e => {
    document.querySelector("#color_picker").focus();
});

let taskName = null;

function tasksInputEvent() {
    let tasksInput = document.querySelectorAll(".task-name");

    [].forEach.call(tasksInput, function (taskInput) {
        taskInput.addEventListener("focus", e => {
            taskName = e.target.value;
        });
        taskInput.addEventListener("blur", e => {
            if (taskName !== e.target.value) {
                fetch(`task/${e.target.dataset.id}`, {
                    method: "put",
                    headers: {
                        "Accept": "*/*",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        _token: token,
                        name: e.target.value,
                        list_id: e.target.dataset.list
                    })
                })
                    .then(response => {
                        if (response.ok) {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                icon: "success",
                                title: "Task Updated"
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                icon: "error",
                                title: "Task can't be updated, Try again"
                            });
                        }
                    })
                    .catch(error => console.error(error));
            }
            taskName = null;
        });
    });
}

tasksInputEvent();

document.querySelector("main").addEventListener("click", e => {
    if (e.target.classList.contains("check-box")) {
        let url, message;
        if (e.target.checked) {
            url     = `task/${e.target.dataset.id}/complete`;
            message = "Task Completed";
        } else {
            url     = `task/${e.target.dataset.id}/incomplete`;
            message = "Task Uncompleted";
        }
        fetch(url, {
            method: "put",
            headers: {
                "Accept": "*/*",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: token
            })
        })
            .then(response => {
                if (response.ok) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: "success",
                        title: message
                    });
                    if (e.target.checked) {
                        e.target.parentElement.parentElement.parentElement.children[1].classList.add("checked");
                    } else {
                        e.target.parentElement.parentElement.parentElement.children[1].classList.remove("checked");
                    }
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: "error",
                        title: "Task can't be updated, Try again"
                    });
                }
            })
            .catch(error => console.error(error));
    }
});

document.querySelector("body").addEventListener("submit", e => {
    e.preventDefault();
    if (e.target.dataset.type === "edit") {
        let id    = document.querySelector("#list_id_to_edit").value,
            name  = document.querySelector("#list_name_to_edit").value,
            color = document.querySelector("#list_color_to_edit").value;
        fetch(`list/${id}`, {
            method: "put",
            headers: {
                "Accept": "*/*",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                    _token: token,
                    user_id: userId,
                    name: name,
                    color: color
                }
            )
        }).then(response => {
            if (response.ok) {
                $("#edit_list").modal("hide");
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
                document.querySelector(`#list_${id} h1`).innerText                  = name;
                document.querySelector("#list-tab a.active h5").innerText           = name;
                document.querySelector("#list-tab a.active .fa-circle").style.color = color;
            }
        }).catch(error => console.error(error));
    } else if (e.target.dataset.type === "delete") {
        let id = document.querySelector("#list_id_to_delete").value;
        fetch(`list/${id}`, {
            method: "delete",
            headers: {
                "Accept": "*/*",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: token
            })
        }).then(response => {
            if (response.ok) {
                $("#delete_list").modal("hide");
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    icon: "success",
                    title: "List deleted"
                });
                document.querySelector(`#list_${id}`).remove();
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

                    listTab.innerHTML =
                        "<div class='text-center mx-auto w-100 alert shadow-lg my-3 alert-dismissible fade show shadow'" +
                        "     role='alert'>" +
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
    } else if (e.target.dataset.type === "delete-task") {
        let id = document.querySelector("#task_id_to_delete").value;
        fetch(`task/${id}`, {
            method: "delete",
            headers: {
                "Accept": "*/*",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                _token: token
            })
        })
            .then(response => {
                if (response.ok) {
                    $("#delete_task").modal("hide");
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: "success",
                        title: "Task Deleted"
                    });
                    let task      = document.querySelector(`#task_${id}`);
                    let container = task.parentElement;
                    task.remove();
                    if (container.children.length <= 1) {
                        container.innerHTML +=
                            "<div class='text-center mx-auto w-100 alert shadow-lg my-3 alert-dismissible fade show shadow'" +
                            "     role='alert'>" +
                            "    <div class='card-body'>" +
                            "        <button class='btn close float-right btn-hover rounded animate action-button' data-dismiss='alert'>" +
                            "            <i class='fa fa-times fa-fw'></i>" +
                            "        </button>" +
                            "        <h5 class='card-title'>Ooops</h5>" +
                            "        <p class='card-text'>You don't have tasks.</p>" +
                            "        <button type='button' onclick='document.getElementById(\"add_task_button\").click()'" +
                            "                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>" +
                            "            Create One Now!" +
                            "        </button>" +
                            "    </div>" +
                            "</div>";
                    }
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        icon: "error",
                        title: "Task can't be deleted, Try again"
                    });
                }
            })
            .catch(error => console.error(error));
    }
});

let deleteModal = $("#delete_list"),
    editModal   = $("#edit_list"),
    deleteTask  = $("#delete_task");

deleteModal.on("show.bs.modal", function (e) {
    document.querySelector("#list_id_to_delete").value   = e.relatedTarget.dataset.id;
    document.querySelector("#delete_list kbd").innerText = e.relatedTarget.dataset.name;
});
deleteModal.on("shown.bs.modal", function (e) {
    document.querySelector("#delete_list button[data-dismiss='modal']").focus();
});
deleteModal.on("hidden.bs.modal", function (e) {
    document.querySelector("#list_id_to_delete").value   = "";
    document.querySelector("#delete_list kbd").innerText = "";
});

deleteTask.on("show.bs.modal", function (e) {
    document.querySelector("#task_id_to_delete").value   = e.relatedTarget.dataset.id;
    document.querySelector("#delete_task kbd").innerText = e.relatedTarget.parentElement.previousElementSibling.value;
});
deleteTask.on("shown.bs.modal", function (e) {
    document.querySelector("#delete_task button[data-dismiss='modal']").focus();
});
deleteTask.on("hidden.bs.modal", function (e) {
    document.querySelector("#task_id_to_delete").value   = "";
    document.querySelector("#delete_task kbd").innerText = "";
});

editModal.on("show.bs.modal", function (e) {
    document.querySelector("#list_id_to_edit").value   = e.relatedTarget.dataset.id;
    document.querySelector("#list_name_to_edit").value = e.relatedTarget.dataset.name;
    $("#cp2").colorpicker("setValue", e.relatedTarget.dataset.color);
    document.querySelector("#list_color_to_edit").value = e.relatedTarget.dataset.color;
});
editModal.on("shown.bs.modal", function (e) {
    document.querySelector("#list_name_to_edit").focus();
});
editModal.on("hidden.bs.modal", function (e) {
    document.querySelector("#list_id_to_edit").value    = "";
    document.querySelector("#list_name_to_edit").value  = "";
    document.querySelector("#list_color_to_edit").value = "";
    $("#cp2").colorpicker("setValue", "#000000");
});
$("#add_list").on("shown.bs.modal", function (e) {
    document.querySelector("#new_list_name").focus();
});
$("#add_task").on("shown.bs.modal", function (e) {
    document.querySelector("#task_name").focus();
});
$("#settings").on("shown.bs.modal", function (e) {
    document.querySelector("#name").focus();
});

// Create List

document.querySelector("#list_color").addEventListener("focus", e => {
    document.querySelector("#color_picker").focus();
});
document.querySelector("#add_list form").addEventListener("submit", e => {
    e.preventDefault();

    let name  = document.querySelector("#new_list_name").value;
    let color = document.querySelector("#list_color").value;
    fetch(`list`, {
        method: "post",
        headers: {
            "Accept": "application/json, text/plain, */*",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            _token: token,
            user_id: userId,
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
                title: "List created"
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
                title: "List can't be created, Try again"
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

// Create Task

document.querySelector("#add_task form").addEventListener("submit", e => {
    e.preventDefault();
    let list_id = document.querySelector("#list-tab a.active").href.split("_")[1];
    let name    = document.querySelector("#task_name").value;
    fetch(`task`, {
        method: "post",
        headers: {
            "Accept": "application/json, text/plain, */*",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            _token: token,
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
            tasksInputEvent();
        }
    }).catch(error => console.error(error));
});
