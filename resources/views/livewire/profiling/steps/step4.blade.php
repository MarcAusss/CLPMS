<div class="card">
    <div class="card-body">
        <h4 class="fw-bold text-primary mb-4">Work Information</h4>
        
        <!-- Simple test fields -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nature of Work</label>
                <select wire:model="workEntries.0.nature_of_work" class="form-select">
                    <option value="">Select Work Type</option>
                    <option value="Farming">Farming</option>
                    <option value="Domestic">Domestic</option>
                    <option value="Construction">Construction</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Work Location</label>
                <select wire:model="workEntries.0.work_location" class="form-select">
                    <option value="">Select Location</option>
                    <option value="Own House">Own House</option>
                    <option value="Farm">Farm</option>
                    <option value="Construction Site">Construction Site</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Age Started Working</label>
                <input type="number" wire:model="workEntries.0.age_started_working" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Hours Per Day</label>
                <input type="number" wire:model="workEntries.0.working_hours_per_day" class="form-control">
            </div>
        </div>

        <!-- Simple add button -->
        <div class="text-end mt-4">
            <button type="button" wire:click="addWorkEntry" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Another Work Entry
            </button>
        </div>

        <!-- Display current work entries count -->
        <div class="mt-3">
            <small class="text-muted">Current work entries: {{ count($workEntries) }}</small>
        </div>
    </div>
</div>