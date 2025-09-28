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
                            <h5 class="card-title mb-0">Manage Information</h5>
                        </div>
                        <div class="card-header  col-md-6 col-sm-6 d-grid d-md-flex justify-content-md-end">
                            <a href="{{ route('admin.addInfo') }}">
                                <button class="btn btn-sm btn-primary" type="button">
                                    <i class="menu-icon tf-icons ti ti-plus"></i>
                                    <span>Add Information</span>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="datatables-users table" id="data-table">
                            <thead class="border-top">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>freelance</th>
                                    <th>photo</th>
                                    <th>Resume File</th>
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
                ajax: "{{ route('admin.infoList') }}",
                columns: [{
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'freelance',
                        name: 'freelance'
                    },
                    {
                        data: 'photo',
                        name: 'photo'
                    },
                    {
                        data: 'resume_file',
                        name: 'resume_file'
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

        jQuery(document).on("click", "button.info_delete_alert", function() {
            if (confirm("Are you sure, want to delete?"))
                jQuery(this).parent().submit();
        });
    </script>
@endsection
