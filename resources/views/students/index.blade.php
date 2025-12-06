@extends('layouts.admin')

@section('title', 'Students')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Students</li>
@endsection

@section('page-title', 'Students')

@section('page-actions')
<a href="{{ route('students.create') }}" class="btn btn-primary btn-wave">
    <i class="ri-add-line me-1"></i> Add Student
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
                        <p class="text-muted mb-1 fs-12 text-uppercase">Total Students</p>
                        <h4 class="fw-bold mb-0">{{ $students->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-primary-transparent rounded-circle">
                        <i class="ri-user-line text-primary fs-18"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card custom-card border-start border-info border-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fs-12 text-uppercase">Courses</p>
                        <h4 class="fw-bold mb-0">{{ $students->pluck('course')->unique()->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-info-transparent rounded-circle">
                        <i class="ri-graduation-cap-line text-info fs-18"></i>
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
                        <p class="text-muted mb-1 fs-12 text-uppercase">Year Levels</p>
                        <h4 class="fw-bold mb-0">{{ $students->pluck('year_level')->unique()->count() }}</h4>
                    </div>
                    <div class="avatar avatar-md bg-success-transparent rounded-circle">
                        <i class="ri-calendar-line text-success fs-18"></i>
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
                    <h6 class="card-title mb-0">All Students</h6>
                    <p class="text-muted mb-0 fs-12">Manage student records</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="ri-filter-line me-1"></i> Filter by Year
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterStudents('all')">All Years</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterStudents('1')">1st Year</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterStudents('2')">2nd Year</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterStudents('3')">3rd Year</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="filterStudents('4')">4th Year</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($students->count() > 0)
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-hover text-nowrap w-100">
                        <thead>
                            <tr>
                                <th class="fw-semibold">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                <th class="fw-semibold">Student</th>
                                <th class="fw-semibold">Student ID</th>
                                <th class="fw-semibold">Email</th>
                                <th class="fw-semibold">Course</th>
                                <th class="fw-semibold">Year Level</th>
                                <th class="fw-semibold text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input row-checkbox" type="checkbox" value="{{ $student->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-md bg-info-transparent rounded-circle">
                                            <span class="avatar-title fs-12">{{ substr($student->firstname, 0, 1) }}{{ substr($student->lastname, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <span class="fw-medium d-block">{{ $student->lastname }}, {{ $student->firstname }} {{ $student->middlename }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="bg-light px-2 py-1 rounded fs-12">{{ $student->student_id }}</code>
                                </td>
                                <td>
                                    <a href="mailto:{{ $student->email }}" class="text-muted">{{ $student->email }}</a>
                                </td>
                                <td>
                                    <span class="badge bg-info-transparent text-info rounded-pill">
                                        {{ $student->course }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">
                                        Year {{ $student->year_level }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group action-btns">
                                        <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-icon btn-primary-light" data-bs-toggle="tooltip" title="Edit Student">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger-light" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $student->id }}" title="Delete Student">
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
                @foreach($students as $student)
                <div class="modal fade" id="deleteModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center p-4">
                                <div class="avatar avatar-xl bg-danger-transparent rounded-circle mb-3 mx-auto">
                                    <i class="ri-delete-bin-line text-danger fs-28"></i>
                                </div>
                                <h5 class="mb-2">Delete Student?</h5>
                                <p class="text-muted mb-4">Are you sure you want to delete <strong>{{ $student->firstname }} {{ $student->lastname }}</strong>? This action cannot be undone.</p>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
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
                        <i class="ri-user-line fs-40 text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-2">No Students Yet</h5>
                    <p class="text-muted mb-4">Start by registering your first student.</p>
                    <a href="{{ route('students.create') }}" class="btn btn-primary">
                        <i class="ri-add-line me-1"></i>Add First Student
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
                searchPlaceholder: 'Search students...',
                search: '',
                lengthMenu: '_MENU_ per page',
                info: 'Showing _START_ to _END_ of _TOTAL_ students',
                paginate: {
                    previous: '<i class="ri-arrow-left-s-line"></i>',
                    next: '<i class="ri-arrow-right-s-line"></i>'
                }
            },
            dom: '<"d-flex flex-wrap justify-content-between align-items-center mb-3"<"d-flex align-items-center gap-2"l><"d-flex align-items-center gap-2"f>>rtip',
            columnDefs: [
                { orderable: false, targets: [0, 6] }
            ],
            order: [[1, 'asc']]
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
    
    function filterStudents(year) {
        var table = $('#datatable-basic').DataTable();
        if (year === 'all') {
            table.column(5).search('').draw();
        } else {
            table.column(5).search('Year ' + year).draw();
        }
    }
</script>
@endpush
