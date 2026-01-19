<div class="school-info section">
    <div class="section-title">
        <h3>College Placement Records</h3>
    </div>
    <div class="section-content">
        @if( sizeof($collegePlacementDataObj) > 0 )
            @foreach( $collegePlacementDataObj as $item )
                <div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 rating_reviews_info">
                    <div class="col-md-12">
                        <div class=" padding-top10 padding-left10 padding-right10">
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa  fa-list"></i> Number Of Recruiting Companies : 
                                @if($item->numberofrecruitingcompany )
                                    {{ $item->numberofrecruitingcompany }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa  fa-calendar"></i> Number Of Placements & Year : 
                                @if($item->numberofplacementlastyear)
                                    {{ $item->numberofplacementlastyear }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa  fa-money"></i> CTC Highest : 
                                @if($item->ctchighest)
                                    {{ $item->ctchighest }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa  fa-money"></i> CTC Lowest : 
                                @if($item->ctclowest)
                                    {{ $item->ctclowest }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa  fa-money"></i> CTC Average : 
                                @if($item->ctcaverage)
                                    {{ $item->ctcaverage }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class=" padding-top10 padding-left10 padding-right10">
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa  fa-calendar-o"></i> Placement Information : </label>
                                <br>
                                @if($item->placementinfo)
                                    <span class="minimize2">{!! $item->placementinfo !!}</span>
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-12">
                <div class="headline text-center">
                    <h4>College hasn't added their placement records.</h4>
                </div>
            </div>
        @endif
    </div>
</div>