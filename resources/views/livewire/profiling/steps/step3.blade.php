<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <label for="height_cm" class="form-label">Height (in cm)</label>
            <input type="text" wire:model.defer="height_cm" class="form-control">
            @error('height_cm')
                <div class="text-danger g-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="weight_kg" class="form-label">Weight (in kg)</label>
            <input type="text" wire:model.defer="weight_kg" class="form-control">
            @error('weight_kg')
                <div class="text-danger g-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="mb-3">
                <label class="form-label">Is a PWD?</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input type="radio" id="disabilityYes" name="has_disability" wire:model="has_disability"
                            value="Yes" class="form-check-input">
                        <label for="disabilityYes" class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="disabilityNo" name="has_disability" wire:model.defer="has_disability"
                            value="No" class="form-check-input">
                        <label for="disabilityNo" class="form-check-label">No</label>
                    </div>
                </div>
                @error('has_disability')
                    <div class="text-danger g-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    @if ($has_disability === 'Yes')
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Specific Disability</label>
                    <div class="row mt-4">

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_1" wire:model.defer="specific_disability"
                                    value="Hearing Impairment" class="form-check-input">
                                <label for="disability_1" class="form-check-label ms-2">Hearing Impairment</label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_2" wire:model.defer="specific_disability"
                                    value="Visual/Seeing Disability" class="form-check-input">
                                <label for="disability_2" class="form-check-label ms-2">Visual/Seeing Disability</label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_3" wire:model.defer="specific_disability"
                                    value="Communication Deficits" class="form-check-input">
                                <label for="disability_3" class="form-check-label ms-2">Communication Deficits</label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_4" wire:model.defer="specific_disability"
                                    value="Mental Disability" class="form-check-input">
                                <label for="disability_4" class="form-check-label ms-2">Mental Disability</label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_5" wire:model.defer="specific_disability"
                                    value="Multiple Disabilities" class="form-check-input">
                                <label for="disability_5" class="form-check-label ms-2">Multiple Disabilities</label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_6" wire:model.defer="specific_disability"
                                    value="Orthopedic/Moving Disability" class="form-check-input">
                                <label for="disability_6" class="form-check-label ms-2">Orthopedic/Moving
                                    Disability</label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_7" wire:model.defer="specific_disability"
                                    value="Learning (Cognitive or Intellectual) Disability" class="form-check-input">
                                <label for="disability_7" class="form-check-label ms-2">Learning (Cognitive or
                                    Intellectual) Disability</label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_8" wire:model.defer="specific_disability"
                                    value="Psychosocial and Behavioral Disabilities" class="form-check-input">
                                <label for="disability_8" class="form-check-label ms-2">Psychosocial and Behavioral
                                    Disabilities</label>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_9" wire:model.defer="specific_disability"
                                    value="Chronic Illness with Disabilities" class="form-check-input">
                                <label for="disability_9" class="form-check-label ms-2">Chronic Illness with
                                    Disabilities</label>
                            </div>
                        </div>

                        <!-- Others Option -->
                        <div class="col-md-12 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" id="disability_10" wire:model="specific_disability"
                                    value="Others" class="form-check-input">
                                <label for="disability_10" class="form-check-label ms-2">Others (Please
                                    specify)</label>
                            </div>
                        </div>

                        <!-- Input field for "Others" when checked -->
                        @if (in_array('Others', $specific_disability))
                            <div class="col-md-12 mt-4">
                                <input type="text" wire:model.defer="specific_disability_other"
                                    class="form-control" placeholder="Specify disability">
                            </div>
                        @endif

                    </div>

                    @error('specific_disability')
                        <div class="text-danger g-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-4">
        <!-- None -->
        <div class="col-md-12 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" id="ailment_none" wire:model="child_ailments" value="None"
                    class="form-check-input">
                <label for="ailment_none" class="form-check-label ms-2">None</label>
            </div>
        </div>

        <!-- List of Ailments -->
        @foreach (['Measles', 'Chickenpox', 'Dengue', 'Influenza (Flu)', 'Malaria', 'Typhoid', 'Diarrhea', 'Recurring Fever', 'Tuberculosis / Primary Complex'] as $ailment)
            <div class="col-md-6 d-flex align-items-center">
                <div class="form-check">
                    <input type="checkbox" id="ailment_{{ Str::slug($ailment) }}" wire:model="child_ailments"
                        value="{{ $ailment }}" class="form-check-input">
                    <label for="ailment_{{ Str::slug($ailment) }}" class="form-check-label ms-2">
                        {{ $ailment }}
                    </label>
                </div>
            </div>
        @endforeach

        <!-- Skin Disease -->
        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" id="ailment_skin_disease" wire:model="child_ailments" value="Skin Disease"
                    class="form-check-input">
                <label for="ailment_skin_disease" class="form-check-label ms-2">Skin Disease</label>
            </div>
        </div>
        @if (in_array('Skin Disease', (array) $child_ailments))
            <div class="col-md-12 mt-2">
                <input type="text" wire:model="skin_disease_specify" class="form-control"
                    placeholder="Specify Skin Disease">
            </div>
        @endif

        <!-- Allergies -->
        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" id="ailment_allergies" wire:model="child_ailments" value="Allergies"
                    class="form-check-input">
                <label for="ailment_allergies" class="form-check-label ms-2">Allergies</label>
            </div>
        </div>
        @if (in_array('Allergies', (array) $child_ailments))
            <div class="col-md-12 mt-2">
                <input type="text" wire:model="allergies_specify" class="form-control"
                    placeholder="Specify Allergies">
            </div>
        @endif

        <!-- Others -->
        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" id="ailment_others" wire:model="child_ailments" value="Others"
                    class="form-check-input">
                <label for="ailment_others" class="form-check-label ms-2">Others (Specify)</label>
            </div>
        </div>
        @if (in_array('Others', (array) $child_ailments))
            <div class="col-md-12 mt-2">
                <input type="text" wire:model="other_ailments_specify" class="form-control"
                    placeholder="Specify Other Ailment">
            </div>
        @endif

        <!-- Follow-up Question (Hidden if "None" is selected) -->
        @if (is_array($child_ailments) && !in_array('None', $child_ailments) && count($child_ailments) > 0)
            <div class="mt-4">
                <label class="form-label">For further assessment of medical condition?</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        <input type="radio" id="assessmentYes" name="medical_assessment"
                            wire:model.defer="medical_assessment" value="Yes" class="form-check-input">
                        <label for="assessmentYes" class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="assessmentNo" name="medical_assessment"
                            wire:model.defer="medical_assessment" value="No" class="form-check-input">
                        <label for="assessmentNo" class="form-check-label">No</label>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <label for="family_medical_history">Does any of the family have any history on the following ailments?</label>
        </div>
    
        <!-- None -->
        <div class="col-md-12 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" id="family_none" wire:model="family_medical_history"
                       value="None" class="form-check-input">
                <label for="family_none" class="form-check-label ms-2">None</label>
            </div>
        </div>
    
        <!-- List of Ailments -->
        @foreach (['Hypertension', 'Diabetes', 'Asthma', 'Kidney Ailment', 'Liver Ailment',
                   'Heart Ailment', 'Cancer', 'Paralysis', 'Respiratory Illness'] as $ailment)
            <div class="col-md-6 d-flex align-items-center">
                <div class="form-check">
                    <input type="checkbox" id="family_{{ Str::slug($ailment) }}" wire:model="family_medical_history"
                           value="{{ $ailment }}" class="form-check-input">
                    <label for="family_{{ Str::slug($ailment) }}" class="form-check-label ms-2">
                        {{ $ailment }}
                    </label>
                </div>
            </div>
        @endforeach
    
        <!-- Others -->
        <div class="col-md-6 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" id="family_others" wire:model="family_medical_history"
                       value="Others" class="form-check-input">
                <label for="family_others" class="form-check-label ms-2">Others (Specify)</label>
            </div>
        </div>
    
        <!-- Input field for "Others" when checked -->
        @if(in_array('Others', (array) $family_medical_history))
            <div class="col-md-12 mt-2">
                <input type="text" wire:model="family_other_specify" class="form-control"
                       placeholder="Specify Other Ailment">
            </div>
        @endif
    </div>
    

</div>
