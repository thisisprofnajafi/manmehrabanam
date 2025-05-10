@include('layouts.header')

<!-- START HOROSCOPE -->
<section class="bg-home bg-light" id="horoscope">
    <div class="home-center">
        <div class="home-desc-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h3 class="title-heading">خرید فالنامه و شرکت در قرعه‌کشی</h3>
                                    <p class="text-muted f-17 mt-3">فالنامه مورد نظر خود را انتخاب کنید و در قرعه‌کشی یک میلیارد تومانی شرکت کنید</p>
                                    <img src="{{ asset('front-end/images/home-border.png') }}" height="15" class="mt-3" alt="">
                                </div>

                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('horoscope.purchase') }}" id="horoscopeForm">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">نوع فالنامه</label>
                                        <select class="form-select" name="horoscope_type" id="horoscopeType">
                                            <option value="daily">فال روزانه</option>
                                            <option value="weekly">فال هفتگی</option>
                                            <option value="monthly">فال ماهانه</option>
                                        </select>
                                    </div>

                                    <div class="mb-4" id="birthMonthContainer" style="display: none;">
                                        <label class="form-label fw-bold">ماه تولد</label>
                                        <select class="form-select" name="birth_month" id="birthMonth">
                                            <option value="1">فروردین</option>
                                            <option value="2">اردیبهشت</option>
                                            <option value="3">خرداد</option>
                                            <option value="4">تیر</option>
                                            <option value="5">مرداد</option>
                                            <option value="6">شهریور</option>
                                            <option value="7">مهر</option>
                                            <option value="8">آبان</option>
                                            <option value="9">آذر</option>
                                            <option value="10">دی</option>
                                            <option value="11">بهمن</option>
                                            <option value="12">اسفند</option>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">مبلغ پرداختی (تومان)</label>
                                        <div class="d-flex align-items-center mb-3">
                                            <button type="button" class="btn btn-outline-primary" id="toggleCustomPrice">
                                                مبلغ دلخواه
                                            </button>
                                        </div>
                                        
                                        <div id="sliderContainer">
                                            <input type="range" class="form-range" id="priceSlider" 
                                                min="10000" max="100000" step="1000" value="10000">
                                            <div class="d-flex justify-content-between mt-2">
                                                <span class="text-muted">۱۰,۰۰۰ تومان</span>
                                                <span id="selectedPrice" class="text-primary fw-bold">۱۰,۰۰۰ تومان</span>
                                                <span class="text-muted">۱۰۰,۰۰۰ تومان</span>
                                            </div>
                                            <input type="hidden" name="amount" id="amount" value="10000">
                                        </div>

                                        <div id="customPriceContainer" style="display: none;">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="customPrice" 
                                                    name="amount" min="10000" value="10000">
                                                <span class="input-group-text">تومان</span>
                                            </div>
                                            <small class="text-muted">حداقل مبلغ: ۱۰,۰۰۰ تومان</small>
                                        </div>
                                    </div>

                                    <div class="text-center mt-5">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            خرید و شرکت در قرعه‌کشی
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const horoscopeType = document.getElementById('horoscopeType');
    const birthMonthContainer = document.getElementById('birthMonthContainer');
    const priceSlider = document.getElementById('priceSlider');
    const selectedPrice = document.getElementById('selectedPrice');
    const amountInput = document.getElementById('amount');
    const toggleCustomPrice = document.getElementById('toggleCustomPrice');
    const sliderContainer = document.getElementById('sliderContainer');
    const customPriceContainer = document.getElementById('customPriceContainer');
    const customPriceInput = document.getElementById('customPrice');

    // Toggle birth month selection
    horoscopeType.addEventListener('change', function() {
        if (this.value === 'birth_month') {
            birthMonthContainer.style.display = 'block';
        } else {
            birthMonthContainer.style.display = 'none';
        }
    });

    // Format price with commas
    function formatPrice(price) {
        return new Intl.NumberFormat('fa-IR').format(price) + ' تومان';
    }

    // Update price display
    function updatePrice(price) {
        selectedPrice.textContent = formatPrice(price);
        amountInput.value = price;
    }

    // Slider change event
    priceSlider.addEventListener('input', function() {
        updatePrice(this.value);
    });

    // Toggle between slider and custom price
    toggleCustomPrice.addEventListener('click', function() {
        if (sliderContainer.style.display !== 'none') {
            sliderContainer.style.display = 'none';
            customPriceContainer.style.display = 'block';
            toggleCustomPrice.textContent = 'استفاده از اسلایدر';
        } else {
            sliderContainer.style.display = 'block';
            customPriceContainer.style.display = 'none';
            toggleCustomPrice.textContent = 'مبلغ دلخواه';
            updatePrice(priceSlider.value);
        }
    });

    // Custom price validation
    customPriceInput.addEventListener('input', function() {
        let value = parseInt(this.value);
        if (value < 10000) {
            this.value = 10000;
        }
        updatePrice(this.value);
    });
});
</script>
@endpush

@include('layouts.footer') 