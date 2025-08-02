@extends('backend.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
          @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success!</strong> {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Error!</strong> {{ Session::get('error') }}
                </div>
            @endif
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="row">
                        <div class="card-header  col-md-6 col-sm-6">
                            <h5 class="card-title mb-0">Manage Expericence</h5>
                        </div>
                        <div class="card-header  col-md-6 col-sm-6 d-grid d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.addExperience') }}">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="menu-icon tf-icons ti ti-plus"></i>
                                    <span>Add Expericence</span>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="datatables-users table" id="data-table">
                            <thead class="border-top">
                                <tr>
                                    <th>No</th>
                                    <th>Expericence Name </th>
                                    <th>Company Name</th>
                                    <th>Company Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('custom_css')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('backend/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
@endsection

@section('custom_js')
    <script src="{{ asset('backend/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.experienceList') }}",
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'ex_name',
                        name: 'ex_name'
                    },
                    {
                        data: 'com_name',
                        name: 'com_name'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date'
                    },
                    {
                        data: 'end_date',
                        name: 'end_date'
                    },
                    {
                        data: 'com_des',
                        name: 'com_des'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });

        jQuery(document).on("click", "button.skill_delete_alert", function() {
            if (confirm("Are you sure, want to delete?"))
                jQuery(this).parent().submit();
        });
    </script>
@endsection
