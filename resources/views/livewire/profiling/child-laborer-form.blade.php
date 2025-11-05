<div wire:ignore.self class="modal fade" id="addAuditModalComponent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_audit_header">
                <h2 class="fw-bold">Add Child Laborer</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross', 'fs-1') !!}
                </div>
            </div>
            <div class="modal-body p-0">
                <!-- Compact Stepper -->
                <div class="stepper stepper-pills bg-light-primary px-6 py-4">
                    <div class="stepper-nav flex-center flex-nowrap overflow-auto pb-2">
                        @for ($i = 1; $i <= $totalSteps; $i++)
                            <div class="stepper-item mx-2 @if ($currentStep == $i) current @endif" style="min-width: 120px;">
                                <div class="stepper-wrapper d-flex align-items-center">
                                    <div class="stepper-icon w-32px h-32px">
                                        <i class="stepper-check fas fa-check fs-5"></i>
                                        <span class="stepper-number fs-6">{{ $i }}</span>
                                    </div>
                                    <div class="stepper-label ms-2">
                                        <h3 class="stepper-title fs-7 fw-bold mb-0">Step {{ $i }}</h3>
                                        <p class="stepper-description fs-8 text-muted mb-0">
                                            {{ $stepDescriptions[$i] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                                @if ($i < $totalSteps)
                                    <div class="stepper-line h-32px"></div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Form Content -->
                <div class="px-6 py-4" style="max-height: 60vh; overflow-y: auto;">
                    @for ($i = 1; $i <= $totalSteps; $i++)
                        <div class="step-content @if ($currentStep == $i) d-block @else d-none @endif" data-step="{{ $i }}">
                            @include('livewire.profiling.steps.step' . $i)
                        </div>
                    @endfor
                </div>

                <!-- Footer Buttons -->
                <div class="modal-footer bg-light px-6 py-4">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <button type="button" class="btn btn-light-primary" 
                                    wire:click="previousStep" 
                                    @if($currentStep == 1) disabled @endif>
                                <i class="ki-duotone ki-arrow-left fs-4 me-1"></i>Previous
                            </button>
                        </div>
                        <div>
                            @if($currentStep < $totalSteps)
                                <button type="button" class="btn btn-primary" wire:click="nextStep">
                                    <span class="indicator-label">Next</span>
                                </button>
                            @else
                                <button type="button" class="btn btn-success" wire:click="save">
                                    <span class="indicator-label">Submit Profile</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        console.log('✅ Livewire form loaded successfully');
        
        // Debug button clicks
        document.addEventListener('click', function(e) {
            if (e.target.closest('button[wire\\:click="save"]')) {
                console.log('🎯 SAVE BUTTON CLICKED - Livewire should trigger save()');
            }
            if (e.target.closest('button[wire\\:click="nextStep"]')) {
                console.log('➡️ NEXT button clicked');
            }
            if (e.target.closest('button[wire\\:click="previousStep"]')) {
                console.log('⬅️ PREVIOUS button clicked');
            }
        });

        // Listen for success/error popups from backend
        window.addEventListener('swal:modal', (e) => {
            const d = e.detail || {};
            if (window.Swal) {
                Swal.fire({
                    title: d.title || 'Notice',
                    text: d.text || '',
                    icon: d.icon || 'info',
                    timer: d.timer || undefined,
                    showConfirmButton: d.showConfirmButton ?? true,
                });
            } else {
                alert((d.title ? d.title + ': ' : '') + (d.text || ''));
            }
        });

        // Close bootstrap modal on event
        window.addEventListener('close-modal', () => {
            const modalEl = document.getElementById('addAuditModalComponent');
            if (modalEl && window.bootstrap) {
                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                modal.hide();
            }
        });

        // Refresh Livewire-powered tables on event
        window.addEventListener('table-refresh', () => {
            // If your list is a Livewire component, emit to it or trigger a browser refresh.
            // Example: Livewire.emit('refreshChildLaborersTable');
            // Or if using DataTables:
            if (window.jQuery && jQuery.fn.DataTable) {
                const tbl = jQuery('#child-laborers-table').DataTable();
                if (tbl) tbl.ajax && tbl.ajax.reload(null, false);
            }
        });

        // Livewire lifecycle hooks for debugging
        Livewire.hook('message.sent', (message, component) => {
            console.log('📤 Livewire message sent:', message.component.id, message.updateQueue);
        });

        Livewire.hook('message.processed', (message, component) => {
            console.log('✅ Livewire message processed');
        });

        Livewire.hook('message.failed', (message, component) => {
            console.log('❌ Livewire message failed:', message);
        });

        Livewire.hook('element.updating', (fromEl, toEl, component) => {
            console.log('🔄 Livewire element updating');
        });

        // Simple flatpickr initialization
        setTimeout(() => {
            const flatpickrInputs = document.querySelectorAll('.dateflatpickr');
            if (flatpickrInputs.length > 0 && typeof flatpickr !== 'undefined') {
                flatpickrInputs.forEach(input => {
                    try {
                        flatpickr(input, {
                            dateFormat: "Y-m-d",
                            altInput: true,
                            altFormat: "F j, Y"
                        });
                    } catch (e) {
                        console.error('Flatpickr error:', e);
                    }
                });
            }
        }, 500);
    });

    // Global error handler
    window.addEventListener('livewire:error', (event) => {
        console.error('🚨 Livewire global error:', event.detail);
    });
</script>
@endpush