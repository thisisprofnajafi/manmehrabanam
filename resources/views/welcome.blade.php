@include('layouts.header')

<!-- END HOME -->
<section class="bg-home bg-light" id="home">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <!-- start row -->
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="main-slider home-content text-center">
                            <ul class="slides">
                                <li>
                                    <h3 class="home-title">فالنامه شخصی خود را با قیمت دلخواه خریداری کنید</h3>
                                    <p class="text-muted f-18 mt-3">با خرید فالنامه، در قرعه‌کشی یک میلیارد تومانی شرکت کنید</p>
                                    <div class="mt-4 pt-3">
                                        <a href="{{ route('horoscope.index') }}" class="btn btn-primary mr-3">خرید فالنامه</a>
                                        <a href="{{ route('lottery.winners') }}" class="btn btn-soft-primary">برندگان قبلی</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- START SERVICES -->
<section class="section bg-services" id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-box text-center">
                    <h3 class="title-heading mt-4">چگونه کار می‌کند؟</h3>
                    <p class="text-muted f-17 mt-3">سه مرحله ساده برای شرکت در قرعه‌کشی</p>
                    <img src="{{ asset('front-end/images/home-border.png') }}" height="15" class="mt-3" alt="">
                </div>
            </div>
        </div>
        <div class="row mt-5 pt-4">
            <div class="col-lg-4">
                <div class="services-box p-4 mt-4">
                    <div class="services-icon bg-soft-primary">
                        <i class="mdi mdi-account-plus text-primary"></i>
                    </div>
                    <h5 class="mt-4">ثبت نام کنید</h5>
                    <p class="text-muted mt-3">با ثبت نام در سایت، به جمع کاربران ما بپیوندید</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="services-box p-4 mt-4">
                    <div class="services-icon bg-soft-primary">
                        <i class="mdi mdi-cart text-primary"></i>
                    </div>
                    <h5 class="mt-4">فالنامه بخرید</h5>
                    <p class="text-muted mt-3">فالنامه مورد نظر خود را با قیمت دلخواه (حداقل ۱۰,۰۰۰ تومان) خریداری کنید</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="services-box p-4 mt-4">
                    <div class="services-icon bg-soft-primary">
                        <i class="mdi mdi-gift text-primary"></i>
                    </div>
                    <h5 class="mt-4">در قرعه‌کشی شرکت کنید</h5>
                    <p class="text-muted mt-3">با هر خرید، شانس خود را برای برنده شدن یک میلیارد تومان افزایش دهید</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- START PRICING -->
<section class="section" id="pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-box text-center">
                    <h3 class="title-heading mt-4">انواع فالنامه</h3>
                    <p class="text-muted f-17 mt-3">فالنامه مورد نظر خود را انتخاب کنید</p>
                    <img src="{{ asset('front-end/images/home-border.png') }}" height="15" class="mt-3" alt="">
                </div>
            </div>
        </div>
        <div class="row mt-5 pt-4">
            <div class="col-lg-4">
                <div class="pricing-box mt-4">
                    <i class="mdi mdi-star h1"></i>
                    <h4 class="f-20">فال روزانه</h4>
                    <div class="mt-4 pt-2">
                        <p class="mb-2 f-18">مشخصات</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>فال روزانه دقیق</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>راهنمایی‌های شخصی</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>پیش‌بینی‌های دقیق</p>
                    </div>
                    <div class="pricing-plan mt-4 pt-2">
                        <h4 class="text-muted">حداقل ۱۰,۰۰۰ تومان</h4>
                    </div>
                    <div class="mt-4 pt-3">
                        <a href="{{ route('horoscope.index') }}" class="btn btn-primary btn-rounded">خرید فال</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="pricing-box mt-4">
                    <div class="pricing-badge">
                        <span class="badge">محبوب</span>
                    </div>
                    <i class="mdi mdi-star-circle h1 text-primary"></i>
                    <h4 class="f-20 text-primary">فال هفتگی</h4>
                    <div class="mt-4 pt-2">
                        <p class="mb-2 f-18">مشخصات</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>پیش‌بینی هفته آینده</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>راهنمایی‌های دقیق</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>توصیه‌های ویژه</p>
                    </div>
                    <div class="pricing-plan mt-4 pt-2">
                        <h4 class="text-muted">حداقل ۱۰,۰۰۰ تومان</h4>
                    </div>
                    <div class="mt-4 pt-3">
                        <a href="{{ route('horoscope.index') }}" class="btn btn-primary btn-rounded">خرید فال</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="pricing-box mt-4">
                    <i class="mdi mdi-star-face h1"></i>
                    <h4 class="f-20">فال ماهانه</h4>
                    <div class="mt-4 pt-2">
                        <p class="mb-2 f-18">مشخصات</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>پیش‌بینی ماه آینده</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>تحلیل کامل</p>
                        <p class="mb-2"><i class="mdi mdi-checkbox-marked-circle text-success f-18 mr-2"></i>راهنمایی‌های ویژه</p>
                    </div>
                    <div class="pricing-plan mt-4 pt-2">
                        <h4 class="text-muted">حداقل ۱۰,۰۰۰ تومان</h4>
                    </div>
                    <div class="mt-4 pt-3">
                        <a href="{{ route('horoscope.index') }}" class="btn btn-primary btn-rounded">خرید فال</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- START CTA -->
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center">
                    <h2>شروع کنید با <span class="text-primary">من مهربانم</span></h2>
                    <p class="text-muted mt-3">فالنامه خود را خریداری کنید و در قرعه‌کشی یک میلیارد تومانی شرکت کنید</p>
                    <div class="mt-4 pt-2">
                        <a href="{{ route('horoscope.index') }}" class="btn btn-soft-primary btn-round mr-3 btn-rounded">خرید فالنامه</a>
                        <a href="{{ route('lottery.winners') }}" class="btn btn-primary btn-round btn-rounded">مشاهده برندگان</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')