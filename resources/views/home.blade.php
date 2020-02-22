@extends('layouts.app')

@section('content')
    @php($start = '/register')
    <!-- Navigation -->
    {{--    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">--}}
    {{--        <div class="container">--}}
    {{--            <a class="navbar-brand js-scroll-trigger" href="{{ $start }}">Start Now</a>--}}
    {{--            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"--}}
    {{--                    data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"--}}
    {{--                    aria-label="Toggle navigation">--}}
    {{--                <span class="navbar-toggler-icon"></span>--}}
    {{--            </button>--}}
    {{--            <div class="collapse navbar-collapse" id="navbarResponsive">--}}
    {{--                <ul class="navbar-nav ml-auto my-2 my-lg-0">--}}
    {{--                    <li class="nav-item">--}}
    {{--                        <a class="nav-link js-scroll-trigger" href="#about">About</a>--}}
    {{--                    </li>--}}
    {{--                    <li class="nav-item">--}}
    {{--                        <a class="nav-link js-scroll-trigger" href="#services">Services</a>--}}
    {{--                    </li>--}}
    {{--                    <li class="nav-item">--}}
    {{--                        <a class="nav-link js-scroll-trigger" href="#portfolio">Examples</a>--}}
    {{--                    </li>--}}
    {{--                    <li class="nav-item">--}}
    {{--                        <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </nav>--}}

    <!-- Header -->
    <header class="masthead bg-secondary" style="background-image: url('{{ asset("img/bg1.jpg") }}');
            background-size: 100% 100%">
        <div class="container vh-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    @include('flash-message')
                    <h1 class="text-uppercase text-white font-weight-bold">Your Favorite Free To-Do List App</h1>
                    <hr class="divider my-4">
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 font-weight-light mb-5">
                        Start organize your daily routine by write your tasks now for free</p>
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="#services">Find Out More</a>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section class="page-section bg-primary" id="about">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">I Have Got What You Need!</h2>
                    <hr class="divider light my-4">
                    <p class="text-secondary mb-4">I started develop this app to provide to people every tool they
                        need in any To-Do tasks app for FREE and ease of use</p>
                    <a class="btn btn-light btn-xl js-scroll-trigger" href="{{ $start }}">Get Started!</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section -->
    <section class="page-section" id="services">
        <div class="container">
            <h2 class="text-center mt-0">Service You Will Get</h2>
            <hr class="divider my-4">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-tasks text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Organize Your Day</h3>
                        <p class="text-muted mb-0">You can Create, Edit, Delete tasks or list of tasks</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-cloud text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Cloud Storage</h3>
                        <p class="text-muted mb-0">You will store your data in the Cloud so, don't care about losing
                            your data</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-database text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Unlimited Storage</h3>
                        <p class="text-muted mb-0">You can create and add List/Task as much you want</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-heart text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Made with Love</h3>
                        <p class="text-muted mb-0">Is it really open source if it's not made with love?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Section -->
    <section class="page-section bg-primary" id="portfolio">
        <h2 class="text-center text-light mt-0">Examples</h2>
        <hr class="divider border-light my-4">
        <div class="row mx-0">
            <div class="col-md-6 mx-auto my-3">
                <img src="{{asset('img/to.png')}}" alt="img" class="img-fluid">
            </div>
            <div class="col-md-6 mx-auto my-3">
                <img src="{{asset('img/to.png')}}" alt="img" class="img-fluid">
            </div>
        </div>
    </section>
    <!-- Call to Action Section -->
    <section class="page-section bg-dark text-white">
        <div class="container text-center">
            <h2 class="mb-4">Free To-Do List App!</h2>
            <a class="btn btn-light btn-xl" href="{{ $start }}">Start Now!</a>
        </div>
    </section>
    <!-- Contact Section -->
    <section class="page-section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">Let's Get In Touch!</h2>
                    <hr class="divider my-4">
                    <p class="text-muted mb-5">
                        Do you have problem using the app? Do you have ideas
                        and ready to start your next project with me? Send me an email
                        and I will get back to you as soon as possible!</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fab fa-twitter fa-3x mb-3 text-muted"></i>
                    <div>
                        <a href="https://twitter.com/Dev_Moath" target="_blank">@Dev_Moath</a>
                    </div>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                    <div>
                        <button id="email" type="button" class="btn btn-link" onclick="copy_email()"
                                data-toggle="tooltip" data-placement="top" title="Click to Copy">
                            Moath.Alhajrii@gmail.com
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="text-light">
        <div class="container-fluid bg-dark py-3">
            <div class="row my-2">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <span class="mr-2">Create Account For FREE!</span>
                    <a class="btn btn-primary rounded-pill px-3 py-2 my-2" href="{{ $start }}" role="button">Get
                        Started!</a>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <span class="mr-2">You Can Collaborate With Me Via</span>
                    <a class="btn btn-outline-primary rounded-pill px-3 py-2 my-2" href="https://github.com/"
                       role="button" target="_blank">
                        <i class="fab fa-github" style="font-size: 18px;"></i> GitHub
                    </a>
                </div>
            </div>
        </div>
        <hr class="m-0">
        <div class="container-fluid bg-dark py-3">
            <div class="small text-center">Copyright &copy; 2019 - To-Do List App</div>
        </div>
    </footer>
@endsection

@section('js')
    <script>
        $("[data-toggle='tooltip']").tooltip();

        function copy_email() {
            let input   = document.createElement("input");
            input.value = document.getElementById("email").innerHTML;
            input.id    = "new_input";
            document.body.appendChild(input);
            input.select();
            document.execCommand("copy");
            document.body.removeChild(input);
            Swal.fire({
                position: "top-start",
                toast: true,
                icon: "success",
                title: "Email Copied 👍",
                showConfirmButton: false,
                timer: 2000
            });
        }
    </script>
@endsection