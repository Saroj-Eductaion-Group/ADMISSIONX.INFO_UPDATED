@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New Pages <!-- <a href="{{ url('administrator/pages') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new pages details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/pages', 'class' => 'form-horizontal', 'data-parsley-validate' => '']) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Title : </label>
                <div class="col-sm-10">
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter page title here', 'data-parsley-error-message' => 'Please enter page title here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Body : </label>
                <div class="col-sm-10">
                    {!! Form::textarea('body', null, ['class' => 'form-control textarea', 'placeholder' => 'Enter content here', 'data-parsley-error-message' => 'Please enter content here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Status : </label>
                <div class="col-sm-10">
                    <select name="status" class="form-control chosen-select" data-placeholder="Choose status ..."  data-parsley-error-message=" Please select status " data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select Status</option>
                        <option value="1">Published</option>
                        <option value="0">Unpublished</option>
                       <!--  <option value="Shemale">Other</option> -->
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection

@section('script')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script >
    $('textarea').ckeditor();
    // $('.textarea').ckeditor(); // if class is prefered.
</script>
<script type="text/javascript">
/*$(function() {
    $('textarea').ckeditor({
        toolbar: 'Full',
        enterMode : CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P
    });
});*/
</script>

@endsection