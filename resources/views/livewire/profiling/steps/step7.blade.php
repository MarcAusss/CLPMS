<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type of Assistance Requested</th>
                <th>Source of Assistance</th>
                <th>Start of Assistance</th>
                <th>End of Assistance</th>
                <th>Family Members Who Requested</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($services_requested as $index => $service)
                <tr>
                    <td>
                        <input type="text" class="form-control" wire:model="services_requested.{{ $index }}.assistance">
                    </td>
                    <td>
                        <input type="text" class="form-control" wire:model="services_requested.{{ $index }}.source">
                    </td>
                    <td>
                        <input type="date" class="form-control" wire:model="services_requested.{{ $index }}.start_date">
                    </td>
                    <td>
                        <input type="date" class="form-control" wire:model="services_requested.{{ $index }}.end_date">
                    </td>
                    <td>
                        <input type="text" class="form-control" wire:model="services_requested.{{ $index }}.members">
                    </td>
                    <td>
                        <input type="text" class="form-control" wire:model="services_requested.{{ $index }}.remarks">
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" wire:click="removeServiceRequested({{ $index }})">Remove</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No services requested yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Add Repeater Button -->
    <button type="button" class="btn btn-primary mt-2" wire:click="addServiceRequested">Add Service</button>
</div>
