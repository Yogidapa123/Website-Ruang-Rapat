<style>
    /* Custom Table Styles */
    body {
        background-image: url('/assets/images/bg.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    .custom-table thead {
        background-color: #c52121;
        color: white;
    }

    .custom-table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .custom-table th, .custom-table td {
        text-align: center;
        padding: 12px;
    }

    .custom-table .btn-custom {
        background-color: #c52121;
        color: white;
        border: none;
    }

    /* Custom Button Styles */
    .btn-custom {
        background-color: #c52121 !important;
        border: none;
        color: white !important;
    }

    .btn-custom:hover {
        background-color: #a71a1a;
    }

    /* Custom Alert Styles */
    .alert-custom {
        background-color: #c52121;
        color: white;
    }
</style>

@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
        <div class="card-body text-end">
            @if (session()->has('userSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show alert-custom"
                    style="margin-top: 50px;" role="alert">
                    {{ session('userSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('deleteUser'))
                <div class="col-md-16 mx-auto alert alert-danger text-center alert-dismissible fade show alert-custom"
                    style="margin-top: 50px;" role="alert">
                    {{ session('deleteUser') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (auth()->user()->role_id === 1)
                <button type="button" class="mb-3 btn btn-custom" data-bs-toggle="modal" data-bs-target="#addUser">
                    Tambah Bidang
                </button>
            @endif
            <div class="table-responsive">
                <div class="d-flex justify-content-start">
                    {{ $users->links() }}
                </div>

                <table class="table custom-table table-hover table-bordered text-center" id="datatable">
                    <thead>
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Username</th>
                            <th scope="row">Email</th>
                            <th scope="row">Role</th>
                            <th scope="row">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($users->count() > 0)
                            @foreach ($users as $user)
                                <tr style="background-color: #ffffff;">
                                    <th scope="row">{{ $loop->iteration }} </th>
                                    <td>{{ $user->name }} </td>
                                    <td>{{ $user->email }} </td>
                                    <td>{{ $user->role->name }} </td>
                                    @if (auth()->user()->role_id === 1)
                                        <td style="font-size: 22px;">
                                            <a href="/dashboard/users/{{ $user->id }}/edit" class="edituser"
                                                id="edituser" data-id="{{ $user->id }}" data-bs-toggle="modal"
                                                data-bs-target="#edituser" style="color: #c52121;">
                                                <i class="bi bi-pencil-square"></i></a>&nbsp;
                                            <a href="/dashboard/users/{{ $user->id }}/makeAdmin" class="makeadmin"
                                                id="makeadmin" style="color: #c52121;">
                                                <i class="bi bi-person-plus-fill"></i></a>&nbsp;
                                            <form action="/dashboard/users/{{ $user->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="bi bi-trash-fill text-danger border-0"
                                                    style="background-color: transparent;" onclick="return confirm('Hapus data Bidang?')"></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    -- Belum Ada Peminjaman --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @extends('dashboard.partials.addUserModal')
    @extends('dashboard.partials.editUserModal')
@endsection