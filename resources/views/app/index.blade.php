@extends('layouts.app')
@section('title', '| Application')
@section('js')
    <script>
        $("#cp1, #cp2").colorpicker();
    </script>
@endsection
@section('content')
    <div class="position-fixed bottom-0 right-0 m-3 btn-group dropleft z-1">
        <button type="button" class="btn btn-lg btn-primary rounded-circle animate action-button shadow"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false" data-offset="-100,0">
            <i class="fas fa-plus fa-2x my-2"></i>
        </button>
        <div class="dropdown-menu shadow">
            <button class="dropdown-item mb-1 py-2" id="add_list_button" data-toggle="modal" data-target="#add_list">
                <i class="fas fa-list-ul fa-fw mr-1"></i> Add List
            </button>
            <button class="dropdown-item mb-1 py-2" data-toggle="modal" id="add_task_button" data-target="#add_task">
                <i class="far fa-check-circle fa-fw mr-1"></i> Add Task
            </button>
        </div>
    </div>
    {{-- List Actions Model --}}
    @include('app.models.create_list')

    {{-- Task Actions Model --}}
    @include('app.models.create_task')
    @include('app.models.edit_task')
    @include('app.models.delete_task')

    {{-- App Settings Model --}}
    @include('app.models.settings')

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
                @include('flash-message')
                <div class="tab-content h-100 mx-auto" id="nav-tabContent">
                    @include('app.parts.lists-tabs-content', ['lists' => $lists])
                </div>
            </main>
        </div>
    </div>
@endsection