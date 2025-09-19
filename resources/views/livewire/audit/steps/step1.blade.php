<div>
    <div class="form-group fv-row mb-10">
        <label class="required form-label">Project Title</label>
        <input type="text" wire:model.defer="a_proj_title" class="form-control form-control-solid" placeholder="Project Title" />
        @error('a_proj_title') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group fv-row mb-10">
        <div class="row">
            <div class="col-md-6">
                <label class="required form-label">Project Number</label>
                <input type="text" wire:model.defer="a_proj_no" class="form-control form-control-solid" placeholder="Project Number" />
                @error('a_proj_no') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                    <div wire:ignore id="date-range-container"> 
                    <label class="required form-label">Audit Date Range</label>
                    <input type="text" wire:model.defer="a_date_range" class="form-control form-control-solid" placeholder="Pick date range" id="a_date_range" wire:ignore/>
                    @error('a_date_range') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            {{-- <div class="col-md-3">
                <label class="required form-label">Date Start</label>
                <input type="date" name="a_date_start" wire:model="a_date_start" class="form-control form-control-solid" placeholder="Pick date Start" wire:ignore/>
                @error('a_date_start') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-3">
                <label class="required form-label">Date End</label>
                <input type="date" name="a_date_end" wire:model="a_date_end" class="form-control form-control-solid" placeholder="Pick date End" wire:ignore/>
                @error('a_date_end') <span class="text-danger">{{ $message }}</span> @enderror
            </div> --}}
        </div>
    </div>

    <div class="form-group fv-row mb-10">
        <label class="required form-label">Introduction</label>
        <textarea wire:model.defer="a_intro" class="form-control form-control-solid" rows="5" placeholder="Audit Plan Introduction"></textarea>
        @error('a_intro') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group fv-row mb-10">
        <label class="required form-label">Privacy Policy</label>
        <textarea wire:model.defer="a_privacy_policy" class="form-control form-control-solid" rows="5" placeholder="Privacy Policy"></textarea>
        @error('a_privacy_policy') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group fv-row mb-10">
        <label class="required form-label">Assessment of Controls</label>
        <textarea wire:model.defer="a_aoc" class="form-control form-control-solid" rows="5" placeholder="Assessment of Controls"></textarea>
        @error('a_aoc') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group fv-row mb-10">
        <label class="required form-label">Audit Approach</label>
        <textarea wire:model.defer="a_approach" class="form-control form-control-solid" rows="5" placeholder="Audit Approach"></textarea>
        @error('a_approach') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>