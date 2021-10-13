@extends('banner.wrapper')

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
                    <h3 class="card-title" id="form-title">Add Banner</h3>
                </div>
                <!-- /.card-header -->
                {!! Form::open(array('class'=>'form-horizontal form-bordered','id'=>'bannerForm')) !!}
                <div class="card-body">
                    <!-- Labels on top Form Content -->
                    <div class="form-group">
                        <label for="banner-image">Banner Image *</label>
                        <input type="file" name="image" value="" class="form-control" id="banner-image">
                        <div id="banner-preview" style="display: none;">
                            <img src="" height="120px">
                            <a href="javascript:void(0)" onClick="removeBanner();">Remove</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        {!! Form::hidden('id', null, array('id' => 'banner_id')) !!}
                        {!! Form::text('title', null, array('placeholder' => 'Title','class' => 'form-control','id' => 'title')) !!}
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        {!! Form::text('excerpt', null, array('placeholder' => 'Excerpt','class' => 'form-control','id' => 'excerpt')) !!}
                    </div>
                    <div class="form-group">
                        <label for="button_text">Button Text</label>
                        {!! Form::text('button_text', null, array('placeholder' => 'Button Text','class' => 'form-control','id' => 'button_text')) !!}
                    </div>
                    <div class="form-group">
                        <label for="button_link">Button Link</label>
                        {!! Form::text('button_link', null, array('placeholder' => 'Button link','class' => 'form-control','id' => 'button_link')) !!}
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
                    <h3 class="card-title" id="form-title">Banner List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- <div class="table-responsive p-0"> -->
                        <table id="banner-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    <!-- </div> -->
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
        $('#form-title').html("Add Banner");
        $('#bannerForm')[0].reset();
        $('#banner_id').val('');
    }

  $(function () {
    var table = $('#banner-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('banners.index') }}",
        order: [[0,'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'image', name: 'image', searchable: false,
                render: function (data, type, row, meta) {
                    return '<img src="{{ asset(config("constants.bannerPath")) }}/'+ data +'" height="75px">';
                }
            },
            { data: 'title', name: 'title', searchable: true },
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

    $('#banner-table tbody').on( 'click', 'input[type=checkbox]', function () {
        var data = table.row( $(this).parents('tr') ).data();
        $.ajax({
            url: "{{ url('/banners/status') }}/"+data.id,
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
                        title: 'Banner status changed.'
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

    $('#banner-table tbody').on( 'click', 'button', function () {
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
                url: "{{ url('/banners') }}/"+id,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Banner deleted successfully'
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
        $.get('banners/' + id, function (data) {
            $('#form-title').html("Edit Banner");
            $('#title').val(data.title);
            $('#excerpt').val(data.excerpt);
            $('#button_text').val(data.button_text);
            $('#button_link').val(data.button_link);
            $('#banner_id').val(data.id);

            $('#banner-image').hide();
            $('#banner-preview').show();
            $('#banner-preview img').attr('src', '{{ asset(config("constants.bannerPath")) }}/' + data.image);

            $("html, body").animate({ scrollTop: 0 }, 300);
        })
    }

    $("#bannerForm").submit(function(event){
        event.preventDefault();
        $('#bannerForm .card-body .alert-danger').remove();
        var id = $('#banner_id').val();
        let formData = new FormData();
        formData.append('title', $(this).find('input[name="title"]').val());
        formData.append('excerpt', $(this).find('input[name="excerpt"]').val());
        formData.append('button_text', $(this).find('input[name="button_text"]').val());
        formData.append('button_link', $(this).find('input[name="button_link"]').val());

        var files = $('#banner-image').prop('files');
        if(files.length > 0 && files[0] != ""){
            formData.append('image', files[0], files[0].name);
        } else {
            var imgName = $(this).find('#banner-preview img').attr('src').split('/').pop();
            formData.append('prev_image', imgName);
        }
        if(id){
            formData.append('_method', 'PATCH')
        }
        $.ajax({
            url: !id ? "{{ route('banners.store') }}" : "{{ url('/banners') }}/"+id,
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
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
                        title: 'Banner saved successfully'
                    })
                    table.ajax.reload( null, false );
                }
                resetForm();
                $('#banner-image').val('');
                $('#banner-image').show();
                $('#banner-preview').hide();
            },
            error:function(error){
                var errors = error.responseJSON.errors;
                var errorStr = '';
                $.each( errors, function( key, value ) {
                    errorStr += '- ' + value[0] + '<br/>';
                });

                var errorsHtml= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + errorStr + '</div>';
                $('#bannerForm .card-body').prepend(errorsHtml);
            }
        });
    });

    $('#banner-image').change(function(e){
        $(this).hide();
        const file = e.target.files[0];
        const imageUrl = URL.createObjectURL(file);
        $('#banner-preview img').attr('src', imageUrl);
        $('#banner-preview').css('display','block');
    });
  });
    function removeBanner(){
        $('#banner-image').show();
        $('#banner-image').val('');
        $('#banner-preview').hide();
        $('#banner-preview img').attr('src','');
    }
</script>
@endsection
