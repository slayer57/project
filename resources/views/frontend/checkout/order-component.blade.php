<div class="container card card-body shadow-lg p-4">
    <h3 class="mb-4 sec-title-wrapper">Your Order</h3>
    <div class="d-flex justify-content-between">
        <h5>Product</h5>
        <h5>Subtotal</h5>
    </div>
    @if ($cartItems->isNotEmpty())
        @foreach ($cartItems as $item)
            <div class="value d-flex justify-content-between">
                <p>{{ $item->name ?? '' }} <b>x {{ $item->quantity ?? '' }}</b></p>
                <p>R.s. {{ number_format($item->price * $item->quantity) }}</p>
            </div>
        @endforeach

        <div class="d-flex justify-content-between mt-2">
            <h6>Shipping Charge</h6>
            <div class="text-right">
                <h6>Rs. {{ number_format(getShippingCharge()) }}</h6>
            </div>
        </div>

        @if (session()->has('couponDiscount'))
            <div class="d-flex justify-content-between mt-2">
                <p class="">Coupon Discount</p>
                <div class="text-right">
                    <h6 class="text-primary">{{ discount() }}</h6>
                </div>
            </div>
        @endif

        <div class="total d-flex justify-content-between mt-4">
            <h5>Total</h5>
            <div class="text-right">
                <h6>Rs. {{ number_format(getTotalAmount(), 2) }}</h6>
                <p>Tax inclusive*</p>
            </div>
        </div>
    @endif

    <div class="form-check mt-3">
        <input class="form-check-input" type="radio" name="payment_method" id="flexRadioDefault2"
            value="Cash on delivery" required />
        <div class="d-flex justify-content-between ps-2">
            <label class="form-check-label" for="flexRadioDefault2">
                Cash on delivery
            </label>
        </div>
    </div>

    <div class="form-check mt-3">
        <input class="form-check-input" value="eSewa" type="radio" name="payment_method" id="flexRadioDefault2"
            required>
        <div class="d-flex justify-content-between ps-2">
            <label class="form-check-label" for="flexRadioDefault2">
                eSewa
            </label>
            <div class="media-wrapper">
                <img src="{{ asset('frontend/assets/images/esewa.jpg') }}" alt="">
            </div>
        </div>
    </div>

    <div class="form-check mt-4">
        <input class="form-check-input" type="checkbox" name="term" value="" id="flexCheckDefault" required />
        <label class="form-check-label" for="flexCheckDefault">
            I have read and agreed to the website
            <a href="{{ route('page.show', 'terms-and-conditions') }}" target="_blank">terms and
                conditions</a>
            <span class="text-danger">*</span>
        </label>
    </div>
    <button class="btn btn-primary place">Place Order</button>
</div>
