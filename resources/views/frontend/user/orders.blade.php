@extends('layouts.frontend.master')
@section('seo')
    <title>{{ $settings['contact_seo_title'] ?? 'Leideu' }}</title>
    <meta name="keywords" content="{{ $settings['contact_seo_keywords'] ?? 'Leideu' }}">
    <meta name="description" content="{{ $settings['contact_seo_description'] ?? 'Leideu' }}">
@endsection
@section('content')
    <section class="checkout">
        <div class="container mt-3">
            <div class="row">
                @include('frontend.user.includes.menu')
                <div class="col-md-10 col-sm-12 col-xs-12">
                    <div class="container card card-body shadow-lg p-4">
                        <h3 class="mb-4 sec-title-wrapper">My Orders ({{ $myorders->total() }})</h3>
                        <div class="table-responsive text-nowrap">
                            @if ($myorders->isNotEmpty())
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th scope="col">Order Number</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Order Status</th>
                                            <th scope="col">Pay Status</th>
                                            <th scope="col">Order Time</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($myorders as $key => $order)
                                            <tr>
                                                <td><strong>{{ $key + $myorders->firstItem() }}</strong></td>
                                                <td>{{ $order->order_number }}</td>
                                                <td>{{ $order->user->first_name . ' ' . $order->user->last_name ?? 'Not Registered' }}
                                                </td>
                                                <td>{{ $order->payment_method ?: 'NA' }}</td>
                                                <td>{{ $order->status ?? '' }}</td>
                                                <td><span
                                                        class="bg-primary p-1 text-white">{{ $order->transaction_status ?: 'Not Paid' }}</span>
                                                </td>
                                                <td>{{ date('Y-m-d, h:i A', strtotime($order->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('order.details', $order->id) }}"
                                                        style="float: left;margin-right: 5px;"
                                                        class="btn btn-sm btn-primary"><i class="fa-solid fa fa-eye"></i>
                                                        View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $myorders->links() }}
                            @else
                                <div class="card-body">
                                    <h6>No Data Found!</h6>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection
