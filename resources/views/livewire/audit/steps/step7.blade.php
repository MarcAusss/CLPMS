<div>
    <h3>Team Members</h3>
    <div id="at_repeater">
        @foreach ($at_repeater as $index => $item)
            <div wire:key="at-item-{{ $index }}" class="mb-5" style="border-bottom: 1px dashed #000; padding-bottom: 15px;">
                <div class="form-group fv-row mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Designation {{ $index + 1 }}:</label>
                            <select wire:model.defer="at_repeater.{{ $index }}.designation" class="form-select form-select-solid" data-placeholder="Select an option">
                                <option></option>
                                <option value="Team Leader">Team Leader</option>
                                <option value="Member - Bureau and Services">Member - Bureau and Services</option>
                                <option value="Member - OSEC & ROs">Member - OSEC & ROs</option>
                            </select>
                            @error("at_repeater.{$index}.designation") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Name {{ $index + 1 }}:</label>
                            <input type="text" wire:model.defer="at_repeater.{{ $index }}.name" class="form-control form-control-solid" placeholder="Enter Name" />
                            @error("at_repeater.{$index}.name") <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-2 d-flex justify-content-end align-items-center">
                            <button type="button" wire:click.prevent="removeAtItem({{ $index }})" class="btn btn-sm btn-light-danger mt-3">
                                <i class="ki-duotone ki-trash fs-5"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-group mt-5 d-flex justify-content-center">
            <button type="button" wire:click.prevent="addAtItem" class="btn btn-light-primary">
                <i class="ki-duotone ki-plus fs-3"></i> Add Team Member
            </button>
        </div>
    </div>
</div>