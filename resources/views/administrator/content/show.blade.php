@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('Content'); /*--}}
{{--*/ $validateUserRoleCallSeoContent = $fetchDataServiceController->validateUserRoleCall('SeoContent'); /*--}}

<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-6">
        <h2>Manage Content</h2>        
    </div>   
    @if(Auth::check())
        @if(Auth::user()->userrole_id == 4)
            @if((isset($validateUserRoleCallSeoContent)) && (sizeof($validateUserRoleCallSeoContent) > 0) && ($validateUserRoleCallSeoContent[0]->edit == '1'))
            <div class="col-lg-2">
                <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $content->contentcategory_id.'/edit') }}" title="View content"><button class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update SEO</button></a>
            </div>     
            @endif
                
            <div class="col-lg-1">
                <a href="{{ URL::previous() }}" class="btn btn-info btn-sm" title="Edit content"><i class="fa fa-arrow-left"></i> Previous</a>
            </div> 
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/') }}" class="btn btn-warning btn-sm" title="Edit content"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>  
            @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->edit == '1'))
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $content->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            @endif
        @else
            <div class="col-lg-2">
                <a href="{{ url($fetchDataServiceController->routeCall().'/contentcategory/' . $content->contentcategory_id.'/edit') }}" title="View content"><button class="btn btn-success btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Update SEO</button></a>
            </div>     
            <div class="col-lg-1">
                <a href="{{ URL::previous() }}" class="btn btn-info btn-sm" title="Edit content"><i class="fa fa-arrow-left"></i> Previous</a>
            </div> 
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/') }}" class="btn btn-warning btn-sm" title="Edit content"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>    
            <div class="col-lg-1">
                <a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $content->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
            </div>
            <div class="col-lg-1">
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => [$fetchDataServiceController->routeCall().'/content', $content->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete User Role',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
            </div>
        @endif
    @endif
    
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ $content->id }}</th>
                                </tr>
                                <tr>
                                    <th>Category Name</th>
                                    <th class="text-capitalize">{{ $content->contentcategoryName }}</th>
                                </tr>  
                                <tr>
                                    <th>Title</th>
                                    <th class="text-capitalize">{{ $content->title }}</th>
                                </tr>  
                                <tr>
                                    <th>Description</th>
                                    <th class="text-capitalize">{{ strip_tags($content->description) }}</th>
                                </tr>      
                                <tr>
                                    <th>Status</th>
                                    <th class="text-capitalize">
                                        @if($content->status == '1')
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </th>
                                </tr>   
                            </thead>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover table-responsive">
                            <h2>SEO Content</h2>        
                            <thead>
                                <tr>
                                    <th> Page Title </th>
                                    <td> {{ $content->pagetitle }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {{ strip_tags($content->SEODescription) }} </td>
                                </tr>
                                <tr>
                                    <th> H1 Title </th>
                                    <td> {{ $content->h1title }} </td>
                                </tr>
                                <tr>
                                    <th> Meta Keyword </th>
                                    <td> {{ $content->keyword }}</td>
                                </tr>
                                 <tr>
                                    <th> H2 Title </th>
                                    <td> {{ $content->h2title }} </td>
                                </tr>
                                 <tr>
                                    <th> H3 Title </th>
                                    <td> {{ $content->h3title }} </td>
                                </tr>
                                 <tr>
                                    <th> Canonical </th>
                                    <td> {{ $content->canonical }} </td>
                                </tr>
                                 <tr>
                                    <th> Image 1 </th>
                                    <td> 
                                        @if($content->image1 != '')
                                            <img class="img-thumbnail img-responsive" src="{{ asset('seo-content') }}/{{ $content->slugurl }}/{{ $content->image1 }}" style="width: 160px; height: 160px; ">
                                        @else

                                            <img  class="img-responsive margin-top15"  id="uploadImage" src="/assets/img/testimonials2.jpg" alt="your image" style="width: 200px; height: 160px; "/>
                                        @endif
                                    </td>
                                </tr>
                                 <tr>
                                    <th> Image alt text 1 </th>
                                    <td> {{ $content->imagealttext1 }} </td>
                                </tr>
                                  <tr>
                                    <th> Image 2 </th>
                                    <td> 
                                        @if($content->image2 != '')
                                            <img class="img-thumbnail img-responsive" src="{{ asset('seo-content') }}/{{ $content->slugurl }}/{{ $content->image2 }}" style="width: 160px; height: 160px; ">
                                        @else

                                            <img  class="img-responsive margin-top15"  id="uploadImage" src="/assets/img/testimonials2.jpg" alt="your image" style="width: 200px; height: 160px; "/>
                                        @endif
                                    </td>
                                </tr>
                                 <tr>
                                    <th> Image alt text 2 </th>
                                    <td> {{ $content->imagealttext2 }} </td>
                                </tr>
                                <tr>
                                    <th> Content 1 </th>
                                    <td> {{ strip_tags($content->content1) }} </td>
                                </tr>
                                <tr>
                                    <th> Content 2 </th>
                                    <td> {{ strip_tags($content->content2) }} </td>
                                </tr>
                                <tr>
                                    <th> MISC </th>
                                    <td> {{ $content->misc }}</td>
                                </tr>
                                @if(!empty($content->productId))
                                 <tr>
                                    <th> Product Name</th>
                                    <td> <a href="{{ url($fetchDataServiceController->routeCall().'/product/' . $content->productsId) }}">{{ $content->productsName }} ({{ $content->productkey }}) ({{ $content->reference }})</a></td>
                                </tr>
                                @endif
                                @if(!empty($content->blogId))
                                <tr>
                                    <th> Blog Name</th>
                                    <td> <a href="{{ url($fetchDataServiceController->routeCall().'/blogs/' . $content->blogsId) }}">{{ $content->topic }}</a></td>
                                </tr>
                                @endif
                                @if(!empty($content->pageId))
                                <tr>
                                    <th> Page Name </th>
                                    <td> <a href="{{ url($fetchDataServiceController->routeCall().'/content/' . $content->contentsId) }}">{{ $content->contentcategoryName }}</a></td>
                                </tr>
                                @endif
                                @if(!empty($content->categoryId))
                                <tr>
                                    <th> Category Name </th>
                                    <td> <a href="{{ url($fetchDataServiceController->routeCall().'/category/' . $content->categoryId) }}">{{ $content->categoryName }}</a></td>
                                </tr>
                                @endif
                            </thead>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection