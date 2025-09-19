<?php

namespace App\Http\Livewire\Audit;

use Livewire\Component;
use App\Models\Audit;
use App\Models\AuditObjective;
use Illuminate\Support\Facades\DB;

// class AddAuditModal extends Component
// {
//     public function render()
//     {
//         return view('livewire.audit.add-audit-modal');
//     }

//     //1.  declare wire:model.defer="field_name" as public variable
//     // Audit Main
//     public $a_proj_title;
//     public $a_proj_no;
//     public $a_start;
//     public $a_end;
//     public $a_date_range;
//     public $auditId;
//     // Objective
//     public $ao_repeater;
//     public $ao_text;
//     // Scope and Methodology
//     public $as_text;
//     public $am_text;

//     public $a_intro;
//     public $a_privacy_policy;
//     public $ac_text;
//     public $a_aoc;
//     public $a_approach;
//     public $arf_text;
//     public $aep_section;
//     public $aep_activity;
//     public $aep_date_range;
//     public $aep_particular;
//     public $ab_text;
//     public $ab_total;
//     public $aabp_text;
//     public $ae_text;
//     public $at_designation;
//     public $at_text;


//     //2. Create function submit,. bind to submit button in form 
//     // wire:loading - for loading upon submit
//     // wire:target - indicator for target of submit button
//     // INSERT DATA
//     public function submitForm() {
//         DB::transaction(function () {
//             [$this->a_start, $this->a_end] = explode(' to ', $this->a_date_range);

//             $auditModel = Audit::Create(
//                 ['a_proj_title'    => $this->a_proj_title,
//                 'a_start'          => $this->a_start,
//                 'a_end'            => $this->a_end,
//                 'a_proj_no'        => $this->a_proj_no,
//                 'a_privacy_policy' => $this->a_privacy_policy],
//             );
            
//             // Fetch Audit PK
//             $this->auditId = $auditModel->a_id;
//             foreach ($this->ao_repeater as $objective) {
//                 $auditObjModel = AuditObjective::Create([
//                     'fk_audit' => $auditModel->a_id, // Foreign key referencing the Audit record
//                     'ao_text'  => $objective['ao_text'], // Text from repeater input
//                 ]);
//             }
//             // $auditObjectiveModel = AuditObjective::Create(
//             //     [   'fk_audit'      => $this->auditId,
//             //         'ao_text'       => $this->ao_text,
//             //     ]
//             // );
//         });

//     }

//     public function mount(){
//         $this->ao_repeater = [['ao_text' => '']];
//     }

//     // 3. Emit listener on list.blade.php to display confirmation. close modal and reload datatable/



// }
