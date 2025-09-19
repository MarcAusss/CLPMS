<?php

namespace App\Http\Controllers;
use App\Models\Audit;
use App\Models\AuditExecution;
use App\DataTables\ScheduleAuditsDataTable;
use Illuminate\Support\Facades\Log;
use App\Models\AuditEngagementPlan;
use App\Models\ChildLaborer;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function edit($id)
    {
        $audit = Audit::findOrFail($id);
        return view('pages.apps.audit-management.audits.action-pages.edit', compact('audit'));
    }

    // Evaluate audit
    public function evaluate($id)
{
    $audit = Audit::with([
        'auditScopes',
        'auditObjectives',
        'auditMethods',
        'auditCriteria',
        'auditResourceReferences',
        'auditEngagementPlans',
        'auditEngagementPlans.specifics',
        'auditBudgets',
        'auditEquipments',
        'auditTeams'
    ])->findOrFail($id);

    return view('pages.apps.audit-management.audits.action-pages.eval', compact('audit'));
}

    // public function evaluate($id)
    // {
    //     $audit = Audit::findOrFail($id);
    //     return view('pages.apps.audit-management.audits.action-pages.evaluate', compact('audit'));
    // }

    // Review audit evaluation
    public function review($id)
    {
        $audit = Audit::findOrFail($id);
        return view('pages.apps.audit-management.audits.action-pages.review', compact('audit'));
    }

    public function view($id)
    {
        // Fetch the audit data along with its related data
        $cl = ChildLaborer::with([
            'education',
            'health',
            'work',
            'requested_services',
            'availed_services',
            'family_members',
            'barangay.city.province.region',
            'Bbarangay.Bcity.Bprovince.Bregion'
        ])->findOrFail($id);

        // Pass the audit data to the view
        return view('pages.apps.audit-management.audits.show', compact('cl'));
    }

    // View audit (read-only)
    // public function view($id)
    // {
    //     $audit = Audit::findOrFail($id);
    //     return view('pages.apps.audit-management.audits.action-pages.view', compact('audit'));
    // }

    // Schedule audit
    public function schedule(ScheduleAuditsDataTable $dataTable, $id)
{
    // Fetch the Audit model
    $audit = Audit::findOrFail($id);

    // Query all AuditEngagementPlans related to this audit
    $auditExecutions = AuditEngagementPlan::with(['specifics'])
        ->where('fk_audit', $audit->a_id) 
        ->where('aep_section', 'Audit Execution')
        ->get();


    // Pass aep_id to the DataTable
    // Make sure you're passing an array of IDs or the actual data you want in your DataTable
    $aepIds = $auditExecutions->pluck('aep_id'); // Pluck only the aep_id values

    return $dataTable
        ->with('aep_ids', $aepIds) // Pass the array of aep_ids to the DataTable
        ->render('pages.apps.audit-management.audits.action-pages.schedule', compact('audit'));
}


}
