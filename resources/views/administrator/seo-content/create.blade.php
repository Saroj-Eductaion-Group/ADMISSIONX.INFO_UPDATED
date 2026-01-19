@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Seo Content</h2>        
    </div>    
    <div class="col-lg-2">
        <a href="{{ url($fetchDataServiceController->routeCall().'/seo-content/') }}" class="btn btn-warning btn-sm" title="Add Seo Content"><i class="fa fa-arrow-left"></i> Back</a>
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
                        {!! Form::open(['url' => $fetchDataServiceController->routeCall().'/seo-content', 'class' => '', 'files' => true, 'data-parsley-validate' => '']) !!}
                        <h2>Metadeta</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="margin-bottom-20">
                                    <label>SEO Page Title</label>
                                    <input class="form-control" type="text" name="pagetitle" placeholder="Enter page title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter page title" >
                                </div>
                            </div>
                        </div>
                        <hr class="hr-line-dashed">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="margin-bottom-20">
                                    <label>SEO H1 Title</label>
                                    <input class="form-control" type="text" name="h1title" placeholder="Enter H1 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H1 title" >
                                </div>
                            </div>
                        </div>
                        <hr class="hr-line-dashed">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="margin-bottom-20">
                                    <label>SEO Meta Keyword</label>
                                    <input class="form-control" type="text" name="keyword" placeholder="Enter meta keyword here"  data-parsley-trigger="change" data-parsley-error-message="Please enter meta keyword" >
                                </div>
                            </div>
                        </div>
                        <hr class="hr-line-dashed">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="margin-bottom-20">
                                    <label>SEO Description</label>
                                    {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'data-parsley-error-message' => 'Please enter page description ', 'data-parsley-trigger' => 'change', 'placeholder' => 'Enter page description here']) !!}
                                </div>
                            </div>
                        </div>
                        <hr class="hr-line-dashed">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="margin-bottom-20">
                                    <label>SEO Canonical Url</label>
                                    <input class="form-control" type="text" name="canonical" placeholder="Enter canonical here"  data-parsley-trigger="change" data-parsley-error-message="Please enter canonical">
                                </div>
                            </div>
                        </div>
                        <hr class="hr-line-dashed">
                        <h2>Content</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="margin-bottom-20">
                                    <label>SEO H2 Title</label>
                                    <input class="form-control" type="text" name="h2title" placeholder="Enter H2 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H2 title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="margin-bottom-20">
                                    <label>SEO H3 Title</label>
                                    <input class="form-control" type="text" name="h3title" placeholder="Enter H3 title here"  data-parsley-trigger="change" data-parsley-error-message="Please enter H3 title">
                                </div>
                            </div>
                        </div>
                        <hr class="hr-line-dashed">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="margin-bottom-20">
                                    <label>SEO Image</label>
                                    <input type="file" class="form-control" name="image" class="input input-file featuredImage"  data-parsley-error-message="Please upload only png , jpg or jpeg." onchange="readURL1(this);" autofocus="" data-parsley-filemaxmegabytes="2" data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg, image/jpg, image/png">
                                    <img  class="img-responsive margin-top15"  id="uploadImage1" src="/assets/images/no-college-logo.jpg" alt="your image" style="width: 200px; height: 160px; "/>
                                    <p class="text-danger hide" id="logoDoc">(please upload .png, .jpg and .jpeg file only)</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="margin-bottom-20">
                                    <label>SEO Image alt text</label>
                                    <input class="form-control" type="text" name="imagealttext" placeholder="Enter image alt text here"  data-parsley-trigger="change" data-parsley-error-message="Please enter image alt text">
                                </div>
                            </div>
                        </div>
                        <hr class="hr-line-dashed">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="margin-bottom-20">
                                    <label>SEO Image Description</label>
                                     {!! Form::textarea('content1', null, ['class' => 'form-control summernote', 'data-parsley-error-message' => 'Please enter page content ', 'data-parsley-trigger' => 'change', 'placeholder' => 'Enter page content here']) !!}
                                </div>
                            </div>
                        </div>
                        <hr class="hr-line-dashed">
                        <div class="text-center margin-top40 margin-bottom-20">
                            <button class="btn btn-primary btn-md">Create</button>
                        </div>
                        <hr class="hr-line-dashed">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection