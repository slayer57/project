@extends('layouts.admin.master')
@section('title', 'Users')

@section('content')
    @include('admin.includes.message')
    <div class="card">

        <div class="row mt-3 mb-0 m-2">
            <div class="col-md-8">
                <form class="d-flex" method="GET" action="">
                    <div class="col-md-6">
                        <div class="input-group gap-2">
                            <input type="text" class="form-control" name="search" value="{{ request('search') ?? '' }}"
                                placeholder="Search ...">
                            <button type="submit" class="input-group-text"><i class="tf-icons bx bx-search"> Search</i>
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="input-group-text"> Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users ({{ $users->total() }})</h5>
        </div>

        <div class="table-responsive text-nowrap">
            @if ($users->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Type</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $key => $user)
                            <tr>
                                <td><strong>{{ $key + $users->firstItem() }}</strong></td>
                                <td><strong>{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</strong></td>
                                <td>{{ $user->email ?? '' }}</td>
                                <td>{{ $user->user_type ?? '' }}</td>
                                <td>{{ $user->updated_at->diffForHumans() }}</td>
                                <td>
                                    <form class="delete-form" action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete_user mr-2" id=""
                                            title="Delete" data-type="confirm"><i class="fa fa-trash"></i>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->appends($searchParams)->links() }}
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
        $('.delete_user').click(function(e) {
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
