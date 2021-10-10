@extends('campaign.wrapper')

@section('stylesheets')
<style>
    .clickable-row:hover{
        cursor: pointer;
    }
</style>
@endsection

@section('sub-content')
    <!-- Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title" id="form-title">Campaign List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table id="campaign-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Start Date</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection

@section('javascripts')
<script>
  $(function () {
    var table = $('#campaign-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('campaigns.index') }}",
        order: [[0,'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name', searchable: true },
            { data: 'location', name: 'location', searchable: true },
            { data: 'start_date', name: 'start_date', searchable: true },
            { data: 'created_by', name: 'created_by', searchable: true,
                render: function ( data, type, row, meta ) {
                    return data.name;
                }
            },
            { data: 'is_published', name: 'is_published', searchable: false,
                render: function ( data, type, row, meta ) {
                    var is_published, status;
                    if(data == '1'){
                        is_published = 'checked';
                        status = 'Published';
                    }else {
                        status = 'Pending';
                    }
                    return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3` + row.id + `" `+ is_published +`>
                                <label class="custom-control-label" for="customSwitch3` + row.id + `">`+ status +`</label>
                            </div>`;
                }
            },
            { data: 'action', name: 'action', searchable: false,
                defaultContent: `<button class='btn btn-sm btn-danger' title='Delete'><i class='fa fa-trash-alt'></i></button>`}
        ]
    });

    $('#campaign-table tbody').on( 'click', 'input[type=checkbox]', function () {
        var data = table.row( $(this).parents('tr') ).data();
        $.ajax({
            url: "{{ url('/campaigns/status') }}/"+data.id,
            type: "PATCH",
            data: {
                'is_published' : data.is_published == '1' ? '0' : '1',
                "_token"    : "{{ csrf_token() }}",
             },
            success:function(data){
                if(data.errors)
                {
                    return;
                }
                if(data.redirectTo){
                    window.location = data.redirectTo;
                }else {
                    Toast.fire({
                        icon: 'success',
                        title: 'Campaign status changed.'
                    });
                    table.ajax.reload( null, false );
                }
            },
            error:function(error){
                var errors = error.responseJSON.errors;
                Toast.fire({
                    icon: 'error',
                    title: errors
                });
            }
        });
    });

    $('#campaign-table tbody').on( 'click', 'button', function () {
        var action = this.title;
        var data = table.row( $(this).parents('tr') ).data();

        if(action == 'Delete')
            deleteRow(data.id);

    } );

    function deleteRow(id){
        if(confirm("Are You sure want to delete ?")) {

            $.ajax({
                type: "DELETE",
                url: "{{ url('/campaigns') }}/"+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Campaign deleted successfully'
                    })
                    table.ajax.reload( null, false );
                },
                error: function (data) {
                    Toast.fire({
                        icon: 'error',
                        title: data.responseJSON.message
                    })
                }
            });
        }
    }
  });
</script>
@endsection
