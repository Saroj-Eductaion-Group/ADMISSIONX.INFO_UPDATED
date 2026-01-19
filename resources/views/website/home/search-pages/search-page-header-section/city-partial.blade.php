<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('study-abroad') }}"> Study Abroad </a> > <a class="text-dark" href="{{ URL::to('/'.$getCityDetailInfoObj->countrySlug.'/college-list') }}"> {{$getCityDetailInfoObj->countryName}} </a> > <a class="text-dark" href="{{ URL::to('/'.$getCityDetailInfoObj->stateSlug.'/'.$getCityDetailInfoObj->countrySlug.'/college-list') }}"> {{$getCityDetailInfoObj->stateName}} </a> > <a class="text-dark" href="javascript:void(0);">{{$getCityDetailInfoObj->name}}</a></span></div>
            </div>
        </div>
    </div>
</div>        
<div class="featured-school-single">
    <div class="container">
        <div class="header-section"></div>
        <div class="header-bg-section">
            @if( $getCityDetailInfoObj->bannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $getCityDetailInfoObj->bannerimage }}" alt="{{$getCityDetailInfoObj->name}} logo" style="max-width: 100%;">
            @elseif( $getCityDetailInfoObj->stateBannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $getCityDetailInfoObj->stateBannerimage }}" alt="{{$getCityDetailInfoObj->name}} logo" style="max-width: 100%;">
            @elseif( $getCityDetailInfoObj->countryBannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $getCityDetailInfoObj->countryBannerimage }}" alt="{{$getCityDetailInfoObj->name}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/banner4.jpg" alt="{{$getCityDetailInfoObj->name}} logo" style="max-width: 100%;">
            @endif
        </div>
        <div class="header-wrapper d-flex">
            <div class="listing-logo">
                @if( $getCityDetailInfoObj->logoimage != '' )
                    <img src="{{ asset('common-logo') }}/{{ $getCityDetailInfoObj->logoimage }}" alt="{{$getCityDetailInfoObj->name}} logo">
                @else
                    <img src="/new-assets/img/scholarship.png" alt="{{$getCityDetailInfoObj->name}} logo">
                @endif
            </div>
            <div class="listing-content">
                <a href="#">
                    <h3>{{$getCityDetailInfoObj->name}}, {{$getCityDetailInfoObj->stateName}}, {{$getCityDetailInfoObj->countryName}}</h3>
                </a>
            </div>
        </div>
        @if(!empty($getCityDetailInfoObj->pagedescription))
        <div class="school-info section">
            <div class="section-title">
                <h3>About {{$getCityDetailInfoObj->name}}, {{$getCityDetailInfoObj->stateName}}, {{$getCityDetailInfoObj->countryName}}</h3>
            </div>
            <div class="section-content">
                <p>{{ $getCityDetailInfoObj->pagetitle }}</p>
                <p>{!! $getCityDetailInfoObj->pagedescription !!}</p>
            </div>
        </div>
        @endif
    </div>  
</div>
<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <h1>List of ({{$getCityDetailInfoObj->name}}) Colleges</h1>
            </div>
        </div>
    </div>
</div>