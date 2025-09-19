<div>
    <h3>Audit Execution Plan</h3>
    <div id="aep_repeater">
        @foreach ($aep_repeater as $outerIndex => $outerItem)
            <div wire:key="outer-item-{{ $outerIndex }}" class="mb-5" style="border-bottom: 1px dashed #000; padding-bottom: 15px;">
                <div class="form-group fv-row mb-3">
                    <label class="form-label">Audit Section {{ $outerIndex + 1 }}:</label>
                    <select wire:model.defer="aep_repeater.{{ $outerIndex }}.section" class="form-select form-select-solid" data-placeholder="Select an option">
                        <option></option>
                        <option value="Audit Engagement Planning">Audit Engagement Planning</option>
                        <option value="Audit Execution">Audit Execution</option>
                        <option value="Audit Reporting">Audit Reporting</option>
                    </select>
                    @error("aep_repeater.{$outerIndex}.section") <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group fv-row mb-3">
                    <label class="form-label">Activity {{ $outerIndex + 1 }}:</label>
                    <input type="text" wire:model.defer="aep_repeater.{{ $outerIndex }}.activity" class="form-control form-control-solid" placeholder="Enter Activity" />
                    @error("aep_repeater.{$outerIndex}.activity") <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group fv-row mb-3">
                    <div wire:ignore id="date-range-container2"> 
                        <label class="form-label">Tentative Timelines {{ $outerIndex + 1 }}:</label>
                        <input type="text" wire:model.defer="aep_repeater.{{ $outerIndex }}.date_range" class="form-control form-control-solid dateflatpickzz" placeholder="Pick date range" />
                        @error("aep_repeater.{$outerIndex}.date_range") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <h4>Particulars</h4>
                <div id="aep_particulars_repeater_{{ $outerIndex }}">
                    @if(isset($outerItem['particulars']) && is_array($outerItem['particulars']))
                        @foreach ($outerItem['particulars'] as $innerIndex => $particular)
                            <div wire:key="particular-{{ $outerIndex }}-{{ $innerIndex }}" class="mb-3 d-flex align-items-center">
                                <div class="col-md-10">
                                    <input type="text" wire:model.defer="aep_repeater.{{ $outerIndex }}.particulars.{{ $innerIndex }}" class="form-control form-control-solid" placeholder="Enter Particulars" />
                                    @error("aep_repeater.{$outerIndex}.particulars.{$innerIndex}") <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-2 d-flex justify-content-end">
                                    <button type="button" wire:click.prevent="removeParticular({{ $outerIndex }}, {{ $innerIndex }})" class="btn btn-sm btn-light-danger">
                                        <i class="ki-duotone ki-trash fs-5"></i> Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="form-group mt-2 d-flex justify-content-center">
                        <button type="button" wire:click.prevent="addParticular({{ $outerIndex }})" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-plus fs-5"></i> Add Particular
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button type="button" wire:click.prevent="removeOuterItem({{ $outerIndex }})" class="btn btn-sm btn-light-danger">
                        <i class="ki-duotone ki-trash fs-5"></i> Delete Row
                    </button>
                </div>
            </div>
        @endforeach

        <div class="form-group mt-5 d-flex justify-content-center">
            <button type="button" wire:click.prevent="addOuterItem" class="btn btn-light-primary">
                <i class="ki-duotone ki-plus fs-3"></i> Add Row
            </button>
        </div>
    </div>
</div>