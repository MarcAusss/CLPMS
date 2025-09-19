<div>
    <h3>Budget</h3>
    <div id="ab_repeater">
        @foreach ($ab_repeater as $outerIndex => $outerItem)
            <div wire:key="ab-outer-item-{{ $outerIndex }}" class="mb-5" style="border-bottom: 1px dashed #000; padding-bottom: 15px;">
                <div class="form-group fv-row mb-3">
                    <label class="form-label">Supply Category or Name {{ $outerIndex + 1 }}:</label>
                    <input type="text" wire:model.defer="ab_repeater.{{ $outerIndex }}.name" class="form-control form-control-solid" placeholder="Enter Supply Category or Name" />
                    @error("ab_repeater.{$outerIndex}.name") <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group fv-row mb-3">
                    <label class="form-label">Total {{ $outerIndex + 1 }}:</label>
                    <div class="input-group mb-5">
                        <span class="input-group-text">Php</span>
                        <input type="number" class="form-control form-control-solid" wire:model.defer="ab_repeater.{{ $outerIndex }}.total" placeholder="Enter Total Amount" />
                        <span class="input-group-text">.00</span>
                    </div>
                    @error("ab_repeater.{$outerIndex}.total") <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <h4>Particular Supply / Item</h4>
                <div id="ab_particulars_repeater_{{ $outerIndex }}">
                    @if(isset($outerItem['particulars']) && is_array($outerItem['particulars']))
                        @foreach ($outerItem['particulars'] as $innerIndex => $particular)
                            <div wire:key="ab-particular-{{ $outerIndex }}-{{ $innerIndex }}" class="mb-3 d-flex align-items-center">
                                <div class="col-md-10">
                                    <input type="text" wire:model.defer="ab_repeater.{{ $outerIndex }}.particulars.{{ $innerIndex }}" class="form-control form-control-solid" placeholder="Enter Particular Supply / Item" />
                                    @error("ab_repeater.{$outerIndex}.particulars.{$innerIndex}") <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-2 d-flex justify-content-end">
                                    <button type="button" wire:click.prevent="removeAbParticular({{ $outerIndex }}, {{ $innerIndex }})" class="btn btn-sm btn-light-danger">
                                        <i class="ki-duotone ki-trash fs-5"></i> Delete
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="form-group mt-2 d-flex justify-content-center">
                        <button type="button" wire:click.prevent="addAbParticular({{ $outerIndex }})" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-plus fs-5"></i> Add Particular Item
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <button type="button" wire:click.prevent="removeAbOuterItem({{ $outerIndex }})" class="btn btn-sm btn-light-danger">
                        <i class="ki-duotone ki-trash fs-5"></i> Delete Row
                    </button>
                </div>
            </div>
        @endforeach

        <div class="form-group mt-5 d-flex justify-content-center">
            <button type="button" wire:click.prevent="addAbOuterItem" class="btn btn-light-primary">
                <i class="ki-duotone ki-plus fs-3"></i> Add Row
            </button>
        </div>
    </div>

    <h3>Equipments</h3>
    <div id="ae_repeater">
        @foreach ($ae_repeater as $index => $item)
            <div wire:key="ae-item-{{ $index }}" class="mb-5" style="border-bottom: 1px dashed #000; padding-bottom: 15px;">
                <div class="form-group fv-row mb-3 d-flex align-items-center">
                    <div class="col-md-10">
                        <label class="form-label">Equipment {{ $index + 1 }}:</label>
                        <input type="text" wire:model.defer="ae_repeater.{{ $index }}" class="form-control form-control-solid" placeholder="Enter Equipment" />
                        @error("ae_repeater.{$index}") <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-2 d-flex justify-content-end">
                        <button type="button" wire:click.prevent="removeAeItem({{ $index }})" class="btn btn-sm btn-light-danger">
                            <i class="ki-duotone ki-trash fs-5"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="form-group mt-5 d-flex justify-content-center">
            <button type="button" wire:click.prevent="addAeItem" class="btn btn-light-primary">
                <i class="ki-duotone ki-plus fs-3"></i> Add Equipment
            </button>
        </div>
    </div>
</div>