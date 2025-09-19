<div>
    <div class="form-group fv-row mb-10">
        <label class="required form-label">Scope of Audit</label>
        <textarea wire:model.defer="as_text" class="form-control form-control-solid" rows="6" placeholder="Scope of Audit"></textarea>
        @error('as_text') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="form-group fv-row mb-10">
        <label class="required form-label">Methodology</label>
        <textarea wire:model.defer="am_text" class="form-control form-control-solid" rows="6" placeholder="Methodology"></textarea>
        @error('am_text') <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>