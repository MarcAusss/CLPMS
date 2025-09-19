<x-default-layout>

    @section('title')
        CL Profiling
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('audit-management.audits.index') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                {{-- <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search"
                        class="form-control form-control-solid w-250px ps-13" placeholder="Search Audit"
                        id="mySearchInput" />
                </div> --}}
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addAuditModalComponent">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Add Profiled CL
                    </button>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:profiling.child-laborer-form>
                <!--end::Modal-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    @push('scripts')
    {!! $dataTable->table() !!}
    {!! $dataTable->scripts() !!}
    {{-- {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            // DataTables initialization
            if ($.fn.dataTable.isDataTable('#audits-table')) {
                $('#audits-table').DataTable().destroy();
            }

            $('#audits-table').DataTable({
                // your DataTables options
            });
            
        });
    </script> --}}
    <script>
        window.addEventListener('profile-saved', () => {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Child Laborer profile successfully saved.',
            });
        });

        
        window.addEventListener('profile-saving-failed', () => {
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Saving Child Laborer profile failed. Please try again.',
            });
        });
    </script>
@endpush

</x-default-layout>
