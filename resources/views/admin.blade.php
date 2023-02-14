@extends('layout')

@section('header')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-header">
            <a href="{{ url('/admin/create') }}" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i></a>
        </div>
        <div class="card-body">
            <h6 class="card-title">{{ $title }}</h6>
                    <table class="table" id="primary_table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>FULLNAME</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('footer')
<script>
    $(window).ready(function () {
        var primary_table = $('#primary_table').DataTable({
            processing: true,
            ajax: {
                url: base_url + 'admin-dt',
                type: 'POST'
            },
            columns: [
                {
                    data: 'index_table',
                    defaultContent: '',
                    searchable: false,
                    orderable: false,
                    className: 'has-text-centered'
                },
                {
                    data: 'fullname'
                },
                {
                    data: 'email'
                },
                {
                    data: 'role.title'
                },
                {
                    data: 'status_to_text',
                    searchable:false,
                    orderable: false,
                },
                {
                    data: 'action',
                    searchable:false,
                    orderable: false,
                    render: function(data, type, row){
                        return `<a href="${base_url}admin/${row.uuid}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit link-icon"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                        <a href="http://127.0.0.1:8000/dashboard/muhammad-razzaki" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity link-icon"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></a>`;
                    }
                },
            ],
        });

        primary_table.on('draw', function() {
            primary_table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                var start = this.page.info().page * this.page.info().length;
                cell.innerHTML = start + i + 1;
                primary_table.cell(cell).invalidate('dom');
            });
        }).draw();

        feather.replace();
    });
</script>
@endsection
