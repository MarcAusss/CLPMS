<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\AuditExecution;
use App\DataTables\ScheduleAuditsDataTable;
use App\DataTables\AuditsDataTable;
use Illuminate\Support\Facades\Log;
use App\Models\AuditEngagementPlan;
use App\Models\ChildLaborer;
use App\Models\Province;
use App\Models\Barangay;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AuditController extends Controller
{
    // =============================================
    // CL PROFILING METHODS
    // =============================================

    /**
     * Display CL Profiling main page with DataTable
     */
    public function index(AuditsDataTable $dataTable)
    {
        return $dataTable->render('pages.apps.audit-management.audits.list');
    }

    /**
     * DataTable server-side processing for CL Profiling
     */
    public function dataTable(Request $request)
    {
        $childLaborers = ChildLaborer::with(['barangay.province'])
            ->select('child_laborers.*');

        return DataTables::of($childLaborers)
            ->addColumn('full_name', function (ChildLaborer $cl) {
                return $cl->last_name . ', ' . $cl->first_name . ' ' . $cl->middle_name;
            })
            ->addColumn('birth_date', function (ChildLaborer $cl) {
                return $cl->date_of_birth ? \Carbon\Carbon::parse($cl->date_of_birth)->format('M j, Y') : '';
            })
            ->addColumn('province', function (ChildLaborer $cl) {
                return $cl->barangay->province->name ?? 'N/A';
            })
            ->addColumn('status', function (ChildLaborer $cl) {
                return $cl->status ?? 'Active';
            })
            ->addColumn('action', function (ChildLaborer $cl) {
                return view('pages.apps.audit-management.audits.columns._actions', compact('cl'))->render();
            })
            ->filterColumn('full_name', function($query, $keyword) {
                $query->whereRaw("CONCAT(last_name, ', ', first_name, ' ', middle_name) like ?", ["%{$keyword}%"]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show single CL record for quick view modal (API)
     */
    public function show($id)
    {
        $childLaborer = ChildLaborer::with([
            'barangay.province',
            'education',
            'health', 
            'work',
            'requested_services',
            'availed_services',
            'family_members'
        ])->findOrFail($id);
        
        return response()->json($childLaborer);
    }

    /**
     * Get CL record for editing
     */
    public function editCl($id)
    {
        $childLaborer = ChildLaborer::with(['barangay.province'])->findOrFail($id);
        return response()->json($childLaborer);
    }

    /**
     * Update CL record (API)
     */
    public function updateCl(Request $request, $id)
    {
        $childLaborer = ChildLaborer::findOrFail($id);
        
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'sex' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer|min:0',
            'barangay_id' => 'required|exists:barangays,id',
            'contact_number' => 'nullable|string|max:20',
            'guardian_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'education_level' => 'nullable|string|max:255',
            'work_type' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'status' => 'required|in:Active,Inactive,Pending'
        ]);

        $childLaborer->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'CL record updated successfully'
        ]);
    }

    /**
     * Delete CL record (API)
     */
    public function destroyCl($id)
    {
        $childLaborer = ChildLaborer::findOrFail($id);
        $childLaborer->delete();

        return response()->json([
            'success' => true,
            'message' => 'CL record deleted successfully'
        ]);
    }

    /**
     * Get provinces for dropdown (API)
     */
    public function getProvinces()
    {
        $provinces = Province::orderBy('name')->get();
        return response()->json($provinces);
    }

    /**
     * Get barangays by province (API)
     */
    public function getBarangaysByProvince(Request $request)
    {
        $barangays = Barangay::where('province_id', $request->province_id)
            ->orderBy('name')
            ->get();
        return response()->json($barangays);
    }

    /**
     * Get dashboard statistics (API)
     */
    public function getDashboardStats()
    {
        $totalProfiles = ChildLaborer::count();
        $activeCases = ChildLaborer::where('status', 'Active')->count();
        $withdrawnCases = ChildLaborer::where('status', 'Withdrawn')->count();
        $pendingCases = ChildLaborer::where('status', 'Pending')->count();
        
        // This month's new profiles
        $monthlyIncrease = ChildLaborer::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return response()->json([
            'total_profiles' => $totalProfiles,
            'active_cases' => $activeCases,
            'withdrawn_cases' => $withdrawnCases,
            'pending_cases' => $pendingCases,
            'monthly_increase' => $monthlyIncrease
        ]);
    }

    // =============================================
    // EXISTING AUDIT METHODS
    // =============================================

    public function edit($id)
    {
        $audit = Audit::findOrFail($id);
        return view('pages.apps.audit-management.audits.action-pages.edit', compact('audit'));
    }

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

    public function review($id)
    {
        $audit = Audit::findOrFail($id);
        return view('pages.apps.audit-management.audits.action-pages.review', compact('audit'));
    }

    public function view($id)
    {
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

        return view('pages.apps.audit-management.audits.show', compact('cl'));
    }

    public function schedule(ScheduleAuditsDataTable $dataTable, $id)
    {
        $audit = Audit::findOrFail($id);

        $auditExecutions = AuditEngagementPlan::with(['specifics'])
            ->where('fk_audit', $audit->a_id) 
            ->where('aep_section', 'Audit Execution')
            ->get();

        $aepIds = $auditExecutions->pluck('aep_id');

        return $dataTable
            ->with('aep_ids', $aepIds)
            ->render('pages.apps.audit-management.audits.action-pages.schedule', compact('audit'));
    }
}