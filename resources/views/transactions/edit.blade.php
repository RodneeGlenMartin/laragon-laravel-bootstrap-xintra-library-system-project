@extends('layouts.admin')

@section('title', 'Edit Transaction')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Transactions</a></li>
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('page-title', 'Edit Transaction')

@section('page-actions')
<a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-wave">
    <i class="ri-arrow-left-line me-1"></i> Back to List
</a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title">Transaction Information</div>
                <span class="badge bg-primary fs-12">{{ $transaction->txn_no }}</span>
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
                
                <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="student_id" class="form-label">Student <span class="text-danger">*</span></label>
                            <select class="form-select @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                                <option value="">Select Student</option>
                                @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id', $transaction->student_id) == $student->id ? 'selected' : '' }}>
                                    {{ $student->student_id }} - {{ $student->lastname }}, {{ $student->firstname }}
                                </option>
                                @endforeach
                            </select>
                            @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="book_id" class="form-label">Book <span class="text-danger">*</span></label>
                            <select class="form-select @error('book_id') is-invalid @enderror" id="book_id" name="book_id" required>
                                <option value="">Select Book</option>
                                @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ old('book_id', $transaction->book_id) == $book->id ? 'selected' : '' }}>
                                    {{ $book->name }} ({{ $book->isbn }})
                                </option>
                                @endforeach
                            </select>
                            @error('book_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Borrowed</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($transaction->date_borrowed)->format('M d, Y h:i A') }}" disabled>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', \Carbon\Carbon::parse($transaction->due_date)->format('Y-m-d')) }}" required>
                            @error('due_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Processed By</label>
                            <input type="text" class="form-control" value="{{ $transaction->by }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <div>
                                @if($transaction->status === 'Returned')
                                <span class="badge bg-secondary fs-12">
                                    <i class="ri-checkbox-multiple-line me-1"></i>Returned on {{ $transaction->returned_at->format('M d, Y') }}
                                </span>
                                @elseif($transaction->status === 'Overdue')
                                @php
                                    $overdueDays = \Carbon\Carbon::parse($transaction->due_date)->startOfDay()->diffInDays(now()->startOfDay());
                                @endphp
                                <span class="badge bg-danger fs-12">
                                    <i class="ri-error-warning-line me-1"></i>Overdue by {{ $overdueDays }} {{ $overdueDays == 1 ? 'day' : 'days' }}
                                </span>
                                @else
                                @php
                                    $daysRemaining = now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($transaction->due_date)->startOfDay());
                                @endphp
                                <span class="badge bg-success fs-12">
                                    <i class="ri-time-line me-1"></i>{{ $daysRemaining }} {{ $daysRemaining == 1 ? 'day' : 'days' }} remaining
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-wave">
                            <i class="ri-save-line me-1"></i> Update Transaction
                        </button>
                        <a href="{{ route('transactions.index') }}" class="btn btn-light btn-wave">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize flatpickr for date picker
        if(typeof flatpickr !== 'undefined') {
            flatpickr('#due_date', {
                dateFormat: 'Y-m-d'
            });
        }
    });
</script>
@endpush

