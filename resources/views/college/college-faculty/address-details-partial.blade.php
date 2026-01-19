<hr>
<div class="col-md-12">
    <div class="white-bg">
        <div id="collapseAddressDetails{{$item->id}}" class="panel-collapse collapse" aria-expanded="flase" style="">
            <div class="panel-body">
                <h4 class=""><strong>Address Details</strong></h4>
                <div class="ibox-content table-responsive">
                    <div class="rating_reviews_info padding-top20 padding-bottom20 padding-left20 padding-right20">
                        <div class="row margin-top10">
                            <div class="col-md-6">
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Address Line 1 : 
                                    @if($item->addressline1)
                                        {{ $item->addressline1 }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Address Line 2 : 
                                    @if($item->addressline2)
                                        {{ $item->addressline2 }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Landmark : 
                                    @if($item->landmark)
                                        {{ $item->landmark }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> City : 
                                    @if($item->cityName)
                                        {{ $item->cityName }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> State : 
                                    @if($item->stateName)
                                        {{ $item->stateName }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Country : 
                                    @if($item->countryName)
                                        {{ $item->countryName }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                                <div>
                                    <label class="font-noraml"><i class="fa-fw fa fa-map-marker"></i> Pincode : 
                                    @if($item->pincode)
                                        {{ $item->pincode }}
                                    @else
                                        <span class="label label-warning">Not updated yet</span>
                                    @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>