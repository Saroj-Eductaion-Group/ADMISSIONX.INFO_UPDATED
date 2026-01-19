@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage News Tag</h2>        
    </div>    
    <div class="col-lg-2">
        <a href="{{ url($fetchDataServiceController->routeCall().'/news-tags/') }}" class="btn btn-warning btn-sm" title="Add NewsTag"><i class="fa fa-arrow-left"></i> Back</a>
    </div>        
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::open(['url' => $fetchDataServiceController->routeCall().'/news-tags', 'class' => '', 'files' => true, 'data-parsley-validate' => '']) !!}

                        <div class="row">
                           <div class="col-md-12">
                                <label>News Tag Name</label>
                                <input type="text" name="name" value="" class="form-control" required="" data-parsley-error-message="Please enter news tags name">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                           <div class="col-md-12">
                               <div class="headline"><h2>SEO Content</h2></div>
                                <input type="hidden" name="seopagename" value="newstagpage">
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
                        <div class="text-center">
                            <button class="btn btn-primary btn-md">Create</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection