@extends('layout')

@section('header')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h6 class="card-title">{{ $title }}</h6>
                    <table class="table" id="primary_table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Agent</th>
                                <th>ID</th>
                                <th>First Sync</th>
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
                url: base_url + 'device/dt',
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
                    data: 'user_agent'
                },
                {
                    data: 'one_signal_id'
                },
                {
                    data: 'created_at'
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
    });
</script>
@endsection
