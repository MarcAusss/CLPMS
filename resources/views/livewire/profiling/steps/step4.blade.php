<div class="card">
    <div class="card-body">
        <h4 class="fw-bold text-primary mb-4">Work Information</h4>
        
        @foreach($workEntries as $index => $entry)
        <div class="work-entry border rounded p-3 mb-4">
            @if($index > 0)
            <div class="text-end mb-2">
                <button type="button" wire:click="removeWorkEntry({{ $index }})" class="btn btn-sm btn-danger">
                    <i class="fas fa-times"></i> Remove
                </button>
            </div>
            @endif
            
            <h6 class="fw-semibold text-muted">Work Entry #{{ $index + 1 }}</h6>
            
            <!-- Nature of Work -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nature of Work *</label>
                    <select wire:model="workEntries.{{ $index }}.nature_of_work" class="form-select">
                        <option value="">Select Work Type</option>
                        <option value="Mining">Mining</option>
                        <option value="Quarrying">Quarrying</option>
                        <option value="Construction">Construction</option>
                        <option value="Transportation">Transportation</option>
                        <option value="Fishing">Fishing</option>
                        <option value="Farming">Farming</option>
                        <option value="Domestic">Domestic</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Others">Others</option>
                    </select>
                    @error("workEntries.{$index}.nature_of_work") <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Work Location/Address *</label>
                    <input type="text" wire:model="workEntries.{{ $index }}.work_location" class="form-control" placeholder="Enter work location or address">
                    @error("workEntries.{$index}.work_location") <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Age and Hours -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Age Started Working *</label>
                    <input type="number" wire:model="workEntries.{{ $index }}.age_started_working" class="form-control" min="1" max="99">
                    @error("workEntries.{$index}.age_started_working") <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Hours Per Day *</label>
                    <input type="number" wire:model="workEntries.{{ $index }}.working_hours_per_day" class="form-control" min="1" max="24">
                    @error("workEntries.{$index}.working_hours_per_day") <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Days Per Week *</label>
                    <input type="number" wire:model="workEntries.{{ $index }}.working_days_per_week" class="form-control" min="1" max="7">
                    @error("workEntries.{$index}.working_days_per_week") <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Work Schedule -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Work Start Time</label>
                    <input type="time" wire:model="workEntries.{{ $index }}.work_start_time" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Work End Time</label>
                    <input type="time" wire:model="workEntries.{{ $index }}.work_end_time" class="form-control">
                </div>
            </div>

            <!-- Work Arrangement -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Work Arrangement</label>
                    <select wire:model="workEntries.{{ $index }}.work_arrangement" class="form-select">
                        <option value="">Select Arrangement</option>
                        <option value="Paid Worker">Paid Worker</option>
                        <option value="Unpaid Worker">Unpaid Worker</option>
                        <option value="Self-Employed">Self-Employed</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Specific Tasks</label>
                    <input type="text" wire:model="workEntries.{{ $index }}.specific_tasks" class="form-control" placeholder="Describe specific tasks">
                </div>
            </div>

            <!-- Employer Information -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Employer Name</label>
                    <input type="text" wire:model="workEntries.{{ $index }}.employer_name" class="form-control" placeholder="Employer's name">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Employer Contact</label>
                    <input type="text" wire:model="workEntries.{{ $index }}.employer_contact" class="form-control" placeholder="Contact number">
                </div>
            </div>

            <!-- Payment and Income -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Payment Basis</label>
                    <input type="text" wire:model="workEntries.{{ $index }}.payment_basis" class="form-control" placeholder="e.g., Daily, Weekly, Monthly">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Average Monthly Income (₱)</label>
                    <input type="number" step="0.01" wire:model="workEntries.{{ $index }}.average_monthly_income" class="form-control" placeholder="0.00">
                </div>
            </div>

            <!-- Supervisor Information -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Has Adult Supervisor?</label>
                    <select wire:model="workEntries.{{ $index }}.has_adult_supervisor" class="form-select">
                        <option value="">Select</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Supervisor Name</label>
                    <input type="text" wire:model="workEntries.{{ $index }}.supervisor_name" class="form-control" placeholder="Supervisor's name">
                </div>
            </div>

            <!-- Supervisor Relationship -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Supervisor Relationship</label>
                    <select wire:model="workEntries.{{ $index }}.work_supervisors" class="form-select">
                    <option value="">Select Relationship</option>
                    <option value="Parent/Guardian">Parent/Guardian</option>
                    <option value="Elder Sibling">Elder Sibling</option>
                    <option value="Employer">Employer</option>
                    <option value="Others">Others</option>
                </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Earnings Usage</label>
                    <input type="text" wire:model="workEntries.{{ $index }}.earnings_usage" class="form-control" placeholder="How earnings are used">
                </div>
            </div>

            <!-- Exposure Risks -->
            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Exposure Risks</label>
                    <input type="text" wire:model="workEntries.{{ $index }}.exposure_risks" class="form-control" placeholder="Describe any work risks or hazards">
                </div>
            </div>
        </div>
        @endforeach

        <!-- Add/Remove buttons -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <small class="text-muted">Current work entries: {{ count($workEntries) }}</small>
            </div>
            <div>
                <button type="button" wire:click="addWorkEntry" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Another Work Entry
                </button>
            </div>
        </div>
    </div>
</div>