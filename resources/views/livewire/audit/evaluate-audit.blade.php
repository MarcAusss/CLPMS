<x-default-layout>
    @section('title')
        Audit Details
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('audit.evaluate', $audit) }}
    @endsection

    <div class="flex-lg-row-fluid ms-lg-15">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Overview</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_security">Engagement Plans</a>
            </li>
            <!--end:::Tab item-->
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_user_view_overview_events_and_logs_tab">Budget and Equipment</a>
            </li>
             <!-- Button aligned to the right -->
            <li class="nav-item ms-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#evaluationModal">
                    Evaluate Audit Plan
                </button>
            </li>
        </ul>
        <!--end:::Tabs-->
        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2 class="mb-1">Audit Details Overview</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9 pt-4">
                        <!--begin::Tab Content-->
                        <div class="tab-content">
                            <div class="d-flex flex-center flex-column py-5">
                                <!--begin::Icon-->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <span class="symbol-label fs-1 bg-light-primary text-primary">
                                        {{ strtoupper(substr($audit->a_proj_title, 0, 1)) }}
                                    </span>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $audit->a_proj_title }}</a>
                                <!--end::Title-->
                                <!--begin::Details-->
                                <div class="fw-bold text-muted">Project Number: {{ $audit->a_proj_no }}</div>
                                <div class="text-muted">Date Range: {{ \Carbon\Carbon::create($audit->a_start)->toFormattedDateString() }} to {{ \Carbon\Carbon::create($audit->a_end)->toFormattedDateString() }}</div>
                            </div>
                        </div>
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
                            <h2 class="mb-1">Details</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <div class="row fw-semibold ms-5">
                            <div class="col-md-6 col-sm-12">
                                <h5 class="fw-bold mb-4">Objectives:</h5>
                                <ul>
                                    @foreach($audit->auditObjectives as $objective)
                                        <li>{{ $objective->ao_text }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <h5 class="fw-bold mt-5">Criterias:</h5>
                                <ul>
                                    @foreach($audit->auditCriteria as $criterion)
                                        <li>{{ $criterion->ac_text }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="row fw-semibold ms-5">
                            <div class="col-md-6 col-sm-12">
                                <h5 class="fw-bold mt-5">Scope:</h5>
                                <p>{{$audit->auditScopes[0]->as_text ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <h5 class="fw-bold mt-5">Methodology:</h5>
                                <p>{{ $audit->auditMethods[0]->am_text ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="row fw-semibold ms-5">
                            <div class="col-md-6 col-sm-12">
                                <h5 class="fw-bold mt-5">References</h5>
                                <ul>
                                    @foreach($audit->auditResourceReferences as $reference)
                                        <li>{{ $reference->arf_text }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <h5 class="fw-bold mt-5">Team Members:</h5>
                                <ul>
                                    @foreach($audit->auditTeams as $team)
                                        <li>{{ $team->at_name }} - {{ $team->at_designation }} (Role: {{ $team->at_role }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>                        
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Tasks-->
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title flex-column">
                            <h2>Engagement Plan</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    {{-- <div class="card-body">
                        <div class="row fw-semibold ms-5">
                            <div class="col-12">
                                @foreach($audit->auditEngagementPlans as $plan)
                            
                                    <div class="border rounded p-4 mb-4">
                                        <div><strong>Section:</strong> {{ $plan->aep_section }}</div>
                                        <div><strong>Activity:</strong> {{ $plan->aep_activity }}</div>
                                        <div><strong>Start Date:</strong> {{ \Carbon\Carbon::create($plan->aep_start)->toFormattedDateString() }}</div>
                                        <div><strong>End Date:</strong> {{ \Carbon\Carbon::create($plan->aep_end)->toFormattedDateString() }}</div>
                                        <h6 class="mt-3">Specifics:</h6>
                                        <ul>
                                            @foreach($plan->specifics as $specific)
                                                <li>{{ $specific->aep_particular }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body">
                        <div class="row fw-semibold ms-5">
                            @foreach($audit->auditEngagementPlans as $plan)
                                <div class="col-4">
                                    <div class="border rounded p-4 mb-4 bg-gray-300">
                                        <div><strong>Section:</strong> {{ $plan->aep_section }}</div>
                                        <div><strong>Activity:</strong> {{ $plan->aep_activity }}</div>
                                        <div><strong>Start Date:</strong> {{ \Carbon\Carbon::create($plan->aep_start)->toFormattedDateString() }}</div>
                                        <div><strong>End Date:</strong> {{ \Carbon\Carbon::create($plan->aep_end)->toFormattedDateString() }}</div>
                                        <h6 class="mt-3">Specifics:</h6>
                                        <ul>
                                            @foreach($plan->specifics as $specific)
                                                <li>{{ $specific->aep_particular }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                        <div class="row ms-5 my-5">
                            <livewire:audit.lcalendar :audit="$audit"/>
                        </div>
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end:::Tab pane-->
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Budget Details</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-5">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                    <tr class="text-start text-muted text-uppercase gs-0">
                                        <th class="min-w-100px">Supply Category / Name</th>
                                        <th>Total Amount</th>
                                        <th>Particular Item</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-6 fw-semibold text-gray-600">
                                    @foreach($audit->auditBudgets as $budget)
                                        <tr>
                                            <td>{{ $budget->ab_text }}</td>
                                            <td>{{ $budget->ab_total }}</td>
                                            <td>
                                                <ul>
                                                    @foreach($budget->particulars as $particular)
                                                        <li>{{ $particular->aabp_text }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                
                <!--begin::Card-->
                <div class="card pt-4 mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header border-0">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Equipments</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 pb-5">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                <tbody class="fs-6 fw-semibold text-gray-600">
                                    @foreach($audit->auditEquipments as $equipment)
                                    <tr>
                                        <td>{{ $equipment->ae_item }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end:::Tab pane-->
        </div>
        <!--end:::Tab content-->
    </div>
    
    <!--begin::Modal-->
    <livewire:audit.evaluation-modal :audit="$audit"/>
    <!--end::Modal-->
    <script>
        document.addEventListener('livewire:load', function () {
            window.addEventListener('evaluationSubmitted', function (event) {
                Swal.fire({
                    icon: event.detail.type,
                    title: event.detail.type === 'success' ? 'Success' : 'Error',
                    text: event.detail.message,
                }).then(() => {
                    if (event.detail.type === 'success') {
                        const modalEl = document.getElementById('evaluationModal');
                        const modalInstance = bootstrap.Modal.getInstance(modalEl);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }
                    if (event.detail.redirectUrl) {
                        window.location.href = event.detail.redirectUrl; 
                    }
                });
            });
        });
    </script>
</x-default-layout>