@extends('category.wrapper')

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
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title" id="form-title">Add Category</h3>
                </div>
                <!-- /.card-header -->
                {!! Form::open(array('class'=>'form-horizontal form-bordered','id'=>'categoryForm')) !!}
                <div class="card-body">
                    <!-- Labels on top Form Content -->
                    <div class="form-group">
                        <label for="name">Name *</label>
                        {!! Form::hidden('id', null, array('id' => 'category_id')) !!}
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
                    </div>
                    <!-- END Labels on top Form Content -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-outline-primary float-right">Save</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="resetForm()">Reset</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title" id="form-title">Category List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table id="category-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
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
    function resetForm(){
        $('#form-title').html("Add Category");
        $('#categoryForm')[0].reset();
        $('#category_id').val('');
    }

  $(function () {
    var table = $('#category-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('categories.index') }}",
        order: [[0,'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name', searchable: true },
            { data: 'is_active', name: 'is_active', searchable: false,
                render: function ( data, type, row, meta ) {
                    var is_active, status;
                    if(data == '1'){
                        is_active = 'checked';
                        status = 'Active';
                    }else {
                        status = 'Inactive';
                    }
                    return `<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="customSwitch3` + row.id + `" `+ is_active +`>
                                <label class="custom-control-label" for="customSwitch3` + row.id + `">`+ status +`</label>
                            </div>`;
                }
            },
            { data: 'action', name: 'action', searchable: false,
                defaultContent: `<button class='btn btn-sm btn-primary' title='Edit'><i class='fa fa-pencil-alt'></i></button>
                                <button class='btn btn-sm btn-danger' title='Delete'><i class='fa fa-trash-alt'></i></button>`}
        ]
    });

    $('#category-table tbody').on( 'click', 'input[type=checkbox]', function () {
        var data = table.row( $(this).parents('tr') ).data();
        $.ajax({
            url: "{{ url('/categories/status') }}/"+data.id,
            type: "PATCH",
            data: {
                'is_active' : data.is_active == '1' ? '0' : '1',
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
                        title: 'Category status changed.'
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

    $('#category-table tbody').on( 'click', 'button', function () {
        var action = this.title;
        var data = table.row( $(this).parents('tr') ).data();

        if (action=='Edit')
            editRow(data.id);

        if(action == 'Delete')
            deleteRow(data.id);

    } );

    function deleteRow(id){
        if(confirm("Are You sure want to delete ?")) {

            $.ajax({
                type: "DELETE",
                url: "{{ url('/categories') }}/"+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Category deleted successfully'
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

    function editRow(id){
        $.get('categories/' + id, function (data) {
            $('#form-title').html("Edit Category");
            $('#name').val(data.name);
            $('#category_id').val(data.id);
            $("html, body").animate({ scrollTop: 0 }, 300);
        })
    }

    $("#categoryForm").submit(function(event){
        event.preventDefault();
        $('#categoryForm .card-body .alert-danger').remove();
        var id = $('#category_id').val();
        $.ajax({
            url: !id ? "{{ route('categories.store') }}" : "{{ url('/categories') }}/"+id,
            type: !id ? "POST" : "PATCH",
            data: $('#categoryForm').serialize(),
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
                        title: 'Category saved successfully'
                    })
                    table.ajax.reload( null, false );
                }
                resetForm();
            },
            error:function(error){
                var errors = error.responseJSON.errors;
                var errorStr = '';
                $.each( errors, function( key, value ) {
                    errorStr += '- ' + value[0] + '<br/>';
                });

                var errorsHtml= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + errorStr + '</div>';
                $('#categoryForm .card-body').prepend(errorsHtml);
            }
        });
    });
  });
</script>
@endsection
