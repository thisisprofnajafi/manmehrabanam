@include('layouts.header')

<!-- START WINNERS -->
<section class="bg-home bg-light" id="winners">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h3 class="title-heading">برندگان قرعه‌کشی</h3>
                                    <p class="text-muted f-17 mt-3">لیست برندگان خوش‌شانس قرعه‌کشی یک میلیارد تومانی</p>
                                    <img src="{{ asset('front-end/images/home-border.png') }}" height="15" class="mt-3" alt="">
                                </div>

                                @if($winners->isEmpty())
                                    <div class="alert alert-info text-center">
                                        هنوز برنده‌ای انتخاب نشده است.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>نام برنده</th>
                                                    <th>مبلغ جایزه</th>
                                                    <th>تاریخ برنده شدن</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($winners as $winner)
                                                    <tr>
                                                        <td>{{ $winner->user->name }}</td>
                                                        <td>{{ number_format($winner->prize_amount) }} تومان</td>
                                                        <td>{{ verta($winner->created_at)->format('Y/m/d H:i') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                <div class="text-center mt-5">
                                    <a href="{{ route('lottery.index') }}" class="btn btn-primary btn-lg px-5">
                                        بازگشت به صفحه قرعه‌کشی
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