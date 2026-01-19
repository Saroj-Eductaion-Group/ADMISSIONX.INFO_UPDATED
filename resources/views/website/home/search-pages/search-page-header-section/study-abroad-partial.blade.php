<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('study-abroad') }}"> Study Abroad </a> > {{$getCountryDetailInfoObj->name}}</span></div>
            </div>
        </div>
    </div>
</div>        
<div class="featured-school-single">
    <div class="container">
        <div class="header-section"></div>
        <div class="header-bg-section">
            @if( $getCountryDetailInfoObj->bannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $getCountryDetailInfoObj->bannerimage }}" alt="{{$getCountryDetailInfoObj->name}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/schools-in-dehradun-ecole.jpg" alt="{{$getCountryDetailInfoObj->name}} logo" style="max-width: 100%;">
            @endif
        </div>
        <div class="header-wrapper d-flex">
            <div class="listing-logo">
                @if( $getCountryDetailInfoObj->logoimage != '' )
                    <img src="{{ asset('common-logo') }}/{{ $getCountryDetailInfoObj->logoimage }}" alt="{{$getCountryDetailInfoObj->name}} logo">
                @else
                    <img src="/new-assets/img/university.png" alt="{{$getCountryDetailInfoObj->name}} logo">
                @endif
            </div>
            <div class="listing-content">
                <a href="#">
                    <h3>{{$getCountryDetailInfoObj->name}}</h3>
                </a>
            </div>
        </div>
        @if(!empty($getCountryDetailInfoObj->pagedescription))
        <div class="school-info section">
            <div class="section-title">
                <h3>About {{$getCountryDetailInfoObj->name}}</h3>
            </div>
            <div class="section-content">
                <p>{{ $getCountryDetailInfoObj->pagetitle }}</p>
                <p>{!! $getCountryDetailInfoObj->pagedescription !!}</p>
            </div>
        </div>
        @endif
    </div>  
</div>
<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <h1>List of College in ({{$getCountryDetailInfoObj->name}})</h1>
            </div>
        </div>
    </div>
</div>