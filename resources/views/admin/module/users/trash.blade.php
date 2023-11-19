@extends('layouts.admin.index')
@section('title', 'User Manager Page')
@section('content')
    @component('admin.components.global.index')
        @slot('module')
            users
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <table class="table table-hover my-3">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Full Name</th>
                        <th class="d-none d-xl-table-cell">Email</th>
                        <th class="d-none d-xl-table-cell">Role</th>
                        <th class="d-none d-md-table-cell">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($users) > 0 )
                        @foreach ($users as $user)
                            <tr>
                                <td><img src="{{ $user->image }}" width="50px" alt="User Image"></td>
                                <td>{{ $user->name }}</td>
                                <td class="d-none d-xl-table-cell">{{ $user->email }}</td>
                                <td class="d-none d-md-table-cell">
                                    @if($user->role == 0)
                                        <span>Admin</span>
                                    @elseif($user->role == 1)
                                        <span>Admin</span>
                                    @elseif($user->role == 2)
                                        <span>Nhân Viên </span>
                                    @endif
                                </td>
                                <td class="d-none d-md-table-cell">
                                    @if($user->status == 0)
                                        <span class="badge bg-success">Active</span>
                                    @elseif($user->status == 1)
                                        <span class="badge bg-warning">Unactive</span>
                                    @elseif($user->status == 2)
                                        <span class="badge bg-danger">Ban</span>
                                    @endif
                                </td>
                                <td >
                                    @component('admin.components.button.return')
                                        @slot('url')
                                            {{ route('users.restore', $user)}}
                                        @endslot
                                    @endcomponent
                                    <div class="mt-1 mb-1"></div>
                                    @component('admin.components.button.trash')
                                        @slot('url')
                                            {{ route('users.force.delete', $user)}}
                                        @endslot
                                    @endcomponent
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="3">No data !</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <ul class="pagination">
                    {{$users->links()}}
                </ul>
            </div>
        </div>
    </div>
@stop


