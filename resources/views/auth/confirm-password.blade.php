<x-guest-layout>
    @section('title', 'Confirm Password')
    
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
                <div class="avatar avatar-xl bg-warning-transparent rounded-circle mx-auto mb-3">
                    <i class="ri-shield-keyhole-line fs-24 text-warning"></i>
                </div>
                <p class="h4 mb-2 fw-semibold">Confirm Password</p>
                <p class="text-muted mb-0 fs-13">This is a secure area. Please confirm your password before continuing.</p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="row gy-3">
                    <div class="col-xl-12">
                        <label for="password" class="form-label text-default">
                            <i class="ri-lock-line me-1 text-muted"></i>Password
                        </label>
                        <div class="position-relative">
                            <input type="password" class="form-control create-password-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                            <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('password',this)">
                                <i class="ri-eye-off-line align-middle"></i>
                            </a>
                        </div>
                        @error('password')
                        <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="ri-shield-check-line me-2"></i>Confirm
                    </button>
                </div>
            </form>
            
            <!-- Security Notice -->
            <div class="mt-4 pt-3 border-top">
                <p class="text-muted text-center mb-0 fs-12">
                    <i class="ri-information-line me-1 text-info"></i>
                    Your session is secure. This confirmation is for additional security.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
