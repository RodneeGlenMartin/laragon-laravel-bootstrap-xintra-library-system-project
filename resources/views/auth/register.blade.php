<x-guest-layout>
    @section('title', 'Create Account')
    
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
            
            <p class="h4 mb-2 text-center fw-semibold">Create Your Account</p>
            <p class="mb-4 text-muted text-center">Get started with the library management system</p>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row gy-3">
                    <div class="col-xl-12">
                        <label for="name" class="form-label text-default">
                            <i class="ri-user-line me-1 text-muted"></i>Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name" required autofocus autocomplete="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12">
                        <label for="email" class="form-label text-default">
                            <i class="ri-mail-line me-1 text-muted"></i>Email Address <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="username">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12">
                        <label for="password" class="form-label text-default">
                            <i class="ri-lock-line me-1 text-muted"></i>Password <span class="text-danger">*</span>
                        </label>
                        <div class="position-relative">
                            <input type="password" class="form-control create-password-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Create a strong password" required autocomplete="new-password">
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
                            <i class="ri-lock-check-line me-1 text-muted"></i>Confirm Password <span class="text-danger">*</span>
                        </label>
                        <div class="position-relative">
                            <input type="password" class="form-control create-password-input @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                            <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('password_confirmation',this)"><i class="ri-eye-off-line align-middle"></i></a>
                        </div>
                        @error('password_confirmation')
                        <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ri-user-add-line me-2"></i>Create Account
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <p class="text-muted mb-0">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-medium">Sign in</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>
