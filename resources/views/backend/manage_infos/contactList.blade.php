@extends('backend.layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="card-header  col-md-6 col-sm-6">
                        <h5 class="card-title mb-0">Contacts</h5>
                    </div>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatables-users table" id="data-table">
                        <thead class="border-top">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>message</th>
                                <th>Reach Out Time</th>
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
            ajax: "{{ route('admin.contactList') }}",
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
                    data: 'subject',
                    name: 'subject'
                },
                {
                    data: 'message',
                    name: 'message'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }
            ]
        });

    });

    jQuery(document).on("click", "button.info_delete_alert", function() {
        if (confirm("Are you sure, want to delete?"))
            jQuery(this).parent().submit();
    });
</script>
@endsection