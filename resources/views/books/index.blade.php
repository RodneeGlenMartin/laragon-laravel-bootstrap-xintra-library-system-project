@extends('layouts.admin')

@section('title', 'Books')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Books</li>
@endsection

@section('page-title', 'Books')

@section('page-actions')
<a href="{{ route('books.create') }}" class="btn btn-primary btn-wave">
    <i class="ri-add-line me-1"></i> Add Book
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
                        <p class="text-muted mb-1 fs-12 text-uppercase">Total Books</p>
                        <h4 class="fw-bold mb-0">{{ $books->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-primary-transparent rounded-circle">
                        <i class="ri-book-2-line text-primary fs-18"></i>
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
                        <p class="text-muted mb-1 fs-12 text-uppercase">Available</p>
                        <h4 class="fw-bold mb-0">{{ $books->where('is_active', true)->count() }}</h4>
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
                        <p class="text-muted mb-1 fs-12 text-uppercase">Unavailable</p>
                        <h4 class="fw-bold mb-0">{{ $books->where('is_active', false)->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-danger-transparent rounded-circle">
                        <i class="ri-close-circle-line text-danger fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card custom-card border-start border-info border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Categories</p>
                        <h4 class="fw-bold mb-0">{{ $books->pluck('category_id')->unique()->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-info-transparent rounded-circle">
                        <i class="ri-price-tag-3-line text-info fs-18"></i>
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
                    <h6 class="card-title mb-0">All Books</h6>
                    <p class="text-muted mb-0 fs-12">Manage your book inventory</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="ri-filter-line me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterBooks('all')">All Books</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterBooks('available')">Available</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterBooks('unavailable')">Unavailable</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($books->count() > 0)
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-hover text-nowrap w-100">
                        <thead>
                            <tr>
                                <th class="fw-semibold">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th class="fw-semibold">Book Details</th>
                                <th class="fw-semibold">ISBN</th>
                                <th class="fw-semibold">Author</th>
                                <th class="fw-semibold">Category</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold">Date Added</th>
                                <th class="fw-semibold text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr data-status="{{ $book->is_active ? 'available' : 'unavailable' }}">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input row-checkbox" type="checkbox" value="{{ $book->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-md bg-success-transparent rounded">
                                            <i class="ri-book-2-line text-success fs-16"></i>
                                        </div>
                                        <div>
                                            <span class="fw-medium d-block">{{ Str::limit($book->name, 30) }}</span>
                                            <span class="text-muted fs-11">#{{ $book->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded fs-12">{{ $book->isbn }}</code>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $book->author }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-transparent text-primary rounded-pill">
                                        {{ $book->category->name ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    @if($book->is_active)
                                    <span class="badge bg-success-transparent text-success rounded-pill">
                                        <i class="ri-checkbox-circle-line me-1"></i>Available
                                    </span>
                                    @else
                                    <span class="badge bg-danger-transparent text-danger rounded-pill">
                                        <i class="ri-close-circle-line me-1"></i>Unavailable
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted" data-bs-toggle="tooltip" title="{{ $book->date_added ? \Carbon\Carbon::parse($book->date_added)->format('F d, Y h:i A') : $book->created_at->format('F d, Y h:i A') }}">
                                        {{ $book->date_added ? \Carbon\Carbon::parse($book->date_added)->format('M d, Y') : $book->created_at->format('M d, Y') }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group action-btns">
                                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-icon btn-primary-light" data-bs-toggle="tooltip" title="Edit Book">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $book->id }}" title="Delete Book">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Delete Modals (outside table) -->
                @foreach($books as $book)
                <div class="modal fade" id="deleteModal{{ $book->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-4">
                                <div class="avatar avatar-xl bg-danger-transparent rounded-circle mb-3 mx-auto">
                                    <i class="ri-delete-bin-line text-danger fs-28"></i>
                                </div>
                                <h5 class="mb-2">Delete Book?</h5>
                                <p class="text-muted mb-4">Are you sure you want to delete <strong>{{ $book->name }}</strong>? This action cannot be undone.</p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
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
                        <i class="ri-book-2-line fs-40 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-2">No Books Yet</h5>
                    <p class="text-muted mb-4">Start by adding your first book to the library inventory.</p>
                    <a href="{{ route('books.create') }}" class="btn btn-primary">
                        <i class="ri-add-line me-1"></i>Add First Book
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
                searchPlaceholder: 'Search books...',
                search: '',
                lengthMenu: '_MENU_ per page',
                info: 'Showing _START_ to _END_ of _TOTAL_ books',
                paginate: {
                    previous: '<i class="ri-arrow-left-s-line"></i>',
                    next: '<i class="ri-arrow-right-s-line"></i>'
                }
            },
            dom: '<"d-flex flex-wrap justify-content-between align-items-center mb-3"<"d-flex align-items-center gap-2"l><"d-flex align-items-center gap-2"f>>rtip',
            columnDefs: [
                { orderable: false, targets: [0, 7] }
            ],
            order: [[6, 'desc']]
        });
        
        $('#selectAll').on('change', function() {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
        });
        
        // Stop checkbox and action button clicks from triggering DataTables row expansion
        $(document).on('click', '.form-check-input, .form-check, .action-btns, .action-btns *', function(e) {
            e.stopPropagation();
        });
        
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el);
        });
    });
    
    function filterBooks(status) {
        var table = $('#datatable-basic').DataTable();
        if (status === 'all') {
            table.column(5).search('').draw();
        } else if (status === 'available') {
            table.column(5).search('Available').draw();
        } else if (status === 'unavailable') {
            table.column(5).search('Unavailable').draw();
        }
    }
</script>
@endpush
