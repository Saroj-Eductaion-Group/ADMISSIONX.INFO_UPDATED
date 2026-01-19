<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('top-courses') }}"> Education Level </a> > {{$checkEducationLevel[0]->name}}</span></div>
            </div>
        </div>
    </div>
</div>        
<div class="featured-school-single">
    <div class="container">
        <div class="header-section"></div>
        <div class="header-bg-section">
            @if( $checkEducationLevel[0]->bannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $checkEducationLevel[0]->bannerimage }}" alt="{{$checkEducationLevel[0]->name}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/banner1.jpg" alt="{{$checkEducationLevel[0]->name}} logo" style="max-width: 100%;">
            @endif
        </div>
        <div class="header-wrapper d-flex">
            <div class="listing-logo">
                @if( $checkEducationLevel[0]->logoimage != '' )
                    <img src="{{ asset('common-logo') }}/{{ $checkEducationLevel[0]->logoimage }}" alt="{{$checkEducationLevel[0]->name}} logo">
                @else
                    <img src="/new-assets/img/graduation-cap.png" alt="{{$checkEducationLevel[0]->name}} logo">
                @endif
            </div>
            <div class="listing-content">
                <a href="#">
                    <h3>{{$checkEducationLevel[0]->name}}</h3>
                </a>
            </div>
        </div>
        @if(!empty($checkEducationLevel[0]->pagedescription))
        <div class="school-info section">
            <div class="section-title">
                <h3>About {{$checkEducationLevel[0]->name}}</h3>
            </div>
            <div class="section-content">
                <p>{{ $checkEducationLevel[0]->pagetitle }}</p>
                <p>{!! $checkEducationLevel[0]->pagedescription !!}</p>
            </div>
        </div>
        @endif
    </div>  
</div>
<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <h1>List of ({{$checkEducationLevel[0]->name}}) Colleges</h1>
            </div>
        </div>
    </div>
</div>