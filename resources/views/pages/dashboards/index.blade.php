<x-default-layout>

    @section('title')
        Child Labor Monitoring System
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <!--begin::Header Section-->
    <div class="card mb-5">
        <div class="card-body py-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold text-gray-900 mb-2">Child Labor Monitoring System</h1>
                    <p class="text-gray-600 fs-6">Comprehensive tracking and management of child labor cases</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="text-gray-700">
                        <div class="fw-semibold fs-3" id="currentDateTime">Loading...</div>
                        <div class="text-muted fs-6">Real-time System Dashboard</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Header Section-->

    <!--begin::Main Content-->
    <div class="row g-5 g-xl-8">
        <!--begin::Left Column - Stats & Quick Actions-->
        <div class="col-xl-8">
            <!--begin::Statistics Cards-->
            <div class="row g-5 mb-5">
                <!--begin::Total Active Cases-->
                <div class="col-md-6">
                    <div class="card card-flush h-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">3,157</span>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Active Child Labor Cases</span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light-success fs-7 fw-semibold">+250</span>
                                <span class="fs-7 fw-semibold text-gray-500 ms-2">Profiles encoded this month</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Total Active Cases-->

                <!--begin::Total Withdrawn Cases-->
                <div class="col-md-6">
                    <div class="card card-flush h-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span class="fs-2hx fw-bold text-success me-2 lh-1 ls-n2">4,567</span>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Withdrawn Child Labor Cases</span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex flex-column">
                                <span class="fs-7 fw-semibold text-gray-500">Community Surveillance</span>
                                <span class="fs-7 fw-semibold text-gray-500">Weekly report updates</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Total Withdrawn Cases-->
            </div>
            <!--end::Statistics Cards-->

            <!--begin::Quick Actions-->
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-4 bg-light-primary rounded">
                                <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                                    <i class="fas fa-list fs-1 text-primary"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary">Profiling List</a>
                                    <span class="text-gray-600">View all child labor profiles</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-4 bg-light-success rounded">
                                <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                    <i class="fas fa-chart-bar fs-1 text-success"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary">Reports</a>
                                    <span class="text-gray-600">Generate system reports</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Quick Actions-->

            <!--begin::Regional Statistics-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Submitted Profiles per Region</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th>Region</th>
                                    <th>Active Cases</th>
                                    <th>Withdrawn Cases</th>
                                    <th>Completion Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-semibold">National Capital Region (NCR)</td>
                                    <td>856</td>
                                    <td>1,234</td>
                                    <td><span class="badge badge-light-success">85%</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Central Luzon</td>
                                    <td>643</td>
                                    <td>892</td>
                                    <td><span class="badge badge-light-warning">72%</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">CALABARZON</td>
                                    <td>587</td>
                                    <td>765</td>
                                    <td><span class="badge badge-light-success">88%</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Central Visayas</td>
                                    <td>421</td>
                                    <td>543</td>
                                    <td><span class="badge badge-light-warning">68%</span></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold">Davao Region</td>
                                    <td>389</td>
                                    <td>498</td>
                                    <td><span class="badge badge-light-danger">62%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Regional Statistics-->
        </div>
        <!--end::Left Column-->

        <!--begin::Right Column - Reminders-->
        <div class="col-xl-4">
            <!--begin::Reminders Card-->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title fw-bold">REMINDERS</h3>
                    <div class="card-toolbar">
                        <span class="badge badge-light-primary">Today</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <!--begin::Reminders List-->
                    <div class="scroll-y mh-500px px-5">
                        <!-- Current Time Highlight -->
                        <div class="d-flex flex-stack py-4 border-bottom border-gray-300 border-bottom-dashed">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle me-4 bg-light-warning">
                                    <span class="symbol-label text-warning fw-bold">NOW</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-900">1:14 AM - System Active</span>
                                    <span class="fs-7 text-gray-600">FRIDAY 19/09/2025</span>
                                </div>
                            </div>
                        </div>

                        <!-- Upcoming Reminders -->
                        <div class="d-flex flex-stack py-3 border-bottom border-gray-300 border-bottom-dashed">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle me-4 bg-light-primary">
                                    <span class="symbol-label text-primary fs-7">2:00</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-900">Daily Report Generation</span>
                                    <span class="fs-7 text-gray-600">Automated system report</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-stack py-3 border-bottom border-gray-300 border-bottom-dashed">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle me-4 bg-light-info">
                                    <span class="symbol-label text-info fs-7">3:00</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-900">Data Backup</span>
                                    <span class="fs-7 text-gray-600">System maintenance</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-stack py-3 border-bottom border-gray-300 border-bottom-dashed">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle me-4 bg-light-success">
                                    <span class="symbol-label text-success fs-7">4:00</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-900">Regional Data Sync</span>
                                    <span class="fs-7 text-gray-600">Update regional databases</span>
                                </div>
                            </div>
                        </div>

                        <!-- Add more reminders as needed -->
                        <div class="d-flex flex-stack py-3 border-bottom border-gray-300 border-bottom-dashed">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle me-4 bg-light-secondary">
                                    <span class="symbol-label text-secondary fs-7">5:00</span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-900">Weekly Analytics</span>
                                    <span class="fs-7 text-gray-600">Performance review</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Reminders List-->
                </div>
                <div class="card-footer py-4">
                    <button class="btn btn-light-primary w-100" type="button">
                        <i class="fas fa-plus me-2"></i>Add New Reminder
                    </button>
                </div>
            </div>
            <!--end::Reminders Card-->
        </div>
        <!--end::Right Column-->
    </div>
    <!--end::Main Content-->

    @push('scripts')
    <script>
        // Update current date and time
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('currentDateTime').textContent = now.toLocaleDateString('en-US', options);
        }

        // Update every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call
    </script>
    @endpush

</x-default-layout>