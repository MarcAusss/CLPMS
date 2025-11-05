// public/js/cl-profiling.js
$(document).ready(function() {
    // Initialize DataTables with your server-side processing
    const table = $('#childLaborersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: ROUTES.datatable,
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
                    let badgeClass = 'badge badge-light-';
                    switch(data) {
                        case 'Active':
                            badgeClass += 'success';
                            break;
                        case 'Inactive':
                            badgeClass += 'danger';
                            break;
                        case 'Pending':
                            badgeClass += 'warning';
                            break;
                        default:
                            badgeClass += 'warning';
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
                            <button type="button" class="btn btn-sm btn-icon btn-light-primary view-btn" data-id="${row.id}" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-light-warning edit-btn" data-id="${row.id}" title="Edit Record">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-icon btn-light-danger delete-btn" data-id="${row.id}" title="Delete Record">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        language: {
            emptyTable: '<div class="text-center py-10"><i class="fas fa-database fs-4x text-gray-300 mb-4"></i><h4 class="text-gray-600">No records found</h4><p class="text-gray-500">There are no CL records in the system yet.</p></div>'
        },
        drawCallback: function(settings) {
            // Re-attach event listeners after table redraw
            attachEventListeners();
        }
    });

    // Search functionality
    $('#searchInput').on('keyup', function(event) {
        if (event.key === 'Enter') {
            table.search(this.value).draw();
        }
    });

    // Export buttons would be implemented here
    $('#excelBtn').on('click', function() {
        alert('Excel export functionality would be implemented here');
    });

    $('#csvBtn').on('click', function() {
        alert('CSV export functionality would be implemented here');
    });

    $('#pdfBtn').on('click', function() {
        alert('PDF export functionality would be implemented here');
    });

    $('#printBtn').on('click', function() {
        window.print();
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

    // View record function
    function viewRecord(id) {
        const url = ROUTES.childLaborers.show.replace(':id', id);
        
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
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
                                    <strong>Contact Number:</strong><br>
                                    ${data.contact_number || 'N/A'}
                                </div>
                                <div class="mb-2">
                                    <strong>Guardian Name:</strong><br>
                                    ${data.guardian_name || 'N/A'}
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

        alert(`Edit functionality for record ${id} would be implemented here.`);
    }

    // Delete record function
    function deleteRecord(id) {
        if (confirm('Are you sure you want to delete this record? This action cannot be undone.')) {
            const url = ROUTES.childLaborers.destroy.replace(':id', id);
            
            fetch(url, {
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

    // Initial attachment of event listeners
    attachEventListeners();
});