<x-default-layout>

    @section('title')
        CL Viewing
    @endsection

    @section('breadcrumbs')
        {{-- {{ Breadcrumbs::render('audit-management.audits.show', $cl) }} --}}
    @endsection

    <!--begin::Layout-->
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Summary-->
                    <!--begin::User Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <div
                                class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $cl->last_name . ',' . $cl->first_name) }}">
                                {{ substr($cl->first_name, 0, 1) }} {{ substr($cl->last_name, 0, 1) }}
                            </div>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#"
                            class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $cl->first_name . ' ' . $cl->middle_name . ' ' . $cl->last_name . ' ' . $cl->suffix }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="mb-9">
                            {{-- @foreach ($cl->roles as $role)
                                <!--begin::Badge-->
                                <div class="badge badge-lg badge-light-primary d-inline">{{ ucwords($role->name) }}</div>
                                <!--begin::Badge-->
                            @endforeach --}}
                        </div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <!--begin::Info heading-->
                        <div class="fw-bold mb-3">Basic Information</div>
                        <!--end::Info heading-->
                        <div class="d-flex flex-wrap flex-center">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bold text-center  text-gray-700">
                                    <span class="w-75px">{{ \Carbon\Carbon::parse($cl->date_of_birth)->age }}</span>
                                </div>
                                <div class="text-center  fw-semibold text-muted">Age</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                <div class="fs-4 text-center fw-bold text-gray-700">
                                    <span class="w-75px">{{ $cl->sex }}</span>
                                </div>
                                <div class=" text-center fw-semibold text-muted">Sex</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="text-center fs-4 fw-bold text-gray-700">
                                    <span class="w-75px">{{ $cl->work->nature_of_work }}</span>
                                </div>
                                <div class="text-center fw-semibold text-muted">Nature of Work</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User Info-->
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details"
                            role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                            <span class="ms-2 rotate-180">
                                <i class="ki-duotone ki-down fs-3"></i>
                            </span>
                        </div>
                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit Data below">
                            <a href="#" class="btn btn-sm btn-light-primary" disabled data-bs-toggle="modal"
                                data-bs-target="#kt_modal_update_details">Edit</a>
                        </span>
                    </div>
                    <!--end::Details toggle-->
                    <div class="separator"></div>
                    <!--begin::Details content-->
                    <div id="kt_user_view_details" class="collapse show">
                        <div class="pb-5 fs-6">
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Child Laborer ID</div>
                            <div class="text-gray-600">{{ $cl->id }}</div>
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Address</div>
                            <div class="text-gray-600">
                                {{ $cl->address_sitio }},
                                </br>
                                {{ $cl->barangay->name }},
                                {{ $cl->barangay->city->name ?? '' }},
                                {{ $cl->barangay->province->name ?? '' }},
                                {{-- @dd($cl->barangay->region) --}}
                                {{ $cl->barangay->region->name ?? '' }}
                            </div>
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Date of Birth</div>
                            <div class="text-gray-600">{{ $cl->date_of_birth}}<i>{{' ('. $cl->dob_actual.')' }}</i></div>
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Living With</div>
                            <div class="text-gray-600">{{ $cl->living_with}}</div>
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Dwelling Type</div>
                            <div class="text-gray-600">{{ $cl->dwelling_type}}</div>
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Religion</div>
                            <div class="text-gray-600">{{ $cl->religion}}</div>
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Is a member of Indegenous Group</div>
                            <div class="text-gray-600">{{ $cl->indigenous_group}} {{ $cl->indigenous_group_spec ?? '' }}</div>
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Place of Birth</div>
                            <div class="text-gray-600">
                                {{ $cl->Bbarangay->name }},
                                {{ $cl->Bbarangay->Bcity->name ?? '' }},
                                {{ $cl->Bbarangay->Bprovince->name ?? '' }},
                                {{-- @dd($cl->barangay->region) --}}
                                {{ $cl->Bbarangay->Bregion->name ?? '' }}
                            </div>
                            
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Date Profiled</div>
                            <div class="text-gray-600">
                                {{ \Carbon\Carbon::parse($cl->created_at)->format('d M Y, g:i a') }}</div>
                            
                        </div>
                    </div>
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

        </div>
        <!--end::Sidebar-->
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                        href="#kt_user_view_enh_tab">Education & Health</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"
                        href="#kt_user_view_work_tab">Work</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab"
                        href="#kt_user_view_family_security">Family</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#kt_user_view_overview_assistance_tab">Assistances</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item ms-auto">
                    <!--begin::Action menu-->
                    <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">Actions
                        <i class="ki-duotone ki-down fs-2 me-0"></i></a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Actions</div>
                        </div>
                        <!--end::Menu item-->
                        
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link px-5">
                                {!! getIcon('document', 'fs-1 me-2') !!}
                                Create Monitoring Report
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu-->
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">
                <!--begin:::Tab pane-->
                {{-- EDUCATION --}}
                <div class="tab-pane fade show active" id="kt_user_view_enh_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card card-flush mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h2 class="mb-1">Education</h2>
                                <div class="fs-6 fw-semibold text-muted">Education Background</div>
                                {{-- <div class="fs-6 fw-semibold text-muted">2 upcoming meetings</div> --}}
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            {{-- <div class="card-toolbar">
                                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
                                    <i class="ki-duotone ki-brush fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Add Schedule
                                </button>
                            </div> --}}
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-4">
                            <!--begin::Tab Content-->
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Has Gone to School</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ $cl->education->has_gone_to_school ? 'Yes' : 'No' }}
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Currently Attending</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">
                                        {{ $cl->education->currently_attending ? 'Yes' : 'No' }}
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Learner Reference No.</label>
                                <div class="col-lg-8">
                                    <span
                                        class="fw-bold fs-6 text-gray-800">{{ $cl->education->learner_reference_no ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Highest Grade Completed</label>
                                <div class="col-lg-8">
                                    <span
                                        class="fw-bold fs-6 text-gray-800">{{ $cl->education->highest_grade_completed }}</span>
                                </div>
                            </div>

                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Mode of Education</label>
                                <div class="col-lg-8">
                                    <span
                                        class="fw-bold fs-6 text-gray-800">{{ $cl->education->mode_of_education }}</span>
                                </div>
                            </div>

                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">Age Stopped Schooling</label>
                                <div class="col-lg-8">
                                    <span
                                        class="fw-bold fs-6 text-gray-800">{{ $cl->education->age_stopped_schooling }}</span>
                                </div>
                            </div>

                            @php
                                $reasons = is_array($cl->education->reason_for_stopping)
                                    ? $cl->education->reason_for_stopping
                                    : json_decode($cl->education->reason_for_stopping, true);
                            @endphp

                            @if (!empty($reasons))
                                <div class="row mb-7">
                                    <label class="col-lg-4 fw-semibold text-muted">Reason/s for Stopping</label>
                                    <div class="col-lg-8">
                                        <ul class="fw-bold fs-6 text-gray-800 mb-0">
                                            @foreach ($reasons as $reason)
                                                <li>{{ $reason }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <!--end::Tab Content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Tasks-->
                    <div class="card card-flush mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h2 class="mb-1">Health</h2>
                                <div class="fs-6 fw-semibold text-muted">Health Background</div>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-4">
                             {{-- Height & Weight --}}
                             <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fw-semibold text-muted">Height (cm)</label>
                                    <div>
                                        <span class="fw-bold fs-6 text-gray-800">{{ $cl->health->height_cm ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-semibold text-muted">Weight (kg)</label>
                                    <div>
                                        <span class="fw-bold fs-6 text-gray-800">{{ $cl->health->weight_kg ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Disability Info --}}
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fw-semibold text-muted">Has Disability</label>
                                    <div>
                                        <span class="fw-bold fs-6 text-gray-800">{{ $cl->health->has_disability ? 'Yes' : 'No' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-semibold text-muted">Disability Types</label>
                                    <div>
                                        <span class="fw-bold fs-6 text-gray-800">
                                            {{ !empty($cl->health->disability_types) ? implode(', ', json_decode($cl->health->disability_types)) : 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        
                            {{-- Disability Assessment & Medical Assessment --}}
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fw-semibold text-muted">Requires Disability Assessment</label>
                                    <div>
                                        <span class="fw-bold fs-6 text-gray-800">{{ $cl->health->requires_disability_assessment ? 'Yes' : 'No' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-semibold text-muted">Requires Medical Assessment</label>
                                    <div>
                                        <span class="fw-bold fs-6 text-gray-800">{{ $cl->health->requires_medical_assessment ? 'Yes' : 'No' }}</span>
                                    </div>
                                </div>
                            </div>
                        
                           
                        
                            {{-- Recent Ailments & Family History --}}
                            <div class="row mb-7">
                                <div class="col-md-6">
                                    <label class="fw-semibold text-muted">Recent Ailments</label>
                                    <div>
                                        <span class="fw-bold fs-6 text-gray-800">{{ $cl->health->recent_ailments ?? 'None' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-semibold text-muted">Family Medical History</label>
                                    <div>
                                        <span class="fw-bold fs-6 text-gray-800">{{ $cl->health->family_medical_history ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                                                
                        <!--end::Card body-->
                    </div>
                    <!--end::Tasks-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                {{-- EDUCATION --}}
                <div class="tab-pane fade show active" id="kt_user_view_work_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card card-flush mb-6 mb-xl-9">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">Work Information</h3>
                        </div>
                        <div class="card-body">
                            @if($cl->work)
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Nature of Work</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->nature_of_work ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Specific Tasks</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->specific_tasks ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Employer Name</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->employer_name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Employer Contact</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->employer_contact ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="fw-semibold text-muted">Employer Address</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->employer_address ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Work Arrangement</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->work_arrangement ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Working Hours Per Day</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->working_hours_per_day ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Working Days Per Week</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->working_days_per_week ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Age Started Working</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->age_started_working ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Work Start Time</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->work_start_time ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Work End Time</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->work_end_time ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Exposure to Risks</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->exposure_risks ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Payment Basis</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->payment_basis ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Average Monthly Income</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->average_monthly_income ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Earnings Usage</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->earnings_usage ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Has Adult Supervisor?</label>
                                        <div class="fw-bold fs-6 text-gray-800">
                                            {{ $cl->work->has_adult_supervisor ? 'Yes' : 'No' }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Supervisor Name</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->supervisor_name ?? 'N/A' }}</div>
                                    </div>
                                </div>
                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="fw-semibold text-muted">Supervisor Relationship</label>
                                        <div class="fw-bold fs-6 text-gray-800">{{ $cl->work->supervisor_relationship ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="text-gray-500">No work information available.</div>
                            @endif
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_user_view_family_security" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Family Profile</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-4">
                            @forelse ($cl->family_members as $member)
                                <div class="card mb-7 shadow-sm border">
                                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                                        <h5 class="mb-0">{{ $member->full_name }}</h5>
                                        <small class="text-muted">Relationship: {{ $member->relationship }}</small>
                                    </div>
                                    <div class="card-body">
                                        {{-- First Row: Sex, Age --}}
                                        <div class="row mb-7">
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Sex</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->sex }}</span></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Age</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->age }}</span></div>
                                            </div>
                                        </div>
                        
                                        {{-- Second Row: Civil Status, Education --}}
                                        <div class="row mb-7">
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Civil Status</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->civil_status }}</span></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Educational Attainment</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->education }}</span></div>
                                            </div>
                                        </div>
                        
                                        {{-- Third Row: Solo Parent, Occupation --}}
                                        <div class="row mb-7">
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Solo Parent</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->solo_parent ? 'Yes' : 'No' }}</span></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Occupation</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->occupation ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                        
                                        {{-- Fourth Row: Income, Disability --}}
                                        <div class="row mb-7">
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Monthly Income</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->income ? '₱' . number_format($member->income, 2) : 'N/A' }}</span></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Disability</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->disability ?? 'None' }}</span></div>
                                            </div>
                                        </div>
                        
                                        {{-- Fifth Row: Skills, Whereabouts --}}
                                        <div class="row mb-7">
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Skills</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->skills ?? 'N/A' }}</span></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="fw-semibold text-muted">Whereabouts</label>
                                                <div><span class="fw-bold fs-6 text-gray-800">{{ $member->whereabouts ?? 'N/A' }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No family members found.</p>
                            @endforelse
                        </div>
                        
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_user_view_overview_assistance_tab" role="tabpanel">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">Services Already Availed</h3>
                        </div>
                        <div class="card-body">
                            @forelse ($cl->availed_services as $service)
                                <div class="border rounded p-4 mb-4">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Type of Assistance</label>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $service->type_of_assistance ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Source</label>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $service->source ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Family Member Received</label>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $service->family_member_recieved ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Date Provided</label>
                                            <div class="fw-bold fs-6 text-gray-800">
                                                {{ \Carbon\Carbon::parse($service->date_provided)->format('d M Y') ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="fw-semibold text-muted">Remarks</label>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $service->remarks ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-gray-500">No services availed yet.</div>
                            @endforelse
                        </div>
                    </div>
                    
                    <div class="card mb-5">
                        <div class="card-header">
                            <h3 class="card-title fw-bold">Services Requested</h3>
                        </div>
                        <div class="card-body">
                            @forelse ($cl->requested_services as $requested_service)
                                <div class="border rounded p-4 mb-4">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Type of Assistance</label>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $requested_service->type_of_assistance ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Source</label>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $requested_service->source ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Start Date</label>
                                            <div class="fw-bold fs-6 text-gray-800">
                                                {{ $requested_service->start_date ? \Carbon\Carbon::parse($requested_service->start_date)->format('d M Y') : 'N/A' }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">End Date</label>
                                            <div class="fw-bold fs-6 text-gray-800">
                                                {{ $requested_service->end_date ? \Carbon\Carbon::parse($requested_service->end_date)->format('d M Y') : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Family Member Requested</label>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $requested_service->family_member_requested ?? 'N/A' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="fw-semibold text-muted">Remarks</label>
                                            <div class="fw-bold fs-6 text-gray-800">{{ $requested_service->remarks ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-gray-500">No services requested.</div>
                            @endforelse
                        </div>
                    </div>
                    
                </div>
                <!--end:::Tab pane-->
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Layout-->
    <!--begin::Modals-->
    <!--begin::Modal - Update user details-->
    {{-- @include('pages.apps/user-management/audits/modals/_update-details')
    <!--end::Modal - Update user details-->
    <!--begin::Modal - Add schedule-->
    @include('pages.apps/user-management/audits/modals/_add-schedule')
    <!--end::Modal - Add schedule-->
    <!--begin::Modal - Add one time password-->
    @include('pages.apps/user-management/audits/modals/_add-one-time-password')
    <!--end::Modal - Add one time password-->
    <!--begin::Modal - Update email-->
    @include('pages.apps/user-management/audits/modals/_update-email')
    <!--end::Modal - Update email-->
    <!--begin::Modal - Update password-->
    @include('pages.apps/user-management/audits/modals/_update-password')
    <!--end::Modal - Update password-->
    <!--begin::Modal - Update role-->
    @include('pages.apps/user-management/audits/modals/_update-role')
    <!--end::Modal - Update role-->
    <!--begin::Modal - Add auth app-->
    @include('pages.apps/user-management/audits/modals/_add-auth-app')
    <!--end::Modal - Add auth app-->
    <!--begin::Modal - Add task-->
    @include('pages.apps/user-management/audits/modals/_add-task')
    <!--end::Modal - Add task--> --}}
    <!--end::Modals-->
</x-default-layout>
