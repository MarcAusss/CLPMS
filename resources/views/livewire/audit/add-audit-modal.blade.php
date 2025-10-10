<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CL Profiling - Data Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }
        
        .navbar {
            background-color: var(--secondary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .main-content {
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .table th {
            background-color: var(--light-bg);
            border-top: none;
            font-weight: 600;
            color: var(--secondary-color);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 8px 16px;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .action-btn {
            padding: 5px 10px;
            margin: 0 2px;
            border-radius: 4px;
        }
        
        .search-box {
            max-width: 300px;
        }
        
        .export-buttons .btn {
            margin-left: 5px;
        }
        
        .no-data-container {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }
        
        .no-data-container i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #dee2e6;
        }
        
        .table > :not(caption) > * > * {
            padding: 0.75rem 0.5rem;
        }
        
        /* Status badges */
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-active {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-chart-line me-2"></i>
                CL Profiling System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> Admin User
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid main-content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">CL Profiling</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <!-- Use your existing Livewire modal trigger -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAuditModalComponent">
                    <i class="fas fa-plus me-1"></i> Add Profiled CL
                </button>
            </div>
        </div>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Audit Management</a></li>
                <li class="breadcrumb-item active" aria-current="page">Audit</li>
            </ol>
        </nav>

        <!-- Data Table Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>CL Records</span>
                <div class="d-flex">
                    <div class="input-group search-box">
                        <input type="text" class="form-control" placeholder="Search..." id="searchInput">
                        <button class="btn btn-outline-secondary" type="button" id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                    <div class="export-buttons ms-3">
                        <button class="btn btn-outline-primary btn-sm" id="excelBtn">
                            <i class="fas fa-file-excel me-1"></i> Excel
                        </button>
                        <button class="btn btn-outline-primary btn-sm" id="csvBtn">
                            <i class="fas fa-file-csv me-1"></i> CSV
                        </button>
                        <button class="btn btn-outline-primary btn-sm" id="pdfBtn">
                            <i class="fas fa-file-pdf me-1"></i> PDF
                        </button>
                        <button class="btn btn-outline-primary btn-sm" id="printBtn">
                            <i class="fas fa-print me-1"></i> Print
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="childLaborersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th class="text-center">Sex</th>
                                <th class="text-center">Date of Birth</th>
                                <th>Province</th>
                                <th class="text-center">Age</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via DataTables server-side processing -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quickViewModalLabel">CL Record Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="quickViewContent">
                    <!-- Content will be populated dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editRecordBtn">Edit Record</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Your Existing Add Modal (Livewire Component) -->
    <!-- This stays exactly as you have it -->
    <div wire:ignore.self id="addAuditModalComponent" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_audit_header">
                    <h2 class="fw-bold">Add Child Laborer</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                        <!-- Your close icon -->
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="modal-body p-0">
                    <!-- Your existing multi-step form content -->
                    <!-- This remains exactly as you have it -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTables with your server-side processing
            const table = $('#childLaborersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('audits.datatable') }}",
                    type: "GET"
                },
                columns: [
                    { 
                        data: 'id', 
                        name: 'id',
                        className: 'text-start'
                    },
                    { 
                        data: 'full_name', 
                        name: 'full_name',
                        className: 'text-start',
                        render: function(data, type, row) {
                            return `<span class="fw-semibold">${data}</span>`;
                        }
                    },
                    { 
                        data: 'sex', 
                        name: 'sex',
                        className: 'text-center',
                        render: function(data) {
                            const icon = data === 'Female' ? 'fas fa-venus text-pink' : 'fas fa-mars text-blue';
                            return `<i class="${icon} me-1"></i>${data}`;
                        }
                    },
                    { 
                        data: 'birth_date', 
                        name: 'birth_date',
                        className: 'text-center'
                    },
                    { 
                        data: 'province', 
                        name: 'province',
                        className: 'text-start'
                    },
                    { 
                        data: 'age', 
                        name: 'age',
                        className: 'text-center fw-bold text-primary'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        render: function(data) {
                            let badgeClass = 'status-badge ';
                            switch(data) {
                                case 'Active':
                                    badgeClass += 'status-active';
                                    break;
                                case 'Inactive':
                                    badgeClass += 'status-inactive';
                                    break;
                                case 'Pending':
                                    badgeClass += 'status-pending';
                                    break;
                                default:
                                    badgeClass += 'status-pending';
                            }
                            return `<span class="${badgeClass}">${data}</span>`;
                        }
                    },
                    { 
                        data: 'action', 
                        name: 'action', 
                        orderable: false, 
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-primary action-btn view-btn" data-id="${row.id}" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary action-btn edit-btn" data-id="${row.id}" title="Edit Record">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger action-btn delete-btn" data-id="${row.id}" title="Delete Record">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-outline-primary btn-sm',
                        text: '<i class="fas fa-file-excel me-1"></i> Excel'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-outline-primary btn-sm',
                        text: '<i class="fas fa-file-csv me-1"></i> CSV'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-outline-primary btn-sm',
                        text: '<i class="fas fa-file-pdf me-1"></i> PDF'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-outline-primary btn-sm',
                        text: '<i class="fas fa-print me-1"></i> Print'
                    }
                ],
                language: {
                    emptyTable: '<div class="no-data-container"><i class="fas fa-database"></i><h4>No records found</h4><p>There are no CL records in the system yet.</p></div>'
                },
                drawCallback: function(settings) {
                    // Re-attach event listeners after table redraw
                    attachEventListeners();
                }
            });

            // Search functionality
            $('#searchButton').on('click', function() {
                table.search($('#searchInput').val()).draw();
            });

            $('#searchInput').on('keyup', function(event) {
                if (event.key === 'Enter') {
                    table.search(this.value).draw();
                }
            });

            // Export buttons
            $('#excelBtn').on('click', function() {
                $('.buttons-excel').trigger('click');
            });

            $('#csvBtn').on('click', function() {
                $('.buttons-csv').trigger('click');
            });

            $('#pdfBtn').on('click', function() {
                $('.buttons-pdf').trigger('click');
            });

            $('#printBtn').on('click', function() {
                $('.buttons-print').trigger('click');
            });

            // Function to attach event listeners to action buttons
            function attachEventListeners() {
                // View button
                $('.view-btn').on('click', function() {
                    const recordId = $(this).data('id');
                    viewRecord(recordId);
                });

                // Edit button
                $('.edit-btn').on('click', function() {
                    const recordId = $(this).data('id');
                    editRecord(recordId);
                });

                // Delete button
                $('.delete-btn').on('click', function() {
                    const recordId = $(this).data('id');
                    deleteRecord(recordId);
                });
            }

            // Initial attachment of event listeners
            attachEventListeners();

            // View record function
            function viewRecord(id) {
                // Fetch record data from your API
                fetch(`/api/child-laborers/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            const modalContent = document.getElementById('quickViewContent');
                            
                            modalContent.innerHTML = `
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-muted mb-3">Personal Information</h6>
                                        <div class="mb-2">
                                            <strong>Full Name:</strong><br>
                                            ${data.last_name || ''}, ${data.first_name || ''} ${data.middle_name || ''}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Sex:</strong><br>
                                            ${data.sex || ''}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Date of Birth:</strong><br>
                                            ${data.date_of_birth ? new Date(data.date_of_birth).toLocaleDateString() : ''}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Age:</strong><br>
                                            ${data.age || ''}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-muted mb-3">Location Information</h6>
                                        <div class="mb-2">
                                            <strong>Province:</strong><br>
                                            ${data.province || ''}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Barangay:</strong><br>
                                            ${data.barangay || ''}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Address:</strong><br>
                                            ${data.address || 'N/A'}
                                        </div>
                                    </div>
                                </div>
                                ${data.notes ? `
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="text-muted mb-2">Additional Notes</h6>
                                        <div class="border rounded p-3 bg-light">
                                            ${data.notes}
                                        </div>
                                    </div>
                                </div>
                                ` : ''}
                            `;

                            // Set up edit button
                            document.getElementById('editRecordBtn').onclick = function() {
                                editRecord(id);
                            };

                            // Show modal
                            const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
                            modal.show();
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching record:', error);
                        alert('Error loading record data');
                    });
            }

            // Edit record function
            function editRecord(id) {
                // Close the view modal if open
                const viewModal = bootstrap.Modal.getInstance(document.getElementById('quickViewModal'));
                if (viewModal) {
                    viewModal.hide();
                }

                // Here you would typically open your edit modal
                // For now, we'll show an alert and refresh the table
                alert(`Edit functionality for record ${id} would be implemented here. This would open your edit modal.`);
                
                // In a real implementation, you would:
                // 1. Fetch the record data
                // 2. Populate your edit modal
                // 3. Show the edit modal
            }

            // Delete record function
            function deleteRecord(id) {
                if (confirm('Are you sure you want to delete this record? This action cannot be undone.')) {
                    fetch(`/api/child-laborers/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Refresh DataTable
                            table.ajax.reload();
                            alert('Record deleted successfully!');
                        } else {
                            alert('Error deleting record: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error deleting record');
                    });
                }
            }

            // Listen for Livewire events when new records are added
            document.addEventListener('livewire:load', function() {
                // Refresh table when your Livewire modal is closed (assuming successful add)
                const addModal = document.getElementById('addAuditModalComponent');
                if (addModal) {
                    addModal.addEventListener('hidden.bs.modal', function() {
                        // Refresh the table to show newly added records
                        table.ajax.reload(null, false); // false means don't reset paging
                    });
                }
            });
        });
    </script>
</body>
</html>