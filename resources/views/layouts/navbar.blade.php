<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <div>
            @if(Route::getCurrentRoute()->getName() === 'home')
                <a class="navbar-brand animate btn-hover rounded px-3 mx-0" href="#">
                    {{ config('app.name', 'Todoit') }}
                </a>
            @else
                <a class="navbar-brand animate btn-hover rounded px-3 mx-0" href="{{ route('home') }}">
                    {{ config('app.name', 'Todoit') }}
                </a>
            @endif
        </div>
        {{--<button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>--}}
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-1">
                @auth
                    <a href="{{ route('app.index') }}" class="nav-link btn-hover rounded px-3 animate">
                        @lang('Start Now')
                    </a>
                @else
                    <a href="{{ route('login') }}" class="nav-link btn-hover rounded px-3 animate">
                        @lang('Start Now')
                    </a>
                @endauth
            </li>
        </ul>
        {{--<div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ml-auto"></ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mx-1">
                    @auth
                        <a href="{{ route('app.index') }}" class="nav-link btn-hover round px-3 animate">
                            @lang('Start Now')
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link btn-hover round px-3 animate">
                            @lang('Start Now')
                        </a>
                    @endauth
                </li>
            </ul>
        </div>--}}
    </div>
</nav>
