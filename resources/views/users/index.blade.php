@extends('layouts.admin')

@section('title', 'Users')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

@section('page-title', 'User Management')

@section('page-actions')
<a href="{{ route('users.create') }}" class="btn btn-primary btn-wave">
    <i class="ri-add-line me-1"></i> Add User
</a>
@endsection

@section('content')
<!-- Summary Cards -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-primary border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Total Users</p>
                        <h4 class="fw-bold mb-0">{{ $users->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-primary-transparent rounded-circle">
                        <i class="ri-user-line text-primary fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-success border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Active Users</p>
                        <h4 class="fw-bold mb-0">{{ $users->where('is_active', true)->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-success-transparent rounded-circle">
                        <i class="ri-checkbox-circle-line text-success fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-danger border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Inactive Users</p>
                        <h4 class="fw-bold mb-0">{{ $users->where('is_active', false)->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-danger-transparent rounded-circle">
                        <i class="ri-close-circle-line text-danger fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-info border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Courses</p>
                        <h4 class="fw-bold mb-0">{{ $users->pluck('course')->unique()->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-info-transparent rounded-circle">
                        <i class="ri-graduation-cap-line text-info fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h6 class="card-title mb-0">All Users</h6>
                    <p class="text-muted mb-0 fs-12">Manage system users</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="ri-filter-line me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterUsers('all')">All Users</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterUsers('active')">Active Only</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterUsers('inactive')">Inactive Only</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($users->count() > 0)
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-hover text-nowrap w-100">
                        <thead>
                            <tr>
                                <th class="fw-semibold">Name</th>
                                <th class="fw-semibold">Student ID</th>
                                <th class="fw-semibold">Email</th>
                                <th class="fw-semibold">Course</th>
                                <th class="fw-semibold">Year Level</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr data-status="{{ $user->is_active ? 'active' : 'inactive' }}">
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-md bg-primary-transparent rounded-circle">
                                            <span class="avatar-title fs-12">{{ $user->initials }}</span>
                                        </div>
                                        <div>
                                            <span class="fw-medium d-block">{{ $user->full_name }}</span>
                                            @if($user->id === auth()->id())
                                            <span class="badge bg-warning-transparent text-warning fs-10">You</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded fs-12">{{ $user->student_id }}</code>
                                </td>
                                <td>
                                    <a href="mailto:{{ $user->email }}" class="text-muted">{{ $user->email }}</a>
                                </td>
                                <td>
                                    <span class="badge bg-info-transparent text-info rounded-pill">
                                        {{ $user->course }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">
                                        Year {{ $user->year_level }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->is_active)
                                    <span class="badge bg-success-transparent text-success rounded-pill">
                                        <i class="ri-checkbox-circle-line me-1"></i>Active
                                    </span>
                                    @else
                                    <span class="badge bg-danger-transparent text-danger rounded-pill">
                                        <i class="ri-close-circle-line me-1"></i>Inactive
                                    </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group action-btns">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-icon btn-primary-light" data-bs-toggle="tooltip" title="Edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-icon btn-warning-light" data-bs-toggle="modal" data-bs-target="#passwordModal{{ $user->id }}" title="Change Password">
                                            <i class="ri-lock-password-line"></i>
                                        </button>
                                        @if($user->id !== auth()->id())
                                        <button type="button" class="btn btn-sm btn-icon btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" title="Delete">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Password Change Modals -->
                @foreach($users as $user)
                <div class="modal fade" id="passwordModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="ri-lock-password-line me-2 text-warning"></i>Change Password
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('users.update-password', $user) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal-body">
                                    <p class="text-muted mb-3">Change password for <strong>{{ $user->full_name }}</strong></p>
                                    <div class="mb-3">
                                        <label for="password{{ $user->id }}" class="form-label">New Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password{{ $user->id }}" name="password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation{{ $user->id }}" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password_confirmation{{ $user->id }}" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-warning">
                                        <i class="ri-lock-password-line me-1"></i>Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modals - Only for users that are NOT the logged-in user -->
                @if($user->id !== auth()->id())
                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-4">
                                <div class="avatar avatar-xl bg-danger-transparent rounded-circle mb-3 mx-auto">
                                    <i class="ri-delete-bin-line text-danger fs-28"></i>
                                </div>
                                <h5 class="mb-2">Delete User?</h5>
                                <p class="text-muted mb-4">Are you sure you want to delete <strong>{{ $user->full_name }}</strong>? This action cannot be undone.</p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="ri-delete-bin-line me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @else
                <div class="text-center py-5">
                    <div class="avatar avatar-xxl bg-light rounded-circle mb-3 mx-auto">
                        <i class="ri-user-line fs-40 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-2">No Users Yet</h5>
                    <p class="text-muted mb-4">Start by creating your first user account.</p>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        <i class="ri-add-line me-1"></i>Create First User
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#datatable-basic').DataTable({
            responsive: false,
            scrollX: true,
            pageLength: 10,
            language: {
                searchPlaceholder: 'Search users...',
                search: '',
                lengthMenu: '_MENU_ per page',
                info: 'Showing _START_ to _END_ of _TOTAL_ users',
                paginate: {
                    previous: '<i class="ri-arrow-left-s-line"></i>',
                    next: '<i class="ri-arrow-right-s-line"></i>'
                }
            },
            dom: '<"d-flex flex-wrap justify-content-between align-items-center mb-3"<"d-flex align-items-center gap-2"l><"d-flex align-items-center gap-2"f>>rtip',
            columnDefs: [
                { orderable: false, targets: [6] }
            ],
            order: [[0, 'asc']]
        });
        
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el);
        });
    });
    
    function filterUsers(filter) {
        var table = $('#datatable-basic').DataTable();
        if (filter === 'all') {
            table.columns().search('').draw();
        } else if (filter === 'active') {
            table.column(5).search('Active').draw();
        } else if (filter === 'inactive') {
            table.column(5).search('Inactive').draw();
        }
    }
</script>
@endpush
