<!-- STEP 1: PERSONAL INFORMATION - FINAL SIMPLE VERSION -->

<div class="form-section">
    <h4>Personal Details</h4>
    
    <div class="row mb-2">
        <div class="col-md-3">
            <label class="form-label required-field">First Name</label>
            <input type="text" wire:model.defer="first_name" class="form-control" required>
            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Middle Name</label>
            <input type="text" wire:model.defer="middle_name" class="form-control">
            @error('middle_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label required-field">Last Name</label>
            <input type="text" wire:model.defer="last_name" class="form-control" required>
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-1">
            <label class="form-label">Suffix</label>
            <input type="text" wire:model.defer="suffix" class="form-control">
            @error('suffix') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label required-field">Sex</label>
            <select wire:model.defer="sex" class="form-select" required>
                <option value="">Select Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            @error('sex') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    
    <div class="row mb-5">
        <div class="col-md-4">
            <label class="form-label required-field">Date of Birth</label>
            <input type="date" wire:model="date_of_birth" class="form-control" required>
            @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label">Age</label>
            <input type="number" wire:model.defer="age" class="form-control readonly-field" readonly>
            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-6">
            <label class="form-label required-field">Birth Certificate</label>
            <select wire:model.defer="birth_certificate" class="form-select" required>
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error('birth_certificate') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
</div>

<!-- HOME ADDRESS SECTION -->
<div class="form-section">
    <div class="row">
        <h4>Home Address</h4>
    </div>

    <div class="row mb-2">
        <div class="col-md-12">
            <label for="address_sitio" class="form-label required-field">Specific Address (House No., Street, Sitio/Purok)</label>
            <input type="text" wire:model.defer="address_sitio" id="address_sitio" class="form-control" placeholder="e.g., Block 5 Lot 12, Purok 3" required>
            @error('address_sitio') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    
    <div class="row mb-5">
        <!-- Region -->
        <div class="col-md-3">
            <label for="address_region" class="form-label fw-semibold required-field">Region</label>
            <select wire:model="address_region" 
                    id="address_region"
                    class="form-select @error('address_region') is-invalid @enderror" 
                    required>
                <option value="">Select Region</option>
                @foreach($address_regions as $region)
                    <option value="{{ $region->region_code }}">{{ $region->name }}</option>
                @endforeach
            </select>
            @error('address_region') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Province -->
        <div class="col-md-3">
            <label for="address_province" class="form-label fw-semibold required-field">Province</label>
            <select wire:model="address_province" 
                    id="address_province"
                    class="form-select @error('address_province') is-invalid @enderror" 
                    {{ empty($address_provinces) ? 'disabled' : '' }} 
                    required>
                <option value="">Select Province</option>
                @foreach($address_provinces as $province)
                    <option value="{{ $province->province_code }}">{{ $province->name }}</option>
                @endforeach
            </select>
            @error('address_province') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- City -->
        <div class="col-md-3">
            <label for="address_city" class="form-label fw-semibold required-field">City/Municipality</label>
            <select wire:model="address_city" 
                    id="address_city"
                    class="form-select @error('address_city') is-invalid @enderror" 
                    {{ empty($address_cities) ? 'disabled' : '' }} 
                    required>
                <option value="">Select City/Municipality</option>
                @foreach($address_cities as $city)
                    <option value="{{ $city->city_code }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('address_city') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Barangay - TEXT INPUT -->
        <div class="col-md-3">
            <label for="address_barangay" class="form-label fw-semibold required-field">Barangay</label>
            <input type="text"
                   id="address_barangay"
                   wire:model.defer="address_barangay"
                   class="form-control @error('address_barangay') is-invalid @enderror"
                   placeholder="Enter Barangay"
                   required>
            @error('address_barangay')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- PLACE OF BIRTH SECTION -->
<div class="form-section">
    <div class="row mb-2">
        <div class="col-md-2">
            <h4>Place of Birth</h4>
        </div>
        <div class="col-md-10">
            <div class="form-check">
                <input type="checkbox" 
                       wire:model="same_as_address" 
                       class="form-check-input" 
                       id="sameAddressCheckbox">
                <label class="form-check-label" for="sameAddressCheckbox">
                    Same as Current Address
                </label>
            </div>
        </div>
    </div>
    
    <div class="row mb-5">
        <!-- Region -->
        <div class="col-md-3">
            <label for="birth_region" class="form-label fw-semibold required-field">Region</label>
            <select wire:model="birth_region" 
                    id="birth_region"
                    class="form-select @error('birth_region') is-invalid @enderror" 
                    {{ $same_as_address ? 'disabled' : '' }} 
                    required>
                <option value="">Select Region</option>
                @foreach($birth_regions as $region)
                    <option value="{{ $region->region_code }}">{{ $region->name }}</option>
                @endforeach
            </select>
            @error('birth_region') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Province -->
        <div class="col-md-3">
            <label for="birth_province" class="form-label fw-semibold required-field">Province</label>
            <select wire:model="birth_province" 
                    id="birth_province"
                    class="form-select @error('birth_province') is-invalid @enderror" 
                    {{ $same_as_address || empty($birth_provinces) ? 'disabled' : '' }} 
                    required>
                <option value="">Select Province</option>
                @foreach($birth_provinces as $province)
                    <option value="{{ $province->province_code }}">{{ $province->name }}</option>
                @endforeach
            </select>
            @error('birth_province') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- City -->
        <div class="col-md-3">
            <label for="birth_city" class="form-label fw-semibold required-field">City/Municipality</label>
            <select wire:model="birth_city" 
                    id="birth_city"
                    class="form-select @error('birth_city') is-invalid @enderror" 
                    {{ $same_as_address || empty($birth_cities) ? 'disabled' : '' }} 
                    required>
                <option value="">Select City/Municipality</option>
                @foreach($birth_cities as $city)
                    <option value="{{ $city->city_code }}">{{ $city->name }}</option>
                @endforeach
            </select>
            @error('birth_city') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <!-- Barangay - TEXT INPUT -->
        <div class="col-md-3">
            <label for="birth_barangay" class="form-label fw-semibold required-field">Barangay</label>
            <input type="text"
                   id="birth_barangay"
                   wire:model.defer="birth_barangay"
                   class="form-control @error('birth_barangay') is-invalid @enderror"
                   placeholder="Enter Barangay"
                   {{ $same_as_address ? 'disabled' : '' }}
                   required>
            @error('birth_barangay')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- RELIGION & INDIGENOUS GROUP SECTION -->
<div class="form-section">
    <h4>Cultural Background</h4>
    
    <div class="row mb-5">
        <div class="col-md-6">
            <label class="form-label required-field">Religion</label>
            <select wire:model.defer="religion" class="form-select" required>
                <option value="">Select Religion</option>
                <option value="Roman Catholic">Roman Catholic</option>
                <option value="Christian">Christian</option>
                <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                <option value="Islam">Islam</option>
                <option value="No Religion">No Religion</option>
                <option value="Others">Others, please specify</option>
            </select>
            @error('religion') <span class="text-danger">{{ $message }}</span> @enderror
        
            @if ($religion === 'Others')
                <input type="text" 
                       wire:model.defer="religion_other" 
                       class="form-control mt-2" 
                       placeholder="Please specify religion" 
                       required>
                @error('religion_other') <span class="text-danger">{{ $message }}</span> @enderror
            @endif
        </div>
        
        <div class="col-md-6">
            <label class="form-label required-field">Part of an Indigenous Peoples Group?</label>
            <select wire:model.defer="indigenous_group" class="form-select" required>
                <option value="">Select Option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error('indigenous_group') <span class="text-danger">{{ $message }}</span> @enderror
        
            @if ($indigenous_group == 'Yes')
                <input type="text" 
                       wire:model.defer="indigenous_group_spec" 
                       class="form-control mt-2" 
                       placeholder="Please specify indigenous group" 
                       required>
                @error('indigenous_group_spec') <span class="text-danger">{{ $message }}</span> @enderror
            @endif
        </div>
    </div>
</div>

<!-- LIVING SITUATION SECTION -->
<div class="form-section">
    <h4>Living Situation</h4>
    
    <div class="row mb-2">
        <div class="col-md-6">
            <label class="form-label required-field">Living With</label>
            <select wire:model.defer="living_with" class="form-select" required>
                <option value="">Select Option</option>
                <option value="Both Parents">Both Parents</option>
                <option value="Father Only">Father Only</option>
                <option value="Mother Only">Mother Only</option>
                <option value="Relatives">Relatives</option>
                <option value="Non-Relatives">Non-Relatives</option>
                <option value="Living Alone">Living Alone</option>
            </select>
            @error('living_with') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        <div class="col-md-6">
            <label class="form-label required-field">Dwelling Type</label>
            <select wire:model.defer="dwelling_type" class="form-select" required>
                <option value="">Select Option</option>
                <option value="Strong Materials">Strong Materials</option>
                <option value="Light Materials">Light Materials</option>
                <option value="Makeshift">Makeshift</option>
                <option value="Mixed Strong">Mixed Strong</option>
                <option value="Mixed Light">Mixed Light</option>
                <option value="Mixed Salvaged">Mixed Salvaged</option>
                <option value="No Permanent Dwelling">No Permanent Dwelling</option>
            </select>
            @error('dwelling_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
</div>