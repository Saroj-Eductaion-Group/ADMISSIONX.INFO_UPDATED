@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
{{--*/ $validateUserRoleCall = $fetchDataServiceController->validateUserRoleCall('News'); /*--}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>News Details 
        @if(Auth::check())
            @if(Auth::user()->userrole_id == 4)
                @if((isset($validateUserRoleCall)) && (sizeof($validateUserRoleCall) > 0) && ($validateUserRoleCall[0]->create == '1'))
                <a href="{{ url($fetchDataServiceController->routeCall().'/news/create') }}" class="btn btn-primary pull-right btn-sm">Add New News</a>
                @endif
            @else
                <a href="{{ url($fetchDataServiceController->routeCall().'/news/create') }}" class="btn btn-primary pull-right btn-sm">Add New News</a>
            @endif
        @endif  
        </h2>
    </div>
</div>
<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <a href="{{ url($fetchDataServiceController->routeCall().'/news') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
               <table class="table table-bordered">
                    <tbody class="tbody">
                        <tr>
                            <th>ID</th>
                            <td>{{ $news->id }}</td> 
                        </tr>
                        <tr>
                            <th>Topic</th>
                            <td>{{ $news->topic }} </td>
                        </tr>
                        <tr>
                            <th>News Featured Image</th>
                            <td> @if( $news->featimage )
                                {{--*/ $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $news->firstname.' '.$news->users_id); /*--}}
                                {{--*/ $slugUrl = strtolower($slugUrl); /*--}}
                                <img class="img-responsive thumbnail" src="/news-image/{{ $news->featimage }}" width="320" alt="{{ $news->featimage }}">
                                @else
                                    <img class="img-responsive thumbnail" src="{{ asset('blogs/default.jpg') }}" width="120" alt="">
                                @endif 
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{!! $news->description !!}</td>
                        </tr>
                        <tr>
                            <th>Publish or Not</th>
                            <td>
                                @if( $news->isactive == '1' )
                                    <span class="label label-success">Published</span>
                                @else
                                    <span class="label label-danger">Not Published</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>News Type</th>
                            <td>@if($news->news_typesname){{ $news->news_typesname }} @else -- @endif</td>
                        </tr>
                        <tr>
                            <th>News Tags</th>
                            <td>
                                @if($news->newstagsids) 
                                    @foreach( $tags as $key1 => $item1 )
                                        <span class="badge badge-info">{{ $item1->name }} </span>
                                    @endforeach
                                @else 
                                    <span class="badge badge-warning">Not Updated yet</span>
                                @endif 
                            </td>
                        </tr>
                        <tr>
                            <th>Author Name</th>
                            <td><a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users' , $news->userID) }}" @endif>{{ $news->firstname }} {{ $news->lastname }}</a></td>
                        </tr>
                    </tbody>                        
                </table>
            </div>
        </div>
        @if(isset($seocontent) && !empty($seocontent))
            @include ('administrator.seo-content.seo-show-partial')
        @endif
    </div>
</div>
@endsection

@section('script')

@endsection