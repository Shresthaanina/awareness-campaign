@extends('setting.wrapper')

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
                    <h3 class="card-title" id="form-title">General Setting</h3>
                </div>
                {!! Form::open(array('url' => route('settings.update'), 'method' => 'PUT','class'=>'form-horizontal form-bordered','id'=>'setting-form','enctype'=>'multipart/form-data')) !!}
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="logo">Logo</label><br>
                                        <input type="file" name="logo" class="form-control" id="logo" value="" @if(isset($settings['logo'])) style="display: none;" @endif>
                                        <div id="logo-preview" @if(!isset($settings['logo'])) style="display: none;" @endif>
                                            <img src="{{ asset(config('constants.settingPath')) . '/' .$settings['logo'] }}" height="150px">
                                            <a href="javascript:void(0)" onClick="removeLogo();">Remove</a>
                                        </div>
                                        @if($errors->has('logo'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('logo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="site_name">Site Name</label>
                                        {!! Form::text('site_name', $settings['site_name'], array('placeholder' => 'Site Name','class' => 'form-control','id' => 'site_name','required')) !!}
                                        @if($errors->has('site_name'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('site_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="site_name">Site Tagline</label>
                                        {!! Form::text('site_tagline', $settings['site_tagline'], array('placeholder' => 'Site Tagline','class' => 'form-control','id' => 'site_tagline')) !!}
                                        @if($errors->has('site_tagline'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('site_tagline') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- /.col-12 -->
    </div>
    <!-- /.row -->
@endsection

@section('javascripts')
<script>
    $(document).ready(function(){
        $('#logo').change(function(e){
            $(this).hide();
            const file = e.target.files[0];
            const imageUrl = URL.createObjectURL(file);
            $('#logo-preview img').attr('src', imageUrl);
            $('#logo-preview').css('display','block');
            // $('#logo').attr('src', imageUrl);
        });

    });
    function removeLogo(){
        $('#logo').show();
        $('#logo').val('');
        $('#logo-preview').hide();
        $('#logo-preview img').attr('src','');
    }
</script>
@endsection
