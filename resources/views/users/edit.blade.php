@extends('layouts.admin')

@section('title', 'Edit User')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('page-title', 'Edit User')

@section('page-actions')
<a href="{{ route('users.index') }}" class="btn btn-light btn-wave">
    <i class="ri-arrow-left-line me-1"></i> Back to List
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-primary-transparent rounded-circle">
                        <span class="avatar-title fs-12">{{ $user->initials }}</span>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Edit User: {{ $user->full_name }}</h6>
                        <p class="text-muted mb-0 fs-12">Update user information</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST" id="userForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Student ID -->
                    <h6 class="fw-semibold mb-3 text-primary">
                        <i class="ri-id-card-line me-1"></i> Identification
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">
                                Student ID <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-hashtag text-muted"></i>
                                </span>
                                <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" value="{{ old('student_id', $user->student_id) }}" placeholder="e.g., 24-54681" required>
                            </div>
                            @error('student_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                Email Address <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-mail-line text-muted"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="user@example.com" required>
                            </div>
                            @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Personal Information -->
                    <h6 class="fw-semibold mb-3 mt-4 text-primary">
                        <i class="ri-user-line me-1"></i> Personal Information
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="lastname" class="form-label">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" placeholder="Enter last name" required>
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="firstname" class="form-label">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" placeholder="Enter first name" required>
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename" class="form-label">
                                Middle Name
                                <span class="text-muted fs-11">(Optional)</span>
                            </label>
                            <input type="text" class="form-control @error('middlename') is-invalid @enderror" id="middlename" name="middlename" value="{{ old('middlename', $user->middlename) }}" placeholder="Enter middle name">
                            @error('middlename')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Academic Information -->
                    <h6 class="fw-semibold mb-3 mt-4 text-primary">
                        <i class="ri-graduation-cap-line me-1"></i> Academic Information
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="course" class="form-label">
                                Course <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-book-open-line text-muted"></i>
                                </span>
                                <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" value="{{ old('course', $user->course) }}" placeholder="e.g., BSIT, BSCS, BSCE" required>
                            </div>
                            @error('course')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="year_level" class="form-label">
                                Year Level <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-calendar-line text-muted"></i>
                                </span>
                                <select class="form-select @error('year_level') is-invalid @enderror" id="year_level" name="year_level" required>
                                    <option value="">Select Year Level</option>
                                    <option value="1" {{ old('year_level', $user->year_level) == 1 ? 'selected' : '' }}>1st Year</option>
                                    <option value="2" {{ old('year_level', $user->year_level) == 2 ? 'selected' : '' }}>2nd Year</option>
                                    <option value="3" {{ old('year_level', $user->year_level) == 3 ? 'selected' : '' }}>3rd Year</option>
                                    <option value="4" {{ old('year_level', $user->year_level) == 4 ? 'selected' : '' }}>4th Year</option>
                                    <option value="5" {{ old('year_level', $user->year_level) == 5 ? 'selected' : '' }}>5th Year</option>
                                </select>
                            </div>
                            @error('year_level')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <h6 class="fw-semibold mb-3 mt-4 text-primary">
                        <i class="ri-settings-3-line me-1"></i> Account Status
                    </h6>
                    
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }} {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Account is active
                            </label>
                            @if($user->id === auth()->id())
                            <input type="hidden" name="is_active" value="1">
                            @endif
                        </div>
                        @if($user->id === auth()->id())
                        <div class="form-text text-warning">
                            <i class="ri-information-line me-1"></i>
                            You cannot deactivate your own account
                        </div>
                        @else
                        <div class="form-text">
                            <i class="ri-information-line me-1"></i>
                            Inactive users cannot log in to the system
                        </div>
                        @endif
                    </div>
                    
                    <div class="d-flex gap-2 pt-3 mt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i> Update User
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-light btn-wave">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <!-- User Info Card -->
        <div class="card custom-card">
            <div class="card-header">
                <h6 class="card-title mb-0">User Details</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="avatar avatar-xl bg-primary-transparent rounded-circle mx-auto mb-2">
                        <span class="avatar-title fs-18">{{ $user->initials }}</span>
                    </div>
                    <h6 class="mb-1">{{ $user->full_name }}</h6>
                    <span class="badge bg-info-transparent text-info">{{ $user->course }}</span>
                </div>
                
                <ul class="list-unstyled mb-0">
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Student ID:</span>
                        <span><code>{{ $user->student_id }}</code></span>
                    </li>
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Email:</span>
                        <span>{{ $user->email }}</span>
                    </li>
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Year Level:</span>
                        <span class="badge bg-primary">Year {{ $user->year_level }}</span>
                    </li>
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Status:</span>
                        <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}-transparent text-{{ $user->is_active ? 'success' : 'danger' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </li>
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Registered:</span>
                        <span>{{ $user->created_at->format('M d, Y') }}</span>
                    </li>
                    <li class="d-flex justify-content-between py-2">
                        <span class="text-muted">Last Updated:</span>
                        <span>{{ $user->updated_at->format('M d, Y') }}</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="card custom-card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-warning-light" data-bs-toggle="modal" data-bs-target="#passwordModal">
                        <i class="ri-lock-password-line me-1"></i> Change Password
                    </button>
                    
                    @if($user->id !== auth()->id())
                    <form action="{{ route('users.toggle-status', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn {{ $user->is_active ? 'btn-danger-light' : 'btn-success-light' }} w-100">
                            @if($user->is_active)
                            <i class="ri-close-circle-line me-1"></i> Deactivate User
                            @else
                            <i class="ri-checkbox-circle-line me-1"></i> Activate User
                            @endif
                        </button>
                    </form>
                    
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="ri-delete-bin-line me-1"></i> Delete User
                    </button>
                    @else
                    <div class="alert alert-info-transparent mb-0">
                        <i class="ri-information-line me-1"></i>
                        <small>You cannot delete or deactivate your own account</small>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password Change Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
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
                    <p class="text-muted mb-3">Set a new password for <strong>{{ $user->full_name }}</strong></p>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" required>
                        <div class="form-text">Minimum 8 characters</div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" required>
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

@if($user->id !== auth()->id())
<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
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
@endsection

@push('scripts')
<script>
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(el) {
        return new bootstrap.Tooltip(el);
    });
</script>
@endpush
