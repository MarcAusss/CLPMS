<?php

namespace App\Http\Controllers;

use App\Models\ChildLaborer;
use App\Models\PhilippineProvince;
use App\Models\PhilippineCity;
use App\Models\PhilippineBarangay;
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
                    // Key fix: Handle null province gracefully
                    return $laborer->province_name ?? 'N/A';
                })
                ->addColumn('status', function ($laborer) {
                    // Default status - you can add a status column to your table if needed
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
     * Get single child laborer for viewing
     */
    public function show($id)
    {
        try {
            $laborer = ChildLaborer::query()
                ->leftJoin('philippine_provinces', 'child_laborers.address_province', '=', 'philippine_provinces.province_code')
                ->leftJoin('philippine_cities', 'child_laborers.address_city', '=', 'philippine_cities.city_code')
                ->select([
                    'child_laborers.*',
                    'philippine_provinces.name as province_name',
                    'philippine_cities.name as city_name'
                ])
                ->where('child_laborers.id', $id)
                ->firstOrFail();

            return response()->json([
                'id' => $laborer->id,
                'first_name' => $laborer->first_name,
                'middle_name' => $laborer->middle_name,
                'last_name' => $laborer->last_name,
                'suffix' => $laborer->suffix,
                'sex' => $laborer->sex,
                'date_of_birth' => $laborer->date_of_birth,
                'age' => $laborer->age,
                'province' => $laborer->province_name ?? 'N/A',
                'city' => $laborer->city_name ?? 'N/A',
                'barangay' => $laborer->address_barangay ?? 'N/A',
                'address' => $this->formatAddress($laborer),
                'status' => 'Active',
                'birth_certificate' => $laborer->birth_certificate ? 'Yes' : 'No',
                'religion' => $laborer->religion,
                'indigenous_group' => $laborer->indigenous_group,
                'living_with' => $laborer->living_with,
                'dwelling_type' => $laborer->dwelling_type,
                'contact_number' => $laborer->contact_number,
                'is_4ps_member' => $laborer->is_4ps_member,
                'house_id_number' => $laborer->house_id_number,
                'notes' => null // Add this field to your table if you need it
            ]);
        } catch (\Exception $e) {
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
                'data' => $laborer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
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
            // Add your update logic here

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Record updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
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
        
        return !empty($parts) ? implode(', ', $parts) : 'N/A';
    }
}