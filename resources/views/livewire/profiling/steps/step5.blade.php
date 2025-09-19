<div class="card">

    <div class="row mb-4">
        <div class="col-md-6">
            <label class="form-label">Is a member of 4Ps?:</label>
            <select wire:model="is_4ps_member" class="form-select">
                <option value="" selected disabled>Select option below</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            @error("is_4ps_member") <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        
        <div class="col-md-6">
            <label class="form-label">4Ps Household ID Number:</label>
            <input 
                type="text" 
                wire:model.defer="house_id_number" 
                class="form-control form-control-solid" 
                placeholder="Enter 4Ps House ID Number" 
                {{ $is_4ps_member === 'Yes' ? '' : 'disabled' }} 
                required="{{ $is_4ps_member === 'Yes' ? 'true' : 'false' }}"
            />
            @error("house_id_number") <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Family Profile</h3>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <tbody>
                @forelse ($family_members as $index => $member)
                <tr>
                    <th class="text-center" colspan="2">Name</th>
                    <th class="text-center">Relationship</th>
                    <th class="text-center">Sex</th>
                    <th class="text-center">Age</th>
                    <th class="text-center">Civil Status</th>
                </tr>
                <!-- First Row -->
                <tr>
                    <td colspan="2">
                        <input type="text" class="form-control" wire:model="family_members.{{ $index }}.name">
                        @error("family_members.$index.name") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control" wire:model="family_members.{{ $index }}.relationship">
                        @error("family_members.$index.relationship") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <select class="form-select" wire:model="family_members.{{ $index }}.sex">
                            <option value="" selected disabled>Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error("family_members.$index.sex") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <input type="number" class="form-control" wire:model="family_members.{{ $index }}.age">
                        @error("family_members.$index.age") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <select class="form-select" wire:model="family_members.{{ $index }}.civil_status">
                            <option value="" selected disabled>Civil Status</option>
                            <option value="" selected disabled>Select Civil Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Separated">Separated</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Annulled">Annulled</option>
                            <option value="Live-in / Common-law">Live-in / Common-law</option>
                        </select>
                        @error("family_members.$index.civil_status") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                </tr>
        
                <!-- Second Row -->
                <tr>
                    <th class="text-center" colspan="3">Highest Educational Attainment</th>
                    <th class="text-center">Solo Parent?</th>
                    <th class="text-center">Occupation</th>
                    <th class="text-center">Monthly Income</th>
                </tr>
                <tr>
                    <td colspan="3">
                        <select class="form-select" wire:model="family_members.{{ $index }}.education">
                            <option value="" selected disabled>Highest Educational Attainment</option>
                            <option value="No Formal Education">No Formal Education</option>
                            <option value="Elementary Level">Elementary Level</option>
                            <option value="Elementary Graduate">Elementary Graduate</option>
                            <option value="High School Level">High School Level</option>
                            <option value="High School Graduate">High School Graduate</option>
                            <option value="Senior High School Level">Senior High School Level</option>
                            <option value="Senior High School Graduate">Senior High School Graduate</option>
                            <option value="Vocational Course">Vocational Course</option>
                            <option value="College Level">College Level</option>
                            <option value="College Graduate">College Graduate</option>
                            <option value="Postgraduate (Master's/PhD)">Postgraduate (Master's/PhD)</option>
                        </select>
                        @error("family_members.$index.education") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <select class="form-control" wire:model="family_members.{{ $index }}.solo_parent">
                            <option value="" selected disabled>Solo Parent?</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="NA">N/A</option>
                        </select>
                        @error("family_members.$index.solo_parent") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control" wire:model="family_members.{{ $index }}.occupation">
                        @error("family_members.$index.occupation") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <input type="number" class="form-control" wire:model="family_members.{{ $index }}.income">
                        @error("family_members.$index.income") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                </tr>
        
                <!-- Third Row -->
                <tr>
                    <th class="text-center" colspan="2">Type of Disability / Ailment<br> (if any)</th>
                    <th class="text-center" colspan="2">Skills</th>
                    <th class="text-center">Whereabouts</th>
                    <th class="text-center">Actions</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" class="form-control" wire:model="family_members.{{ $index }}.disability">
                        @error("family_members.$index.disability") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td colspan="2">
                        <input type="text" class="form-control" wire:model="family_members.{{ $index }}.skills">
                        @error("family_members.$index.skills") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <input type="text" class="form-control" wire:model="family_members.{{ $index }}.whereabouts">
                        @error("family_members.$index.whereabouts") <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" wire:click="removeFamilyMember({{ $index }})">Remove</button>
                    </td>
                </tr>
        
                <tr><td colspan="6"></td></tr> <!-- Empty row for spacing -->
                @empty
                <tr>
                    <td colspan="6" class="text-center">No family members added.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <button type="button" class="btn btn-primary mt-3" wire:click="addFamilyMember">Add Family Member</button>
</div>
