<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('top-university') }}"> University</a> > {{$getUniversityDetailInfoObj->name}}</span></div>
            </div>
        </div>
    </div>
</div>  

<div class="featured-school-single">
    <div class="container">
        <div class="header-section"></div>
        <div class="header-bg-section">
            @if( $getUniversityDetailInfoObj->bannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $getUniversityDetailInfoObj->bannerimage }}" alt="{{$getUniversityDetailInfoObj->name}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/schools-in-dehradun-ecole.jpg" alt="{{$getUniversityDetailInfoObj->name}} logo" style="max-width: 100%;">
            @endif
        </div>
        <div class="header-wrapper d-flex">
            <div class="listing-logo">
                @if( $getUniversityDetailInfoObj->logoimage != '' )
                    <img src="{{ asset('common-logo') }}/{{ $getUniversityDetailInfoObj->logoimage }}" alt="{{$getUniversityDetailInfoObj->name}} logo">
                @else
                    <img src="/new-assets/img/university.png" alt="{{$getUniversityDetailInfoObj->name}} logo">
                @endif
            </div>
            <div class="listing-content">
                <a href="#">
                    <h3>{{$getUniversityDetailInfoObj->name}}</h3>
                </a>
            </div>
        </div>
        @if(!empty($getUniversityDetailInfoObj->pagedescription))
        <div class="school-info section">
            <div class="section-title">
                <h3>About {{$getUniversityDetailInfoObj->name}}</h3>
            </div>
            <div class="section-content">
                <p>{{ $getUniversityDetailInfoObj->pagetitle }}</p>
                <p>{!! $getUniversityDetailInfoObj->pagedescription !!}</p>
            </div>
        </div>
        @endif
    </div>  
</div>
<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <h1>List of ({{$getUniversityDetailInfoObj->name}}) Colleges </h1>
            </div>
        </div>
    </div>
</div>