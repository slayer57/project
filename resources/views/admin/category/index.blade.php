@extends('layouts.admin.master')
@section('title', 'Categories')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            @if ($parentCategory)
                <h5 class="mb-0">Sub-Categories ({{ $parentCategory->name }})</h5>
            @else
                <h5 class="mb-0">Categories</h5>
            @endif

            <small class="text-muted float-end">
                @if ($parent == 0)
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                        Create</a>
                @else
                    <a class="btn btn-primary" href="{{ route('admin.categories.create', ['parent' => $parent]) }}"><i
                            class="fa-solid fa-plus"></i>
                        Create</a>

                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary"><i
                            class="fa-solid fa-arrow-left"></i>
                        Back</a>
                @endif
            </small>

        </div>

        <div class="table-responsive text-nowrap">
            @if ($categories->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Banner</th>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($categories as $key => $category)
                            <tr>
                                <td><strong>{{ $key + $categories->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ asset('admin/images/category/') }}/{{ $category->image ?: 'avatar.png' }}"
                                        data-fancybox="demo" class="fancybox">
                                        <img src="{{ asset('admin/images/category/') }}/{{ $category->image ?: 'avatar.png' }}"
                                            alt="{{ $category->name }}" width="80px">
                                    </a>
                                </td>
                                <td class="">
                                    <a href="{{ asset('admin/images/category/') }}/{{ $category->banner_image ?: 'avatar.png' }}"
                                        data-fancybox="demo" class="fancybox">
                                        <img src="{{ asset('admin/images/category/') }}/{{ $category->banner_image ?: 'avatar.png' }}"
                                            alt="{{ $category->name }}" width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $category->name ?? '-' }}</strong></td>
                                <td>{{ $category->order ?? '-' }}</td>

                                <td><span
                                        class="badge {{ $category->status == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $category->status == 0 ? 'Draft' : 'Published' }}</span>
                                </td>
                                <td><span
                                        class="badge {{ $category->is_featured == 0 ? 'bg-label-danger' : 'bg-label-success' }}">{{ $category->is_featured == 0 ? 'No' : 'Yes' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.index', ['parent' => $category->id]) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-dark"><i
                                            class="fa fa-align-justify"></i> Sub/Category</a>

                                    @if (!$parent)
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                            style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    @else
                                        <a href="{{ route('admin.categories.edit', ['category' => $category->id, 'parent' => $parent]) }}"
                                            style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    @endif

                                    <form class="delete-form"
                                        action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_category mr-2"
                                            id="" title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
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
        $('.delete_category').click(function(e) {
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
