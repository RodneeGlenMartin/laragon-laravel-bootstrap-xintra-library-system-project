<x-guest-layout>
    @section('title', 'Forgot Password')
    
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
                <div class="avatar avatar-xl bg-primary-transparent rounded-circle mx-auto mb-3">
                    <i class="ri-lock-unlock-line fs-24 text-primary"></i>
                </div>
                <p class="h4 mb-2 fw-semibold">Forgot Password?</p>
                <p class="text-muted mb-0 fs-13">Enter your email address to receive password reset instructions.</p>
            </div>
            
            <!-- Development Environment Notice -->
            @if(config('mail.default') === 'log')
            <div class="alert alert-info-transparent border-info mb-4" role="alert">
                <div class="d-flex align-items-start gap-2">
                    <i class="ri-information-line fs-20 text-info flex-shrink-0 mt-1"></i>
                    <div>
                        <strong class="d-block mb-1">Development Mode</strong>
                        <span class="fs-12">Email is configured to log mode. Reset links are saved in <code>storage/logs/laravel.log</code> instead of being sent via email.</span>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Session Status - Success Message -->
            @if (session('status'))
            <div class="alert alert-success-transparent border-success mb-4" role="alert">
                <div class="d-flex align-items-start gap-2">
                    <i class="ri-checkbox-circle-line fs-20 text-success flex-shrink-0 mt-1"></i>
                    <div>
                        <strong class="d-block mb-1">Reset Link Sent!</strong>
                        <span class="fs-12">{{ session('status') }}</span>
                        @if(config('mail.default') === 'log')
                        <div class="mt-2 pt-2 border-top border-success-transparent">
                            <span class="fs-12"><i class="ri-lightbulb-line me-1"></i>Check <code>storage/logs/laravel.log</code> for the reset link.</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row gy-3">
                    <div class="col-xl-12">
                        <label for="email" class="form-label text-default">
                            <i class="ri-mail-line me-1 text-muted"></i>Email Address
                        </label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your registered email" required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ri-mail-send-line me-2"></i>Request Password Reset
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-muted">
                    <i class="ri-arrow-left-line me-1"></i>Back to Sign In
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
