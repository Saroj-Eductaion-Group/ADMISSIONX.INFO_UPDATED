<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('/'.$checkCoursesObj[0]->functionalareapageslug.'/colleges') }}"> {{$checkCoursesObj[0]->functionalareaName }}  </a> ><a class="text-dark" href="{{ URL::to('/'.$checkCoursesObj[0]->functionalareapageslug.'/'.$checkCoursesObj[0]->degreepageslug.'/colleges') }}"> {{$checkCoursesObj[0]->degreeName }}  </a> > <a class="text-dark" href="{{ URL::to('/stream/'.$checkCoursesObj[0]->functionalareapageslug.'/'.$checkCoursesObj[0]->degreepageslug.'/courses') }}"> {{$checkCoursesObj[0]->name }} </a></span></div>
            </div>
        </div>
    </div>
</div>        
<div class="featured-school-single">
    <div class="container">
        <div class="header-section"></div>
        <div class="header-bg-section">
            @if( $checkCoursesObj[0]->bannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $checkCoursesObj[0]->bannerimage }}" alt="{{$checkCoursesObj[0]->name}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/banner1.jpg" alt="{{$checkCoursesObj[0]->name}} logo" style="max-width: 100%;">
            @endif
        </div>
        <div class="header-wrapper d-flex">
            <div class="listing-logo">
                @if( $checkCoursesObj[0]->logoimage != '' )
                    <img src="{{ asset('common-logo') }}/{{ $checkCoursesObj[0]->logoimage }}" alt="{{$checkCoursesObj[0]->name}} logo">
                @else
                    <img src="/new-assets/img/campus.png" alt="{{$checkCoursesObj[0]->name}} logo">
                @endif
            </div>
            <div class="listing-content">
                <a href="#">
                    <h3>{{$checkCoursesObj[0]->name}}, {{$checkCoursesObj[0]->degreeName }}, {{$checkCoursesObj[0]->functionalareaName }}</h3>
                </a>
            </div>
        </div>
        @if(!empty($checkCoursesObj[0]->pagedescription))
        <div class="school-info section">
            <div class="section-title">
                <h3>About {{$checkCoursesObj[0]->name}}</h3>
            </div>
            <div class="section-content">
                <p>{{ $checkCoursesObj[0]->pagetitle }}</p>
                <p>{!! $checkCoursesObj[0]->pagedescription !!}</p>
            </div>
        </div>
        @endif
    </div>  
</div>
<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <h1>List of ({{$checkCoursesObj[0]->name}}) Colleges</h1>
            </div>
        </div>
    </div>
</div>