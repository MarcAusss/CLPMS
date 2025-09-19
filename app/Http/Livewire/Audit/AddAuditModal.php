<?php
namespace App\Http\Livewire\Audit;

use Livewire\Component;
use App\Models\Audit;
use App\Models\AuditABParticular;
use App\Models\AuditBudget;
use App\Models\AuditCriterion;
use App\Models\AuditEngagementPlan;
use App\Models\AuditEngagementPlanSpecific;
use App\Models\AuditEquipment;
use App\Models\AuditMethod;
use App\Models\AuditObjective;
use App\Models\AuditResourceReference;
use App\Models\AuditScope;
use App\Models\AuditTeam;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AddAuditModal extends Component
{
    // Stepper Descriptions
    public $stepDescriptions = [
        1   => 'Audit Project',
        2   => 'Objectives',
        3   => 'Scope & Methodology',
        4   => 'Criteria & Reference',
        5   => 'Execution Plan',
        6   => 'Budget & Equipment',
        7   => 'Team Members',
    ];
    protected $listeners = ['nextStep', 'previousStep'];
    public $currentStep = 1;
    public $totalSteps = 7;

    // Step 1: Audit Information
    public $auditId;
    public $a_proj_title;
    public $a_proj_no;
    public $a_date_range;
    public $a_intro;
    public $a_privacy_policy;
    public $a_aoc;
    public $a_approach;

    // Step 2: Objectives
    public $ao_repeater = [""];

    // Step 3: Scope and Methodology
    public $as_text;
    public $am_text;

    // Step 4: Audit Criteria and References
    public $ac_repeater = [""];
    public $arf_repeater = [""];

    // Step 5: Audit Execution Plan
    public $aepId;
    public $aep_date_start;
    public $aep_date_end;
    public $aep_repeater = [
        [
            "section" => "",
            "activity" => "",
            "date_range" => "",
            "particulars" => [""],
        ],
    ];

    // Step 6: Budget and Equipments
    public $abId;
    public $ab_repeater = [
        ["name" => "", "total" => "", "particulars" => [""]],
    ];
    public $ae_repeater = [""];

    // Step 7: Team Members
    public $at_repeater = [["designation" => "", "name" => ""]];

    protected $rules = [
        1 => [
            "a_proj_title" => "required|string",
            "a_proj_no" => "required|string",
            "a_date_range" => "required|string",
            "a_intro" => "required|string",
            "a_privacy_policy" => "required|string",
            "a_aoc" => "required|string",
            "a_approach" => "required|string",
        ],
        2 => ['ao_repeater.*.objective' => 'required|string'], 
        3 => ["as_text" => "required|string", "am_text" => "required|string"],
        4 => [
            "ac_repeater.*" => "required|string",
            "arf_repeater.*" => "required|string",
        ],
        5 => [
            "aep_repeater.*.section" => "required|string",
            "aep_repeater.*.activity" => "required|string",
            "aep_repeater.*.date_range" => "required|string",
            "aep_repeater.*.particulars.*" => "required|string",
        ],
        6 => [
            "ab_repeater.*.name" => "required|string",
            "ab_repeater.*.total" => "required|numeric",
            "ab_repeater.*.particulars.*" => "required|string",
            "ae_repeater.*" => "required|string",
        ],
        7 => [
            "at_repeater.*.designation" => "required|string",
            "at_repeater.*.name" => "required|string",
        ],
    ];

    
    protected $messages = [
        'a_proj_title.required' => 'Project Title is required.',
        'a_proj_no.required' => 'Project Number is required.',
        'a_date_range.required' => 'Date Range is required.',
        'a_intro.required' => 'Introduction is required.',
        'a_privacy_policy.required' => 'Privacy Policy is required.',
        'a_aoc.required' => 'Acceptance of Conditions is required.',
        'a_approach.required' => 'Approach is required.',
    
        'ao_repeater.*.objective.required' => 'Objective is required.',
    
        'as_text.required' => 'Scope of Work is required.',
        'am_text.required' => 'Methodology is required.',
    
        'ac_repeater.*.required' => 'Criterias are required.',
        'arf_repeater.*.required' => 'References are required.',
    
        'aep_repeater.*.section.required' => 'Section is required.',
        'aep_repeater.*.activity.required' => 'Activity is required.',
        'aep_repeater.*.date_range.required' => 'Date Range is required.',
        'aep_repeater.*.particulars.*.required' => 'Particulars are required.',
    
        'ab_repeater.*.name.required' => 'Name is required.',
        'ab_repeater.*.total.required' => 'Total is required.',
        'ab_repeater.*.total.numeric' => 'Total must be a number.',
        'ab_repeater.*.particulars.*.required' => 'Particulars are required.',
        'ae_repeater.*.required' => 'Evaluation Criteria is required.',
    
        'at_repeater.*.designation.required' => 'Designation is required.',
        'at_repeater.*.name.required' => 'Name is required.',
    ];

    public function mount()
    {
        // Initialize with at least one empty objective
        $this->ao_repeater = [
            ['objective' => ''],
        ];
    }
    
    public function updated($propertyName)
    {
        if (array_key_exists($this->currentStep, $this->rules)) {
            $rulesForCurrentStep = $this->rules[$this->currentStep];
            if (array_key_exists($propertyName, $rulesForCurrentStep) || str_starts_with($propertyName, 'ao_repeater.') || str_starts_with($propertyName, 'ac_repeater.') || str_starts_with($propertyName, 'arf_repeater.') || str_starts_with($propertyName, 'aep_repeater.') || str_starts_with($propertyName, 'ab_repeater.') || str_starts_with($propertyName, 'ae_repeater.') || str_starts_with($propertyName, 'at_repeater.')) {
                $this->validateOnly($propertyName, $rulesForCurrentStep);
            }
        }
        if ($propertyName === 'a_date_range') {
            if (!empty($this->a_date_range)) {
                try {
                    $dates = explode(' to ', $this->a_date_range);
                    Carbon::parse($dates[0]);
                    Carbon::parse($dates[1]);
                    $this->validateOnly($propertyName);
                } catch (\Exception $e) {
                    $this->addError('a_date_range', 'Invalid date format.');
                }
            }
        }
    }

    public function nextStep()
    {
        $this->validateData();
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

    private function validateData()
    {
        if (array_key_exists($this->currentStep, $this->rules)) {
            $this->validate($this->rules[$this->currentStep]);
        }
    }

    // Repeater Methods

    public function addObjective()
    {
        $this->ao_repeater[] = ["objective" => ""];
    }

    public function removeObjective($index)
    {
        unset($this->ao_repeater[$index]);
        $this->ao_repeater = array_values($this->ao_repeater);
    }

    public function addCriteria()
    {
        $this->ac_repeater[] = "";
    }

    public function removeCriteria($index)
    {
        unset($this->ac_repeater[$index]);
        $this->ac_repeater = array_values($this->ac_repeater);
    }

    public function addReference()
    {
        $this->arf_repeater[] = "";
    }

    public function removeReference($index)
    {
        unset($this->arf_repeater[$index]);
        $this->arf_repeater = array_values($this->arf_repeater);
    }

    public function addOuterItem()
    {
        $this->aep_repeater[] = [
            "section" => "",
            "activity" => "",
            "date_range" => "",
            "particulars" => [""],
        ];
    }

    public function removeOuterItem($outerIndex)
    {
        unset($this->aep_repeater[$outerIndex]);
        $this->aep_repeater = array_values($this->aep_repeater);
    }

    public function addParticular($outerIndex)
    {
        $this->aep_repeater[$outerIndex]["particulars"][] = "";
    }

    public function removeParticular($outerIndex, $innerIndex)
    {
        unset($this->aep_repeater[$outerIndex]["particulars"][$innerIndex]);
        $this->aep_repeater[$outerIndex]["particulars"] = array_values(
            $this->aep_repeater[$outerIndex]["particulars"]
        );
    }

    public function addAbOuterItem()
    {
        $this->ab_repeater[] = [
            "name" => "",
            "total" => "",
            "particulars" => [""],
        ];
    }

    public function removeAbOuterItem($outerIndex)
    {
        unset($this->ab_repeater[$outerIndex]);
        $this->ab_repeater = array_values($this->ab_repeater);
    }

    public function addAbParticular($outerIndex)
    {
        $this->ab_repeater[$outerIndex]["particulars"][] = "";
    }

    public function removeAbParticular($outerIndex, $innerIndex)
    {
        unset($this->ab_repeater[$outerIndex]["particulars"][$innerIndex]);
        $this->ab_repeater[$outerIndex]["particulars"] = array_values(
            $this->ab_repeater[$outerIndex]["particulars"]
        );
    }

    public function addAeItem()
    {
        $this->ae_repeater[] = "";
    }

    public function removeAeItem($index)
    {
        unset($this->ae_repeater[$index]);
        $this->ae_repeater = array_values($this->ae_repeater);
    }

    public function addAtItem()
    {
        $this->at_repeater[] = ["designation" => "", "name" => ""];
    }

    public function removeAtItem($index)
    {
        unset($this->at_repeater[$index]);
        $this->at_repeater = array_values($this->at_repeater);
    }

    public function submit()
    {
        $this->validateData();
        try {
            // Database Transaction
            DB::transaction(function () {
                [$this->a_start, $this->a_end] = explode(' to ', $this->a_date_range);
    
                $auditModel = Audit::Create(
                    ['a_proj_title'    => $this->a_proj_title,
                    'a_start'          => $this->a_start,
                    'a_end'            => $this->a_end,
                    'a_proj_no'        => $this->a_proj_no,
                    'a_privacy_policy' => $this->a_privacy_policy],
                );
                
                // Fetch Audit PK
                $this->auditId = $auditModel->a_id;
    
                // Audit Objectives Insert
                foreach ($this->ao_repeater as $objective) {
                    $auditObjModel = AuditObjective::Create([
                        'fk_audit' => $this->auditId, // Foreign key referencing the Audit record
                        'ao_text'  => $objective['objective'], // Text from repeater input
                    ]);
                }
                
                // Audit Scope
                $auditScopeModel = AuditScope::Create([
                    'fk_audit' => $this->auditId, // Foreign key referencing the Audit record
                    'as_text' =>$this->as_text,
                ]);
    
                // Audit Methodology
                $auditMethodologyModel = AuditMethod::Create([
                    'fk_audit' => $this->auditId, // Foreign key referencing the Audit record
                    'am_text' =>$this->am_text,
                ]);
    
                // Audit Criteria
                foreach($this->ac_repeater as $criteria) {
                    $auditCriteriaModel = AuditCriterion::Create([
                        'fk_audit'  => $this->auditId,
                        'ac_text'   => $criteria,
                    ]);
                }
    
                // Audit References
                foreach($this->arf_repeater as $reference) {
                    $auditReferenceModel = AuditResourceReference::Create([
                        'fk_audit'  => $this->auditId,
                        'arf_text'  => $reference,
                    ]);
                }
    
                // Audit Execution Plan
                foreach($this->aep_repeater as $aep) {
                    [$this->aep_date_start, $this->aep_date_end] = explode(' to ', $aep['date_range']);
                    $auditExecutionPlanModel = AuditEngagementPlan::Create([
                        'fk_audit'      =>  $this->auditId,
                        'aep_section'   =>  $aep['section'],
                        'aep_activity'  =>  $aep['activity'],
                        'aep_start'     =>  $this->aep_date_start,
                        'aep_end'       =>  $this->aep_date_end,
                    ]);
                    // Fetch Audit Execution Plan ID
                    $this->aepId = $auditExecutionPlanModel->aep_id;
                    // Audit Execution Plan Particulars
                    foreach($aep['particulars'] as $aepartics) {
                        $auditExecutionPlanSpecsModel = AuditEngagementPlanSpecific::Create([
                            'fk_aep'            =>  $this->aepId,
                            'aep_particular'    =>  $aepartics
                        ]);
                    }
    
                }
                
                // Audit Budget
                foreach($this->ab_repeater as $budget) {
                    $auditBudgetModel = AuditBudget::Create([
                        'fk_audit'      =>      $this->auditId,
                        'ab_total'      =>      $budget['total'],
                        'ab_text'       =>      $budget['name']
                    ]);
    
                    // Fetch Audit Budget ID
                    $this->abId = $auditBudgetModel->ab_id;
    
                    // Audit Budget Particulars
                    foreach($budget['particulars'] as $abpart) {
                        $auditBudgetParticularModel = AuditABParticular::Create([
                            'fk_ab'     => $this->abId,
                            'aabp_text' => $abpart,
                        ]);
                    }
                } 
    
                // Audit Equipments
                foreach($this->ae_repeater as $equipment) {
                    $auditEquimpentModel = AuditEquipment::Create([
                        'fk_audit'      =>      $this->auditId,
                        'ae_item'       =>      $equipment
                    ]);
                }
    
                //Audit Team
                foreach($this->at_repeater as $team) {
                    if($team['designation'] === "Team Leader") {
                        $auditTeamModel = AuditTeam::Create([
                            'fk_audit'          =>  $this->auditId,
                            'at_name'           =>  $team['name'],
                            'at_designation'    =>  $team['designation'],
                            'at_role'           =>  "Leader"
                        ]);
                    } else {
                        $auditTeamModel = AuditTeam::Create([
                            'fk_audit'          =>  $this->auditId,
                            'at_name'           =>  $team['name'],
                            'at_designation'    =>  $team['designation'],
                            'at_role'           =>  "Member"
                        ]);
                    }
                }
                
    
            });
            
            // Reset the Stepper
            $this->currentStep = 1; // Reset stepper to the first step

             // Reset the form immediately
             $this->reset(['a_proj_title', 'a_proj_no', 'a_date_range', 
             'a_intro', 'a_privacy_policy', 'a_aoc', 'a_approach', 
             'ao_repeater', 'as_text', 'am_text', 'ac_repeater', 
             'arf_repeater', 'aep_repeater', 'ab_repeater', 
             'ae_repeater', 'at_repeater']); 

            $this->dispatchBrowserEvent('swal:modal', [
                'title' => 'Success!',
                'text' => 'Audit created successfully.',
                'icon' => 'success',
                'timer' => 3000,
                'showConfirmButton' => false,
            ]);



            // Emit closeModal event after a slight delay (optional)
            $this->emit('closeModal'); 
        } catch (\Exception $e) {
            Log::error($e); 
            dd($e);
            $this->dispatchBrowserEvent('swal:modal', [
                'title' => 'Error!',
                'text' => 'An error occurred while creating the audit.',
                'icon' => 'error',
            ]);
        }
    }

    public function render()
    {
        
        return view("livewire.audit.add-audit-modal");
    }
}