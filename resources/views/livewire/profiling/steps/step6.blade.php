<div>
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Services Availed by the Family</h3>
        </div>
    </div>

    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Assistance Already Availed</th>
                    <th class="text-center">Source of Assistance</th>
                    <th class="text-center">Year Availed</th>
                    <th class="text-center">Family Members Who Availed</th>
                    <th class="text-center">Remarks</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services_availed as $index => $service)
                    <tr>
                        <td>
                            <input type="text" class="form-control" wire:model="services_availed.{{ $index }}.assistance">
                            @error("services_availed.{$index}.assistance") <span class="text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" wire:model="services_availed.{{ $index }}.source">
                            @error("services_availed.{$index}.source") <span class="text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td>
                            <input type="number" class="form-control" wire:model="services_availed.{{ $index }}.year" min="1900" max="{{ now()->year }}">
                            @error("services_availed.{$index}.year") <span class="text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" wire:model="services_availed.{{ $index }}.members">
                            @error("services_availed.{$index}.members") <span class="text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td>
                            <input type="text" class="form-control" wire:model="services_availed.{{ $index }}.remarks">
                            @error("services_availed.{$index}.remarks") <span class="text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm" wire:click="removeService({{ $index }})">Remove</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No services availed yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <button type="button"class="btn btn-primary mt-3" wire:click="addService">Add Service Availed</button>
</div>
