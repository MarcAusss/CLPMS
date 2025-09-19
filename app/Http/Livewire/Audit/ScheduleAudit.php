<?php

namespace App\Http\Livewire\Audit;

use App\Models\Audit;
use App\Models\AuditEngagementPlan;
use App\Models\AuditExecution;
use App\Models\AuditExecutionSpecific;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Models\Offices;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ScheduleAudit extends Component
{
    public $auditExecutions = [];
    public $offices = [];
    public $aex_date_range;
    public $audit;
    public $auditEngagementPlans;

    public function resetForm()
    {
        $this->auditExecutions = [];
        $this->addAuditExecution(); // Start with one empty form
        $this->aex_date_range = null;
    }

    public function mount()
    {
        // Fetch all the Audit Engagement Plans with the Audit Execution
        $this->auditEngagementPlans = AuditEngagementPlan::where('fk_audit', $this->audit->a_id)
        ->where('aep_section', 'Audit Execution')
        ->get();
        // Load offices or other initial data
        $this->offices = Offices::all();
        $this->addAuditExecution(); // Start with one form
    }

    public function addAuditExecution()
    {
        $this->auditExecutions[] = [
            'fk_aep' => '',
            'aex_office' => '',
            'aex_date_range' => '',
            'specifics' => [''],
        ];
    }

    public function removeAuditExecution($index)
    {
        unset($this->auditExecutions[$index]);
        $this->auditExecutions = array_values($this->auditExecutions); // Reindex the array
    }

    public function addSpecific($formIndex)
    {
        $this->auditExecutions[$formIndex]['specifics'][] = '';
    }

    public function removeSpecific($formIndex, $specificIndex)
    {
        unset($this->auditExecutions[$formIndex]['specifics'][$specificIndex]);
        $this->auditExecutions[$formIndex]['specifics'] = array_values($this->auditExecutions[$formIndex]['specifics']); // Reindex
    }

    public function saveAll()
    {
        // dd($this);
        $this->validate([
            // Loop through each audit execution
            'auditExecutions.*.aex_office' => 'required|exists:offices,id',
            'auditExecutions.*.aex_date_range' => 'required',            
            // Specifics validation
            'auditExecutions.*.specifics.*' => 'required|string|min:3',
        ], [
            'auditExecutions.*.aex_office.required' => 'Please select an office.',
            'auditExecutions.*.aex_office.exists' => 'The selected office is invalid.',
            'auditExecutions.*.specifics.*.required' => 'Specific details are required.',
            'auditExecutions.*.specifics.*.string' => 'Specific details must be a string.',
            'auditExecutions.*.specifics.*.min' => 'Specific details must be at least 3 characters long.',
        ]);
    
        DB::beginTransaction();
        // Save logic
        try {
            
            foreach ($this->auditExecutions as $auditExecution) {
                $dates = explode(' to ', $auditExecution['aex_date_range']);
                    $auditExecutionModel = AuditExecution::create([
                        'fk_aep' => $auditExecution['fk_aep'],  
                        'aex_office' => $auditExecution['aex_office'],
                        'aex_start' => $dates[0],
                        'aex_end' => $dates[1],
                    ]);
            
                    if (isset($auditExecution['specifics'])) {
                        foreach ($auditExecution['specifics'] as $specific) {
                            AuditExecutionSpecific::create([
                                'audit_execution_id' => $auditExecutionModel->aex_id,
                                'specific_detail' => $specific,
                            ]);
                        }
                    }
                }
                
                DB::commit();
                $this->resetForm();
                $this->emit('refreshDatatable');
                $this->emit('showAlert', 'success', 'Audit Executions and Specifics saved successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            $this->emit('showAlert', 'error', 'An error occurred while saving: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.audit.schedule-audit');
    }
}
