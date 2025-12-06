@extends('layouts.admin')

@section('title', 'Create Student')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students</a></li>
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endsection

@section('page-title', 'Register New Student')

@section('page-actions')
<a href="{{ route('students.index') }}" class="btn btn-light btn-wave">
    <i class="ri-arrow-left-line me-1"></i> Back to List
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-info-transparent rounded-circle">
                        <i class="ri-user-add-line text-info"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Student Information</h6>
                        <p class="text-muted mb-0 fs-12">Enter the details for the new student</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('students.store') }}" method="POST" id="studentForm">
                    @csrf
                    
                    <!-- Student ID & Contact -->
                    <h6 class="fw-semibold mb-3 text-info">
                        <i class="ri-id-card-line me-1"></i> Identification
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">
                                Student ID <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Enter the unique student identification number.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-hashtag text-muted"></i>
                                </span>
                                <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" value="{{ old('student_id') }}" placeholder="e.g., 2024-00001" required>
                            </div>
                            <div class="form-text">
                                <i class="ri-information-line me-1"></i>
                                Must be unique for each student
                            </div>
                            @error('student_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                Email Address <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Student's email address for communication.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-mail-line text-muted"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="student@example.com" required>
                            </div>
                            @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Personal Information -->
                    <h6 class="fw-semibold mb-3 mt-4 text-info">
                        <i class="ri-user-line me-1"></i> Personal Information
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="lastname" class="form-label">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Enter last name" required>
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="firstname" class="form-label">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}" placeholder="Enter first name" required>
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename" class="form-label">
                                Middle Name
                                <span class="text-muted fs-11">(Optional)</span>
                            </label>
                            <input type="text" class="form-control @error('middlename') is-invalid @enderror" id="middlename" name="middlename" value="{{ old('middlename') }}" placeholder="Enter middle name">
                            @error('middlename')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Academic Information -->
                    <h6 class="fw-semibold mb-3 mt-4 text-info">
                        <i class="ri-graduation-cap-line me-1"></i> Academic Information
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="course" class="form-label">
                                Course <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Enter the student's course or program.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-book-open-line text-muted"></i>
                                </span>
                                <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" value="{{ old('course') }}" placeholder="e.g., BSIT, BSCS, BSCE" required>
                            </div>
                            <div class="form-text">
                                <i class="ri-information-line me-1"></i>
                                Use standard course abbreviations
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
                                    <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                                    <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                                    <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                                    <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
                                    <option value="5" {{ old('year_level') == '5' ? 'selected' : '' }}>5th Year</option>
                                </select>
                            </div>
                            @error('year_level')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 pt-3 mt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i> Save Student
                        </button>
                        <a href="{{ route('students.index') }}" class="btn btn-light btn-wave">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <!-- Help Card -->
        <div class="card custom-card bg-info-transparent border-0">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3">
                    <div class="avatar avatar-md bg-info rounded-circle flex-shrink-0">
                        <i class="ri-lightbulb-line text-white"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold mb-2">Tips for Student Records</h6>
                        <ul class="mb-0 ps-3 text-muted fs-13">
                            <li class="mb-1">Verify student ID before saving</li>
                            <li class="mb-1">Use valid email addresses</li>
                            <li class="mb-1">Enter names as they appear on official documents</li>
                            <li>Double-check course and year level</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Required Fields Info -->
        <div class="card custom-card">
            <div class="card-header">
                <h6 class="card-title mb-0">Required Fields</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">Student ID</span>
                    </li>
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">Email Address</span>
                    </li>
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">Last Name</span>
                    </li>
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">First Name</span>
                    </li>
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">Course</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">Year Level</span>
                    </li>
                </ul>
            </div>
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
