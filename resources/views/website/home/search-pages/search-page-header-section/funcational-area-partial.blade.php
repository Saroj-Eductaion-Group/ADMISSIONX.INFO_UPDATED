<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('top-courses') }}"> Stream </a> > <a class="text-dark" href="{{ URL::to('/stream') }}">{{$checkFuncationalArea[0]->name}}</a></span></div>
            </div>
        </div>
    </div>
</div>        
<div class="featured-school-single">
    <div class="container">
        <div class="header-section"></div>
        <div class="header-bg-section">
            @if( $checkFuncationalArea[0]->bannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $checkFuncationalArea[0]->bannerimage }}" alt="{{$checkFuncationalArea[0]->name}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/banner4.jpg" alt="{{$checkFuncationalArea[0]->name}} logo" style="max-width: 100%;">
            @endif
        </div>
        <div class="header-wrapper d-flex">
            <div class="listing-logo">
                @if( $checkFuncationalArea[0]->logoimage != '' )
                    <img src="{{ asset('common-logo') }}/{{ $checkFuncationalArea[0]->logoimage }}" alt="{{$checkFuncationalArea[0]->name}} logo">
                @else
                    <img src="/new-assets/img/scholarship.png" alt="{{$checkFuncationalArea[0]->name}} logo">
                @endif
            </div>
            <div class="listing-content">
                <a href="#">
                    <h3>{{$checkFuncationalArea[0]->name}}</h3>
                </a>
            </div>
        </div>
        @if(!empty($checkFuncationalArea[0]->pagedescription))
        <div class="school-info section">
            <div class="section-title">
                <h3>About {{$checkFuncationalArea[0]->name}}</h3>
            </div>
            <div class="section-content">
                <p>{{ $checkFuncationalArea[0]->pagetitle }}</p>
                <p>{!! $checkFuncationalArea[0]->pagedescription !!}</p>
            </div>
        </div>
        @endif
    </div>  
</div>
<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <h1>List of ({{$checkFuncationalArea[0]->name}}) Colleges</h1>
            </div>
        </div>
    </div>
</div>