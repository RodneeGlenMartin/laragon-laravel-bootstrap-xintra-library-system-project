<x-guest-layout>
    @section('title', 'Reset Password')
    
    <div class="card custom-card auth-card my-auto">
        <div class="card-body">
            <!-- Logo for Mobile -->
            <div class="text-center mb-4 d-xl-none">
                <a href="{{ url('/') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                        <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
                    </svg>
                    <span class="fs-5 fw-semibold text-dark">Library System</span>
                </a>
            </div>
            
            <!-- Icon -->
            <div class="text-center mb-4">
                <div class="avatar avatar-xl bg-success-transparent rounded-circle mx-auto mb-3">
                    <i class="ri-key-2-line fs-24 text-success"></i>
                </div>
                <p class="h4 mb-2 fw-semibold">Set New Password</p>
                <p class="text-muted mb-0">Create a strong password for your account</p>
            </div>
            
            <!-- Step Indicator -->
            <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success rounded-pill"><i class="ri-check-line"></i></span>
                    <span class="text-success fs-13">Email Sent</span>
                </div>
                <i class="ri-arrow-right-s-line text-muted"></i>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success rounded-pill"><i class="ri-check-line"></i></span>
                    <span class="text-success fs-13">Verified</span>
                </div>
                <i class="ri-arrow-right-s-line text-muted"></i>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary rounded-pill">3</span>
                    <span class="text-primary fw-medium fs-13">Reset</span>
                </div>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="row gy-3">
                    <div class="col-xl-12">
                        <label for="email" class="form-label text-default">
                            <i class="ri-mail-line me-1 text-muted"></i>Email Address
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $request->email) }}" placeholder="Enter your email" required autofocus autocomplete="username" readonly style="background-color: #f8f9fa;">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12">
                        <label for="password" class="form-label text-default">
                            <i class="ri-lock-line me-1 text-muted"></i>New Password <span class="text-danger">*</span>
                        </label>
                        <div class="position-relative">
                            <input type="password" class="form-control create-password-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password" required autocomplete="new-password">
                            <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('password',this)"><i class="ri-eye-off-line align-middle"></i></a>
                        </div>
                        <!-- Password Strength Indicator -->
                        <div class="password-strength">
                            <div class="password-strength-bar" id="password-strength-bar"></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <span class="password-strength-text" id="password-strength-text"></span>
                            <span class="fs-11 text-muted">Min 8 characters</span>
                        </div>
                        @error('password')
                        <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12">
                        <label for="password_confirmation" class="form-label text-default">
                            <i class="ri-lock-check-line me-1 text-muted"></i>Confirm New Password <span class="text-danger">*</span>
                        </label>
                        <div class="position-relative">
                            <input type="password" class="form-control create-password-input @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" required autocomplete="new-password">
                            <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('password_confirmation',this)"><i class="ri-eye-off-line align-middle"></i></a>
                        </div>
                        @error('password_confirmation')
                        <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <!-- Password Requirements -->
                <div class="alert alert-light border-0 mt-3 mb-0">
                    <p class="fw-medium mb-2 fs-13">Password Requirements:</p>
                    <ul class="mb-0 ps-3 fs-12 text-muted">
                        <li>At least 8 characters long</li>
                        <li>Contains uppercase and lowercase letters</li>
                        <li>Contains at least one number</li>
                        <li>Contains at least one special character</li>
                    </ul>
                </div>
                
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ri-lock-password-line me-2"></i>Reset Password
                    </button>
                </div>
            </form>
            
            <!-- Security Notice -->
            <div class="mt-4 pt-3 border-top">
                <p class="text-muted text-center mb-0 fs-12">
                    <i class="ri-shield-check-line me-1 text-success"></i>
                    After resetting, you'll be redirected to sign in with your new password
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
