<div>
    <div id="ao_repeater">
        @foreach ($ao_repeater as $index => $objective)
            <div wire:key="objective-{{ $index }}" class="mb-5">
                <div class="form-group fv-row d-flex align-items-center">
                    <div class="col-md-10">
                        <label class="form-label">Objective {{ $index + 1 }}:</label>
                        <input type="text" wire:model.defer="ao_repeater.{{ $index }}.objective" 
                            class="form-control form-control-solid" placeholder="Enter Objective" required />
                        @error("ao_repeater.{$index}.objective") 
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div class="col-md-2 d-flex justify-content-end">
                        <button type="button" wire:click.prevent="removeObjective({{ $index }})" 
                                class="btn btn-sm btn-light-danger">
                            <i class="ki-duotone ki-trash fs-5"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-group mt-5 d-flex justify-content-center">
            <button type="button" wire:click.prevent="addObjective" class="btn btn-light-primary">
                <i class="ki-duotone ki-plus fs-3"></i> Add Objective
            </button>
        </div>
    </div>
</div>