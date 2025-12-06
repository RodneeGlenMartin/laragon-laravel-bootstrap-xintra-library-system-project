<x-guest-layout>
    @section('title', 'Sign In')
    
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
            
            <p class="h4 mb-2 text-center fw-semibold">Welcome Back!</p>
            <p class="mb-4 text-muted text-center">Sign in to access your library dashboard</p>
            
            <!-- Session Status -->
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="ri-checkbox-circle-line me-2"></i>{{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row gy-3">
                    <div class="col-xl-12">
                        <label for="email" class="form-label text-default">
                            <i class="ri-mail-line me-1 text-muted"></i>Email Address
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autofocus autocomplete="username">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12">
                        <label for="password" class="form-label text-default d-flex justify-content-between align-items-center">
                            <span><i class="ri-lock-line me-1 text-muted"></i>Password</span>
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="fw-normal text-primary fs-12">Forgot password?</a>
                            @endif
                        </label>
                        <div class="position-relative">
                            <input type="password" class="form-control create-password-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                            <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('password',this)" id="button-addon2">
                                <i class="ri-eye-off-line align-middle"></i>
                            </a>
                        </div>
                        @error('password')
                        <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-xl-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label text-muted fw-normal" for="remember_me">
                                Keep me signed in
                                </label>
                        </div>
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ri-login-box-line me-2"></i>Sign In
                    </button>
                </div>
            </form>
            
            <div class="text-center mt-4">
                <p class="text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-medium">Create one</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>
