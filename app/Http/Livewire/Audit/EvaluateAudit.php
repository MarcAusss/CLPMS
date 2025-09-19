<?php

namespace App\Http\Livewire\Audit;
use App\Models\Audit;
use App\Models\AuditEvaluation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EvaluateAudit extends Component
{
    public $audit; // Holds the audit details
   

    public function mount($audit)
    {
        // Load the audit with its relationships
        $this->audit = Audit::with([
            'auditScopes',
            'auditObjectives',
            'auditMethods',
            'auditCriteria',
            'auditResourceReferences',
            'auditEngagementPlans',
            'auditEngagementPlans.specifics',
            'auditBudgets',
            'auditEquipments',
            'auditTeams',
        ])->findOrFail($audit->a_id);
    }
    // // Define validation rules
    // protected $rules = [
    //     'evaluations.*.element' => 'required|string',
    //     'evaluations.*.comments' => 'nullable|string',
    //     'evaluations.*.rating' => 'required|integer|min:1|max:5',
    // ];

    // Submit the evaluation
    // public function submit()
    // {
    //     dd($this);
    //     // Validate the inputs
    //     $this->validate();

    //     // Store the evaluation in the database
    //     AuditEvaluation::create([
    //         'audit_id' => $this->audit->id,
    //         'comments' => $this->comments,
    //         'approval' => $this->approval,
    //         'evaluator_id' => Auth::id(),
    //     ]);

    //     // Flash success message and reset form
    //     session()->flash('success', 'Evaluation submitted successfully!');
    //     $this->reset(['comments', 'approval']); // Reset form fields

    //     // Close the modal by dispatching a browser event
    //     $this->dispatchBrowserEvent('closeModal');
    // }

    public function render()
    {
        return view('livewire.audit.evaluate-audit');
    }
}
