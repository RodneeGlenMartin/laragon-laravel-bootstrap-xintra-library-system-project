@extends('layouts.admin')

@section('title', 'Profile Settings')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
@endsection

@section('page-title', 'Profile Settings')

@section('page-actions')
<a href="{{ route('dashboard') }}" class="btn btn-light btn-wave">
    <i class="ri-arrow-left-line me-1"></i> Back to Dashboard
</a>
@endsection

@section('content')
<div class="row">
    <!-- Profile Overview -->
    <div class="col-xl-4">
        <div class="card custom-card">
            <div class="card-body text-center py-5">
                <!-- Avatar -->
                <div class="position-relative d-inline-block mb-3">
                    <div class="avatar avatar-xxl bg-primary-transparent rounded-circle">
                        <span class="avatar-title fs-28">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                    </div>
                </div>
                
                <h5 class="mb-1 fw-semibold">{{ $user->name }}</h5>
                <p class="text-muted mb-3">{{ $user->email }}</p>
                
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge bg-primary-transparent text-primary rounded-pill px-3 py-2">
                        <i class="ri-shield-user-line me-1"></i> Administrator
                    </span>
                </div>
                
                <hr class="my-4">
                
                <div class="text-start">
                    <h6 class="fw-semibold mb-3">Account Information</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Member Since</span>
                            <span class="fw-medium">{{ $user->created_at->format('M d, Y') }}</span>
                        </li>
                        <li class="d-flex justify-content-between py-2">
                            <span class="text-muted">Last Updated</span>
                            <span class="fw-medium">{{ $user->updated_at->format('M d, Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Help Card -->
        <div class="card custom-card bg-primary-transparent border-0">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3">
                    <div class="avatar avatar-md bg-primary rounded-circle flex-shrink-0">
                        <i class="ri-lightbulb-line text-white"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold mb-1">Security Tip</h6>
                        <p class="text-muted fs-13 mb-0">Use a strong password with a mix of letters, numbers, and special characters to keep your account secure.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Profile Settings -->
    <div class="col-xl-8">
        <!-- Profile Information -->
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-primary-transparent rounded-circle">
                        <i class="ri-user-line text-primary"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Profile Information</h6>
                        <p class="text-muted mb-0 fs-12">Update your account's profile information and email address</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>

                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                Full Name <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-user-line text-muted"></i>
                                </span>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                            </div>
                        @error('name')
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
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="alert alert-warning-transparent mt-2 py-2 px-3 fs-13">
                                <i class="ri-error-warning-line me-1"></i>
                                Your email address is unverified.
                                <button form="send-verification" class="btn btn-link p-0 fs-13 text-warning">
                                    Resend verification email
                                </button>
                            </div>

                            @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success-transparent mt-2 py-2 px-3 fs-13">
                                <i class="ri-checkbox-circle-line me-1"></i>
                                A new verification link has been sent.
                            </div>
                            @endif
                            @endif
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mt-2">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i>Save Changes
                        </button>
                        @if (session('status') === 'profile-updated')
                        <span class="text-success fs-13">
                            <i class="ri-checkbox-circle-line me-1"></i>Profile updated successfully!
                        </span>
                        @endif
                    </div>
                </form>
        </div>
    </div>

        <!-- Update Password -->
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-warning-transparent rounded-circle">
                        <i class="ri-lock-line text-warning"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Update Password</h6>
                        <p class="text-muted mb-0 fs-12">Ensure your account is using a strong password to stay secure</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="update_password_current_password" class="form-label">
                                Current Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-lock-line text-muted"></i>
                                </span>
                        <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="update_password_current_password" name="current_password" autocomplete="current-password">
                            </div>
                        @error('current_password', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="col-md-6 mb-3">
                            <label for="update_password_password" class="form-label">
                                New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-lock-password-line text-muted"></i>
                                </span>
                        <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="update_password_password" name="password" autocomplete="new-password">
                            </div>
                            <div class="form-text fs-12">
                                <i class="ri-information-line me-1"></i>
                                Minimum 8 characters with mixed case and numbers
                            </div>
                        @error('password', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="col-md-6 mb-3">
                            <label for="update_password_password_confirmation" class="form-label">
                                Confirm New Password <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-lock-check-line text-muted"></i>
                                </span>
                        <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                            </div>
                        @error('password_confirmation', 'updatePassword')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 mt-2">
                        <button type="submit" class="btn btn-warning btn-wave">
                            <i class="ri-key-line me-1"></i>Update Password
                        </button>
                    @if (session('status') === 'password-updated')
                        <span class="text-success fs-13">
                            <i class="ri-checkbox-circle-line me-1"></i>Password updated successfully!
                        </span>
                    @endif
                    </div>
                </form>
    </div>
</div>

        <!-- Delete Account -->
        <div class="card custom-card border-danger">
            <div class="card-header bg-danger-transparent">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-danger rounded-circle">
                        <i class="ri-error-warning-line text-white"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0 text-danger">Danger Zone</h6>
                        <p class="text-muted mb-0 fs-12">Irreversible and destructive actions</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start gap-3">
                    <div class="flex-grow-1">
                        <h6 class="fw-semibold mb-1">Delete Account</h6>
                        <p class="text-muted mb-0 fs-13">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                    </div>
                    <button type="button" class="btn btn-danger btn-wave flex-shrink-0" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        <i class="ri-delete-bin-line me-1"></i>Delete Account
                </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="modal-body text-center p-4">
                    <div class="avatar avatar-xxl bg-danger-transparent rounded-circle mb-3 mx-auto">
                        <i class="ri-error-warning-line text-danger fs-40"></i>
                </div>
                    <h4 class="mb-2">Delete Your Account?</h4>
                    <p class="text-muted mb-4">
                        This action is <strong>permanent</strong> and cannot be undone. All your data, including library records and settings, will be permanently deleted.
                    </p>
                    
                    <div class="text-start mb-4">
                        <label for="delete_password" class="form-label">
                            <i class="ri-lock-line me-1"></i>
                            Enter your password to confirm
                        </label>
                        <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="delete_password" name="password" placeholder="Enter your password" required>
                        @error('password', 'userDeletion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="alert alert-danger-transparent border-0 text-start mb-4">
                        <div class="d-flex gap-2">
                            <i class="ri-information-line fs-16"></i>
                            <div class="fs-13">
                                <strong>What will be deleted:</strong>
                                <ul class="mb-0 mt-1 ps-3">
                                    <li>Your profile and account settings</li>
                                    <li>All associated data and records</li>
                                    <li>Access to the library system</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-light btn-lg" data-bs-dismiss="modal">
                            <i class="ri-close-line me-1"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-danger btn-lg">
                            <i class="ri-delete-bin-line me-1"></i>Yes, Delete My Account
                        </button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
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
