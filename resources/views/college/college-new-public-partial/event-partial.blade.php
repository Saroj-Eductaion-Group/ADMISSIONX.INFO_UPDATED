<div class="school-info section">
    <div class="section-title">
        <h3>College Events</h3>
    </div>
    <div class="section-content">
        @if( sizeof($getCollegeEvents) > 0 )
            @foreach( $getCollegeEvents as $item )
                <div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 rating_reviews_info">
                    <div class="col-md-8">
                        <div class=" padding-top10 padding-left10 padding-right10">
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa  fa-calendar-o"></i> Event Name : </label>
                                @if($item->name)
                                    {{ $item->name }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                
                            </div>
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa  fa-calendar"></i> Event Date : </label>
                                @if( $item->datetime )
                                    {{ date('d F Y h:i a', strtotime($item->datetime)) }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa  fa-map-marker"></i> Event Venue :</label> 
                                @if($item->venue)
                                    {{ $item->venue }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="padding-bottom10 padding-left10 padding-right10">
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa fa-link"></i> Event URL : </label>
                                @if($item->link)
                                    {{ $item->link }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                
                            </div>
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa fa-sticky-note"></i> Description :</label> 
                                @if( $item->description )
                                <span class="minimize2">{{ $item->description }}</span></p>
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
                    <h4>College hasn't added their events.</h4>
                </div>
            </div>
        @endif
    </div>
</div>