<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
    <div class="detail-page-signup">
        <div class="row">
            <div class="col-md-12">
                <div class="headline"><h2>Highest & Average Average</h2></div>
                <img src="{{ asset('assets/images/single-line-graphs.png')}}" class="img-responsive" style="max-height: 300px;width: 100%">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="headline"><h4 class="h4">College Placement Information</h4></div>
            </div>
        </div>
        @foreach($collegePlacementDataObj as  $collegeData)
            @if(!empty($collegeData->placementinfo))
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-4">
                        <h5>Placement Information :</h5>
                    </div>
                    <div class="col-md-8">
                        <h5 class="text-capitalize">{{ $collegeData->placementinfo }}</h5>
                    </div>
                </div>
            @endif
            @if(!empty($collegeData->numberofrecruitingcompany))
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-4">
                        <h5>Number Of Recruiting Companies :</h5>
                    </div>
                    <div class="col-md-8">
                        <h5>{{ $collegeData->numberofrecruitingcompany }}</h5>
                    </div>
                </div>
            @endif
            @if(!empty($collegeData->ctchighest))
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-4">
                        <h5>CTC Highest :</h5>
                    </div>
                    <div class="col-md-8">
                        <h5>{{ $collegeData->ctchighest }}</h5>
                    </div>
                </div>
            @endif
            @if(!empty($collegeData->ctcaverage))
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-4">
                        <h5>CTC Average :</h5>
                    </div>
                    <div class="col-md-8">
                        <h5>{{ $collegeData->ctcaverage }}</h5>
                    </div>
                </div>
            @endif
            @if(!empty($collegeData->ctclowest))
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-4">
                        <h5>CTC Lowest :</h5>
                    </div>
                    <div class="col-md-8">
                        <h5>{{ $collegeData->ctclowest }}</h5>
                    </div>
                </div>
            @endif
        @endforeach

        <div class="row">
            <div class="col-md-12">
                <div class="headline"><h4 class="h4">Frequently Visited Companies</h4></div>
            </div>
        </div>

        <div class="row parent-container-images">
            @for($counter = 0; $counter <=19; $counter++)
                <div class="col-md-3">
                    <a href="https://picsum.photos/800/600?random={{ $counter }}"><img class="img-responsive img-thumbnail" src="https://picsum.photos/180/180?random={{ $counter }}"></a>
                    
                </div>
            @endfor
        </div>
    </div>
</div>

<script type="text/javascript">
    var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 300) return;
        
        $(this).html(
            t.slice(0,300)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(300,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
    $('.parent-container-images').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            // options for gallery
            enabled: true
        },
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it
            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
</script>