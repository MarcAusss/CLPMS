<div>
    <div class="row mb-2">
        <div class="col-md-3">
            <label class="form-label">First Name</label>
            <input type="text" wire:model.defer="first_name" class="form-control" required>
            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Middle Name</label>
            <input type="text" wire:model.defer="middle_name" class="form-control" required>
            @error('middle_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-3">
            <label class="form-label">Last Name</label>
            <input type="text" wire:model.defer="last_name" class="form-control">
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-1">
            <label class="form-label">Suffix</label>
            <input type="text" wire:model.defer="suffix" class="form-control">
            @error('suffix') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label">Sex</label>
            <select wire:model.defer="sex" class="form-select">
                <option value="" selected disabled>Select Option Below</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            @error('sex') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-4">
            <label class="form-label">Date of Birth</label>
            <input type="date" wire:model="date_of_birth" class="form-control" required>
            @error('date_of_birth') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-3">
            <label for="dob_actual" class="form-label">Actual or Estimate</label>
            <select wire:model.defer="dob_actual" class="form-select">
                <option value="" selected disabled>Select Option</option>
                <option value="Actual">Actual</option>
                <option value="Estimate">Estimate</option>
            </select>
            @error('dob_actual') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-1">
            <label class="form-label">Age</label>
            <input type="number" wire:model.defer="age" class="form-control" readonly>
            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Birth Certificate</label>
            <select wire:model.defer="birth_certificate" class="form-select" required>
                <option value="" selected disabled>Select</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error('birth_certificate') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="row">
        <h4>Home Address</h4>
    </div>

    <!-- Current Address Section -->
    <div class="row mb-2">
        <div class="col-md-12">
            <label for="address_sitio">Specific Address</label>
            <input type="text" wire:model.defer="address_sitio" class="form-control">
            @error('address_sitio') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-3">
            <label for="address_region" class="form-label fw-semibold">Region</label>
            <select wire:model="address_region" class="form-select">
                <option value="" selected disabled>Region</option>
                @foreach($address_regions as $region)
                    <option value="{{ $region->region_code }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="address_province" class="form-label fw-semibold">Province</label>
            <select wire:model="address_province" class="form-select">
                <option value="" selected disabled>Province</option>
                @foreach($address_provinces as $province)
                    <option value="{{ $province->province_code }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="address_city" class="form-label fw-semibold">City/Municipality</label>
            <select wire:model="address_city" class="form-select">
                <option value="" selected disabled>City/Municipality</option>
                @foreach($address_cities as $city)
                    <option value="{{ $city->city_code }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="employer_region" class="form-label fw-semibold">Barangay</label>
            <select wire:model="address_barangay" class="form-select">
                <option value="" selected disabled>Barangay</option>
                @foreach($address_barangays as $barangay)
                    <option value="{{ $barangay->psgc_code }}">{{ $barangay->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row mt-3">
       
    </div>

    <!-- Place of Birth Section -->
    <div class="row mb-2">
        <div class="col-md-2">
            <h4>Place of Birth</h4>
        </div>
        <div class="col-md-10">
            <div class="form-check">
                <input type="checkbox" wire:model.defer="same_as_address" class="form-check-input" id="sameAddressCheckbox" wire:click="toggleSameAsAddress">
                <label class="form-check-label" for="sameAddressCheckbox">Same as Current Address</label>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <label for="birth_region" class="form-label fw-semibold">Region</label>
            <select wire:model="birth_region" class="form-select">
                <option value="" selected disabled>Region</option>
                @foreach($birth_regions as $region)
                    <option value="{{ $region->region_code }}">{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="birth_province" class="form-label fw-semibold">Province</label>
            <select wire:model="birth_province" class="form-select">
                <option value="" selected disabled>Province</option>
                @foreach($birth_provinces as $province)
                    <option value="{{ $province->province_code }}">{{ $province->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="birth_city" class="form-label fw-semibold">City/Municipality</label>
            <select wire:model="birth_city" class="form-select">
                <option value="" selected disabled>City/Municipality</option>
                @foreach($birth_cities as $city)
                    <option value="{{ $city->city_code }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="employer_region" class="form-label fw-semibold">Barangay</label>
            <select wire:model="birth_barangay" class="form-select">
                <option value="" selected disabled>Barangay</option>
                @foreach($birth_barangays as $barangay)
                    <option value="{{ $barangay->psgc_code }}">{{ $barangay->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Religion & Indigenous Group -->
    <div class="row mb-2">
        <div class="col-md-6">
            <label class="form-label">Religion</label>
            <select wire:model="religion" class="form-select" required>
                <option value="" selected disabled>Select Option Below</option>
                <option value="Roman Catholic">Roman Catholic</option>
                <option value="Christian">Christian</option>
                <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                <option value="Islam">Islam</option>
                <option value="No Religion">No Religion</option>
                <option value="Others">Others, please specify</option>
            </select>
            @error('religion') <span class="text-danger">{{ $message }}</span> @enderror
        
            @if ($religion === 'Others')
                <input type="text" wire:model="religion_other" class="form-control mt-2" placeholder="Please specify" required>
                @error('religion_other') <span class="text-danger">{{ $message }}</span> @enderror
            @endif
        </div>
        <div class="col-md-6">
            <label class="form-label">Part of an Indigenous Peoples Group?</label>
            <select wire:model="indigenous_group" class="form-select" required>
                <option value="" selected disabled>Select Option Below</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        
            @if ($indigenous_group == 'Yes')
                <input type="text" wire:model="indigenous_group_spec" class="form-control mt-2" placeholder="Please specify" required>
                @error('indigenous_group_spec') <span class="text-danger">{{ $message }}</span> @enderror
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <h4>Living Situation</h4>
    </div>
    
    <!-- Living With Section -->
    <div class="row mb-2">
        <div class="col-md-6">
            <label class="form-label">Living With</label>
            <select wire:model.defer="living_with" class="form-select" required>
                <option value="" selected disabled>Select Option Below</option>
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
            <label class="form-label">Dwelling Type</label>
            <select wire:model.defer="dwelling_type" class="form-select" required>
                <option value="" selected disabled>Select Option Below</option>
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
