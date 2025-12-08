@extends('layouts.admin')

@section('title', 'Edit Student')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('students.index') }}">Students</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('page-title', 'Edit Student')

@section('page-actions')
<a href="{{ route('students.index') }}" class="btn btn-secondary btn-wave">
    <i class="ri-arrow-left-line me-1"></i> Back to List
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Student Information</div>
            </div>
            <div class="card-body">
                <form action="{{ route('students.update', $student) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">Student ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" value="{{ old('student_id', $student->student_id) }}" placeholder="e.g., 24-54681" required>
                            @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $student->email) }}" placeholder="Enter email address" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname', $student->lastname) }}" placeholder="Enter last name" required>
                            @error('lastname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname', $student->firstname) }}" placeholder="Enter first name" required>
                            @error('firstname')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control @error('middlename') is-invalid @enderror" id="middlename" name="middlename" value="{{ old('middlename', $student->middlename) }}" placeholder="Enter middle name">
                            @error('middlename')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" value="{{ old('course', $student->course) }}" placeholder="Enter course (e.g., BSIT, BSCS)" required>
                            @error('course')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="year_level" class="form-label">Year Level <span class="text-danger">*</span></label>
                            <select class="form-select @error('year_level') is-invalid @enderror" id="year_level" name="year_level" required>
                                <option value="">Select Year Level</option>
                                <option value="1" {{ old('year_level', $student->year_level) == '1' ? 'selected' : '' }}>1st Year</option>
                                <option value="2" {{ old('year_level', $student->year_level) == '2' ? 'selected' : '' }}>2nd Year</option>
                                <option value="3" {{ old('year_level', $student->year_level) == '3' ? 'selected' : '' }}>3rd Year</option>
                                <option value="4" {{ old('year_level', $student->year_level) == '4' ? 'selected' : '' }}>4th Year</option>
                                <option value="5" {{ old('year_level', $student->year_level) == '5' ? 'selected' : '' }}>5th Year</option>
                            </select>
                            @error('year_level')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i> Update Student
                        </button>
                        <a href="{{ route('students.index') }}" class="btn btn-light btn-wave">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

