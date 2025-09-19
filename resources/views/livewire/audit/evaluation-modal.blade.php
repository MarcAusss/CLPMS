<div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evaluationModalLabel">Audit Evaluation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Comments and Approval/Denial -->
                <form wire:submit.prevent="submit">
                    @csrf
                    <!-- Comments Section -->
                    <div class="mb-3 fv-row">
                        <label for="comments" class="form-label">Comments</label>
                        <textarea wire:model.defer="comments" id="comments" class="form-control" rows="3" placeholder="Enter your comments here..."></textarea>
                        @error('comments')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Approval/Denial Section -->
                    <div class="fv-row mb-3">
                        <label for="status" class="form-label">Approval Status</label>
                        <select wire:model.defer="status" id="status" class="form-control">
                            <option value="">Select Approval Status</option>
                            <option value="approved">Approved</option>
                            <option value="denied">Denied</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit Evaluation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>