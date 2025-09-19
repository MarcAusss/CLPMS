<div wire:ignore.self id="addAuditModalComponent" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xxl">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_add_audit_header">
                <h2 class="fw-bold">Add Child Laborer</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross', 'fs-1') !!}
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <form class="form w-lg-1000px mx-auto" wire:submit.prevent="save">
                    <div class="stepper stepper-pills">
                        <div class="stepper-nav flex-center flex-wrap mb-10">
                            @for ($i = 1; $i <= $totalSteps; $i++)
                                <div class="stepper-item mx-4 my-4 @if ($currentStep == $i) current @endif">
                                    <div class="stepper-wrapper d-flex align-items-center" wire:click="gotoStep({{ $i }})">
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">{{ $i }}</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Step {{ $i }}</h3>
                                            <p class="stepper-description">
                                                {{ $stepDescriptions[$i] ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                    @if ($i < $totalSteps)
                                        <div class="stepper-line h-40px"></div>
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>

                    @for ($i = 1; $i <= $totalSteps; $i++)
                        <div class="step-content @if ($currentStep == $i) d-block @else d-none @endif" data-step="{{ $i }}">
                            @include('livewire.profiling.steps.step' . $i)
                        </div>
                    @endfor

                    <div class="d-flex flex-stack pt-10">
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3" wire:click="previousStep" @if($currentStep == 1) disabled @endif>
                                <i class="ki-duotone ki-arrow-left fs-4 me-1"></i>Previous
                            </button>
                        </div>
                        <div>
                            @if($currentStep < $totalSteps)
                            <button type="button" class="btn btn-lg btn-primary" wire:click="nextStep">
                                <span class="indicator-label">Next</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            @else
                            <button type="submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                            @endif
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