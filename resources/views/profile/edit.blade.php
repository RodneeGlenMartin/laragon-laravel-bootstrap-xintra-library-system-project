@extends('layouts.admin')

@section('title', 'Profile Settings')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
@endsection

@section('page-title', 'Profile Settings')

@section('content')
<div class="row">
    <div class="col-xl-4">
        <!-- Profile Card -->
        <div class="card custom-card">
            <div class="card-body text-center">
                <div class="avatar avatar-xxl bg-primary-transparent rounded-circle mx-auto mb-3">
                    <span class="avatar-title fs-24">{{ $user->initials }}</span>
                </div>
                <h5 class="mb-1">{{ $user->full_name }}</h5>
                <p class="text-muted mb-3">
                    <code>{{ $user->student_id }}</code>
                </p>
                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-info-transparent text-info">{{ $user->course }}</span>
                    <span class="badge bg-primary">Year {{ $user->year_level }}</span>
                </div>
                <p class="text-muted fs-13 mb-0">
                    <i class="ri-mail-line me-1"></i>{{ $user->email }}
                </p>
            </div>
            <div class="card-footer">
                <ul class="list-unstyled mb-0">
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Status:</span>
                        <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}-transparent text-{{ $user->is_active ? 'success' : 'danger' }}">
                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </li>
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Member Since:</span>
                        <span>{{ $user->created_at->format('M d, Y') }}</span>
                    </li>
                    <li class="d-flex justify-content-between py-2">
                        <span class="text-muted">Last Updated:</span>
                        <span>{{ $user->updated_at->diffForHumans() }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <!-- Update Profile Form -->
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-primary-transparent rounded-circle">
                        <i class="ri-user-settings-line text-primary"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Profile Information</h6>
                        <p class="text-muted mb-0 fs-12">Update your account's profile information</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="ri-checkbox-circle-line me-2"></i>Profile updated successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

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
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="lastname" class="form-label">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="firstname" class="form-label">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename" class="form-label">
                                Middle Name
                            </label>
                            <input type="text" class="form-control @error('middlename') is-invalid @enderror" id="middlename" name="middlename" value="{{ old('middlename', $user->middlename) }}">
                            @error('middlename')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="course" class="form-label">
                                Course <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-book-open-line text-muted"></i>
                                </span>
                                <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" value="{{ old('course', $user->course) }}" required>
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

                    <div class="d-flex justify-content-end pt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
                </div>
            </div>

        <!-- Update Password Form -->
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-warning-transparent rounded-circle">
                        <i class="ri-lock-password-line text-warning"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Update Password</h6>
                        <p class="text-muted mb-0 fs-12">Ensure your account is using a secure password</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    @if (session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="ri-checkbox-circle-line me-2"></i>Password updated successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="current_password" class="form-label">
                                Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-lock-line text-muted"></i>
                                </span>
                                <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="current_password" name="current_password" autocomplete="current-password">
                            </div>
                            @error('current_password', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-lock-password-line text-muted"></i>
                                </span>
                                <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="password" name="password" autocomplete="new-password">
                            </div>
                            <div class="form-text">Minimum 8 characters</div>
                            @error('password', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">
                                Confirm New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-lock-check-line text-muted"></i>
                                </span>
                                <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                            </div>
                            @error('password_confirmation', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end pt-3 border-top">
                        <button type="submit" class="btn btn-warning btn-wave">
                            <i class="ri-lock-password-line me-1"></i> Update Password
                        </button>
                    </div>
                </form>
                </div>
            </div>

        <!-- Delete Account -->
        <div class="card custom-card border-danger">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-danger-transparent rounded-circle">
                        <i class="ri-error-warning-line text-danger"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0 text-danger">Delete Account</h6>
                        <p class="text-muted mb-0 fs-12">Permanently delete your account</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-danger-transparent border-0 mb-4">
                    <div class="d-flex align-items-start gap-2">
                        <i class="ri-error-warning-line fs-20 text-danger mt-1"></i>
                        <div>
                            <strong>Warning:</strong> Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="ri-delete-bin-line me-1"></i> Delete Account
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center p-4">
                    <div class="avatar avatar-xl bg-danger-transparent rounded-circle mb-3 mx-auto">
                        <i class="ri-error-warning-line text-danger fs-28"></i>
                    </div>
                    <h5 class="mb-2">Are you sure?</h5>
                    <p class="text-muted mb-4">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.</p>
                    
                    <div class="mb-3 text-start">
                        <label for="delete_password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="delete_password" name="password" placeholder="Enter your password to confirm">
                        @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="ri-delete-bin-line me-1"></i>Delete Account
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
