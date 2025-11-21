@extends('layouts.admin.master')
@section('title', 'Pages')

@section('content')
    @include('admin.includes.message')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pages ({{ $pages->total() }})</h5>
            <small class="text-muted float-end">
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>
                    Create</a>
            </small>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($pages->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($pages as $key => $page)
                            <tr>
                                <td><strong>{{ $key + $pages->firstItem() }}</strong></td>
                                <td class="">
                                    <a href="{{ asset('admin/images/page') }}/{{ $page->image ?: 'avatar.png' }}"
                                        data-fancybox="demo" class="fancybox">
                                        <img src="{{ asset('admin/images/page') }}/{{ $page->image ?: 'avatar.png' }}"
                                            alt="{{ $page->title }}" width="80px">
                                    </a>
                                </td>
                                <td><strong>{{ $page->title ?? '' }}</strong></td>
                                <td>{{ $page->link ?? '-' }}</td>

                                <td>{{ $page->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('admin.pages.edit', $page->id) }}"
                                        style="float: left;margin-right: 5px;" class="btn btn-sm btn-primary"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>

                                    @if ($page->id > 5)
                                        <form class="delete-form" action="{{ route('admin.pages.destroy', $page->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete_page mr-2"
                                                id="" title="Delete" data-type="confirm"><i
                                                    class="fa fa-trash"></i>
                                                Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pages->links() }}
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
        $('.delete_page').click(function(e) {
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
