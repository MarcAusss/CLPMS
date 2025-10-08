<div wire:ignore.self id="addAuditModalComponent" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_audit_header">
                <h2 class="fw-bold">Add Child Laborer</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross', 'fs-1') !!}
                </div>
            </div>
            <div class="modal-body p-0">
                <form class="form" wire:submit.prevent="save">
                    <!-- Compact Stepper -->
                    <div class="stepper stepper-pills bg-light-primary px-6 py-4">
                        <div class="stepper-nav flex-center flex-nowrap overflow-auto pb-2">
                            @for ($i = 1; $i <= $totalSteps; $i++)
                                <div class="stepper-item mx-2 @if ($currentStep == $i) current @endif" style="min-width: 120px;">
                                    <div class="stepper-wrapper d-flex align-items-center cursor-pointer" wire:click="gotoStep({{ $i }})">
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

                    <!-- Form Content with Better Spacing -->
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
                                <button type="button" class="btn btn-light-primary" wire:click="previousStep" @if($currentStep == 1) disabled @endif>
                                    <i class="ki-duotone ki-arrow-left fs-4 me-1"></i>Previous
                                </button>
                            </div>
                            <div>
                                @if($currentStep < $totalSteps)
                                <button type="button" class="btn btn-primary" wire:click="nextStep">
                                    <span class="indicator-label">Next</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                @else
                                <button type="submit" class="btn btn-success">
                                    <span class="indicator-label">Submit Profile</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', () => {
            initializeFlatpickr();
        });

        function initializeFlatpickr() {
            document.querySelectorAll('.dateflatpickr').forEach(input => {
                flatpickr(input, {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "F j, Y"
                });
            });
        }
        initializeFlatpickr();
    });
</script>
@endpush