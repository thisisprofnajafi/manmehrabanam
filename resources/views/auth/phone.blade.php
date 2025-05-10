<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="utf-8" />
    <title>من مهربانم - ورود</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Bootstrap 4 Landing Page Template" />
    <meta name="keywords" content="bootstrap 4, premium, marketing, multipurpose" />
    <meta content="Themesdesign" name="author" />
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon-32x32.png') }}">
    <!-- css -->
    <link href="{{ asset('front-end/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front-end/css/bootstrap-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front-end/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front-end/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('front-end/css/custom.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="rtl">
    <div class="account-home-btn d-none d-sm-block">
        <a href="{{ route('home') }}" class="text-primary"><i class="mdi mdi-home h1"></i></a>
    </div>

    <section class="bg-account-pages vh-100">
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-12">
                            <div class="login-box">
                                <div class="row align-items-center no-gutters">
                                    <div class="col-lg-6">
                                        <div class="bg-light">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    <div class="home-img login-img text-center d-none d-lg-inline-block">
                                                        <div class="animation-2"></div>
                                                        <div class="animation-3"></div>
                                                        <img src="{{ asset('front-end/images/features/img-4.png') }}" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-11">
                                                <div class="p-4">
                                                    <div class="text-center mt-3">
                                                        <a href="{{ route('home') }}">
                                                            <img src="{{ asset('front-end/images/logo-dark.png') }}" alt="" height="22">
                                                        </a>
                                                        <p class="text-muted mt-3">ورود به حساب کاربری</p>
                                                    </div>

                                                    @if(session('error'))
                                                        <div class="alert alert-danger text-center" role="alert">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif

                                                    @if(session('success'))
                                                        <div class="alert alert-success text-center" role="alert">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif

                                                    <div class="p-3 custom-form">
                                                        <form method="POST" action="{{ route('auth.send-otp') }}" id="phoneForm">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="phone">شماره موبایل</label>
                                                                <input type="tel" class="form-control" id="phone" name="phone" 
                                                                    placeholder="شماره موبایل را وارد نمایید" required
                                                                    pattern="09[0-9]{9}" dir="ltr">
                                                                <small class="text-muted">مثال: 09123456789</small>
                                                                <div class="invalid-feedback" id="phoneError"></div>
                                                            </div>
                                                            <div class="mt-3">
                                                                <button type="submit" class="btn btn-primary btn-block">ارسال کد تایید</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- javascript -->
    <script src="{{ asset('front-end/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-end/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('front-end/js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneForm = document.getElementById('phoneForm');
            const phoneInput = document.getElementById('phone');
            const phoneError = document.getElementById('phoneError');

            // Phone number validation
            phoneInput.addEventListener('input', function(e) {
                const phone = e.target.value;
                const phoneRegex = /^09[0-9]{9}$/;
                
                if (!phoneRegex.test(phone)) {
                    phoneError.textContent = 'شماره موبایل باید با ۰۹ شروع شود و ۱۱ رقم باشد';
                    phoneInput.classList.add('is-invalid');
                } else {
                    phoneError.textContent = '';
                    phoneInput.classList.remove('is-invalid');
                }
            });

            phoneForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const phone = phoneInput.value;
                const phoneRegex = /^09[0-9]{9}$/;

                if (!phoneRegex.test(phone)) {
                    phoneError.textContent = 'شماره موبایل باید با ۰۹ شروع شود و ۱۱ رقم باشد';
                    phoneInput.classList.add('is-invalid');
                    return;
                }

                // Submit the form
                this.submit();
            });
        });
    </script>
</body>
</html> 