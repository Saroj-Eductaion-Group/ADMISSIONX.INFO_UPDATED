@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
{{--*/ $validateUserRoleCallSeoContent = $fetchDataServiceController->validateUserRoleCall('SeoContent'); /*--}}
<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    @if(Auth::check())
                        @if(Auth::user()->userrole_id == 4)
                            @if((isset($validateUserRoleCallSeoContent)) && (sizeof($validateUserRoleCallSeoContent) > 0) && ($validateUserRoleCallSeoContent[0]->edit == '1'))
                                <div class="col-lg-12">
                                    <h2>Manage Seo Content <a href="{{ url('/administrator/seo-content/' . $seocontent->id . '/edit') }}" class="btn btn-primary btn-sm pull-right" title="Edit"><i class="fa fa-pencil"></i> Edit</a></h2>
                                </div>
                            @endif
                        @else
                            @if( Auth::user()->userrole_id == '1' )
                            <div class="col-lg-12">
                                <h2>Manage Seo Content <a href="{{ url('/administrator/seo-content/' . $seocontent->id . '/edit') }}" class="btn btn-primary btn-sm pull-right" title="Edit"><i class="fa fa-pencil"></i> Edit</a></h2>
                            </div>
                            @endif
                        @endif
                    @endif

                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>{{ $seocontent->id }}</th>
                                </tr>
                                <tr>
                                    <th> Page Title </th>
                                    <td> {{ $seocontent->pagetitle }} </td>
                                </tr>
                                <tr>
                                    <th> Description </th>
                                    <td> {{ strip_tags($seocontent->SEODescription) }} </td>
                                </tr>
                                <tr>
                                    <th> H1 Title </th>
                                    <td> {{ $seocontent->h1title }} </td>
                                </tr>
                                <tr>
                                    <th> Meta Keyword </th>
                                    <td> {{ $seocontent->keyword }}</td>
                                </tr>
                                 <tr>
                                    <th> H2 Title </th>
                                    <td> {{ $seocontent->h2title }} </td>
                                </tr>
                                 <tr>
                                    <th> H3 Title </th>
                                    <td> {{ $seocontent->h3title }} </td>
                                </tr>
                                 <tr>
                                    <th> Canonical </th>
                                    <td> {{ $seocontent->canonical }} </td>
                                </tr>
                                 <tr>
                                    <th> SEO Image </th>
                                    <td> 
                                        @if($seocontent->image != '')
                                            <img class="img-thumbnail img-responsive" src="{{ asset('seo-content') }}/{{ $seocontent->image }}" style="width: 160px; height: 160px; ">
                                        @else

                                            <img  class="img-responsive margin-top15"  id="uploadImage" src="/assets/images/no-college-logo.jpg" alt="your image" style="width: 200px; height: 160px; "/>
                                        @endif
                                    </td>
                                </tr>
                                 <tr>
                                    <th> SEO Image alt text</th>
                                    <td> {{ $seocontent->imagealttext }} </td>
                                </tr>
                                <tr>
                                    <th> SEO Image Description </th>
                                    <td> {{ strip_tags($seocontent->content) }} </td>
                                </tr>
                                <tr>
                                    <th> MISC </th>
                                    <td> {{ $seocontent->misc }}</td>
                                </tr>
                                @if(Auth::check())
                                    @if( Auth::user()->userrole_id == '1' )
                                    <tr>
                                        <th>Last Updated By</th>
                                        <td>
                                            @if($seocontent->eUserId)
                                            <a @if(Auth::check() && Auth::user()->userrole_id == 4) href="javascript:void(0);" @else href="{{ url($fetchDataServiceController->routeCall().'/users', $seocontent->eUserId) }}" @endif>{{ $seocontent->employeeFirstname }} {{ $seocontent->employeeMiddlename}} {{ $seocontent->employeeLastname}} (ID:- {{ $seocontent->eUserId}}) <hr> Date & Time:- {{ $seocontent->updated_at}}</a>
                                            @else
                                                <span class="label label-warning">Not Updated Yet</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endif
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>