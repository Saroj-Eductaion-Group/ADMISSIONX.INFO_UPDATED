@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Education Level <!-- <a href="{{ url('employee/educationlevel') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update education level details</h5>                            
            </div>
            <div class="ibox-content">
                 {!! Form::model($educationlevel, [ 'method' => 'PATCH', 'url' => ['employee/educationlevel', $educationlevel->id], 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Education Level Name : </label>
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter education level here', 'data-parsley-error-message' => 'Please enter education level here', 'data-parsley-trigger'=>'change', 'required' => '','data-parsley-pattern'=>'^[a-zA-Z\\/s &().,-]*$']) !!}
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                @include('common-partials.common-fileds-update-partial')
                <hr>
                <div class="row">
                   <div class="col-md-12">
                       <div class="headline"><h2>SEO Content</h2></div>
                        <input type="hidden" name="seopagename" value="educationlevelpage">
                        @if(isset($seocontent) && (sizeof($seocontent) > 0))
                            @if(!empty($seocontent[0]->seoContentId))
                                <input type="hidden" name="seoContentId" value="{{ $seocontent[0]->seoContentId }}">
                            @endif
                            @include ('administrator.seo-content.seo-update-partial')
                        @else
                            @include ('administrator.seo-content.seo-create-partial')
                        @endif
                   </div> 
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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
@include('common-partials.common-fileds-update-scripts-partial')
@endsection