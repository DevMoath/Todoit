@extends('layouts.app')

@section('content')
    @include('layouts.navbar')
    <div>
        <!-- Page Header -->
        <header class="masthead" style="background-image: url('{{ asset('img/bg1.jpg') }}')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                            @include('layouts.flash-message')
                            <h1>@lang('Todoit')</h1>
                            <span class="subheading">
                                @lang('What you need to organize your day 😊')
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="col-md-7 mx-auto">
            <section class="mb-5 pb-2">
                <h1 class="text-center mb-3">
                    @lang('About me')
                </h1>
                <hr>
                <p class="font-20 text-muted text-center">
                    @lang("My name is Moath and I started develop this app to provide to people every tool they need in any To-Do list app for FREE and ease of use")
                </p>
            </section>
            <section class="mb-5 pb-2">
                <h1 class="text-center mb-3">
                    @lang('Service You Will Get')
                </h1>
                <hr>
                <div class="row services">
                    <div class="col-sm-6 my-2">
                        <div class="card shadow-sm">
                            <div class="card-body mx-auto text-center">
                                <i class="fas fa-4x fa-tasks text-primary mb-4"></i>
                                <h3 class="h4 mb-2">@lang('Organize Your Day')</h3>
                                <p class="text-muted mb-0">@lang('You can Create, Edit, Delete tasks or list of tasks')</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 my-2">
                        <div class="card shadow-sm">
                            <div class="card-body mx-auto text-center">
                                <i class="fas fa-4x fa-cloud text-dark mb-4"></i>
                                <h3 class="h4 mb-2">@lang('Cloud Storage')</h3>
                                <p class="text-muted mb-0">@lang("You will store your data in the Cloud so, don't care about losing your data")</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 my-2">
                        <div class="card shadow-sm">
                            <div class="card-body mx-auto text-center">
                                <i class="fas fa-4x fa-database text-success mb-4"></i>
                                <h3 class="h4 mb-2">@lang('Unlimited Storage')</h3>
                                <p class="text-muted mb-0">@lang("You can create Lists/Tasks as much you want")</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 my-2">
                        <div class="card shadow-sm">
                            <div class="card-body mx-auto text-center">
                                <i class="fas fa-4x fa-heart text-danger mb-4"></i>
                                <h3 class="h4 mb-2">@lang('Made with Love')</h3>
                                <p class="text-muted mb-0">@lang("Is it really open source if it's not made with love ?")</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mb-5 pb-2">
                <h1 class="text-center mb-3">
                    @lang("Let's Get In Touch!")
                </h1>
                <hr>
                <p class="font-20 text-muted text-center">
                    @lang('Do you have problem using the app? Do you have ideas and ready to start your next project with me?
                    Email me, and I will get back to you as soon as possible!')
                </p>
                <div class="row">
                    <div class="col-sm-4 my-2">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <i class="fab fa-twitter fa-3x text-primary"></i>
                                </h5>
                                <a href="https://twitter.com/Dev_Moath" class="btn btn-link btn-hover btn-block">
                                    @Dev_Moath
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 my-2">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <i class="fas fa-envelope fa-3x text-dark"></i>
                                </h5>
                                <a href="mailto:Moath.alhajrii@gmail.com"
                                   class="btn btn-link btn-hover btn-block">
                                    Moath.Alhajrii@gmail.com
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 my-2">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <i class="fab fa-github fa-3x text-secondary"></i>
                                </h5>
                                <a href="https://github.com/DevMoath/Todoit" class="btn btn-link btn-hover btn-block">
                                    @DevMoath
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mb-5 pb-2">
                <h1 class="text-center mb-3">
                    @lang('Or write your ideas, suggestions here')
                </h1>
                <hr>
                <form method="POST" action="{{ route('suggestions.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label required">
                            @lang('Name')
                        </label>
                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" placeholder="example" required
                                   autocomplete="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label required">
                            @lang('E-Mail')
                        </label>
                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" placeholder="email@example.com" required
                                   autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-md-4 col-form-label required">
                            @lang('Message')
                        </label>
                        <div class="col-md-8">
                            <textarea name="message" id="message" cols="30" placeholder="@lang('message ...')"
                                      class="form-control @error('message') is-invalid @enderror" rows="10"
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-5 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block">
                                @lang('Send')
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    @include('layouts.footer')
@endsection
