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
                                <span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2" id="totalActiveCases">0</span>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Total Active Child Labor Cases</span>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-light-success fs-7 fw-semibold" id="monthlyIncrease">+0</span>
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
                                <span class="fs-2hx fw-bold text-success me-2 lh-1 ls-n2" id="totalWithdrawnCases">0</span>
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
                                    <i class="fas fa-users fs-1 text-primary"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('cl-profiling.index') }}" class="fs-4 fw-bold text-gray-900 text-hover-primary">CL Profiling</a>
                                    <span class="text-gray-600">Manage child labor profiles and records</span>
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
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-4 bg-light-warning rounded">
                                <span class="svg-icon svg-icon-2hx svg-icon-warning me-4">
                                    <i class="fas fa-plus-circle fs-1 text-warning"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-4 fw-bold text-gray-900 text-hover-primary" data-bs-toggle="modal" data-bs-target="#addAuditModalComponent">Add New Profile</a>
                                    <span class="text-gray-600">Create new child labor profile</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-4 bg-light-info rounded">
                                <span class="svg-icon svg-icon-2hx svg-icon-info me-4">
                                    <i class="fas fa-search fs-1 text-info"></i>
                                </span>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('cl-profiling.index') }}#search" class="fs-4 fw-bold text-gray-900 text-hover-primary">Search Profiles</a>
                                    <span class="text-gray-600">Find specific child labor cases</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Quick Actions-->

            <!--begin::Recent Activity-->
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Recent CL Profile Activity</h3>
                    <div class="card-toolbar">
                        <a href="{{ route('cl-profiling.index') }}" class="btn btn-sm btn-light-primary">View All</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th>Profile ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Province</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                </tr>
                            </thead>
                            <tbody id="recentActivityTable">
                                <!-- Data will be populated via JavaScript -->
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <div class="spinner-border spinner-border-sm me-2"></div>
                                        Loading recent activity...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Recent Activity-->

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
                            <tbody id="regionalStatsTable">
                                <!-- Data will be populated via JavaScript -->
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        <div class="spinner-border spinner-border-sm me-2"></div>
                                        Loading regional statistics...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end::Regional Statistics-->
        </div>
        <!--end::Left Column-->

        <!--begin::Right Column - Reminders & System Info-->
        <div class="col-xl-4">
            <!--begin::System Overview-->
            <div class="card mb-5">
                <div class="card-header">
                    <h3 class="card-title fw-bold">System Overview</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center mb-4">
                            <div class="symbol symbol-50px symbol-circle me-4 bg-light-primary">
                                <span class="symbol-label text-primary">
                                    <i class="fas fa-database fs-2"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fs-5 fw-bold text-gray-900" id="totalProfiles">0</span>
                                <span class="text-gray-600">Total Profiles</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="symbol symbol-50px symbol-circle me-4 bg-light-success">
                                <span class="symbol-label text-success">
                                    <i class="fas fa-check-circle fs-2"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fs-5 fw-bold text-gray-900" id="completedProfiles">0</span>
                                <span class="text-gray-600">Completed Profiles</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50px symbol-circle me-4 bg-light-warning">
                                <span class="symbol-label text-warning">
                                    <i class="fas fa-clock fs-2"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fs-5 fw-bold text-gray-900" id="pendingProfiles">0</span>
                                <span class="text-gray-600">Pending Review</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::System Overview-->

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
                                    <span class="fs-6 fw-bold text-gray-900" id="currentTime">Loading...</span>
                                    <span class="fs-7 text-gray-600" id="currentDate">Loading...</span>
                                </div>
                            </div>
                        </div>

                        <!-- System Reminders -->
                        <div class="d-flex flex-stack py-3 border-bottom border-gray-300 border-bottom-dashed">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle me-4 bg-light-primary">
                                    <span class="symbol-label text-primary fs-7">
                                        <i class="fas fa-sync"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-900">Data Sync Required</span>
                                    <span class="fs-7 text-gray-600">Sync pending profile updates</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-stack py-3 border-bottom border-gray-300 border-bottom-dashed">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle me-4 bg-light-info">
                                    <span class="symbol-label text-info fs-7">
                                        <i class="fas fa-chart-line"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-900">Monthly Report Due</span>
                                    <span class="fs-7 text-gray-600">Generate monthly statistics</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-stack py-3 border-bottom border-gray-300 border-bottom-dashed">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-35px symbol-circle me-4 bg-light-success">
                                    <span class="symbol-label text-success fs-7">
                                        <i class="fas fa-shield-alt"></i>
                                    </span>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 fw-bold text-gray-900">System Backup</span>
                                    <span class="fs-7 text-gray-600">Scheduled maintenance</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Reminders List-->
                </div>
                <div class="card-footer py-4">
                    <a href="{{ route('cl-profiling.index') }}" class="btn btn-light-primary w-100">
                        <i class="fas fa-tasks me-2"></i>Manage Profiles
                    </a>
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
        const dateOptions = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric'
        };
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };
        
        document.getElementById('currentDateTime').textContent = 
            now.toLocaleDateString('en-US', dateOptions) + ' • ' + 
            now.toLocaleTimeString('en-US', timeOptions);
            
        document.getElementById('currentDate').textContent = 
            now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('currentTime').textContent = 
            now.toLocaleTimeString('en-US', timeOptions);
    }

    // Load dashboard statistics from API
    async function loadDashboardStats() {
        try {
            const response = await fetch("{{ route('api.dashboard.stats') }}");
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            
            // Update statistics with real data
            document.getElementById('totalActiveCases').textContent = data.active_cases.toLocaleString();
            document.getElementById('monthlyIncrease').textContent = `+${data.monthly_increase}`;
            document.getElementById('totalWithdrawnCases').textContent = data.withdrawn_cases.toLocaleString();
            document.getElementById('totalProfiles').textContent = data.total_profiles.toLocaleString();
            document.getElementById('completedProfiles').textContent = (data.withdrawn_cases + data.active_cases).toLocaleString();
            document.getElementById('pendingProfiles').textContent = data.pending_cases.toLocaleString();

            // Load recent activity and regional stats
            await loadRecentActivity();
            await loadRegionalStats();
            
        } catch (error) {
            console.error('Error loading dashboard stats:', error);
            // Fallback to mock data if API fails
            loadMockData();
        }
    }

    // Fallback mock data
    function loadMockData() {
        document.getElementById('totalActiveCases').textContent = '3,157';
        document.getElementById('monthlyIncrease').textContent = '+250';
        document.getElementById('totalWithdrawnCases').textContent = '4,567';
        document.getElementById('totalProfiles').textContent = '7,724';
        document.getElementById('completedProfiles').textContent = '6,189';
        document.getElementById('pendingProfiles').textContent = '1,535';
        
        loadRecentActivity();
        loadRegionalStats();
    }

    // Load recent activity from API
    async function loadRecentActivity() {
        try {
            // First, let's try to get recent profiles from the datatable endpoint
            const response = await fetch("{{ route('cl-profiling.datatable') }}?length=5");
            if (!response.ok) {
                throw new Error('Failed to fetch recent activity');
            }
            const data = await response.json();
            
            const tbody = document.getElementById('recentActivityTable');
            tbody.innerHTML = '';

            if (data.data && data.data.length > 0) {
                data.data.forEach(activity => {
                    const statusClass = activity.status === 'Active' ? 'badge-light-success' : 
                                      activity.status === 'Pending' ? 'badge-light-warning' : 'badge-light-danger';
                    
                    // Calculate time ago
                    const updatedAt = new Date(activity.updated_at || activity.created_at);
                    const timeAgo = getTimeAgo(updatedAt);
                    
                    const row = `
                        <tr>
                            <td class="fw-semibold">${activity.id}</td>
                            <td>${activity.full_name}</td>
                            <td>${activity.age}</td>
                            <td>${activity.province}</td>
                            <td><span class="badge ${statusClass}">${activity.status}</span></td>
                            <td class="text-muted">${timeAgo}</td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            } else {
                // Fallback to mock data if no real data
                loadMockRecentActivity();
            }
            
        } catch (error) {
            console.error('Error loading recent activity:', error);
            loadMockRecentActivity();
        }
    }

    // Mock recent activity data
    function loadMockRecentActivity() {
        const recentActivity = [
            { id: 'CL00123', name: 'Dela Cruz, Juan', age: 14, province: 'Metro Manila', status: 'Active', updated: '2 hours ago' },
            { id: 'CL00124', name: 'Santos, Maria', age: 15, province: 'Cavite', status: 'Pending', updated: '4 hours ago' },
            { id: 'CL00125', name: 'Reyes, Pedro', age: 13, province: 'Laguna', status: 'Withdrawn', updated: '1 day ago' },
            { id: 'CL00126', name: 'Gonzales, Ana', age: 16, province: 'Bulacan', status: 'Active', updated: '1 day ago' },
            { id: 'CL00127', name: 'Torres, Miguel', age: 14, province: 'Rizal', status: 'Pending', updated: '2 days ago' }
        ];

        const tbody = document.getElementById('recentActivityTable');
        tbody.innerHTML = '';

        recentActivity.forEach(activity => {
            const statusClass = activity.status === 'Active' ? 'badge-light-success' : 
                              activity.status === 'Pending' ? 'badge-light-warning' : 'badge-light-danger';
            
            const row = `
                <tr>
                    <td class="fw-semibold">${activity.id}</td>
                    <td>${activity.name}</td>
                    <td>${activity.age}</td>
                    <td>${activity.province}</td>
                    <td><span class="badge ${statusClass}">${activity.status}</span></td>
                    <td class="text-muted">${activity.updated}</td>
                </tr>
            `;
            tbody.innerHTML += row;
        });
    }

    // Load regional statistics (you can enhance this with real API later)
    async function loadRegionalStats() {
        try {
            // For now, we'll use mock data for regional stats
            // You can create an API endpoint for this later
            const regionalStats = [
                { region: 'National Capital Region (NCR)', active: 856, withdrawn: 1234, rate: 85 },
                { region: 'Central Luzon', active: 643, withdrawn: 892, rate: 72 },
                { region: 'CALABARZON', active: 587, withdrawn: 765, rate: 88 },
                { region: 'Central Visayas', active: 421, withdrawn: 543, rate: 68 },
                { region: 'Davao Region', active: 389, withdrawn: 498, rate: 62 }
            ];

            const tbody = document.getElementById('regionalStatsTable');
            tbody.innerHTML = '';

            regionalStats.forEach(stat => {
                const rateClass = stat.rate >= 80 ? 'badge-light-success' : 
                                stat.rate >= 70 ? 'badge-light-warning' : 'badge-light-danger';
                
                const row = `
                    <tr>
                        <td class="fw-semibold">${stat.region}</td>
                        <td>${stat.active.toLocaleString()}</td>
                        <td>${stat.withdrawn.toLocaleString()}</td>
                        <td><span class="badge ${rateClass}">${stat.rate}%</span></td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
            
        } catch (error) {
            console.error('Error loading regional stats:', error);
            // Regional stats will use the mock data above
        }
    }

    // Helper function to calculate time ago
    function getTimeAgo(date) {
        const now = new Date();
        const diffInMs = now - new Date(date);
        const diffInHours = Math.floor(diffInMs / (1000 * 60 * 60));
        const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

        if (diffInHours < 1) {
            return 'Just now';
        } else if (diffInHours < 24) {
            return `${diffInHours} hour${diffInHours > 1 ? 's' : ''} ago`;
        } else if (diffInDays < 7) {
            return `${diffInDays} day${diffInDays > 1 ? 's' : ''} ago`;
        } else {
            return new Date(date).toLocaleDateString();
        }
    }

    // Initialize dashboard
    document.addEventListener('DOMContentLoaded', function() {
        updateDateTime();
        setInterval(updateDateTime, 1000);
        loadDashboardStats();
        
        // Refresh stats every 5 minutes
        setInterval(loadDashboardStats, 300000);
    });
</script>
@endpush

</x-default-layout>