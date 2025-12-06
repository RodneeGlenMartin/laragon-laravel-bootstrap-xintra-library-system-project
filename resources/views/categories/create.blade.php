@extends('layouts.admin')

@section('title', 'Create Category')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endsection

@section('page-title', 'Create Category')

@section('page-actions')
<a href="{{ route('categories.index') }}" class="btn btn-light btn-wave">
    <i class="ri-arrow-left-line me-1"></i> Back to List
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-primary-transparent rounded-circle">
                        <i class="ri-price-tag-3-line text-primary"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Category Information</h6>
                        <p class="text-muted mb-0 fs-12">Enter the details for the new category</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" id="categoryForm">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            Category Name <span class="text-danger">*</span>
                            <span class="tooltip-icon" data-bs-toggle="tooltip" title="Enter a unique name for this category. This will be used to organize books.">?</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="ri-folder-line text-muted"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Fiction, Science, History" required autofocus>
                        </div>
                        <div class="form-text">
                            <i class="ri-information-line me-1"></i>
                            Use a descriptive name that clearly identifies the type of books in this category.
                        </div>
                        @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2 pt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i> Save Category
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-light btn-wave">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <!-- Help Card -->
        <div class="card custom-card bg-primary-transparent border-0">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3">
                    <div class="avatar avatar-md bg-primary rounded-circle flex-shrink-0">
                        <i class="ri-lightbulb-line text-white"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold mb-2">Tips for Categories</h6>
                        <ul class="mb-0 ps-3 text-muted fs-13">
                            <li class="mb-1">Use clear, descriptive names</li>
                            <li class="mb-1">Keep categories broad enough to be useful</li>
                            <li class="mb-1">Avoid duplicate or similar categories</li>
                            <li>Consider your library's organization needs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Examples Card -->
        <div class="card custom-card">
            <div class="card-header">
                <h6 class="card-title mb-0">Example Categories</h6>
            </div>
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-light text-dark">Fiction</span>
                    <span class="badge bg-light text-dark">Non-Fiction</span>
                    <span class="badge bg-light text-dark">Science</span>
                    <span class="badge bg-light text-dark">Technology</span>
                    <span class="badge bg-light text-dark">History</span>
                    <span class="badge bg-light text-dark">Literature</span>
                    <span class="badge bg-light text-dark">Biography</span>
                    <span class="badge bg-light text-dark">Reference</span>
                </div>
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
    
    // Form validation feedback
    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        var nameInput = document.getElementById('name');
        if (!nameInput.value.trim()) {
            e.preventDefault();
            nameInput.classList.add('is-invalid');
            nameInput.focus();
        }
    });
    
    document.getElementById('name').addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('is-invalid');
        }
    });
</script>
@endpush
