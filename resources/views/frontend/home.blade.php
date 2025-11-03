<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <link href="{{asset('frontend/assets/img/favicon.ico')}}" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Averia+Serif+Libre:wght@400;700&family=Poppins&display=swap"
        rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="{{asset('frontend/assets/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">

    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="51">
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-text d-flex flex-column h-100 justify-content-center text-center">
                <img class="w-100 img-fluid mb-4" src="{{ asset('storage/photos/' . $info->photo) }}" alt="Image">

                <h1 class="mt-2">{{ $info->name }}</h1>

                <div class="mb-4" style="height: 22px;">
                    <h4 class="typed-text-output d-inline-block text-body"></h4>
                    <div class="typed-text d-none">Full Stack Developer, AI Developer</div>
                </div>

                <div class="d-flex justify-content-center mt-auto mb-3">
                    <a class="mx-2" href="https://www.linkedin.com/in/yogesh-bachute-982a72194/"><i class="fab fa-linkedin-in"></i></a>
                    <a class="mx-2" href="+1`"><i class="fab fa-github"></i></a>
                </div>

                <div class="d-flex align-items-end justify-content-between">
                    <a href="{{ route('openResumeFile', ['folder' => 'resume_files', 'token' => $info->token]) }}"
                        target="_blank" class="btn btn-block border-right">
                        View CV
                    </a>
                    <a href="#contact" class="btn btn-block btn-scroll">Contact Me</a>
                </div>
            </div>
            <div class="sidebar-icon d-flex flex-column h-100 justify-content-center text-right">
                <i class="fas fa-2x fa-angle-double-right text-primary"></i>
            </div>
        </div>
        <div class="content">
            <div class="container bg-white py-5">
                <div class="row px-3">
                    <div class="col-12">
                        <h2 class="title position-relative pb-2 mb-4">About Me</h2>
                    </div>
                    <div class="col-12">
                        <p>{{ $info->about_me }}</p>
                        <div class="row">
                            <div class="col-sm-6 py-1">
                                <h5 class="d-inline text-primary">Name:</h5>
                                {{ $info->name ?? ''}}
                            </div>
                            <div class="col-sm-6 py-1">
                                <h5 class="d-inline text-primary">Birthday:</h5> {{ $info->dob}}
                            </div>
                            <div class="col-sm-6 py-1">
                                <h5 class="d-inline text-primary">Degree:</h5> {{ $info->degree}}
                            </div>
                            <div class="col-sm-6 py-1">
                                <h5 class="d-inline text-primary">Experience:</h5> {{ $info->experience }}
                            </div>
                            <div class="col-sm-6 py-1">
                                <h5 class="d-inline text-primary">Phone:</h5> {{ $info->phone }}
                            </div>
                            <div class="col-sm-6 py-1">
                                <h5 class="d-inline text-primary">Email:</h5> {{ $info->email }}
                            </div>
                            <div class="col-sm-6 py-1">
                                <h5 class="d-inline text-primary">Address:</h5> {{ $info->address }}
                            </div>
                            <div class="col-sm-6 py-1">
                                <h5 class="d-inline text-primary">Freelance:</h5> {{$info->freelance}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container bg-white py-5">
                <div class="col-12">
                    <h2 class="title position-relative pb-2 mb-4">Skills</h2>
                </div>
                <div class="row px-3">
                    <div class="col-sm-6">
                        @foreach($skills_languages as $row)
                            <div class="skill mb-4">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">{{ $row->skill_name }}</p>
                                    <p class="mb-2">{{ $row->skill_per }}%</p>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $row->skill_per }}%;" aria-valuenow="{{ $row->skill_per }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-sm-6">
                        @foreach($skills_frameworks as $row)
                            <div class="skill mb-4">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">{{ $row->skill_name }}</p>
                                    <p class="mb-2">{{ $row->skill_per }}%</p>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $row->skill_per }}%;" aria-valuenow="{{ $row->skill_per }}"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="container bg-white py-5">
                <div class="row px-3">
                    <div class="col-12">
                        <h2 class="title position-relative pb-2 mb-4">Expericence</h2>
                    </div>
                    <div class="col-12">
                        <div class="border-left border-primary pt-2 pl-4 ml-2">
                            @foreach ($experience as $row)
                                <div class="position-relative mb-4">
                                    <i class="fa fa-arrow-right text-primary position-absolute"
                                        style="top: 3px; left: -24px;"></i>
                                    <h5 class="mb-1">{{ $row->ex_name }}</h5>
                                    <p class="mb-2">{{ $row->com_name }} | <small>{{ $row->start_date }} -
                                            {{ $row->end_date }}</small></p>
                                    <p>{{ $row->com_des }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="container bg-white py-5 px-0">
                <div class="bg-primary text-center p-5">
                    <h1 class="text-white font-weight-bold">Subscribe My Newsletter</h1>
                    <p class="text-white">Subscribe and get my latest article in your inbox</p>
                    <form class="form-inline justify-content-center">
                        <div class="input-group">
                            <input type="text" class="form-control border-0 p-4" placeholder="Your Email">
                            <div class="input-group-append">
                                <button class="btn btn-dark px-4" type="submit">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container bg-white pt-5 pb-3">
                <div class="row px-3">
                    <div class="col-12">
                        <h2 class="title position-relative pb-2 mb-4">Services</h2>
                    </div>
                    @foreach ($service as $row)
                        <div class="col-md-6 service-item text-center mb-3">
                            <i class="fa fa-2x fa-laptop-code mx-auto mb-4"></i>
                            <h5 class="mb-2">{{ $row->ser_name }}</h5>
                            <p>{{ $row->ser_desc }}</p>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="container bg-white pt-5 pb-3">
                <div class="row px-3">
                    <div class="col-12">
                        <h2 class="title position-relative pb-2 mb-4">Projects</h2>
                    </div>
                    <div class="col-12">
                        <div class="row portfolio-container">
                            @foreach ($project as $row)
                                <div class="col-md-6 mb-4 portfolio-item first">
                                    <div class="position-relative overflow-hidden mb-2">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('storage/proj_imgs/' . $row->proj_img) }}"
                                            alt="{{ $row->title ?? 'Project Image' }}">

                                        <div class="portfolio-btn d-flex align-items-center justify-content-center">
                                            <a href="{{ $row->proj_link ?? 'javscript:void();' }}" target="_blank">
                                                <i class="fa fa-4x fa-eye text-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Portfolio End -->

            <!-- Contact Start -->
            <div class="container bg-white py-5" id="contact">
                <div class="row px-3">
                    <div class="col-12">
                        <h2 class="title position-relative pb-2 mb-4">Contact Me</h2>
                    </div>
                    <div class="col-12">
                        <div class="contact-form">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form name="sentMessage" action="{{ route('contact') }}" method="POST" novalidate>
                                @csrf

                                <div class="form-row">
                                    <div class="control-group col-sm-6 mb-3">
                                        <input type="text" class="form-control p-4" id="name" placeholder="Your Name"
                                            name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <p class="text-danger mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="control-group col-sm-6 mb-3">
                                        <input type="email" class="form-control p-4" id="email" placeholder="Your Email"
                                            name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <p class="text-danger mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="control-group mb-3">
                                    <input type="text" class="form-control p-4" id="subject" placeholder="Subject"
                                        name="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="control-group mb-3">
                                    <textarea class="form-control py-3 px-4" rows="5" id="message" placeholder="Message"
                                        name="message" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-danger mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <button class="btn btn-primary py-3 px-4" type="submit" id="sendMessageButton">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Contact End -->


            <!-- Footer Start -->
            <div class="container-fluid bg-white pt-5 px-0">
                <div class="container bg-dark text-light text-center py-5">
                    <div class="d-flex justify-content-center mb-4">
                        <a class="btn btn-outline-primary btn-square mr-2" href="https://github.com/Yogesh5454573"><i class="fab fa-github"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-2" href="https://www.linkedin.com/in/yogesh-bachute-982a72194/"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <a class="text-white" href="javascript:void();">Privacy</a>
                        <span class="px-3">|</span>
                        <a class="text-white" href="javascript:void();">Terms</a>
                        <span class="px-3">|</span>
                        <a class="text-white" href="javascript:void();">FAQs</a>
                        <span class="px-3">|</span>
                        <a class="text-white" href="javascript:void();">Help</a>
                    </div>
                    <p class="m-0">&copy; All Rights Reserved. Designed by <a href="/">Yogesh</a></p>
                </div>
            </div>
            <!-- Footer End -->
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend/assets/lib/typed/typed.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('frontend/assets/lib/lightbox/js/lightbox.min.js')}}"></script>

    <!-- Contact Javascript File -->
    <script src="{{asset('frontend/assets/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('frontend/assets/mail/contact.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('frontend/assets/js/main.js')}}"></script>
</body>

</html>