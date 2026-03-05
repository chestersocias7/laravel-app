@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Role Management</h1>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('admin.roles.update', $user->id) }}" method="POST" class="d-flex align-items-center">
                        @csrf
                        @method('PATCH')
                        <select name="role" class="form-select form-select-sm me-2">
                            <option value="employee" @if($user->role == 'employee') selected @endif>Employee</option>
                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </td>
                <td>
                    @if($user->is_approved)
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        @if(!$user->is_approved)
                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="me-2">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                        @endif
                        @if(auth()->id() !== $user->id)
                            <form action="{{ route('admin.roles.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
