@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Popular Career Detail <a href="{{ url('counseling/counseling-career-details') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update popular career detail </h5>
            </div>
            <div class="ibox-content">
            {!! Form::model($counselingcareerdetail, [
                'method' => 'PATCH',
                'url' => ['/counseling/counseling-career-details', $counselingcareerdetail->id],
                'class' => 'form-horizontal',
                'data-parsley-validate' => '', 
                'enctype' => 'multipart/form-data',
                'files' => true
            ]) !!}

            @include ('counseling.counseling-career-details.form', ['submitButtonText' => 'Update'])
            <hr>
            <div class="row">
               <div class="col-md-12">
                   <div class="headline"><h2>SEO Content</h2></div>
                    <input type="hidden" name="seopagename" value="popularcareerpage">
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
            <hr>
            <div class="form-group">
                <div class="col-md-offset-4 col-md-4">
                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  
@endsection
@section('script')
@include('counseling.common-partial.counseling-career-scripts')
@endsection