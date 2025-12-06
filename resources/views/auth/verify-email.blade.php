<x-guest-layout>
    @section('title', 'Verify Email')
    
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
                <div class="avatar avatar-xl bg-info-transparent rounded-circle mx-auto mb-3">
                    <i class="ri-mail-check-line fs-24 text-info"></i>
                </div>
                <p class="h4 mb-2 fw-semibold">Verify Your Email</p>
                <p class="text-muted mb-0 fs-13">Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.</p>
            </div>

            @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success-transparent border-success mb-4" role="alert">
                <div class="d-flex align-items-center gap-2">
                    <i class="ri-checkbox-circle-line fs-20 text-success"></i>
                    <span>A new verification link has been sent to your email address.</span>
                </div>
            </div>
            @endif

            <div class="alert alert-light border-0 mb-4">
                <div class="d-flex align-items-start gap-2">
                    <i class="ri-information-line fs-18 text-primary mt-1"></i>
                    <div class="fs-13 text-muted">
                        <strong class="d-block mb-1">Didn't receive the email?</strong>
                        <ul class="mb-0 ps-3">
                            <li>Check your spam or junk folder</li>
                            <li>Make sure you entered the correct email</li>
                            <li>Click below to resend the verification email</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="ri-mail-send-line me-2"></i>Resend Verification Email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-light btn-lg w-100">
                        <i class="ri-logout-box-r-line me-2"></i>Sign Out
                    </button>
                </form>
            </div>
            
            <!-- Help Section -->
            <div class="mt-4 pt-3 border-top">
                <p class="text-muted text-center mb-0 fs-12">
                    <i class="ri-information-line me-1 text-info"></i>
                    The verification link will expire in 60 minutes
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
