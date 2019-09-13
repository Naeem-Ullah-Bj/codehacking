@extends('layouts.admin')
@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="user_table">
            <thead>
                <tr>
                    <th width="10%">Image:</th>
                    <th width="20%">Category</th>
                    <th width="35%">Title:</th>
                    <th width="20%">Body:</th>
                    <th width="50%">Action:</th>
                </tr>
            </thead>
        </table>
    </div>

@endsection
@section('footer')

    <script>
        $(document).ready(function () {
            $('#user_table').DataTable({
                processing:true,
                serverSide:true,
                ajax:{
                    url:"{{ route('test.index') }}",

                },
                columns:[
                    {
                        data: 'photo_id',
                        name: 'photo_id',

                        render: function (data,type,full,mata) {
                                    return "<img src=" +data+ " width='70' class='img-thumbnail'>"
                                },
                        orderable: false
                    },
                    {
                        data:'category_id',
                        name:'category_id'
                    },
                    {
                        data: 'title',
                        name: 'title'

                    },
                    {
                        data: 'body',
                        name: 'body'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }

                ]

            });
        });
    </script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

@endsection

