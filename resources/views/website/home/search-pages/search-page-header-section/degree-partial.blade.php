<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">       
                <div><span><a class="text-dark" href="{{ URL::to('/') }}">Home </a> > <a class="text-dark" href="{{ URL::to('/'.$checkDegreeObj[0]->functionalareapageslug.'/colleges') }}"> {{$checkDegreeObj[0]->functionalareaName }}  </a> ><a class="text-dark" href="{{ URL::to('/stream/'.$checkDegreeObj[0]->functionalareapageslug.'/'.$checkDegreeObj[0]->pageslug.'/courses') }}"> {{$checkDegreeObj[0]->name }}  </a></span></div>
            </div>
        </div>
    </div>
</div>        
<div class="featured-school-single">
    <div class="container">
        <div class="header-section"></div>
        <div class="header-bg-section">
            @if( $checkDegreeObj[0]->bannerimage != '' )
                <img src="{{ asset('/common-banner') }}/{{ $checkDegreeObj[0]->bannerimage }}" alt="{{$checkDegreeObj[0]->name}} logo" style="max-width: 100%;">
            @else
                <img src="/new-assets/img/banner3.jpg" alt="{{$checkDegreeObj[0]->name}} logo" style="max-width: 100%;">
            @endif
        </div>
        <div class="header-wrapper d-flex">
            <div class="listing-logo">
                @if( $checkDegreeObj[0]->logoimage != '' )
                    <img src="{{ asset('common-logo') }}/{{ $checkDegreeObj[0]->logoimage }}" alt="{{$checkDegreeObj[0]->name}} logo">
                @else
                    <img src="/new-assets/img/elearning.png" alt="{{$checkDegreeObj[0]->name}} logo">
                @endif
            </div>
            <div class="listing-content">
                <a href="#">
                    <h3>{{$checkDegreeObj[0]->name}}, {{$checkDegreeObj[0]->functionalareaName }}</h3>
                </a>
            </div>
        </div>
        @if(!empty($checkDegreeObj[0]->pagedescription))
        <div class="school-info section">
            <div class="section-title">
                <h3>About {{$checkDegreeObj[0]->name}}</h3>
            </div>
            <div class="section-content">
                <p>{{ $checkDegreeObj[0]->pagetitle }}</p>
                <p>{!! $checkDegreeObj[0]->pagedescription !!}</p>
            </div>
        </div>
        @endif
    </div>  
</div>
<div class="page-header">
    <div class="container">
        <div class="col-md-12">
            <div class="row justify-content-between">
                <h1>List of ({{$checkDegreeObj[0]->name}}) Colleges</h1>
            </div>
        </div>
    </div>
</div>