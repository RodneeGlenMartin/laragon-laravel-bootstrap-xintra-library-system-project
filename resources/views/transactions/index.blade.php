@extends('layouts.admin')

@section('title', 'Transactions')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Transactions</li>
@endsection

@section('page-title', 'Transactions (Borrowed Books)')

@section('page-actions')
<a href="{{ route('transactions.create') }}" class="btn btn-primary btn-wave">
    <i class="ri-add-line me-1"></i> New Transaction
</a>
@endsection

@section('content')
<!-- Summary Cards -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-primary border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Total Transactions</p>
                        <h4 class="fw-bold mb-0">{{ $transactions->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-primary-transparent rounded-circle">
                        <i class="ri-exchange-line text-primary fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-success border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Active</p>
                        <h4 class="fw-bold mb-0">{{ $transactions->filter(function($t) { return $t->status === 'Active'; })->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-success-transparent rounded-circle">
                        <i class="ri-checkbox-circle-line text-success fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-danger border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Overdue</p>
                        <h4 class="fw-bold mb-0">{{ $transactions->filter(function($t) { return $t->status === 'Overdue'; })->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-danger-transparent rounded-circle">
                        <i class="ri-error-warning-line text-danger fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-secondary border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Returned</p>
                        <h4 class="fw-bold mb-0">{{ $transactions->filter(function($t) { return $t->status === 'Returned'; })->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-secondary-transparent rounded-circle">
                        <i class="ri-checkbox-multiple-line text-secondary fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h6 class="card-title mb-0">All Transactions</h6>
                    <p class="text-muted mb-0 fs-12">Track book borrowing activities</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="ri-filter-line me-1"></i> Filter Status
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterTransactions('all')">All Transactions</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterTransactions('active')">Active</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterTransactions('overdue')">Overdue</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterTransactions('returned')">Returned</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($transactions->count() > 0)
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-hover text-nowrap w-100">
                        <thead>
                            <tr>
                                <th class="fw-semibold">Transaction #</th>
                                <th class="fw-semibold">Student</th>
                                <th class="fw-semibold">Book</th>
                                <th class="fw-semibold">Date Borrowed</th>
                                <th class="fw-semibold">Due Date</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold">Processed By</th>
                                <th class="fw-semibold text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            @php
                                $status = $transaction->status;
                                $dueDate = \Carbon\Carbon::parse($transaction->due_date);
                            @endphp
                            <tr data-status="{{ strtolower($status) }}">
                                <td>
                                    <code class="bg-light px-2 py-1 rounded fs-12">{{ $transaction->txn_no }}</code>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-sm bg-primary-transparent rounded-circle flex-shrink-0">
                                            <span class="avatar-title fs-10">{{ substr($transaction->student->firstname, 0, 1) }}{{ substr($transaction->student->lastname, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <span class="fw-medium d-block fs-13">{{ $transaction->student->lastname }}, {{ $transaction->student->firstname }}</span>
                                            <span class="text-muted fs-11">{{ $transaction->student->student_id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-medium fs-13">{{ Str::limit($transaction->book->name, 25) }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ \Carbon\Carbon::parse($transaction->date_borrowed)->format('M d, Y') }}</span>
                                </td>
                                <td>
                                    <span class="{{ $status === 'Overdue' ? 'text-danger fw-medium' : 'text-muted' }}">
                                        {{ $dueDate->format('M d, Y') }}
                                    </span>
                                </td>
                                <td>
                                    @if($status === 'Returned')
                                    <span class="badge bg-secondary-transparent text-secondary rounded-pill">
                                        <i class="ri-checkbox-multiple-line me-1"></i>Returned
                                    </span>
                                    @elseif($status === 'Overdue')
                                    <span class="badge bg-danger-transparent text-danger rounded-pill">
                                        <i class="ri-error-warning-line me-1"></i>Overdue
                                    </span>
                                    @else
                                    <span class="badge bg-success-transparent text-success rounded-pill">
                                        <i class="ri-checkbox-circle-line me-1"></i>Active
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">{{ $transaction->by }}</span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group action-btns">
                                        @if($transaction->isActive())
                                        <button type="button" class="btn btn-sm btn-icon btn-success-light" data-bs-toggle="modal" data-bs-target="#returnModal{{ $transaction->id }}" title="Return Book">
                                            <i class="ri-arrow-go-back-line"></i>
                                        </button>
                                        @endif
                                        <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-sm btn-icon btn-primary-light" data-bs-toggle="tooltip" title="Edit Transaction">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger-light delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $transaction->id }}" title="Delete Transaction">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Return & Delete Modals (outside table) -->
                @foreach($transactions as $transaction)
                <!-- Return Modal -->
                @if($transaction->isActive())
                <div class="modal fade" id="returnModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-4">
                                <div class="avatar avatar-xl bg-success-transparent rounded-circle mb-3 mx-auto">
                                    <i class="ri-arrow-go-back-line text-success fs-28"></i>
                                </div>
                                <h5 class="mb-2">Return Book?</h5>
                                <p class="text-muted mb-4">
                                    Mark <strong>"{{ $transaction->book->name }}"</strong> as returned by 
                                    <strong>{{ $transaction->student->full_name ?? $transaction->student->firstname . ' ' . $transaction->student->lastname }}</strong>?
                                </p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('transactions.return', $transaction) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success">
                                            <i class="ri-checkbox-circle-line me-1"></i>Confirm Return
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-4">
                                <div class="avatar avatar-xl bg-danger-transparent rounded-circle mb-3 mx-auto">
                                    <i class="ri-delete-bin-line text-danger fs-28"></i>
                                </div>
                                <h5 class="mb-2">Delete Transaction?</h5>
                                <p class="text-muted mb-4">Are you sure you want to delete transaction <strong>{{ $transaction->txn_no }}</strong>? This action cannot be undone.</p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="ri-delete-bin-line me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-center py-5">
                    <div class="avatar avatar-xxl bg-light rounded-circle mb-3 mx-auto">
                        <i class="ri-exchange-line fs-40 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-2">No Transactions Yet</h5>
                    <p class="text-muted mb-4">Start by recording a book borrowing transaction.</p>
                    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                        <i class="ri-add-line me-1"></i>Create First Transaction
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        var table = $('#datatable-basic').DataTable({
            responsive: false,
            scrollX: true,
            pageLength: 10,
            language: {
                searchPlaceholder: 'Search transactions...',
                search: '',
                lengthMenu: '_MENU_ per page',
                info: 'Showing _START_ to _END_ of _TOTAL_ transactions',
                paginate: {
                    previous: '<i class="ri-arrow-left-s-line"></i>',
                    next: '<i class="ri-arrow-right-s-line"></i>'
                }
            },
            dom: '<"d-flex flex-wrap justify-content-between align-items-center mb-3"<"d-flex align-items-center gap-2"l><"d-flex align-items-center gap-2"f>>rtip',
            columnDefs: [
                { orderable: false, targets: [7] }
            ],
            order: [[3, 'desc']]
        });
        
        // Prevent action buttons from triggering row expansion
        $(document).on('click', '.action-btns, .action-btns *', function(e) {
            e.stopPropagation();
        });
        
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el);
        });
    });
    
    function filterTransactions(status) {
        var table = $('#datatable-basic').DataTable();
        if (status === 'all') {
            table.column(5).search('').draw();
        } else if (status === 'active') {
            table.column(5).search('Active').draw();
        } else if (status === 'overdue') {
            table.column(5).search('Overdue').draw();
        } else if (status === 'returned') {
            table.column(5).search('Returned').draw();
        }
    }
</script>
@endpush
