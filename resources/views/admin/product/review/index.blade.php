@extends('layouts.admin.master')
@section('title', 'Product Reviews')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product "{{ $product->name ?? '' }}" Reviews ({{ $reviews->count() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                    Back</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($reviews->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>User</th>
                            <th>Reviews</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($reviews as $key => $review)
                            <tr>
                                <td><strong>{{ $key + $reviews->firstItem() }}</strong></td>
                                <td><strong>{{ $review->user->first_name ?? '' }}
                                        {{ $review->user->last_name ?? '' }}</strong></td>
                                <td style="white-space: break-spaces;">{{ $review->comments ?? '-' }}</td>
                                <td><span
                                        class="badge {{ $review->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $review->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.review.edit', $review->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>

                                    <form class="delete-form" action="{{ route('admin.review.destroy', $review->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_review mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $reviews->links() }}
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
        $('.delete_review').click(function(e) {
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
