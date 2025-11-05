<?php

namespace App\Http\Livewire\Profiling;

use App\Models\AssistanceRecord;
use App\Models\ChildLaborer;
use App\Models\ChildEducation;
use App\Models\ChildHealth;
use App\Models\FamilyMember;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\ChildWork;
use App\Models\PhilippineBarangay;
use App\Models\PhilippineCity;
use App\Models\PhilippineProvince;
use App\Models\PhilippineRegion;
use App\Models\RequestedService;

class ChildLaborerForm extends Component
{
    public $employer_regions = [];
    public $employer_provinces = [];
    public $employer_cities = [];
    public $employer_barangays = [];
    public $address_regions = [];
    public $address_provinces = [];
    public $address_cities = [];
    public $address_barangays = [];
    public $birth_regions = [];
    public $birth_provinces = [];
    public $birth_cities = [];
    public $birth_barangays = [];
    
    // Stepper Descriptions
    public $stepDescriptions = [
        1   => 'Personal Information',
        2   => 'Educational Background',
        3   => 'Health Information',
        4   => 'Work Information',
        5   => 'Family Profile',
        6   => 'Services Availed',
        7   => 'Services Requested'
    ];
    
    protected $listeners = ['nextStep', 'previousStep'];
    public $currentStep = 1;
    public $totalSteps = 7;
    public $cl_id;
    
    // Step 1: Personal Information
    public $last_name, $first_name, $middle_name, $suffix, $date_of_birth, $age, $birth_sitio;
    public $address_sitio, $contact_number, $medical_assessment;
    public $indigenous_group_spec, $religion_other, $house_id_number;
    public ?string $address_region = null;
    public ?string $address_province = null;
    public ?string $address_city = null;
    public ?string $address_barangay = null;
    public ?string $employer_region = null;
    public ?string $employer_province = null;
    public ?string $employer_city = null;
    public ?string $employer_barangay = null;
    public ?string $birth_region = null;
    public ?string $birth_province = null;
    public ?string $birth_city = null;
    public ?string $birth_barangay = null;
    public $is_4ps_member = '';

    public $indigenous_group = '';
    public $religion = '';

    public $birth_certificate = null;
    public $living_with = '';
    public $dwelling_type = '';
    public $sex = '';
    public $same_as_address = false;
    
    // A1
    public $has_gone_to_school, $currently_attending, $learner_reference_no, $mode_of_education, $age_stopped_schooling, $reason_for_stopping_other, $reason_for_stopping_other_text, $quit_schooling;
    public $highest_grade_completed = "";
    public $reason_for_stopping = [];

    // A2
    public $height_cm, $weight_kg, $has_disability, $requires_disability_assessment, $specific_disability_other, $child_ailments_other, $child_laborer_id;
    public $skin_disease_specify, $allergies_specify, $other_ailments_specify, $family_other_specify;
    public $specific_disability = [];
    public $child_ailments = [];
    public $family_medical_history =[];

    // A3
    public $workEntries = [];
    public $services_availed = [];
    public $family_members = [];
    public $services_requested = [];

    public function mount()
    {
        $this->employer_regions = PhilippineRegion::all();
        $this->address_regions = PhilippineRegion::all();
        $this->birth_regions = PhilippineRegion::all();
    }

    // HOME ADDRESS CASCADING
public function updatedAddressRegion($value)
{
    $this->address_province = null;
    $this->address_city = null;
    $this->address_barangay = null;
    $this->address_provinces = [];
    $this->address_cities = [];
    $this->address_barangays = [];
    
    if ($value) {
        $this->address_provinces = PhilippineProvince::where('region_code', $value)
            ->orderBy('name')
            ->get();
    }
    
    $this->dispatchBrowserEvent('address-region-changed');
}

public function updatedAddressProvince($value)
{
    $this->address_city = null;
    $this->address_barangay = null;
    $this->address_cities = [];
    $this->address_barangays = [];
    
    if ($value) {
        $this->address_cities = PhilippineCity::where('province_code', $value)
            ->orderBy('name')
            ->get();
    }
    
    $this->dispatchBrowserEvent('address-province-changed');
}

public function updatedAddressCity($value)
{
    $this->address_barangay = null;
    $this->address_barangays = [];
    
    if ($value) {
        $this->address_barangays = PhilippineBarangay::where('city_code', $value)
            ->orderBy('name')
            ->get()
            ->map(function ($b) { $b->code = (string) $b->code; return $b; });
    }
    
    $this->dispatchBrowserEvent('address-city-changed');
}

    // BIRTH ADDRESS CASCADING
public function updatedBirthRegion($value)
{
    $this->birth_province = null;
    $this->birth_city = null;
    $this->birth_barangay = null;
    $this->birth_provinces = [];
    $this->birth_cities = [];
    $this->birth_barangays = [];
    
    if ($value) {
        $this->birth_provinces = PhilippineProvince::where('region_code', $value)
            ->orderBy('name')
            ->get();
    }
    
    $this->dispatchBrowserEvent('birth-region-changed');
}

public function updatedBirthProvince($value)
{
    $this->birth_city = null;
    $this->birth_barangay = null;
    $this->birth_cities = [];
    $this->birth_barangays = [];
    
    if ($value) {
        $this->birth_cities = PhilippineCity::where('province_code', $value)
            ->orderBy('name')
            ->get();
    }
    
    $this->dispatchBrowserEvent('birth-province-changed');
}

public function updatedBirthCity($value)
{
    $this->birth_barangay = null;
    $this->birth_barangays = [];
    
    if ($value) {
        $this->birth_barangays = PhilippineBarangay::where('city_code', $value)
            ->orderBy('name')
            ->get()
            ->map(function ($b) { $b->code = (string) $b->code; return $b; });
    }
    
    $this->dispatchBrowserEvent('birth-city-changed');
}

    // SIMPLE VALIDATION - NO CUSTOM RULES
    protected $rules = [
        1 => [
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'middle_name' => 'nullable|string|max:255',
        'suffix' => 'nullable|string|max:10',
        'sex' => 'required|in:Male,Female',
        'date_of_birth' => 'required|date|before:today',
        'age' => 'required|integer|min:1|max:17',
        'birth_certificate' => 'required|in:Yes,No',
        
        // HOME ADDRESS - REQUIRED
        'address_sitio' => 'required|string|max:255',
        'address_region' => 'required|string|max:255',
        'address_province' => 'required|string|max:255',
        'address_city' => 'required|string|max:255',
        'address_barangay' => 'required|string|max:255',
        
        // BIRTH ADDRESS - CONDITIONAL BASED ON same_as_address
        'birth_region' => 'required_if:same_as_address,false|nullable|string|max:255',
        'birth_province' => 'required_if:same_as_address,false|nullable|string|max:255',
        'birth_city' => 'required_if:same_as_address,false|nullable|string|max:255',
        'birth_barangay' => 'required_if:same_as_address,false|nullable|string|max:255',
        
        'religion' => 'required|string|max:255',
        'religion_other' => 'nullable|required_if:religion,Others|string|max:255',
        'indigenous_group' => 'required|in:Yes,No',
        'indigenous_group_spec' => 'nullable|required_if:indigenous_group,Yes|string|max:255',
        
        'living_with' => 'required|in:Both Parents,Father Only,Mother Only,Relatives,Non-Relatives,Living Alone',
        'dwelling_type' => 'required|in:Strong Materials,Light Materials,Makeshift,Mixed Strong,Mixed Light,Mixed Salvaged,No Permanent Dwelling',
    ],
        2 => [
            // Keep only minimal blockers so the step can advance easily
            'has_gone_to_school' => 'required|in:Yes,No',
            'currently_attending' => 'required|in:Yes,No',
            'quit_schooling' => 'required|in:Yes,No',
            'highest_grade_completed' => 'required|string',
            // Relax the following conditionals to optional to avoid blocking
            'learner_reference_no' => 'nullable|string',
            'mode_of_education' => 'nullable|string',
            'age_stopped_schooling' => 'nullable|integer|min:3|max:99',
            'reason_for_stopping' => 'nullable|array',
            'reason_for_stopping_other' => 'nullable|boolean',
            'reason_for_stopping_other_text' => 'nullable|string|max:255',
        ],
        3 => [
            'height_cm' => 'required|numeric|min:30|max:300',
            'weight_kg' => 'required|numeric|min:1|max:500',
            'has_disability' => 'required|in:Yes,No',
            'specific_disability' => 'nullable|exclude_unless:has_disability,Yes|array',
            'specific_disability.*' => 'string|in:Hearing Impairment,Visual/Seeing Disability,Communication Deficits,Mental Disability,Multiple Disabilities,Orthopedic/Moving Disability,Learning (Cognitive or Intellectual) Disability,Psychosocial and Behavioral Disabilities,Chronic Illness with Disabilities,Others',
            'specific_disability_other' => 'nullable|required_if:specific_disability.*,Others|string',
            
            'child_ailments' => 'array|nullable',
            'child_ailments.*' => 'string|in:Measles,Chickenpox,Dengue,Influenza (Flu),Malaria,Typhoid,Diarrhea,Recurring Fever,Tuberculosis / Primary Complex,Skin Disease,Allergies,Others,None',
            'skin_disease_specify' => 'required_if:child_ailments.*,Skin Disease|string|nullable',
            'allergies_specify' => 'required_if:child_ailments.*,Allergies|string|nullable',
            'other_ailments_specify' => 'required_if:child_ailments.*,Others|string|nullable',

            // If None is selected or no ailments selected, medical_assessment should be nullable and not required
            'medical_assessment' => 'nullable|in:Yes,No',

            'family_medical_history' => 'array|nullable',
            'family_medical_history.*' => 'string|in:Hypertension,Diabetes,Asthma,Kidney Ailment,Liver Ailment,Heart Ailment,Cancer,Paralysis,Respiratory Illness,Others,None',
            'family_other_specify' => 'required_if:family_medical_history.*,Others|string|nullable',
        ],
        4 => [
            // Relaxed to match current UI in step4.blade.php
            'workEntries.*.nature_of_work' => 'required|string',
            'workEntries.*.work_location' => 'required|string',
            'workEntries.*.age_started_working' => 'required|numeric|min:1|max:99',
            'workEntries.*.working_hours_per_day' => 'required|numeric|min:1|max:24',
            // Other fields optional until UI is completed
            'workEntries.*.nature_of_work_other' => 'nullable|string',
            'workEntries.*.work_location_other' => 'nullable|string',
            'workEntries.*.specific_tasks' => 'nullable|string',
            'workEntries.*.employer_name' => 'nullable|string',
            'workEntries.*.employer_contact' => 'nullable|string',
            'workEntries.*.work_basis' => 'nullable|string',
            'workEntries.*.work_months' => 'nullable|array',
            'workEntries.*.work_arrangement' => 'nullable|string',
            'workEntries.*.work_arrangement_other' => 'nullable|string',
            'workEntries.*.working_days_per_week' => 'nullable|numeric|min:1|max:7',
            'workEntries.*.work_start_time' => 'nullable|date_format:H:i',
            'workEntries.*.work_end_time' => 'nullable|date_format:H:i',
            'workEntries.*.payment_basis' => 'nullable|string',
            'workEntries.*.exposure_risks' => 'nullable|array',
            'workEntries.*.average_monthly_income' => 'nullable|numeric|min:0',
            'workEntries.*.has_adult_supervisor' => 'nullable|string|in:Yes,No',
            'workEntries.*.work_supervisors' => 'nullable|array',
            'workEntries.*.work_supervisors_other' => 'nullable|string',
            'workEntries.*.supervisor_name' => 'nullable|string',
            'workEntries.*.earnings_usage' => 'nullable|array',
            'workEntries.*.earnings_usage_other' => 'nullable|string',
        ],
        5 => [
            'is_4ps_member' => 'required',
            'house_id_number' => 'required_if:is_4ps_member,Yes',
            'family_members' => 'required|array|min:1',
            'family_members.*.name' => 'required|string|max:255',
            'family_members.*.relationship' => 'required|string|max:255',
            'family_members.*.sex' => 'required|in:Male,Female',
            'family_members.*.age' => 'required|integer|min:0|max:120',
            'family_members.*.civil_status' => 'required|string|max:255',
            'family_members.*.education' => 'required|string',
            'family_members.*.solo_parent' => 'required|in:Yes,No,NA',
            'family_members.*.occupation' => 'nullable|string|max:255',
            'family_members.*.income' => 'nullable|numeric|min:0',
            'family_members.*.disability' => 'nullable|string|max:255',
            'family_members.*.skills' => 'nullable|string|max:255',
            'family_members.*.whereabouts' => 'nullable|string|max:255',
        ],
        6 => [
            'services_availed.*.assistance' => 'required|string',
            'services_availed.*.source' => 'required|string',
            'services_availed.*.year' => 'required|integer|min:2000',
            'services_availed.*.members' => 'required|string',
            'services_availed.*.remarks' => 'nullable|string',
        ],
        7 => [
            'services_requested.*.assistance' => 'required|string|max:255',
            'services_requested.*.source' => 'required|string|max:255',
            'services_requested.*.start_date' => 'required|date',
            'services_requested.*.end_date' => 'required|date|after_or_equal:services_requested.*.start_date',
            'services_requested.*.members' => 'required|string|max:255',
            'services_requested.*.remarks' => 'nullable|string|max:255',
        ]
    ];

    public function updated($propertyName)
    {
        if (array_key_exists($this->currentStep, $this->rules)) {
            $rulesForCurrentStep = $this->rules[$this->currentStep];
            $this->validateOnly($propertyName, $rulesForCurrentStep);
        }
    }

    // Keep all your other methods exactly as they were...
    public function addService()
    {
        $this->services_availed[] = [
            'assistance' => '',
            'source' => '',
            'year' => '',
            'members' => '',
            'remarks' => '',
        ];
    }

    public function removeService($index)
    {
        unset($this->services_availed[$index]);
        $this->services_availed = array_values($this->services_availed);
    }

    public function addFamilyMember()
    {
        $this->family_members[] = [
            'name' => '',
            'relationship' => '',
            'sex' => '',
            'age' => '',
            'civil_status' => '',
            'solo_parent' => 'No',
            'education' => '',
            'occupation' => '',
            'income' => '',
            'skills' => '',
            'whereabouts' => '',
            'disability' => ''
        ];
    }

    public function removeFamilyMember($index)
    {
        unset($this->family_members[$index]);
        $this->family_members = array_values($this->family_members);
    }

    // EMPLOYER ADDRESS CASCADING
public function updatedEmployerRegion($value)
{
    $this->employer_province = null;
    $this->employer_city = null;
    $this->employer_barangay = null;
    $this->employer_provinces = [];
    $this->employer_cities = [];
    $this->employer_barangays = [];
    
    if ($value) {
        $this->employer_provinces = PhilippineProvince::where('region_code', $value)
            ->orderBy('name')
            ->get();
    }
}

public function updatedEmployerProvince($value)
{
    $this->employer_city = null;
    $this->employer_barangay = null;
    $this->employer_cities = [];
    $this->employer_barangays = [];
    
    if ($value) {
        $this->employer_cities = PhilippineCity::where('province_code', $value)
            ->orderBy('name')
            ->get();
    }
}

public function updatedEmployerCity($value)
{
    $this->employer_barangay = null;
    $this->employer_barangays = [];
    
    if ($value) {
        $this->employer_barangays = PhilippineBarangay::where('city_code', $value)
            ->orderBy('name')
            ->get();
    }
}
    public function addWorkEntry()
    {
        $this->workEntries[] = [
            'nature_of_work' => '',
            'nature_of_work_other' => '',
            'work_location' => '',
            'work_location_other' => '',
            'specific_tasks' => '',
            'employer_name' => '',
            'employer_contact' => '',
            'work_basis' => '',
            'work_months' => [],
            'work_arrangement' => '',
            'work_arrangement_other' => '',
            'working_hours_per_day' => '',
            'working_days_per_week' => '',
            'work_start_time' => '',
            'work_end_time' => '',
            'age_started_working' => '',
            'payment_basis' => '',
            'exposure_risks' => [],
            'average_monthly_income' => '',
            'has_adult_supervisor' => '',
            'work_supervisors' => [],
            'work_supervisors_other' => '',
            'supervisor_name' => '',
            'earnings_usage' => [],
            'earnings_usage_other' => '',
        ];
    }

    public function removeWorkEntry($index)
    {
        unset($this->workEntries[$index]);
        $this->workEntries = array_values($this->workEntries);
    }

    public function addServiceRequested()
    {
        $this->services_requested[] = [
            'assistance' => '',
            'source' => '',
            'start_date' => '',
            'end_date' => '',
            'members' => '',
            'remarks' => '',
        ];
    }

    public function removeServiceRequested($index)
    {
        unset($this->services_requested[$index]);
        $this->services_requested = array_values($this->services_requested);
    }

    // IMPROVED toggleSameAsAddress
public function toggleSameAsAddress()
{
    if ($this->same_as_address) {
        // Copy all values including barangay text
        $this->birth_region = $this->address_region;
        $this->birth_province = $this->address_province;
        $this->birth_city = $this->address_city;
        $this->birth_barangay = $this->address_barangay; // Just copy the text
        
        // Load region/province/city dropdowns
        if ($this->birth_region) {
            $this->birth_provinces = PhilippineProvince::where('region_code', $this->birth_region)
                ->orderBy('name')
                ->get();
        }
        if ($this->birth_province) {
            $this->birth_cities = PhilippineCity::where('province_code', $this->birth_province)
                ->orderBy('name')
                ->get();
        }
    } else {
        // Clear everything
        $this->birth_region = null;
        $this->birth_province = null;
        $this->birth_city = null;
        $this->birth_barangay = null;
        $this->birth_provinces = [];
        $this->birth_cities = [];
    }
}

// ADD THIS NEW METHOD - This ensures barangay values are properly set
public function updatedAddressBarangay($value)
{
    // Just log for debugging - don't modify the value
    \Log::info('Address Barangay Updated', [
        'value' => $value,
        'city' => $this->address_city
    ]);
}

public function updatedBirthBarangay($value)
{
    // Just log for debugging - don't modify the value
    \Log::info('Birth Barangay Updated', [
        'value' => $value,
        'city' => $this->birth_city,
        'same_as_address' => $this->same_as_address
    ]);
}

    public function updatedDateOfBirth()
    {
        if ($this->date_of_birth) {
            $this->age = Carbon::parse($this->date_of_birth)->age;
        }
    }

    public function updatedChildAilments($value)
    {
        $this->child_ailments = (array) $this->child_ailments;

        if (in_array('None', $this->child_ailments)) {
            $this->child_ailments = ['None'];
            $this->skin_disease_specify = null;
            $this->allergies_specify = null;
            $this->other_ailments_specify = null;
        }

        if (count($this->child_ailments) > 1 && in_array('None', $this->child_ailments)) {
            $this->child_ailments = array_diff($this->child_ailments, ['None']);
        }
    }

    public function updatedFamilyMedicalHistory($value)
    {
        $this->family_medical_history = (array) $this->family_medical_history;

        if (in_array('None', $this->family_medical_history)) {
            $this->family_medical_history = ['None'];
            $this->family_other_specify = null;
        }

        if (count($this->family_medical_history) > 1 && in_array('None', $this->family_medical_history)) {
            $this->family_medical_history = array_diff($this->family_medical_history, ['None']);
        }
    }

    // IMPROVED nextStep with better validation
public function nextStep()
{
    // Log current values for debugging
    \Log::info('Next Step Called', [
        'step' => $this->currentStep,
        'address_barangay' => $this->address_barangay,
        'birth_barangay' => $this->birth_barangay,
        'same_as_address' => $this->same_as_address
    ]);
    
    // Copy address to birth if checkbox is checked
    if ($this->currentStep == 1 && $this->same_as_address) {
        $this->birth_region = $this->address_region;
        $this->birth_province = $this->address_province;
        $this->birth_city = $this->address_city;
        $this->birth_barangay = $this->address_barangay;
    }
    
    // Validate
    if (array_key_exists($this->currentStep, $this->rules)) {
        try {
            $this->validate($this->rules[$this->currentStep]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Failed', [
                'errors' => $e->errors(),
                'step' => $this->currentStep
            ]);
            throw $e;
        }
    }
    
    // Move to next step
    if ($this->currentStep < $this->totalSteps) {
        $this->currentStep++;
    }
}

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function gotoStep($step)
    {
        $this->currentStep = $step;
    }

    public function render()
    {
        return view('livewire.profiling.child-laborer-form');
    }

    public function save()
    {
        try {
            DB::beginTransaction();
        
            // Create Child Laborer
            $clData = ChildLaborer::create([
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'last_name' => $this->last_name,
                'suffix' => $this->suffix,
                'sex' => $this->sex,
                'date_of_birth' => $this->date_of_birth,
                'age' => $this->age,
                'birth_certificate' => $this->birth_certificate === 'Yes' ? 1 : 0,
                'address_region' => $this->address_region,
                'address_province' => $this->address_province,
                'address_city' => $this->address_city,
                'address_barangay' => $this->address_barangay,
                'address_sitio' => $this->address_sitio,
                'place_of_birth' => $this->getBirthPlaceText(),
                'religion' => $this->religion,
                'indigenous_group' => $this->indigenous_group,
                'living_with' => $this->living_with,
                'dwelling_type' => $this->dwelling_type,
                'contact_number' => $this->contact_number ?? null,
                'is_4ps_member' => $this->is_4ps_member,
                'house_id_number' => $this->is_4ps_member === 'Yes' ? $this->house_id_number : null,
            ]);
        
            $this->cl_id = $clData->id;
        
            // Create Education Record
            if ($this->has_gone_to_school) {
                ChildEducation::create([
                    'child_laborer_id' => $this->cl_id,
                    'has_gone_to_school' => $this->has_gone_to_school === 'Yes' ? 1 : 0,
                    'currently_attending' => $this->currently_attending === 'Yes' ? 1 : 0,
                    'learner_reference_no' => $this->currently_attending === 'Yes' ? $this->learner_reference_no : null,
                    'mode_of_education' => $this->mode_of_education,
                    'quit_schooling' => $this->quit_schooling === 'Yes' ? 1 : 0,
                    'highest_grade_completed' => $this->highest_grade_completed,
                    'age_stopped_schooling' => $this->quit_schooling === 'Yes' ? $this->age_stopped_schooling : null,
                    'reason_for_stopping' => $this->quit_schooling === 'Yes' 
                        ? json_encode(array_merge(
                            $this->reason_for_stopping ?? [], 
                            $this->reason_for_stopping_other && $this->reason_for_stopping_other_text 
                                ? [$this->reason_for_stopping_other_text] 
                                : []
                        )) 
                        : null,
                ]);
            }
        
            // Create Health Record
            if ($this->height_cm && $this->weight_kg) {
                ChildHealth::create([
                    'child_laborer_id' => $this->cl_id,
                    'height_cm' => $this->height_cm,
                    'weight_kg' => $this->weight_kg,
                    'has_disability' => $this->has_disability === 'Yes' ? 1 : 0,
                    'specific_disability' => $this->specific_disability ? json_encode($this->specific_disability) : null,
                    'specific_disability_other' => $this->specific_disability_other,
                    'child_ailments' => $this->child_ailments ? json_encode($this->child_ailments) : null,
                    'skin_disease_specify' => $this->skin_disease_specify,
                    'allergies_specify' => $this->allergies_specify,
                    'other_ailments_specify' => $this->other_ailments_specify,
                    'medical_assessment' => $this->medical_assessment === 'Yes' ? 1 : 0,
                    'family_medical_history' => $this->family_medical_history ? json_encode($this->family_medical_history) : null,
                    'family_other_specify' => $this->family_other_specify,
                ]);
            }
        
            // Create Work Entries
            foreach ($this->workEntries as $entry) {
                ChildWork::create([
                    'child_laborer_id' => $this->cl_id,
                    'nature_of_work' => $entry['nature_of_work'],
                    'nature_of_work_other' => $entry['nature_of_work_other'] ?? null,
                    'work_location' => $entry['work_location'],
                    'work_location_other' => $entry['work_location_other'] ?? null,
                    'specific_tasks' => $entry['specific_tasks'] ?? null,
                    'employer_name' => $entry['employer_name'] ?? null,
                    'employer_contact' => $entry['employer_contact'] ?? null,
                    'work_basis' => $entry['work_basis'],
                    'work_months' => isset($entry['work_months']) ? json_encode($entry['work_months']) : null,
                    'employer_region' => $this->employer_region ?? null,
                    'employer_province' => $this->employer_province ?? null,
                    'employer_city' => $this->employer_city ?? null,
                    'employer_barangay' => $this->employer_barangay ?? null,
                    'work_arrangement' => $entry['work_arrangement'],
                    'work_arrangement_other' => $entry['work_arrangement_other'] ?? null,
                    'working_hours_per_day' => $entry['working_hours_per_day'] ?? null,
                    'working_days_per_week' => $entry['working_days_per_week'] ?? null,
                    'work_start_time' => $entry['work_start_time'] ?? null,
                    'work_end_time' => $entry['work_end_time'] ?? null,
                    'age_started_working' => $entry['age_started_working'],
                    'payment_basis' => $entry['payment_basis'] ?? null,
                    'exposure_risks' => isset($entry['exposure_risks']) ? json_encode($entry['exposure_risks']) : null,
                    'average_monthly_income' => $entry['average_monthly_income'] ?? null,
                    'has_adult_supervisor' => $entry['has_adult_supervisor'] === 'Yes' ? 1 : 0,
                    'work_supervisors' => isset($entry['work_supervisors']) ? json_encode($entry['work_supervisors']) : null,
                    'work_supervisors_other' => $entry['work_supervisors_other'] ?? null,
                    'supervisor_name' => $entry['supervisor_name'] ?? null,
                    'earnings_usage' => isset($entry['earnings_usage']) ? json_encode($entry['earnings_usage']) : null,
                    'earnings_usage_other' => $entry['earnings_usage_other'] ?? null,
                ]);
            }
        
            // Create Family Members
            foreach ($this->family_members as $member) {
                FamilyMember::create([
                    'child_laborer_id' => $clData->id,
                    'full_name' => $member['name'],
                    'relationship' => $member['relationship'],
                    'sex' => $member['sex'],
                    'age' => $member['age'],
                    'civil_status' => $member['civil_status'],
                    'education' => $member['education'] ?? null,
                    'solo_parent' => $member['solo_parent'] ?? null,
                    'occupation' => $member['occupation'] ?? null,
                    'income' => $member['income'] ?? null,
                    'disability' => $member['disability'] ?? null,
                    'skills' => $member['skills'] ?? null,
                    'whereabouts' => $member['whereabouts'] ?? null,
                ]);
            }
        
            // Create Services Availed
            foreach ($this->services_availed as $service) {
                AssistanceRecord::create([
                    'child_laborer_id' => $this->cl_id,
                    'type_of_assistance' => $service['assistance'] ?? null,
                    'source' => $service['source'] ?? null,
                    'date_provided' => $service['year'] ?? null,
                    'family_member_recieved' => $service['members'] ?? null,
                    'remarks' => $service['remarks'] ?? null,
                ]);
            }
        
            // Create Services Requested
            foreach ($this->services_requested as $service) {
                RequestedService::create([
                    'child_laborer_id' => $this->cl_id,
                    'type_of_assistance' => $service['assistance'] ?? null,
                    'source' => $service['source'] ?? null,
                    'start_date' => $service['start_date'] ?? null,
                    'end_date' => $service['end_date'] ?? null,
                    'family_member_requested' => $service['members'] ?? null,
                    'remarks' => $service['remarks'] ?? null,
                ]);
            }
        
            DB::commit();
            
            // Reset form and show success
            $this->resetForm();
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('swal:modal', [
                'title' => 'Success!',
                'text' => 'Child Laborer Profile Saved Successfully.',
                'icon' => 'success',
                'timer' => 3000,
                'showConfirmButton' => false,
            ]);
            
            $this->emit('childLaborerAdded');
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error saving child laborer: ' . $e->getMessage());
            $this->dispatchBrowserEvent('swal:modal', [
                'title' => 'Error!',
                'text' => 'An error occurred while saving the profile: ' . $e->getMessage(),
                'icon' => 'error',
            ]);
        }
    }

    private function getBirthPlaceText()
{
    if ($this->same_as_address) {
        return $this->getAddressText();
    }
    
    $parts = [];
    
    if ($this->birth_barangay) {
        $parts[] = 'Brgy. ' . $this->birth_barangay;
    }
    
    if ($this->birth_city) {
        $city = PhilippineCity::where('city_code', $this->birth_city)->first();
        if ($city) $parts[] = $city->name;
    }
    
    if ($this->birth_province) {
        $province = PhilippineProvince::where('province_code', $this->birth_province)->first();
        if ($province) $parts[] = $province->name;
    }
    
    if ($this->birth_region) {
        $region = PhilippineRegion::where('region_code', $this->birth_region)->first();
        if ($region) $parts[] = $region->name;
    }
    
    return implode(', ', $parts);
}

private function getAddressText()
{
    $parts = [];
    
    if ($this->address_sitio) {
        $parts[] = $this->address_sitio;
    }
    
    if ($this->address_barangay) {
        $parts[] = 'Brgy. ' . $this->address_barangay;
    }
    
    if ($this->address_city) {
        $city = PhilippineCity::where('city_code', $this->address_city)->first();
        if ($city) $parts[] = $city->name;
    }
    
    if ($this->address_province) {
        $province = PhilippineProvince::where('province_code', $this->address_province)->first();
        if ($province) $parts[] = $province->name;
    }
    
    if ($this->address_region) {
        $region = PhilippineRegion::where('region_code', $this->address_region)->first();
        if ($region) $parts[] = $region->name;
    }
    
    return implode(', ', $parts);
}

    private function resetForm()
    {
        $this->currentStep = 1;
        $this->reset([
            'first_name', 'middle_name', 'last_name', 'suffix', 'sex',
            'date_of_birth', 'age', 'birth_certificate', 'address_sitio',
            'address_region', 'address_province', 'address_city', 'address_barangay',
            'birth_region', 'birth_province', 'birth_city', 'birth_barangay',
            'religion', 'religion_other', 'indigenous_group', 'indigenous_group_spec',
            'living_with', 'dwelling_type', 'contact_number', 'is_4ps_member', 'house_id_number',
            'has_gone_to_school', 'currently_attending', 'learner_reference_no', 'mode_of_education',
            'quit_schooling', 'highest_grade_completed', 'age_stopped_schooling', 'reason_for_stopping',
            'reason_for_stopping_other', 'reason_for_stopping_other_text', 'height_cm', 'weight_kg',
            'has_disability', 'specific_disability', 'specific_disability_other', 'child_ailments',
            'skin_disease_specify', 'allergies_specify', 'other_ailments_specify', 'medical_assessment',
            'family_medical_history', 'family_other_specify'
        ]);
        $this->workEntries = [];
        $this->family_members = [];
        $this->services_availed = [];
        $this->services_requested = [];
        $this->employer_regions = PhilippineRegion::all();
        $this->address_regions = PhilippineRegion::all();
        $this->birth_regions = PhilippineRegion::all();
    }
}