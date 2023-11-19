@extends('layouts.admin.index')
@section('title', 'Categories')

@section('content')
    @component('admin.components.global.index')
        @slot('module')
            category
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
            <div class="card flex-fill">
                <table class="table" id="table-index">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script>
    $(function () {
        let table = $('#table-index').DataTable({
            dom: 'rtp',
            select: true,
            processing: true,
            serverSide: true,
            language: {
                'paginate': {
                    'previous': '<span class="prev-icon"><<</span>',
                    'next': '<span class="next-icon">>></span>'
                }
            },
            ajax: '{!! route('category.api.index') !!}',
            "pageLength": 5,
            columnDefs: [
                { className: "not-export", "targets": [2] }
            ],
            columns: [
                { data: 'name_category', name: 'name'},
                { data: 'status', name: 'status'},
                {
                    data: 'action',
                    targets: 2,
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return `
                            <div class="d-flex">
                                <a class="btn btn-primary" href="${data[0]}">
                                    Edit
                                </a>
                                &nbsp;
                                <form action="${data[1]}" method="post">
                                    <button type='button'class="btn-delete btn btn-danger">Delete</button>
                                </form>
                            </div>
                        `
                    }
                }
            ]
        });

        $('#select-status').change(function () {
            let value = $(this).val();
            table.column(1).search(value).draw();
        });

        $(document).on('click', '.btn-delete', function () {
            let form = $(this).parents('form');
            axios.delete(form.attr('action'))
                .then(res => {
                    table.draw();
                })
                .catch(err => {
                    console.log(err);
                });
        });
    });

</script>
@stop
