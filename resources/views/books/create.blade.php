@extends('layouts.admin')

@section('title', 'Create Book')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endsection

@section('page-title', 'Add New Book')

@section('page-actions')
<a href="{{ route('books.index') }}" class="btn btn-light btn-wave">
    <i class="ri-arrow-left-line me-1"></i> Back to List
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-success-transparent rounded-circle">
                        <i class="ri-book-2-line text-success"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Book Information</h6>
                        <p class="text-muted mb-0 fs-12">Enter the details for the new book</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="POST" id="bookForm">
                    @csrf
                    
                    <!-- Basic Information -->
                    <h6 class="fw-semibold mb-3 text-primary">
                        <i class="ri-information-line me-1"></i> Basic Information
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                Book Title <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Enter the full title of the book as it appears on the cover.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-book-line text-muted"></i>
                                </span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter book title" required>
                            </div>
                            @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="isbn" class="form-label">
                                ISBN <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="International Standard Book Number - usually found on the back cover or copyright page.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-barcode-line text-muted"></i>
                                </span>
                                <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="e.g., 978-3-16-148410-0" required>
                            </div>
                            <div class="form-text">
                                <i class="ri-information-line me-1"></i>
                                Enter the 10 or 13-digit ISBN number
                            </div>
                            @error('isbn')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Author & Category -->
                    <h6 class="fw-semibold mb-3 mt-4 text-primary">
                        <i class="ri-user-line me-1"></i> Author & Category
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="author" class="form-label">
                                Author <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Enter the name of the book's author(s).">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-user-line text-muted"></i>
                                </span>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}" placeholder="Enter author name" required>
                            </div>
                            @error('author')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">
                                Category <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Select the category that best describes this book.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-price-tag-3-line text-muted"></i>
                                </span>
                                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @if($categories->isEmpty())
                            <div class="form-text text-warning">
                                <i class="ri-alert-line me-1"></i>
                                No categories found. <a href="{{ route('categories.create') }}">Create one first</a>.
                            </div>
                            @endif
                            @error('category_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 pt-3 mt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i> Save Book
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-light btn-wave">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <!-- Help Card -->
        <div class="card custom-card bg-success-transparent border-0">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3">
                    <div class="avatar avatar-md bg-success rounded-circle flex-shrink-0">
                        <i class="ri-lightbulb-line text-white"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold mb-2">Tips for Adding Books</h6>
                        <ul class="mb-0 ps-3 text-muted fs-13">
                            <li class="mb-1">Double-check the ISBN for accuracy</li>
                            <li class="mb-1">Use the author's full name</li>
                            <li class="mb-1">Choose the most appropriate category</li>
                            <li>Review details before saving</li>
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
                        <span class="fs-13">Book Title</span>
                    </li>
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">ISBN Number</span>
                    </li>
                    <li class="d-flex align-items-center gap-2 mb-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">Author Name</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="ri-checkbox-circle-line text-success"></i>
                        <span class="fs-13">Category</span>
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
