@extends('layouts.admin.master')
@section('title', 'Products')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="row mt-3 mb-0 m-2">
            <div class="col-md-8">
                <form class="d-flex" method="GET" action="">
                    <div class="col-md-6">
                        <div class="input-group gap-2">
                            <input type="text" class="form-control search-input" name="search"
                                value="{{ request('search') ?? '' }}" placeholder="Search by product..." autocomplete="off">
                            <button type="submit" class="input-group-text"><i class="tf-icons bx bx-search"></i>
                                Search</button>
                            <a href="{{ route('admin.products.index') }}" class="input-group-text"> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Products</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($products->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Discount (%)</th>
                            <th>Price (R.s.)</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $key => $product)
                            <tr>
                                <td><strong>{{ $key + $products->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ asset('admin/images/product/') }}/{{ $product->featured_image ?: 'avatar.png' }}"
                                        data-fancybox="demo" class="fancybox">
                                        <img src="{{ asset('admin/images/product/') }}/{{ $product->featured_image ?: 'avatar.png' }}"
                                            alt="{{ $product->name }}" width="80px">
                                    </a>
                                </td>

                                <td><strong>{{ $product->name ?? '' }}</strong></td>
                                <td><strong>{{ $product->discount ?? '-' }}</strong></td>
                                <td>{{ $product->price ?? '-' }}</td>
                                <td><span
                                        class="badge {{ $product->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $product->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.product.review', $product->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa fa-commenting"></i> Review</a>

                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>


                                    <form class="delete-form" action="{{ route('admin.products.destroy', $product->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_product mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->appends($searchParams)->links() }}
            @else
                <div class="card-body">
                    <h6>No Data Found!</h6>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('.delete_product').click(function(e) {
            e.preventDefault();
            swal({
                    title: `Are you sure?`,
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $(this).closest("form").submit();
                    }
                });
        });
    </script>
@endsection
