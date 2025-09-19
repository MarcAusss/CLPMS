<div>
    <h3>Audit Criteria</h3>
    <div id="ac_repeater">
        @foreach ($ac_repeater as $index => $criteria)
            <div wire:key="criteria-{{ $index }}" class="mb-5">
                <div class="form-group fv-row d-flex align-items-center">
                    <div class="col-md-10">
                        <label class="form-label">Audit Criteria {{ $index + 1 }}:</label>
                        <input type="text" wire:model.defer="ac_repeater.{{ $index }}" class="form-control form-control-solid" placeholder="Enter Audit Criteria" required />
                        @error("ac_repeater.{$index}") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2 d-flex justify-content-end">
                        <button type="button" wire:click.prevent="removeCriteria({{ $index }})" class="btn btn-sm btn-light-danger">
                            <i class="ki-duotone ki-trash fs-5"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-group mt-5 d-flex justify-content-center">
            <button type="button" wire:click.prevent="addCriteria" class="btn btn-light-primary">
                <i class="ki-duotone ki-plus fs-3"></i> Add Criteria
            </button>
        </div>
    </div>

    <hr class="my-5"> {{-- Separator between repeaters --}}

    <h3>References</h3>
    <div id="arf_repeater">
        @foreach ($arf_repeater as $index => $reference)
            <div wire:key="reference-{{ $index }}" class="mb-5">
                <div class="form-group fv-row d-flex align-items-center">
                    <div class="col-md-10">
                        <label class="form-label">Reference {{ $index + 1 }}:</label>
                        <input type="text" wire:model.defer="arf_repeater.{{ $index }}" class="form-control form-control-solid" placeholder="Enter Reference" required />
                        @error("arf_repeater.{$index}") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2 d-flex justify-content-end">
                        <button type="button" wire:click.prevent="removeReference({{ $index }})" class="btn btn-sm btn-light-danger">
                            <i class="ki-duotone ki-trash fs-5"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-group mt-5 d-flex justify-content-center">
            <button type="button" wire:click.prevent="addReference" class="btn btn-light-primary">
                <i class="ki-duotone ki-plus fs-3"></i> Add Reference
            </button>
        </div>
    </div>
</div>