@extends('employee/admin-layouts.master')

@section('content')
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Gallery Details <a href="{{ url('employee/galleries/create') }}" class="btn btn-primary pull-right btn-sm">Add New Gallery</a></h2>
    </div>
</div> -->

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content">
               <!-- <a href="{{ url('employee/galleries') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> -->
               <table class="table table-bordered">
                    <tbody>
                    @foreach( $gallery as $gallery)
                        <tr>
                            <th>ID</th>
                            <td>{{ $gallery->id }}</td> 
                        </tr>
                        <tr>
                            <th>Last Updated By</th>
                            <td>
                                @if($gallery->eUserId)
                                <a href="{{ url('employee/users', $gallery->eUserId) }}">{{ $gallery->employeeFirstname }} {{ $gallery->employeeMiddlename}} {{ $gallery->employeeLastname}} (ID:- {{ $gallery->eUserId}}) Date & Time:-  {{ $gallery->updated_at}}</a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Caption</th>
                            <td>
                                @if( $gallery->caption)
                                    {{ $gallery->caption }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Width</th>
                            <td>
                                @if( $gallery->width)
                                    {{ $gallery->width }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Height</th>
                            <td>
                                @if( $gallery->height)
                                    {{ $gallery->height }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            @if($gallery->misc == 'affiliationLettersImage')
                                <th>Affiliation-Document</th>
                            @else
                                <th>Gallery Image</th>
                            @endif
                            <td>
                            @if( $gallery->misc != 'affiliationLettersImage' && $gallery->misc != 'videogallery') 
                                @if( $gallery->galleryName )
                                {{--*/ $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $gallery->firstname.' '.$gallery->userID); /*--}}
                                {{--*/ $slugUrl = strtolower($slugUrl); /*--}}
                                <img class="img-responsive thumbnail" src="/gallery/{{ $slugUrl }}/{{ $gallery->galleryName }}" width="120" alt="{{ $gallery->galleryName }}">
                                @else
                                    <label> Not Updated Yet</label>
                                @endif
                            @elseif( $gallery->misc != 'affiliationLettersImage' && $gallery->misc == 'videogallery')
                                @if($gallery->misc == 'videogallery')
                                <div class="embed-responsive embed-responsive-16by9">
                                    {{--*/ 
                                        $explodeYoutubeLink = explode('watch?v=', $gallery->galleryName);
                                    /*--}}
                                    <iframe width="560" height="315" src="http://www.youtube.com/embed/{{$explodeYoutubeLink[1]}}" frameborder="0" allowfullscreen></iframe>
                                </div>
                                @else
                                    <label> Not Updated Yet</label>
                                @endif
                            @elseif($gallery->misc == 'affiliationLettersImage' &&  $gallery->width != '' && $gallery->height != '0')
                                {{--*/ $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $gallery->firstname.' '.$gallery->userID); /*--}}
                                {{--*/ $slugUrl = strtolower($slugUrl); /*--}}
                                <img class="img-responsive thumbnail" src="/gallery/{{ $slugUrl }}/{{ $gallery->galleryName }}" width="120" alt="{{ $gallery->galleryName }}"> 
                            @else
                                @if( $gallery->galleryName )
                                    {{--*/ $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $gallery->firstname.' '.$gallery->userID); /*--}}
                                    {{--*/ $slugUrl = strtolower($slugUrl); /*--}}
                                    <a href="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $gallery->galleryName }}" alt="{{ $gallery->galleryName }}" download="Affiliation-Document">
                                        <img class="" src="{{asset('assets/images/pdf.png') }}" alt="{{ $gallery->galleryName }}" width="120"> 
                                    </a>
                                @else
                                    <label> Not Updated Yet</label>
                                @endif 
                            @endif
                            </td>
                        </tr>
                        
                        <tr>
                            <th>Category Name</th>
                            <td>
                                @if( $gallery->categoryName)
                                    {{ $gallery->categoryName }}
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>User Name</th>
                            <td>@if( $gallery->userID)
                                    <a href="{{ url('employee/users') }}/{{ $gallery->userID }}" title="{{ $gallery->firstname }} {{ $gallery->lastname }}">{{ $gallery->firstname }} {{ $gallery->lastname }} </a>
                                @else
                                    <span class="label label-warning">Not Updated Yet</span>
                                @endif
                            </td>
                        </tr>
                       
                        
                        @endforeach
                    </tbody>                        
                </table>
            </div>
        </div>
    </div>
</div>

@endsection