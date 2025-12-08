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
                    <!-- Student ID -->
                    <div class="col-md-6">
                        <label for="student_id" class="form-label text-default">
                            <i class="ri-hashtag me-1 text-muted"></i>Student ID <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" value="{{ old('student_id') }}" placeholder="e.g., 24-54681" required autofocus>
                        @error('student_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label text-default">
                            <i class="ri-mail-line me-1 text-muted"></i>Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required autocomplete="username">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Last Name -->
                    <div class="col-md-4">
                        <label for="lastname" class="form-label text-default">
                            Last Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Last name" required>
                        @error('lastname')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- First Name -->
                    <div class="col-md-4">
                        <label for="firstname" class="form-label text-default">
                            First Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="First name" required>
                        @error('firstname')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Middle Name -->
                    <div class="col-md-4">
                        <label for="middlename" class="form-label text-default">
                            Middle Name
                        </label>
                        <input type="text" class="form-control @error('middlename') is-invalid @enderror" id="middlename" name="middlename" value="{{ old('middlename') }}" placeholder="Middle name">
                        @error('middlename')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Course -->
                    <div class="col-md-6">
                        <label for="course" class="form-label text-default">
                            <i class="ri-book-open-line me-1 text-muted"></i>Course <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" value="{{ old('course') }}" placeholder="e.g., BSIT, BSCS" required>
                        @error('course')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
        </div>

                    <!-- Year Level -->
                    <div class="col-md-6">
                        <label for="year_level" class="form-label text-default">
                            <i class="ri-calendar-line me-1 text-muted"></i>Year Level <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('year_level') is-invalid @enderror" id="year_level" name="year_level" required>
                            <option value="">Select Year</option>
                            <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                            <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                            <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                            <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
                            <option value="5" {{ old('year_level') == '5' ? 'selected' : '' }}>5th Year</option>
                        </select>
                        @error('year_level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
        </div>

        <!-- Password -->
                    <div class="col-md-6">
                        <label for="password" class="form-label text-default">
                            <i class="ri-lock-line me-1 text-muted"></i>Password <span class="text-danger">*</span>
                        </label>
                        <div class="position-relative">
                            <input type="password" class="form-control create-password-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Min 8 characters" required autocomplete="new-password">
                            <a href="javascript:void(0);" class="show-password-button text-muted" onclick="createpassword('password',this)"><i class="ri-eye-off-line align-middle"></i></a>
                        </div>
                        @error('password')
                        <div class="text-danger fs-12 mt-1">{{ $message }}</div>
                        @enderror
        </div>

        <!-- Confirm Password -->
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label text-default">
                            <i class="ri-lock-check-line me-1 text-muted"></i>Confirm Password <span class="text-danger">*</span>
                        </label>
                        <div class="position-relative">
                            <input type="password" class="form-control create-password-input @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
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
