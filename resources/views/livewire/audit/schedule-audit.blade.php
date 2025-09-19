<div class="card card-flush mb-6 mb-xl-9">
    <!-- Card Header -->
    <div class="card-header mt-6 d-flex justify-content-between align-items-center">
        <div class="card-title flex-column">
            <h2 class="mb-1">Audit Schedule</h2>
        </div>
        <!-- Save All Button inside the Form -->
        <button type="submit" form="auditScheduleForm" class="btn btn-success">Save All</button>
    </div>

    <!-- Card Body -->
    <div class="card-body p-9 pt-4">
        <form id="auditScheduleForm" wire:submit.prevent="saveAll">
            @foreach($auditExecutions as $index => $auditExecution)
                <div class="border rounded p-4 mb-4">
                    <h5 class="mb-3">Schedule #{{ $index + 1 }}</h5>
                    
                    <!-- Office Dropdown -->
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="aex_office_{{ $index }}" class="form-label">Office</label>
                                <select wire:model="auditExecutions.{{ $index }}.aex_office" id="aex_office_{{ $index }}" class="form-select">
                                    <option value="">Select Office</option>
                                    @foreach($offices->groupBy('category') as $category => $groupedOffices)
                                        <optgroup label="{{ $category }}">
                                            @foreach($groupedOffices as $office)
                                                <option value="{{ $office->id }}">{{ $office->office_name }} ({{ $office->shortname }})</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error("auditExecutions.$index.aex_office") 
                                    <div class="text-danger small">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="fk_aep{{ $index }}" class="form-label">Engagement Plan</label>
                            <select wire:model="auditExecutions.{{ $index }}.fk_aep" id="fk_aep{{ $index }}" class="form-select">
                                <option value="">Select Engagement Plan</option>
                                @foreach($auditEngagementPlans as $engagementPlan)
                                    <option value="{{ $engagementPlan->aep_id }}">{{ $engagementPlan->aep_activity }}</option>
                                @endforeach
                            </select>
                            @error("auditExecutions.$index.fk_aep") 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror
                        </div>
                    </div>


                    <!-- Date Range Picker -->
                    <div class="mb-3">
                        <label for="aex_date_range_{{ $index }}" class="form-label">Schedule</label>
                        <input type="text" 
                            id="aex_date_range_{{ $index }}" 
                            class="form-control flatpickrzz" 
                            wire:model.defer="auditExecutions.{{ $index }}.aex_date_range"
                            placeholder="Select date range"
                            data-index="{{ $index }}">
                        @error("auditExecutions.$index.aex_date_range") 
                            <div class="text-danger small">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Specifics Repeater -->
                    <div class="mb-3">
                        <label class="form-label">Specifics</label>
                        @foreach($auditExecution['specifics'] as $specificIndex => $specific)
                            <div class="input-group mb-2">
                                <input wire:model="auditExecutions.{{ $index }}.specifics.{{ $specificIndex }}" type="text" class="form-control" placeholder="Enter Specific">
                                <button type="button" wire:click="removeSpecific({{ $index }}, {{ $specificIndex }})" class="btn btn-danger">Remove</button>
                                @if ($specificIndex === count($auditExecution['specifics']) - 1)
                                    <button 
                                        type="button" 
                                        wire:click="addSpecific({{ $index }})" 
                                        class="btn btn-success ms-2"
                                        title="Add Specific"
                                    >
                                        +
                                    </button>
                                @endif
                            </div>
                        @endforeach
                        @error("auditExecutions.$index.specifics.*") 
                            <div class="text-danger small">{{ $message }}</div> 
                        @enderror
                    </div>

                    <!-- Remove Form Button -->
                    <div class="d-flex justify-content-end">
                        <button 
                            type="button" 
                            wire:click="removeAuditExecution({{ $index }})" 
                            class="btn btn-danger btn-sm"
                        >
                            Remove This Form
                        </button>
                    </div>
                </div>
            @endforeach
        </form>

        <!-- Add Audit Schedule Button -->
        <div class="d-flex justify-content-center">
            <button 
                type="button" 
                wire:click="addAuditExecution" 
                class="btn btn-success">
                Add Audit Schedule
            </button>
        </div>

        <!-- Success Message -->
        @if (session()->has('message'))
            <div class="alert alert-success mt-3">
                {{ session('message') }}
            </div>
        @endif
    </div>

</div>
