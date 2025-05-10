@include('layouts.header')

<!-- START LOTTERY -->
<section class="bg-home bg-light" id="lottery">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h3 class="title-heading">قرعه‌کشی یک میلیارد تومانی</h3>
                                    <p class="text-muted f-17 mt-3">با خرید فالنامه در قرعه‌کشی شرکت کنید و شانس برنده شدن جایزه بزرگ را از دست ندهید</p>
                                    <img src="{{ asset('front-end/images/home-border.png') }}" height="15" class="mt-3" alt="">
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="text-center mb-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="text-primary mb-3">جایزه کل</h5>
                                                    <h3 class="mb-0">{{ number_format($totalPrize) }} تومان</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-0 shadow-sm">
                                                <div class="card-body">
                                                    <h5 class="text-primary mb-3">تعداد شرکت‌کنندگان</h5>
                                                    <h3 class="mb-0">{{ number_format($participants) }} نفر</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <h5 class="alert-heading">نحوه شرکت در قرعه‌کشی</h5>
                                    <p class="mb-0">
                                        ۱. خرید فالنامه با مبلغ حداقل ۱۰,۰۰۰ تومان<br>
                                        ۲. هر خرید یک شانس برای برنده شدن<br>
                                        ۳. هر چه مبلغ خرید بیشتر باشد، شانس برنده شدن بیشتر است
                                    </p>
                                </div>

                                <div class="text-center mt-5">
                                    <a href="{{ route('horoscope.index') }}" class="btn btn-primary btn-lg px-5">
                                        خرید فالنامه و شرکت در قرعه‌کشی
                                    </a>
                                    <a href="{{ route('lottery.winners') }}" class="btn btn-outline-primary btn-lg px-5 ms-2">
                                        مشاهده برندگان قبلی
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer') 