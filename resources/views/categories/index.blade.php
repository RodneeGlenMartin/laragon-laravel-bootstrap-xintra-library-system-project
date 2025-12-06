@extends('layouts.admin')

@section('title', 'Categories')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Categories</li>
@endsection

@section('page-title', 'Categories')

@section('page-actions')
<a href="{{ route('categories.create') }}" class="btn btn-primary btn-wave">
    <i class="ri-add-line me-1"></i> Add Category
</a>
@endsection

@section('content')
<!-- Summary Cards -->
<div class="row mb-4">
    <div class="col-md-4 col-sm-6">
        <div class="card custom-card border-start border-primary border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Total Categories</p>
                        <h4 class="fw-bold mb-0">{{ $categories->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-primary-transparent rounded-circle">
                        <i class="ri-folder-line text-primary fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card custom-card border-start border-success border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Active Categories</p>
                        <h4 class="fw-bold mb-0">{{ $categories->where('is_active', true)->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-success-transparent rounded-circle">
                        <i class="ri-checkbox-circle-line text-success fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card custom-card border-start border-warning border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Inactive Categories</p>
                        <h4 class="fw-bold mb-0">{{ $categories->where('is_active', false)->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-warning-transparent rounded-circle">
                        <i class="ri-close-circle-line text-warning fs-18"></i>
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
                    <h6 class="card-title mb-0">All Categories</h6>
                    <p class="text-muted mb-0 fs-12">Manage your book categories</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="ri-filter-line me-1"></i> Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterTable('all')">All Categories</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterTable('active')">Active Only</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterTable('inactive')">Inactive Only</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($categories->count() > 0)
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-hover text-nowrap w-100">
                        <thead>
                            <tr>
                                <th class="fw-semibold">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th class="fw-semibold">ID</th>
                                <th class="fw-semibold">Category Name</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold">Date Added</th>
                                <th class="fw-semibold text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr data-status="{{ $category->is_active ? 'active' : 'inactive' }}">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input row-checkbox" type="checkbox" value="{{ $category->id }}">
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">#{{ $category->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-sm bg-primary-transparent rounded">
                                            <i class="ri-price-tag-3-line text-primary"></i>
                                        </div>
                                        <span class="fw-medium">{{ $category->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($category->is_active)
                                    <span class="badge bg-success-transparent text-success rounded-pill">
                                        <i class="ri-checkbox-circle-line me-1"></i>Active
                                    </span>
                                    @else
                                    <span class="badge bg-danger-transparent text-danger rounded-pill">
                                        <i class="ri-close-circle-line me-1"></i>Inactive
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted" data-bs-toggle="tooltip" title="{{ $category->date_added ? $category->date_added->format('F d, Y h:i A') : $category->created_at->format('F d, Y h:i A') }}">
                                        {{ $category->date_added ? $category->date_added->format('M d, Y') : $category->created_at->format('M d, Y') }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group action-btns">
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-icon btn-primary-light" data-bs-toggle="tooltip" title="Edit Category">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->id }}" title="Delete Category">
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
                @foreach($categories as $category)
                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-4">
                                <div class="avatar avatar-xl bg-danger-transparent rounded-circle mb-3 mx-auto">
                                    <i class="ri-delete-bin-line text-danger fs-28"></i>
                                </div>
                                <h5 class="mb-2">Delete Category?</h5>
                                <p class="text-muted mb-4">Are you sure you want to delete <strong>{{ $category->name }}</strong>? This action cannot be undone.</p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
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
                        <i class="ri-folder-line fs-40 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-2">No Categories Yet</h5>
                    <p class="text-muted mb-4">Start by creating your first book category to organize your library.</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="ri-add-line me-1"></i>Create First Category
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
        // Initialize DataTable
        var table = $('#datatable-basic').DataTable({
            responsive: false,
            scrollX: true,
            pageLength: 10,
            language: {
                searchPlaceholder: 'Search categories...',
                search: '',
                lengthMenu: '_MENU_ per page',
                info: 'Showing _START_ to _END_ of _TOTAL_ categories',
                paginate: {
                    previous: '<i class="ri-arrow-left-s-line"></i>',
                    next: '<i class="ri-arrow-right-s-line"></i>'
                }
            },
            dom: '<"d-flex flex-wrap justify-content-between align-items-center mb-3"<"d-flex align-items-center gap-2"l><"d-flex align-items-center gap-2"f>>rtip',
            columnDefs: [
                { orderable: false, targets: [0, 5] }
            ],
            order: [[1, 'desc']]
        });
        
        // Select all checkbox
        $('#selectAll').on('change', function() {
            $('.row-checkbox').prop('checked', $(this).prop('checked'));
        });
        
        // Stop checkbox and action button clicks from triggering DataTables row expansion
        $(document).on('click', '.form-check-input, .form-check, .action-btns, .action-btns *', function(e) {
            e.stopPropagation();
        });
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el);
        });
    });
    
    // Filter function
    function filterTable(status) {
        var table = $('#datatable-basic').DataTable();
        if (status === 'all') {
            table.column(3).search('').draw();
        } else if (status === 'active') {
            table.column(3).search('Active').draw();
        } else if (status === 'inactive') {
            table.column(3).search('Inactive').draw();
        }
    }
</script>
@endpush
