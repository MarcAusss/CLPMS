<div class="container">
    <div class="row">
        <!-- Has gone to school -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Has gone to school?</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input type="radio" id="schoolYes" name="has_gone_to_school" 
                               wire:model.defer="has_gone_to_school" value="Yes" class="form-check-input">
                        <label for="schoolYes" class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="schoolNo" name="has_gone_to_school" 
                               wire:model.defer="has_gone_to_school" value="No" class="form-check-input">
                        <label for="schoolNo" class="form-check-label">No</label>
                    </div>
                </div>
                @error('has_gone_to_school')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Attending school at present -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Attending school at present?</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input type="radio" id="schoolYesPresent" name="currently_attending" 
                               wire:model="currently_attending" value="Yes" class="form-check-input">
                        <label for="schoolYesPresent" class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="schoolNoPresent" name="currently_attending" 
                               wire:model="currently_attending" value="No" class="form-check-input">
                        <label for="schoolNoPresent" class="form-check-label">No</label>
                    </div>
                </div>
                @error('currently_attending')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Learner Reference Number (LRN) -->
            @if($currently_attending === 'Yes')
                <div class="g-2">
                    <label class="form-label">Learner Reference Number (LRN)</label>
                    <input type="text" wire:model="learner_reference_no" class="form-control">
                    @error('learner_reference_no')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            @endif
        </div>

        <!-- Mode of education -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Mode of Education</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input type="radio" id="formalYes" name="mode_of_education" 
                               wire:model="mode_of_education" value="Formal" class="form-check-input">
                        <label for="formalYes" class="form-check-label">Formal</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="informalNo" name="mode_of_education" 
                               wire:model="mode_of_education" value="Informal" class="form-check-input">
                        <label for="informalNo" class="form-check-label">Informal</label>
                    </div>
                </div>
                @error('mode_of_education')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Stopped Schooling? -->
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Has quit schooling?</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input type="radio" id="schoolingYes" name="quit_schooling" 
                               wire:model="quit_schooling" value="Yes" class="form-check-input">
                        <label for="schoolingYes" class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="schoolingNo" name="quit_schooling" 
                               wire:model="quit_schooling" value="No" class="form-check-input">
                        <label for="schoolingNo" class="form-check-label">No</label>
                    </div>
                </div>
                @error('quit_schooling')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <!-- Highest Grade Completed -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="highest_grade_completed" class="form-label">Highest Grade Completed</label>
                <select wire:model.defer="highest_grade_completed" class="form-select">
                    <option value="" selected disabled>Select Highest grade completed</option>
                    <optgroup label="Elementary">
                        <option value="Grade 1">Grade 1</option>
                        <option value="Grade 2">Grade 2</option>
                        <option value="Grade 3">Grade 3</option>
                        <option value="Grade 4">Grade 4</option>
                        <option value="Grade 5">Grade 5</option>
                        <option value="Grade 6">Grade 6</option>
                    </optgroup>
                    <optgroup label="Junior High School">
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                    </optgroup>
                    <optgroup label="Senior High School">
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </optgroup>
                </select>
                @error('highest_grade_completed')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @if($quit_schooling === 'Yes')
        <!-- Age Quit Schooling -->
        <div class="col-md-6">
            <div class="mb-3">
                <label for="highest_grade_completed" class="form-label">Age Stopped Schooling</label>
                <input type="text" wire:model.defer="age_stopped_schooling" class="form-control" required>
                @error('age_stopped_schooling')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        @endif
    </div>
    @if($quit_schooling === 'Yes')
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="mb-3">
                <label class="form-label">Reason for Stopping</label>
                <div class="row g-2"> <!-- Added spacing -->
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_1" wire:model.defer="reason_for_stopping" 
                                   value="To engage in paid or self-employment to augment family income" 
                                   class="form-check-input">
                            <label for="reason_1" class="form-check-label ms-2">
                                To engage in paid or self-employment to augment family income
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_2" wire:model.defer="reason_for_stopping" 
                                   value="To help in family operated farm or business" 
                                   class="form-check-input">
                            <label for="reason_2" class="form-check-label ms-2">
                                To help in family operated farm or business
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_3" wire:model.defer="reason_for_stopping" 
                                   value="Attend to household chores like taking care of family members" 
                                   class="form-check-input">
                            <label for="reason_3" class="form-check-label ms-2">
                                Attend to household chores like taking care of family members
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_4" wire:model.defer="reason_for_stopping" 
                                   value="Cannot afford to go to school" 
                                   class="form-check-input">
                            <label for="reason_4" class="form-check-label ms-2">
                                Cannot afford to go to school
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_5" wire:model.defer="reason_for_stopping" 
                                   value="Not interested in school" 
                                   class="form-check-input">
                            <label for="reason_5" class="form-check-label ms-2">
                                Not interested in school
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_6" wire:model.defer="reason_for_stopping" 
                                   value="School is too far" 
                                   class="form-check-input">
                            <label for="reason_6" class="form-check-label ms-2">
                                School is too far
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_7" wire:model.defer="reason_for_stopping" 
                                   value="Illness or disability" 
                                   class="form-check-input">
                            <label for="reason_7" class="form-check-label ms-2">
                                Illness or disability
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_8" wire:model.defer="reason_for_stopping" 
                                   value="Teachers are not supportive" 
                                   class="form-check-input">
                            <label for="reason_8" class="form-check-label ms-2">
                                Teachers are not supportive
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_9" wire:model.defer="reason_for_stopping" 
                                   value="Due to Bullying" 
                                   class="form-check-input">
                            <label for="reason_9" class="form-check-label ms-2">
                                Due to Bullying
                            </label>
                        </div>
                    </div>
        
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_10" wire:model.defer="reason_for_stopping" 
                                   value="Due to early pregnancy" 
                                   class="form-check-input">
                            <label for="reason_10" class="form-check-label ms-2">
                                Due to early pregnancy
                            </label>
                        </div>
                    </div>
        
                    <!-- Others Option -->
                    <div class="col-md-12 d-flex align-items-center">
                        <div class="form-check">
                            <input type="checkbox" id="reason_11" wire:model="reason_for_stopping_other" 
                                   class="form-check-input">
                            <label for="reason_11" class="form-check-label ms-2">
                                Others (Please specify)
                            </label>
                        </div>
                    </div>
        
                    <!-- Input field for "Others" when checked -->
                    @if($reason_for_stopping_other)
                        <div class="col-md-12 g-2">
                            <input type="text" wire:model="reason_for_stopping_other_text" 
                                   class="form-control" placeholder="Specify reason">
                        </div>
                    @endif
        
                </div>
        
                <!-- Error message -->
                @error('reason_for_stopping')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
    </div>
    @endif
</div>
