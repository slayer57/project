@if ($cartItems->count() > 0)
    <section class="cart-products p-3">
        <div class="container mt-0">
            <div class="table-responsive">
                <table class="table">
                    <thead class="hidden">
                        <tr>
                            <th scope="col">
                                <form class="delete-form" action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    <button class="delete border-0 bg-transparent empty-cart" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Empty your cart">
                                        <i class="text-primary fa fa-minus-circle p-2"></i>
                                    </button>
                                </form>
                            </th>
                            <th scope="col"></th>
                            <th scope="col">Products</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Quantity</th>
                            <th scope="col" class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr class="d-block d-lg-table-row">
                                <td class="align-middle d-block d-lg-table-cell border-bottom" style="width:10px">
                                    <span class="p-3 h6">
                                        <a href="javascript:void(0)">
                                            <i class="fa fa-times text-secondary cursor-pointer cart-item"
                                                aria-hidden="true" cart-item-id="{{ $item->id }}"></i></a>
                                    </span>
                                </td>
                                <td class="product-image d-block d-lg-table-cell  border-bottom" style="width: 170px;">
                                    <img src="{{ asset('admin/images/product/' . $item->attributes->image) }}"
                                        alt="{{ $item->name ?? '' }}" class="img-fluid rounded-3"
                                        style="width: 170px;" />
                                </td>
                                <th scope="row"
                                    class="align-middle d-flex d-lg-table-cell  border-bottom justify-content-between">
                                    <p class="mb-0 d-lg-none" style="font-weight: 500;">Product</p>
                                    <p class="mb-2">{{ $item->name ?? '' }}</p>
                                </th>
                                <td
                                    class="align-middle text-center d-flex d-lg-table-cell  border-bottom justify-content-between">
                                    <p class="mb-0 d-lg-none justify-content-between" style="font-weight: 500;">
                                        Price</p>
                                    <p class="mb-0" style="font-weight: 500;">R.s.
                                        {{ number_format($item->price ?? 0) }}</p>
                                </td>
                                <td
                                    class="align-middle text-center d-flex d-lg-table-cell  border-bottom justify-content-between">
                                    <p class="mb-0 d-lg-none" style="font-weight: 500;">Quantity</p>

                                    <div class="d-flex flex-row justify-content-center">
                                        <button class="btn btn-link px-2 btn-decrease"
                                            itemquantity="{{ $item->id }}">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form1" min="0" name="quantity"
                                            value="{{ $item->quantity ?? 0 }}" type="number"
                                            class="form-control form-control-sm text-center" readonly
                                            style="width: 50px;" />

                                        <button class="btn btn-link px-2 btn-increase"
                                            itemquantity="{{ $item->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td
                                    class="align-middle text-center d-flex d-lg-table-cell  border-bottom justify-content-between">
                                    <p class="mb-0 d-lg-none" style="font-weight: 500;">Total</p>
                                    <p class="mb-0" style="font-weight: 500;">R.s.
                                        {{ number_format($item->price * $item->quantity) }}</p>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="d-block d-lg-table-row">
                            <td class="border-bottom-0"></td>
                            <td class="border-bottom-0"></td>
                            <th scope="row" class="border-bottom-0"></th>
                            <td class="align-middle border-bottom-0"> </td>
                            <td class="align-middle border-bottom-0 text-center">
                                <p class="mb-2" style="font-weight: 500;">Subtotal</p>
                                <p class="mb-2" style="font-weight: 500;">Shipping</p>
                                <p class="mb-2" style="font-weight: 500;">Total (tax included)</p>
                            </td>
                            <td class="align-middle border-bottom-0 text-center">
                                <p class="mb-2" style="font-weight: 500;">R.s {{ number_format(Cart::getTotal()) }}
                                </p>
                                <p class="mb-2" style="font-weight: 500;">R.s
                                    {{ number_format(getShippingCharge()) }}</p>
                                <p class="mb-2" style="font-weight: 500;">R.s
                                    {{ number_format(getTotalAmount(), 2) }}
                                </p>
                            </td>
                        </tr>
                        <tr class="d-block d-lg-table-row">
                            <td class="border-bottom-0"></td>
                            <td class="border-bottom-0"></td>
                            <th scope="row" class="border-bottom-0">
                            </th>
                            <td class="align-middle border-bottom-0">
                            </td>
                            <td class="align-middle border-bottom-0 border-top">
                            </td>
                            <td class="align-middle border-bottom-0 border-top text-center">
                                <a href="{{ route('checkout') }}" class="btn btn-primary btn-block btn-md">
                                    PROCEED TO CHECKOUT</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@else
    <div class="container">
        <div class="alert alert-secondary text-center m-3" role="alert">
            There's nothing on your cart.
        </div>
    </div>
@endif
