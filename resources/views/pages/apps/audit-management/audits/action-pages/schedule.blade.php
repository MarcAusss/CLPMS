<x-default-layout>
    @section('title')
        Audit Evaluation
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('audit.schedule', $audit) }}
    @endsection

    <livewire:audit.schedule-audit :audit="$audit" />

    <div class="card">
        <div class="card-body p-9 pt-4">
                {{ $dataTable->table(['class' => 'table table-striped table-bordered']) }}
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush
    <script>
        document.addEventListener('livewire:load', () => {
            Livewire.on('showAlert', (type, message) => {
                Swal.fire({
                    icon: type,
                    title: type === 'success' ? 'Success' : 'Error',
                    text: message,
                    confirmButtonText: 'OK',
                });
            });

            Livewire.on('refreshDatatable', () => {
                // Trigger DataTable reload or redraw
                $('#schedule-audits-table').DataTable().ajax.reload();
            });

            // Initialize Flatpickr for all inputs with the class 'flatpickr'
            Livewire.hook('message.processed', () => {
                const dateRangeInputs = document.querySelectorAll('.flatpickrzz'); 
                dateRangeInputs.forEach(input => {
                    flatpickr(input, {
                        mode: "range", 
                        dateFormat: "Y-m-d", 
                        altInput: true, 
                        altFormat: "F j, Y" 
                    });
                });
            });
        });
    </script>
    
</x-default-layout>
