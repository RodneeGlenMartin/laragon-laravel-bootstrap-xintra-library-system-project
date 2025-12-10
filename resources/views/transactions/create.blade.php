@extends('layouts.admin')

@section('title', 'Create Transaction')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transactions</a></li>
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endsection

@section('page-title', 'New Book Borrowing')

@section('page-actions')
<a href="{{ route('transactions.index') }}" class="btn btn-light btn-wave">
    <i class="ri-arrow-left-line me-1"></i> Back to List
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-warning-transparent rounded-circle">
                        <i class="ri-exchange-line text-warning"></i>
                    </div>
                    <div>
                        <h6 class="card-title mb-0">Transaction Information</h6>
                        <p class="text-muted mb-0 fs-12">Record a new book borrowing transaction</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ri-error-warning-line fs-18"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
                    @csrf
                    
                    <!-- Student & Book Selection -->
                    <h6 class="fw-semibold mb-3 text-warning">
                        <i class="ri-user-line me-1"></i> Student & Book
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">
                                Student <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Select the student borrowing the book.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-user-line text-muted"></i>
                                </span>
                                <select class="form-select @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                                    <option value="">Select Student</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->student_id }} - {{ $student->lastname }}, {{ $student->firstname }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @if($students->isEmpty())
                            <div class="form-text text-warning">
                                <i class="ri-alert-line me-1"></i>
                                No students found. <a href="{{ route('students.create') }}">Register one first</a>.
                            </div>
                            @endif
                            @error('student_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="book_id" class="form-label">
                                Book <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Select the book being borrowed.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-book-2-line text-muted"></i>
                                </span>
                                <select class="form-select @error('book_id') is-invalid @enderror" id="book_id" name="book_id" required>
                                    <option value="">Select Book</option>
                                    @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->name }} ({{ $book->isbn }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @if($books->isEmpty())
                            <div class="form-text text-warning">
                                <i class="ri-alert-line me-1"></i>
                                No books available. All books are currently borrowed or inactive.
                            </div>
                            @endif
                            @error('book_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Due Date -->
                    <h6 class="fw-semibold mb-3 mt-4 text-warning">
                        <i class="ri-calendar-line me-1"></i> Due Date
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">
                                Return Due Date <span class="text-danger">*</span>
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Select the date when the book should be returned.">?</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="ri-calendar-check-line text-muted"></i>
                                </span>
                                <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', \Carbon\Carbon::now()->addDays(7)->format('Y-m-d')) }}" min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" required>
                            </div>
                            <div class="form-text">
                                <i class="ri-information-line me-1"></i>
                                Default borrowing period is 7 days
                            </div>
                            @error('due_date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quick Select</label>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="setDueDate(7)">7 Days</button>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="setDueDate(14)">14 Days</button>
                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="setDueDate(30)">30 Days</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info Alert -->
                    <div class="alert alert-info-transparent border-0 mb-0 mt-3">
                        <div class="d-flex align-items-start gap-2">
                            <i class="ri-information-line fs-18"></i>
                            <div>
                                <strong>Note:</strong> The transaction will be automatically assigned a unique transaction number. The borrowing date will be set to today's date.
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 pt-3 mt-3 border-top">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i> Create Transaction
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-light btn-wave">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <!-- Help Card -->
        <div class="card custom-card bg-warning-transparent border-0">
            <div class="card-body">
                <div class="d-flex align-items-start gap-3">
                    <div class="avatar avatar-md bg-warning rounded-circle flex-shrink-0">
                        <i class="ri-lightbulb-line text-white"></i>
                    </div>
                    <div>
                        <h6 class="fw-semibold mb-2">Tips for Transactions</h6>
                        <ul class="mb-0 ps-3 text-muted fs-13">
                            <li class="mb-1">Verify student identity before lending</li>
                            <li class="mb-1">Check book availability status</li>
                            <li class="mb-1">Set appropriate return dates</li>
                            <li>Inform students of overdue policies</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Transaction Summary -->
        <div class="card custom-card">
            <div class="card-header">
                <h6 class="card-title mb-0">Transaction Summary</h6>
            </div>
            <div class="card-body">
                <div id="transactionSummary">
                    <div class="text-center text-muted py-3">
                        <i class="ri-file-list-line fs-24 d-block mb-2"></i>
                        <span class="fs-13">Select student and book to see summary</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Borrowing Policy -->
        <div class="card custom-card">
            <div class="card-header">
                <h6 class="card-title mb-0">
                    <i class="ri-information-line me-1"></i> Borrowing Policy
                </h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 fs-13 text-muted">
                    <li class="mb-2">
                        <i class="ri-time-line me-1 text-primary"></i>
                        Standard borrowing period: 7-14 days
                    </li>
                    <li class="mb-2">
                        <i class="ri-alert-line me-1 text-warning"></i>
                        Overdue books incur penalties
                    </li>
                    <li class="mb-2">
                        <i class="ri-refresh-line me-1 text-info"></i>
                        Books can be renewed once
                    </li>
                    <li>
                        <i class="ri-book-line me-1 text-success"></i>
                        Maximum 3 books per student
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Store student and book data for summary
    var studentsData = @json($students->keyBy('id'));
    var booksData = @json($books->keyBy('id'));

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(el) {
        return new bootstrap.Tooltip(el);
    });
    
    // Initialize flatpickr for date picker
    document.addEventListener('DOMContentLoaded', function() {
        if(typeof flatpickr !== 'undefined') {
            flatpickr('#due_date', {
                minDate: 'today',
                dateFormat: 'Y-m-d',
                defaultDate: new Date().fp_incr(7)
            });
        }

        // Add event listeners for summary update
        document.getElementById('student_id').addEventListener('change', updateTransactionSummary);
        document.getElementById('book_id').addEventListener('change', updateTransactionSummary);
        document.getElementById('due_date').addEventListener('change', updateTransactionSummary);
        
        // Initial update in case of old values
        updateTransactionSummary();
    });
    
    // Quick date selection
    function setDueDate(days) {
        var date = new Date();
        date.setDate(date.getDate() + days);
        var formattedDate = date.toISOString().split('T')[0];
        document.getElementById('due_date').value = formattedDate;
        
        // Update flatpickr if available
        if(typeof flatpickr !== 'undefined') {
            var fp = document.getElementById('due_date')._flatpickr;
            if(fp) fp.setDate(date);
        }
        
        // Update summary
        updateTransactionSummary();
    }

    // Update transaction summary
    function updateTransactionSummary() {
        var studentId = document.getElementById('student_id').value;
        var bookId = document.getElementById('book_id').value;
        var dueDate = document.getElementById('due_date').value;
        var summaryDiv = document.getElementById('transactionSummary');

        if (!studentId || !bookId) {
            summaryDiv.innerHTML = `
                <div class="text-center text-muted py-3">
                    <i class="ri-file-list-line fs-24 d-block mb-2"></i>
                    <span class="fs-13">Select student and book to see summary</span>
                </div>
            `;
            return;
        }

        var student = studentsData[studentId];
        var book = booksData[bookId];

        if (!student || !book) {
            return;
        }

        var today = new Date();
        var borrowDate = today.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        var dueDateFormatted = dueDate ? new Date(dueDate + 'T00:00:00').toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' }) : 'Not set';
        
        // Calculate days until due
        var daysUntilDue = '';
        if (dueDate) {
            var dueDateObj = new Date(dueDate + 'T00:00:00');
            var diffTime = dueDateObj - today;
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            daysUntilDue = `<span class="badge bg-${diffDays <= 7 ? 'warning' : 'success'}-transparent ms-1">${diffDays} days</span>`;
        }

        summaryDiv.innerHTML = `
            <div class="mb-3 pb-3 border-bottom">
                <p class="text-muted fs-12 mb-1">Student</p>
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-primary-transparent rounded-circle">
                        <span class="text-primary fs-12">${(student.firstname ? student.firstname[0] : '') + (student.lastname ? student.lastname[0] : '')}</span>
                    </div>
                    <div>
                        <p class="fw-semibold mb-0 fs-13">${student.lastname}, ${student.firstname}</p>
                        <p class="text-muted mb-0 fs-12">${student.student_id}</p>
                    </div>
                </div>
            </div>
            <div class="mb-3 pb-3 border-bottom">
                <p class="text-muted fs-12 mb-1">Book</p>
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-sm bg-warning-transparent rounded-circle">
                        <i class="ri-book-2-line text-warning fs-14"></i>
                    </div>
                    <div>
                        <p class="fw-semibold mb-0 fs-13">${book.name}</p>
                        <p class="text-muted mb-0 fs-12">ISBN: ${book.isbn || 'N/A'}</p>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-6">
                    <p class="text-muted fs-12 mb-1">Borrow Date</p>
                    <p class="fw-semibold mb-0 fs-13">${borrowDate}</p>
                </div>
                <div class="col-6">
                    <p class="text-muted fs-12 mb-1">Due Date</p>
                    <p class="fw-semibold mb-0 fs-13">${dueDateFormatted}${daysUntilDue}</p>
                </div>
            </div>
        `;
    }
</script>
@endpush
