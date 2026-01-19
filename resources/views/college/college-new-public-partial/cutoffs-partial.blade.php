<div class="school-info section">
    <div class="section-title">
        <h3>College Cut Offs</h3>
    </div>
    <div class="section-content">
        @if( sizeof($collegeCutOffsObj) > 0 )
            @foreach( $collegeCutOffsObj as $item )
                <div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 rating_reviews_info">
                    <div class="col-md-12">
                        <div class=" padding-top10  padding-left10 padding-right10">
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa  fa-list"></i> Title : 
                                @if($item->title)
                                    {{ $item->title }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Stream : 
                                @if($item->functionalareaName)
                                    {{ $item->functionalareaName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa  fa-graduation-cap"></i> Degree : 
                                @if($item->degreeName)
                                    {{ $item->degreeName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa fa-list"></i> Degree Level : 
                                @if($item->educationlevelName)
                                    {{ $item->educationlevelName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course Type : 
                                @if($item->coursetypeName)
                                    {{ $item->coursetypeName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div class="">
                                <label class="font-noraml"><i class="fa-fw fa fa-book"></i> Course : 
                                @if($item->courseName)
                                    {{ $item->courseName }}
                                @else
                                    <span class="label label-warning">Not updated yet</span>
                                @endif
                                </label>
                            </div>
                            <div>
                                <label class="font-noraml"><i class="fa-fw fa fa-sticky-note"></i> Cut Offs Details : </label>
                                <br>
                                @if($item->description)
                                    <span class="minimize2">{!! $item->description !!}</span>
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
                    <h4>College hasn't added their cut offs.</h4>
                </div>
            </div>
        @endif
    </div>
</div>