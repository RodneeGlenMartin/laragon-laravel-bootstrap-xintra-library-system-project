@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('page-title', 'Dashboard')

@section('page-actions')
<div class="d-flex gap-2">
    <button type="button" class="btn btn-light btn-wave" data-bs-toggle="tooltip" title="Refresh Data" onclick="location.reload()">
        <i class="ri-refresh-line"></i>
    </button>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-wave">
        <i class="ri-add-line me-1"></i> New Transaction
    </a>
</div>
@endsection

@section('content')
<!-- Welcome Banner -->
<div class="alert alert-primary-transparent border-0 mb-4" role="alert">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="avatar avatar-lg bg-primary-transparent rounded-circle">
                <i class="ri-hand-heart-line fs-24 text-primary"></i>
            </div>
            <div>
                <h5 class="mb-1 fw-semibold">Welcome back, {{ Auth::user()->name }}!</h5>
                <p class="mb-0 text-muted">Here's what's happening with your library today.</p>
            </div>
        </div>
        <div class="d-none d-md-block">
            <span class="text-muted fs-13">
                <i class="ri-calendar-line me-1"></i>{{ now()->format('l, F j, Y') }}
            </span>
        </div>
    </div>
</div>

<!-- Start::row-1 - Stats Cards -->
<div class="row">
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <span class="d-block mb-1 text-muted fs-12 text-uppercase fw-medium">Total Categories</span>
                        <h3 class="fw-bold mb-0">{{ $stats['total_categories'] }}</h3>
                    </div>
                    <div class="avatar avatar-md bg-primary-transparent rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('categories.index') }}" class="text-primary fw-medium fs-13">
                        View All <i class="ri-arrow-right-line ms-1"></i>
                </a>
                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary-light">
                        <i class="ri-add-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <span class="d-block mb-1 text-muted fs-12 text-uppercase fw-medium">Total Books</span>
                        <h3 class="fw-bold mb-0">{{ $stats['total_books'] }}</h3>
                    </div>
                    <div class="avatar avatar-md bg-success-transparent rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-success" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="badge bg-success-transparent text-success">
                        <i class="ri-checkbox-circle-line me-1"></i>{{ $stats['active_books'] }} Available
                </span>
                    <a href="{{ route('books.create') }}" class="btn btn-sm btn-success-light">
                        <i class="ri-add-line"></i>
                </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <span class="d-block mb-1 text-muted fs-12 text-uppercase fw-medium">Total Students</span>
                        <h3 class="fw-bold mb-0">{{ $stats['total_students'] }}</h3>
                    </div>
                    <div class="avatar avatar-md bg-info-transparent rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-info" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="{{ route('students.index') }}" class="text-info fw-medium fs-13">
                        View All <i class="ri-arrow-right-line ms-1"></i>
                </a>
                    <a href="{{ route('students.create') }}" class="btn btn-sm btn-info-light">
                        <i class="ri-add-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-12">
        <div class="card custom-card overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div>
                        <span class="d-block mb-1 text-muted fs-12 text-uppercase fw-medium">Transactions</span>
                        <h3 class="fw-bold mb-0">{{ $stats['total_transactions'] }}</h3>
                    </div>
                    <div class="avatar avatar-md bg-warning-transparent rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-warning" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                @if($stats['overdue_transactions'] > 0)
                    <span class="badge bg-danger-transparent text-danger">
                        <i class="ri-alert-line me-1"></i>{{ $stats['overdue_transactions'] }} Overdue
                </span>
                @else
                    <span class="badge bg-success-transparent text-success">
                        <i class="ri-checkbox-circle-line me-1"></i>No Overdue
                </span>
                @endif
                    <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-warning-light">
                        <i class="ri-add-line"></i>
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::row-1 -->

<!-- Start::row-2 - Main Content -->
<div class="row">
    <!-- Recent Transactions -->
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Recent Transactions</h6>
                    <p class="text-muted mb-0 fs-12">Latest book borrowing activities</p>
                </div>
                <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-primary-light">
                    View All <i class="ri-arrow-right-line ms-1"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($recentTransactions->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Student</th>
                                <th>Book</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    @foreach($recentTransactions as $transaction)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-sm bg-primary-transparent rounded-circle flex-shrink-0" style="min-width: 32px; min-height: 32px;">
                                            <span class="avatar-title fs-11">{{ substr($transaction->student->firstname, 0, 1) }}{{ substr($transaction->student->lastname, 0, 1) }}</span>
                                        </div>
                                        <div class="min-width-0">
                                            <p class="mb-0 fw-medium fs-13 text-truncate">{{ $transaction->student->lastname }}, {{ $transaction->student->firstname }}</p>
                                            <span class="text-muted fs-11">{{ $transaction->student->student_id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-medium fs-13">{{ Str::limit($transaction->book->name, 25) }}</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-13">{{ \Carbon\Carbon::parse($transaction->due_date)->format('M d, Y') }}</span>
                                </td>
                                <td>
                                @if(\Carbon\Carbon::parse($transaction->due_date)->isPast())
                                    <span class="badge bg-danger-transparent text-danger rounded-pill">
                                        <i class="ri-error-warning-line me-1"></i>Overdue
                                    </span>
                                @elseif(\Carbon\Carbon::parse($transaction->due_date)->isToday())
                                    <span class="badge bg-warning-transparent text-warning rounded-pill">
                                        <i class="ri-time-line me-1"></i>Due Today
                                    </span>
                                @else
                                    <span class="badge bg-success-transparent text-success rounded-pill">
                                        <i class="ri-checkbox-circle-line me-1"></i>Active
                                    </span>
                                @endif
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-icon btn-light" data-bs-toggle="tooltip" title="Edit">
                                        <i class="ri-edit-line"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                @else
                <div class="text-center py-5">
                    <div class="avatar avatar-xl bg-light rounded-circle mb-3 mx-auto">
                        <i class="ri-exchange-line fs-28 text-muted"></i>
                    </div>
                    <h6 class="text-muted mb-2">No transactions yet</h6>
                    <p class="text-muted fs-13 mb-3">Start by creating a new book borrowing transaction</p>
                    <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">
                        <i class="ri-add-line me-1"></i>New Transaction
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-xl-4">
        <!-- Quick Actions -->
        <div class="card custom-card">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('categories.create') }}" class="btn btn-outline-primary text-start d-flex align-items-center gap-2">
                        <div class="avatar avatar-sm bg-primary-transparent rounded-circle flex-shrink-0">
                            <i class="ri-price-tag-3-line text-primary"></i>
                        </div>
                        <div class="min-width-0">
                            <span class="fw-medium d-block text-truncate">Add Category</span>
                            <span class="d-block fs-11 text-muted text-truncate">Create a new book category</span>
                        </div>
                    </a>
                    <a href="{{ route('books.create') }}" class="btn btn-outline-success text-start d-flex align-items-center gap-2">
                        <div class="avatar avatar-sm bg-success-transparent rounded-circle flex-shrink-0">
                            <i class="ri-book-2-line text-success"></i>
                        </div>
                        <div class="min-width-0">
                            <span class="fw-medium d-block text-truncate">Add Book</span>
                            <span class="d-block fs-11 text-muted text-truncate">Register a new book</span>
                        </div>
                    </a>
                    <a href="{{ route('students.create') }}" class="btn btn-outline-info text-start d-flex align-items-center gap-2">
                        <div class="avatar avatar-sm bg-info-transparent rounded-circle flex-shrink-0">
                            <i class="ri-user-add-line text-info"></i>
                        </div>
                        <div class="min-width-0">
                            <span class="fw-medium d-block text-truncate">Add Student</span>
                            <span class="d-block fs-11 text-muted text-truncate">Register a new student</span>
                        </div>
                    </a>
                    <a href="{{ route('transactions.create') }}" class="btn btn-outline-warning text-start d-flex align-items-center gap-2">
                        <div class="avatar avatar-sm bg-warning-transparent rounded-circle flex-shrink-0">
                            <i class="ri-exchange-line text-warning"></i>
                        </div>
                        <div class="min-width-0">
                            <span class="fw-medium d-block text-truncate">New Transaction</span>
                            <span class="d-block fs-11 text-muted text-truncate">Record a book borrowing</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Recently Added Books -->
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">Recently Added Books</h6>
                <a href="{{ route('books.index') }}" class="fs-12 text-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @if($recentBooks->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($recentBooks as $book)
                    <li class="list-group-item d-flex align-items-center gap-2 px-3 py-3">
                        <div class="avatar avatar-sm bg-success-transparent rounded flex-shrink-0" style="min-width: 32px; min-height: 32px;">
                            <i class="ri-book-2-line text-success fs-14"></i>
                        </div>
                        <div class="flex-grow-1 min-width-0 overflow-hidden">
                            <p class="mb-0 fw-medium text-truncate fs-13">{{ $book->name }}</p>
                            <span class="text-muted fs-11 text-truncate d-block">{{ $book->author }}</span>
                        </div>
                        <span class="badge bg-primary-transparent text-primary fs-10 flex-shrink-0 text-truncate" style="max-width: 70px;">{{ $book->category->name ?? 'N/A' }}</span>
                    </li>
                    @endforeach
                </ul>
                @else
                <div class="text-center py-4">
                    <i class="ri-book-line fs-24 text-muted d-block mb-2"></i>
                    <span class="text-muted fs-13">No books added yet</span>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Tips & Help -->
        <div class="card custom-card bg-primary-transparent border-0" id="help">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3">
                    <div class="avatar avatar-md bg-primary rounded-circle flex-shrink-0">
                        <i class="ri-lightbulb-line text-white"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold mb-1">Pro Tip</h6>
                        <p class="text-muted mb-2 fs-13">Use keyboard shortcuts to navigate faster! Press <kbd>⌘K</kbd> to open search, or <kbd>G</kbd> then <kbd>B</kbd> to go to Books.</p>
                        <a href="javascript:void(0);" class="text-primary fw-medium fs-13" data-bs-toggle="modal" data-bs-target="#keyboardShortcutsModal">
                            View All Shortcuts <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::row-2 -->

<!-- Start::row-3 - Activity Overview -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <h6 class="card-title mb-0">Library Overview</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded bg-light h-100">
                            <div class="avatar avatar-lg bg-primary rounded-circle flex-shrink-0">
                                <i class="ri-book-open-line text-white fs-20"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_books'] }}</h4>
                                <span class="text-muted fs-13">Total Books</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded bg-light h-100">
                            <div class="avatar avatar-lg bg-success rounded-circle flex-shrink-0">
                                <i class="ri-checkbox-circle-line text-white fs-20"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['active_books'] }}</h4>
                                <span class="text-muted fs-13">Available</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded bg-light h-100">
                            <div class="avatar avatar-lg bg-warning rounded-circle flex-shrink-0">
                                <i class="ri-time-line text-white fs-20"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['total_transactions'] - $stats['overdue_transactions'] }}</h4>
                                <span class="text-muted fs-13">Borrowed</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="d-flex align-items-center gap-3 p-3 rounded bg-light h-100">
                            <div class="avatar avatar-lg bg-danger rounded-circle flex-shrink-0">
                                <i class="ri-error-warning-line text-white fs-20"></i>
                            </div>
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $stats['overdue_transactions'] }}</h4>
                                <span class="text-muted fs-13">Overdue</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End::row-3 -->
@endsection

@push('scripts')
<script>
    // Initialize tooltips
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(el) {
        new bootstrap.Tooltip(el);
    });
</script>
@endpush
