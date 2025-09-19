<div class="card">
    <div class="card-body">
        @foreach ($workEntries as $index => $entry)
            <div class="border p-4 mb-3 rounded shadow-sm bg-light">
                <h4 class="fw-bold text-primary">Work Entry #{{ $index + 1 }}</h4>

                <div class="row">
                    <!-- Nature of Work -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label fw-semibold">Nature of Work*</label>
                        <select wire:model="workEntries.{{ $index }}.nature_of_work" class="form-select">
                            <option value="">Select Work Type</option>
                            @foreach (['Mining', 'Quarrying', 'Construction', 'Transportation and Storage', 'Waste Management', 'Forestry and Logging', 'Fishing', 'Farming', 'Domestic', 'Manufacturing', 'Pyrotechnics Production', 'Online Sexual Exploitation of Children (OSEC)', 'Children in Prostitution', 'Others'] as $workType)
                                <option value="{{ $workType }}">{{ $workType }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if (isset($entry['nature_of_work']) && $entry['nature_of_work'] == 'Others')
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-semibold">Specify Other Work</label>
                            <input type="text" wire:model="workEntries.{{ $index }}.nature_of_work_other"
                                class="form-control" placeholder="Specify work type">
                        </div>
                    @endif
                </div>


                <div class="row">
                    <!-- Work Location -->
                    <div class="mb-3 col-md-6">
                        <label class="form-label fw-semibold">Work Location*</label>
                        <select wire:model="workEntries.{{ $index }}.work_location" class="form-select">
                            <option value="">Select Location</option>
                            @foreach (['Own House', 'Employer’s House', 'Office', 'Factory', 'Farm', 'Street', 'Market Place', 'Mining Site', 'Construction Site', 'Quarry Site', 'Open Sea', 'River/Lake', 'Others'] as $location)
                                <option value="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if (isset($entry['work_location']) && $entry['work_location'] == 'Others')
                        <div class="mb-3 col-md-6">
                            <label class="form-label fw-semibold">Specify Other Location</label>
                            <input type="text" wire:model="workEntries.{{ $index }}.work_location_other"
                                class="form-control">
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Specific Tasks</label>
                        <textarea wire:model="workEntries.{{ $index }}.specific_tasks" class="form-control"
                            placeholder="Describe specific tasks"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Employer Name</label>
                        <input type="text" wire:model="workEntries.{{ $index }}.employer_name"
                            class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Employer Contact</label>
                        <input type="text" wire:model="workEntries.{{ $index }}.employer_contact"
                            class="form-control">
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label fw-semibold">Work Basis*</label>
                        <select wire:model="workEntries.{{ $index }}.work_basis" class="form-select">
                            <option value="">Select Basis</option>
                            <option value="Daily">Daily</option>
                            <option value="Seasonal">Seasonal</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <!-- Work Basis -->
                    

                    @if (isset($entry['work_basis']) && $entry['work_basis'] == 'Seasonal')
                        <div class="mb-3 col-md-12">
                            <label class="form-label fw-semibold">Specify Months of Work</label>
                            <div class="row">
                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                wire:model.defer="workEntries.{{ $index }}.work_months"
                                                value="{{ $month }}" class="form-check-input">
                                            <label class="form-check-label">{{ $month }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="employer_region" class="form-label fw-semibold">Region</label>
                        <select wire:model="employer_region" class="form-select">
                            <option value="" selected disabled>Region</option>
                            @foreach($employer_regions as $region)
                                <option value="{{ $region->region_code }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="employer_province" class="form-label fw-semibold">Province</label>
                        <select wire:model="employer_province" class="form-select">
                            <option value="" selected disabled>Province</option>
                            @foreach($employer_provinces as $province)
                                <option value="{{ $province->province_code }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="employer_city" class="form-label fw-semibold">City/Municipality</label>
                        <select wire:model="employer_city" class="form-select">
                            <option value="" selected disabled>City/Municipality</option>
                            @foreach($employer_cities as $city)
                                <option value="{{ $city->city_code }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="employer_region" class="form-label fw-semibold">Barangay</label>
                        <select wire:model="employer_barangay" class="form-select">
                            <option value="" selected disabled>Barangay</option>
                            @foreach($employer_barangays as $barangay)
                                <option value="{{ $barangay->psgc_code }}">{{ $barangay->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    @if (isset($entry['work_basis']) && $entry['work_arrangement'] == 'Others')
                        <div class="col-md-3">
                    @endif
                    <label class="form-label fw-semibold">Work Arrangement</label>
                    <select wire:model="workEntries.{{ $index }}.work_arrangement" class="form-select">
                        <option value ="" selected disabled>Select a work arrangement</option>>
                        <option value="Paid worker in own household-operated farm or business">Paid worker in own
                            household-operated farm or business</option>
                        <option value="Paid worker by an employer, financier or landowner">Paid worker by an employer,
                            financier or landowner</option>
                        <option value="Worker without pay in own family - operated farm or business">Worker without pay
                            in own family-operated farm or business</option>
                        <option value="Self-employed">Self-Employed</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                @if (isset($entry['work_basis']) && $entry['work_arrangement'] == 'Others')
                    <div class="col-md-3">
                        <label for="asdf">Specify</label>
                        <input type="text" wire:model="workEntries.{{ $index }}.work_arrangement"
                            class="form-control">
                    </div>
                @endif
            </div>


            <!-- Working Hours -->
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label class="form-label fw-semibold">Hours Per Day</label>
                    <input type="number" wire:model="workEntries.{{ $index }}.working_hours_per_day"
                        class="form-control">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label fw-semibold">Days Per Week</label>
                    <input type="number" wire:model="workEntries.{{ $index }}.working_days_per_week"
                        class="form-control">
                </div>
            </div>


            <div class="row">
                <!-- Time of Work -->
                <div class="mb-3 col-md-6">
                    <label class="form-label fw-semibold">Time of Work (Start)</label>
                    <input type="time" wire:model="workEntries.{{ $index }}.work_start_time"
                        class="form-control">
                </div>
                <div class="mb-3 col-md-6">
                    <label class="form-label fw-semibold">Time of Work (End)</label>
                    <input type="time" wire:model="workEntries.{{ $index }}.work_end_time"
                        class="form-control">
                </div>
            </div>

            <div class="row">
                <!-- Age Started Working -->
                <div class="mb-3 col-md-6">
                    <label class="form-label fw-semibold">Age Started Working*</label>
                    <input type="number" wire:model="workEntries.{{ $index }}.age_started_working"
                        class="form-control">
                </div>

                <!-- Payment Basis -->
                <div class="mb-3 col-md-6">
                    <label class="form-label fw-semibold">Payment Basis</label>
                    <select wire:model="workEntries.{{ $index }}.payment_basis" class="form-select">
                        <option value="">Select Basis</option>
                        @foreach (['Hourly', 'Daily', 'Weekly', 'Monthly', 'Per Gram', 'Per Piece', 'Per Task or Pakyaw', 'In Kind', 'Commission Basis', 'Others'] as $basis)
                            <option value="{{ $basis }}">{{ $basis }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Exposure to Risks (Checkboxes) -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Exposure to Risks</label>
                <div class="row">
                    @foreach (['Exposure to Chemicals', 'Physical Injuries', 'Suffocation', 'Extreme Weather', 'Health Complications', 'Accident-prone Areas', 'Drowning'] as $risk)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox"
                                    wire:model.defer="workEntries.{{ $index }}.exposure_risks"
                                    value="{{ $risk }}" class="form-check-input">
                                <label class="form-check-label">{{ $risk }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- Average Monthly Income -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">How much is your average monthly income in Php?</label>
                        <input type="number" wire:model="workEntries.{{ $index }}.average_monthly_income"
                            class="form-control">
                    </div>
                    <!-- Adult Supervision -->
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Does an adult supervise your work?</label>
                        <select wire:model="workEntries.{{ $index }}.has_adult_supervisor"
                            class="form-select">
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>

            @if (isset($entry['has_adult_supervisor']) && $entry['has_adult_supervisor'] == 'Yes')
                <div class="row">
                    <!-- Who Supervises Your Work -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Who supervises your work?</label>
                            <div class="row">
                                @foreach (['Parent/Guardian', 'Elder Brother or Sister', 'Other Relatives', 'Employer', 'Friends'] as $supervisor)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox"
                                                wire:model.defer="workEntries.{{ $index }}.work_supervisors"
                                                value="{{ $supervisor }}" class="form-check-input">
                                            <label class="form-check-label">{{ $supervisor }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input type="checkbox"
                                            wire:model.defer="workEntries.{{ $index }}.work_supervisors"
                                            value="Others" class="form-check-input">
                                        <label class="form-check-label">Others</label>
                                    </div>
                                    <input type="text"
                                        wire:model="workEntries.{{ $index }}.work_supervisors_other"
                                        class="form-control mt-2" placeholder="Specify if others">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Name of Supervisor -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name of Supervisor</label>
                            <input type="text" wire:model="workEntries.{{ $index }}.supervisor_name"
                                class="form-control">
                        </div>
                    </div>
                </div>
            @endif


            <!-- What do you usually do with your earnings? -->
            <div class="mb-3">
                <label class="form-label fw-semibold">What do you usually do with your earnings?</label>
                <div class="row">
                    @foreach (['Give all or part of earnings to my parents/guardian', 'Employer gives all or part of my earnings to my parents/guardian', 'Pay for my tuition fees', 'Buy things for school', 'Buy things for household needs and use', 'Buy things for myself', 'Spent for basic needs', 'Save'] as $usage)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox"
                                    wire:model.defer="workEntries.{{ $index }}.earnings_usage"
                                    value="{{ $usage }}" class="form-check-input">
                                <label class="form-check-label">{{ $usage }}</label>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-6">
                        <div class="form-check">
                            <input type="checkbox" wire:model.defer="workEntries.{{ $index }}.earnings_usage"
                                value="Others" class="form-check-input">
                            <label class="form-check-label">Others</label>
                        </div>
                        <input type="text" wire:model="workEntries.{{ $index }}.earnings_usage_other"
                            class="form-control mt-2" placeholder="Specify if others">
                    </div>
                </div>
            </div>



            <!-- Remove Entry Button -->
            <div class="text-end mt-3">
                <button wire:click="removeWorkEntry({{ $index }})" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i> Remove Entry
                </button>
            </div>

        @endforeach
    </div>

    <div class="text-end mt-3">
        <button type="button" wire:click="addWorkEntry" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Work Entry
        </button>
    </div>
</div>
