<?php

namespace App\Http\Livewire\Audit;

use App\Models\Audit;
use App\Models\AuditEvaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Livewire\Component;

class EvaluationModal extends Component
{
    public $status;
    public $comments;
    public $audit;

    // Define validation rules
    protected $rules = [
        'status' => 'required|string',
        'comments' => 'nullable|string',
    ];


    // Submit the evaluation
    public function submit()
    {
        try {
            // Validate the inputs
            $this->validate();

            // Store the evaluation in the database
            AuditEvaluation::create([
                'fk_audit' => $this->audit->a_id,
                'comments' => $this->comments,
                'status' => $this->status,
                'evaluated_by' => Auth::id(),
            ]);

            // Reset form fields
            $this->reset(['comments', 'status']);

            // Dispatch browser event for success
            $this->dispatchBrowserEvent('evaluationSubmitted', [
                'type' => 'success',
                'message' => 'Evaluation submitted successfully!',
                'redirectUrl' => route('audit-management.audits.index'),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            $this->dispatchBrowserEvent('evaluationSubmitted', [
                'type' => 'error',
                'message' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            dd($e);
            // Handle non-validation errors
            Log::error('Evaluation Submission Error: ' . $e->getMessage());

            // Dispatch browser event for error
            $this->dispatchBrowserEvent('evaluationSubmitted', [
                'type' => 'error',
                'message' => 'An error occurred while submitting the evaluation. Please try again.',
            ]);
        }
    }



    public function render()
    {
        return view('livewire.audit.evaluation-modal');
    }

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
    
}
