@extends('layouts.app')
@section('title', '| Application')
@section('content')
    <div class="position-fixed bottom-0 right-0 m-3 btn-group dropleft z-1">
        <button type="button" class="btn btn-lg btn-primary rounded-circle animate action-button shadow"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="-100,0">
            <i class="fas fa-plus fa-2x my-2"></i>
        </button>
        <div class="dropdown-menu shadow">
            <button class="dropdown-item mb-1 py-2" id="add_list_button" data-toggle="modal" data-target="#add_list">
                <i class="fas fa-list-ul fa-fw mr-1"></i> @lang('Add List')
            </button>
            <button class="dropdown-item mb-1 py-2" data-toggle="modal" id="add_task_button" data-target="#add_task">
                <i class="far fa-check-circle fa-fw mr-1"></i> @lang('Add Task')
            </button>
        </div>
    </div>

    {{-- App Settings Model --}}
    @include('app.models.settings')

    {{-- List Actions Model --}}
    @include('app.models.create_list')
    @include('app.models.edit_list')
    @include('app.models.delete_list')

    {{-- Task Actions Model --}}
    @include('app.models.create_task')

    {{-- App Container --}}
    <div class="container-fluid vh-100">
        {{-- Side bar menu --}}
        <div class="row">
            <div class="col-lg-3 p-0 shadow bg-white position-fixed z-1" id="nav-container">
                <nav class="col-lg-12 navbar navbar-expand-lg navbar-light flex-lg-column flex-row" id="nav">
                    <div class="d-flex justify-content-between w-100 mb-2">
                        <button class="btn-hover btn navbar-toggler border-0 text-dark" id="toggler"
                                data-toggle="collapse" data-target="#sidebar">
                            <i class="fas fa-ellipsis-v fa-fw scale-1-5 rotate-90" id="menu"></i>
                        </button>
                        <a role="button" class="btn-hover btn px-3 mx-2 rounded action-button animate"
                           href="{{ route("home") }}">
                            <i class="fas fa-home fa-fw scale-1-5"></i>
                        </a>
                        <a role="button" href="#" class="btn-hover btn px-3 mx-2 rounded action-button animate"
                           data-toggle="modal" data-target="#settings">
                            <i class="fas fa-cog fa-fw scale-1-5"></i>
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn-hover btn px-3 mx-2 rounded action-button animate">
                                <i class="fas fa-sign-out-alt fa-fw scale-1-5"></i>
                            </button>
                        </form>
                    </div>
                    <div class="collapse navbar-collapse w-100" id="sidebar">
                        <div class="list-group w-100 p-2 mt-3" id="list-tab" role="tablist">
                            @include('app.parts.lists-tabs', ['lists' => $lists])
                        </div>
                    </div>
                </nav>
            </div>
            {{-- Main Content (Tasks) --}}
            <main class="col-lg-9 offset-lg-3 h-100">
                @include('layouts.flash-message')
                <div class="tab-content h-100 mx-auto" id="nav-tabContent">
                    @include('app.parts.lists-tabs-content', ['lists' => $lists])
                </div>
            </main>
        </div>
    </div>
@endsection

@section('js')
    <script>
        window.onload = e => {
            $("#cp1").colorpicker();
            document.querySelector("#list_color_to_edit").addEventListener("focus", e => {
                document.querySelector("#edit_color_picker").focus();
            });
            document.querySelector("#list_color").addEventListener("focus", e => {
                document.querySelector("#color_picker").focus();
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
                            _token: "{{ csrf_token() }}",
                            user_id: parseInt({{ auth()->id() }}),
                            name: name,
                            color: color
                        })
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
                                title: "@lang('List updated')"
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
                                title: "@lang("List can't be updated, Try again")"
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
                            _token: "{{ csrf_token() }}"
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
                                title: "@lang('List deleted')"
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
                                    "        <h5 class='card-title'>@lang('Ooops')</h5>" +
                                    "        <p class='card-text'>@lang('You don\'t have list.')</p>" +
                                    "        <button type='button' onclick='document.getElementById(\"add_list_button\").click()'" +
                                    "                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>" +
                                    "            @lang('Create One Now!')" +
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
                                    "        <h5 class='card-title'>@lang('Ooops')</h5>" +
                                    "        <p class='card-text'>@lang('You don\'t have list.')</p>" +
                                    "        <button type='button' onclick='document.getElementById(\"add_list_button\").click()'" +
                                    "                class='btn btn-primary rounded animate action-button px-3 mx-2 shadow'>" +
                                    "            @lang('Create One Now!')" +
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
                                title: "@lang("List can't be deleted, Try again")"
                            });
                        }
                    }).catch(error => console.error(error));
                }
            });

            let deleteModal = $("#delete_list"),
                editModal   = $("#edit_list");

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
        };
    </script>
@endsection
