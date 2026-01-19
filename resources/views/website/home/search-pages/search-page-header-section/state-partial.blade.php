<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('study-abroad') }}"> Study Abroad </a> > <a class="text-dark" href="{{ URL::to('/'.$getStateDetailInfoObj->countrySlug.'/college-list') }}"> {{$getStateDetailInfoObj->countryName}} </a> > <a class="text-dark" href="javascript:void(0);">{{$getStateDetailInfoObj->name}}</a></span></div>
            </div>
        </div>
    </div>
</div>        
<div class="featured-school-single">
    <div class="container">
        <div class="header-section"></div>
        <div class="header-bg-section">
            @if( $getStateDetailInfoObj->bannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $getStateDetailInfoObj->bannerimage }}" alt="{{$getStateDetailInfoObj->name}} logo" style="max-width: 100%;">
            @elseif( $getStateDetailInfoObj->countryBannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $getStateDetailInfoObj->countryBannerimage }}" alt="{{$getStateDetailInfoObj->name}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/banner4.jpg" alt="{{$getStateDetailInfoObj->name}} logo" style="max-width: 100%;">
            @endif
        </div>
        <div class="header-wrapper d-flex">
            <div class="listing-logo">
                @if( $getStateDetailInfoObj->logoimage != '' )
                    <img src="{{ asset('common-logo') }}/{{ $getStateDetailInfoObj->logoimage }}" alt="{{$getStateDetailInfoObj->name}} logo">
                @else
                    <img src="/new-assets/img/scholarship.png" alt="{{$getStateDetailInfoObj->name}} logo">
                @endif
            </div>
            <div class="listing-content">
                <a href="#">
                    <h3>{{$getStateDetailInfoObj->name}}, {{$getStateDetailInfoObj->countryName}}</h3>
                </a>
            </div>
        </div>
        @if(!empty($getStateDetailInfoObj->pagedescription))
        <div class="school-info section">
            <div class="section-title">
                <h3>About {{$getStateDetailInfoObj->name}}, {{$getStateDetailInfoObj->countryName}}</h3>
            </div>
            <div class="section-content">
                <p>{{ $getStateDetailInfoObj->pagetitle }}</p>
                <p>{!! $getStateDetailInfoObj->pagedescription !!}</p>
            </div>
        </div>
        @endif
    </div>  
</div>
<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <h1>List of ({{$getStateDetailInfoObj->name}}) Colleges</h1>
            </div>
        </div>
    </div>
</div>