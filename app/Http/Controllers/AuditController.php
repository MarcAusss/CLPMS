<?php

namespace App\Http\Controllers;

use App\Models\ChildLaborer;
use App\Models\PhilippineProvince;
use App\Models\PhilippineCity;
use App\Models\PhilippineBarangay;
use App\Models\PhilippineRegion;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class AuditController extends Controller
{
    /**
     * Display the CL Profiling index page
     */
    public function index()
    {
        return view('pages.cl-profiling.index');
    }

    /**
     * Get DataTables data for Child Laborers
     */
    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $query = ChildLaborer::query()
                ->leftJoin('philippine_provinces', 'child_laborers.address_province', '=', 'philippine_provinces.province_code')
                ->leftJoin('philippine_cities', 'child_laborers.address_city', '=', 'philippine_cities.city_code')
                ->select([
                    'child_laborers.*',
                    'philippine_provinces.name as province_name',
                    'philippine_cities.name as city_name'
                ]);

            return DataTables::eloquent($query)
                ->addColumn('full_name', function ($laborer) {
                    $fullName = trim($laborer->first_name . ' ' . 
                                    ($laborer->middle_name ? $laborer->middle_name . ' ' : '') . 
                                    $laborer->last_name . 
                                    ($laborer->suffix ? ' ' . $laborer->suffix : ''));
                    return $fullName;
                })
                ->addColumn('birth_date', function ($laborer) {
                    return $laborer->date_of_birth 
                        ? \Carbon\Carbon::parse($laborer->date_of_birth)->format('M d, Y') 
                        : 'N/A';
                })
                ->addColumn('province', function ($laborer) {
                    return $laborer->province_name ?? 'N/A';
                })
                ->addColumn('status', function ($laborer) {
                    return 'Active';
                })
                ->addColumn('action', function ($laborer) {
                    return '<div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary action-btn view-btn" data-id="' . $laborer->id . '" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary action-btn edit-btn" data-id="' . $laborer->id . '" title="Edit Record">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger action-btn delete-btn" data-id="' . $laborer->id . '" title="Delete Record">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    /**
     * Get complete child laborer profile with all related data
     */
    public function show($id)
    {
        try {
            $laborer = ChildLaborer::with([
                'education',
                'health',
                'workHistory',
                'familyMembers',
                'assistanceRecords',
                'requestedServices'
            ])
            ->leftJoin('philippine_provinces', 'child_laborers.address_province', '=', 'philippine_provinces.province_code')
            ->leftJoin('philippine_cities', 'child_laborers.address_city', '=', 'philippine_cities.city_code')
            ->leftJoin('philippine_regions', 'child_laborers.address_region', '=', 'philippine_regions.region_code')
            ->select([
                'child_laborers.*',
                'philippine_provinces.name as province_name',
                'philippine_cities.name as city_name',
                'philippine_regions.name as region_name'
            ])
            ->where('child_laborers.id', $id)
            ->firstOrFail();

            // Format the complete response
            $data = [
                // Personal Information
                'personal' => [
                    'id' => $laborer->id,
                    'full_name' => $this->getFullName($laborer),
                    'first_name' => $laborer->first_name,
                    'middle_name' => $laborer->middle_name,
                    'last_name' => $laborer->last_name,
                    'suffix' => $laborer->suffix,
                    'sex' => $laborer->sex,
                    'date_of_birth' => $laborer->date_of_birth,
                    'age' => $laborer->age,
                    'birth_certificate' => $laborer->birth_certificate ? 'Yes' : 'No',
                    'place_of_birth' => $laborer->place_of_birth ?? 'N/A',
                ],
                
                // Address Information
                'address' => [
                    'complete_address' => $this->formatAddress($laborer),
                    'region' => $laborer->region_name ?? 'N/A',
                    'province' => $laborer->province_name ?? 'N/A',
                    'city' => $laborer->city_name ?? 'N/A',
                    'barangay' => $laborer->address_barangay ?? 'N/A',
                    'sitio' => $laborer->address_sitio ?? 'N/A',
                ],
                
                // Cultural & Living
                'cultural' => [
                    'religion' => $laborer->religion === 'Others' 
                        ? ($laborer->religion_other ?? 'Others') 
                        : $laborer->religion,
                    'indigenous_group' => $laborer->indigenous_group,
                    'indigenous_group_spec' => $laborer->indigenous_group_spec ?? 'N/A',
                    'living_with' => $laborer->living_with,
                    'dwelling_type' => $laborer->dwelling_type,
                    'contact_number' => $laborer->contact_number ?? 'N/A',
                ],
                
                // 4Ps Information
                'fourps' => [
                    'is_4ps_member' => $laborer->is_4ps_member,
                    'house_id_number' => $laborer->house_id_number ?? 'N/A',
                ],
                
                // Education Information
                'education' => $laborer->education ? [
                    'has_gone_to_school' => $laborer->education->has_gone_to_school ? 'Yes' : 'No',
                    'currently_attending' => $laborer->education->currently_attending ? 'Yes' : 'No',
                    'learner_reference_no' => $laborer->education->learner_reference_no ?? 'N/A',
                    'highest_grade_completed' => $laborer->education->highest_grade_completed ?? 'N/A',
                    'mode_of_education' => $laborer->education->mode_of_education ?? 'N/A',
                    'age_stopped_schooling' => $laborer->education->age_stopped_schooling ?? 'N/A',
                    'reason_for_stopping' => $this->parseJsonField($laborer->education->reason_for_stopping),
                    'quit_schooling' => $laborer->education->quit_schooling ? 'Yes' : 'No',
                ] : null,
                
                // Health Information
                'health' => $laborer->health ? [
                    'height_cm' => $laborer->health->height_cm . ' cm',
                    'weight_kg' => $laborer->health->weight_kg . ' kg',
                    'has_disability' => $laborer->health->has_disability ? 'Yes' : 'No',
                    'specific_disability' => $this->parseJsonField($laborer->health->specific_disability),
                    'specific_disability_other' => $laborer->health->specific_disability_other ?? null,
                    'child_ailments' => $this->parseJsonField($laborer->health->child_ailments),
                    'skin_disease_specify' => $laborer->health->skin_disease_specify ?? null,
                    'allergies_specify' => $laborer->health->allergies_specify ?? null,
                    'other_ailments_specify' => $laborer->health->other_ailments_specify ?? null,
                    'medical_assessment' => $laborer->health->medical_assessment ? 'Yes' : 'No',
                    'family_medical_history' => $this->parseJsonField($laborer->health->family_medical_history),
                    'family_other_specify' => $laborer->health->family_other_specify ?? null,
                ] : null,
                
                // Work History
                'work_history' => $laborer->workHistory->map(function($work) {
                    return [
                        'id' => $work->id,
                        'nature_of_work' => $work->nature_of_work,
                        'specific_tasks' => $this->parseJsonField($work->specific_tasks),
                        'employer_name' => $work->employer_name ?? 'N/A',
                        'employer_contact' => $work->employer_contact ?? 'N/A',
                        'employer_address' => $work->employer_address ?? 'N/A',
                        'work_arrangement' => $work->work_arrangement ?? 'N/A',
                        'working_hours_per_day' => $work->working_hours_per_day ?? 0,
                        'working_days_per_week' => $work->working_days_per_week ?? 0,
                        'work_start_time' => $work->work_start_time ?? 'N/A',
                        'work_end_time' => $work->work_end_time ?? 'N/A',
                        'age_started_working' => $work->age_started_working ?? 0,
                        'exposure_risks' => $this->parseJsonField($work->exposure_risks),
                        'payment_basis' => $this->parseJsonField($work->payment_basis),
                        'average_monthly_income' => $work->average_monthly_income 
                            ? '₱' . number_format($work->average_monthly_income, 2) 
                            : 'N/A',
                        'earnings_usage' => $this->parseJsonField($work->earnings_usage),
                        'has_adult_supervisor' => $work->has_adult_supervisor ? 'Yes' : 'No',
                        'supervisor_name' => $work->supervisor_name ?? 'N/A',
                        'supervisor_relationship' => $work->supervisor_relationship ?? 'N/A',
                    ];
                })->toArray(),
                
                // Family Members
                'family_members' => $laborer->familyMembers->map(function($member) {
                    return [
                        'id' => $member->id,
                        'name' => $member->full_name ?? 'N/A',
                        'relationship' => $member->relationship ?? 'N/A',
                        'sex' => $member->sex ?? 'N/A',
                        'age' => $member->age ?? 0,
                        'civil_status' => $member->civil_status ?? 'N/A',
                        'education' => $member->education ?? 'N/A',
                        'solo_parent' => $member->solo_parent ?? 'N/A',
                        'occupation' => $member->occupation ?? 'N/A',
                        'income' => $member->income ? '₱' . number_format($member->income, 2) : 'N/A',
                        'disability' => $member->disability ?? 'None',
                        'skills' => $member->skills ?? 'N/A',
                        'whereabouts' => $member->whereabouts ?? 'N/A',
                    ];
                })->toArray(),
                
                // Assistance Records
                'assistance_records' => $laborer->assistanceRecords->map(function($record) {
                    return [
                        'type_of_assistance' => $record->type_of_assistance ?? 'N/A',
                        'source' => $record->source ?? 'N/A',
                        'date_provided' => $record->date_provided ?? 'N/A',
                        'family_member_received' => $record->family_member_recieved ?? 'N/A',
                        'remarks' => $record->remarks ?? 'N/A',
                    ];
                })->toArray(),
                
                // Requested Services
                'requested_services' => $laborer->requestedServices->map(function($service) {
                    return [
                        'type_of_assistance' => $service->type_of_assistance ?? 'N/A',
                        'source' => $service->source ?? 'N/A',
                        'start_date' => $service->start_date ?? 'N/A',
                        'end_date' => $service->end_date ?? 'N/A',
                        'family_member_requested' => $service->family_member_requested ?? 'N/A',
                        'remarks' => $service->remarks ?? 'N/A',
                    ];
                })->toArray(),
            ];

            return response()->json($data);
            
        } catch (\Exception $e) {
            \Log::error('Error fetching child laborer: ' . $e->getMessage());
            return response()->json([
                'error' => 'Record not found',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get child laborer data for editing
     */
    public function editCl($id)
    {
        try {
            $laborer = ChildLaborer::with([
                'education',
                'health',
                'workHistory',
                'familyMembers',
                'assistanceRecords',
                'requestedServices'
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $laborer->toArray()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update child laborer record
     */
    public function updateCl(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $laborer = ChildLaborer::findOrFail($id);
            
            // Update basic info
            $laborer->update($request->only([
                'first_name', 'middle_name', 'last_name', 'suffix',
                'sex', 'date_of_birth', 'age', 'birth_certificate',
                'address_region', 'address_province', 'address_city',
                'address_barangay', 'address_sitio', 'place_of_birth',
                'religion', 'religion_other', 'indigenous_group',
                'indigenous_group_spec', 'living_with', 'dwelling_type',
                'contact_number', 'is_4ps_member', 'house_id_number'
            ]));

            // Update related records (education, health, work, family, etc.)
            // This would be handled by your Livewire component's save method

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Record updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error updating child laborer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a child laborer record
     */
    public function destroyCl($id)
    {
        try {
            DB::beginTransaction();

            $laborer = ChildLaborer::findOrFail($id);
            
            // Delete related records (cascade)
            $laborer->education()->delete();
            $laborer->health()->delete();
            $laborer->workHistory()->delete();
            $laborer->familyMembers()->delete();
            $laborer->assistanceRecords()->delete();
            $laborer->requestedServices()->delete();
            
            // Delete main record
            $laborer->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error deleting child laborer: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting record: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get dashboard statistics
     */
    public function getDashboardStats()
    {
        try {
            $stats = [
                'total_child_laborers' => ChildLaborer::count(),
                'male_count' => ChildLaborer::where('sex', 'Male')->count(),
                'female_count' => ChildLaborer::where('sex', 'Female')->count(),
                'with_disability' => \App\Models\ChildHealth::where('has_disability', 1)->count(),
                'in_school' => \App\Models\ChildEducation::where('currently_attending', 1)->count(),
                'out_of_school' => \App\Models\ChildEducation::where('currently_attending', 0)->count(),
                '4ps_members' => ChildLaborer::where('is_4ps_member', 'Yes')->count(),
            ];

            return response()->json($stats);
        } catch (\Exception $e) {
            \Log::error('Error fetching dashboard stats: ' . $e->getMessage());
            return response()->json([
                'error' => 'Error fetching statistics',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get provinces for dropdowns
     */
    public function getProvinces(Request $request)
    {
        $regionCode = $request->get('region_code');
        
        $query = PhilippineProvince::query();
        
        if ($regionCode) {
            $query->where('region_code', $regionCode);
        }
        
        $provinces = $query->orderBy('name')->get();
        
        return response()->json($provinces);
    }

    /**
     * Get barangays by province
     */
    public function getBarangaysByProvince(Request $request)
    {
        $provinceCode = $request->get('province_code');
        $cityCode = $request->get('city_code');
        
        $query = PhilippineBarangay::query();
        
        if ($cityCode) {
            $query->where('city_code', $cityCode);
        } elseif ($provinceCode) {
            $query->where('province_code', $provinceCode);
        }
        
        $barangays = $query->orderBy('name')->get();
        
        return response()->json($barangays);
    }

    /**
     * Parse JSON field to array
     */
    private function parseJsonField($field)
    {
        if (is_null($field)) {
            return [];
        }
        
        if (is_string($field)) {
            $decoded = json_decode($field, true);
            return is_array($decoded) ? $decoded : [$field];
        }
        
        return is_array($field) ? $field : [];
    }

    /**
     * Get full name
     */
    private function getFullName($laborer)
    {
        return trim($laborer->first_name . ' ' . 
                   ($laborer->middle_name ? $laborer->middle_name . ' ' : '') . 
                   $laborer->last_name . 
                   ($laborer->suffix ? ' ' . $laborer->suffix : ''));
    }

    /**
     * Format complete address
     */
    private function formatAddress($laborer)
    {
        $parts = [];
        
        if ($laborer->address_sitio) {
            $parts[] = $laborer->address_sitio;
        }
        
        if ($laborer->address_barangay) {
            $parts[] = 'Brgy. ' . $laborer->address_barangay;
        }
        
        if (isset($laborer->city_name)) {
            $parts[] = $laborer->city_name;
        }
        
        if (isset($laborer->province_name)) {
            $parts[] = $laborer->province_name;
        }
        
        if (isset($laborer->region_name)) {
            $parts[] = $laborer->region_name;
        }
        
        return !empty($parts) ? implode(', ', $parts) : 'N/A';
    }
} 