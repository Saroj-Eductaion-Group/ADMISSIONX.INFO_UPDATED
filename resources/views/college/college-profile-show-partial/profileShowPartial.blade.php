<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="detail-page-signup">
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-8">
                <div class="headline"><h2>About Us</h2></div>
            </div>
            <div class="col-md-4">
                <h5 class="text-right">Updated On - {{ date('F d, Y', strtotime($collegeProfileDataObj[0]->updated_at)) }}</h5>
            </div>  
        </div>
        @if( $collegeProfileDataObj )
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-12">  
                @foreach(  $collegeProfileDataObj as  $collegeData )
                    @if($collegeData->description)
                        <h5 style="text-align: justify;">{{ $collegeData->description }}</h5>                         
                    @endif
                @endforeach
            </div>
        </div>
        @endif
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-12">
                <div class="headline"><h4 class="h4">College Highlights</h4></div>
            </div>
        </div>

        @if( $collegeProfileDataObj )
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-4">
                <h5>Established Year : </h5>
            </div>
            <div class="col-md-8">
                @foreach(  $collegeProfileDataObj as  $collegeData )
                    @if($collegeData->estyear)
                        <h5>{{ $collegeData->estyear }}</h5>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        @if( $collegeProfileDataObj )
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-4">	        	
                <h5>College Type : </h5>
            </div>
            <div class="col-md-8">
				@foreach(  $collegeProfileDataObj as  $collegeData )
	                @if($collegeData->collegetypeName)
						<h5>{{ $collegeData->collegetypeName }}</h5>
					@endif
				@endforeach
			</div>	
		</div>
        @endif

        @if( $collegeProfileDataObj )
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-4">
                <h5>University : </h5>
            </div>
            <div class="col-md-8">
                @foreach(  $collegeProfileDataObj as  $collegeData )
                    @if($collegeData->universityName)
                        <h5>{{ $collegeData->universityName }}</h5>
                    @endif
                @endforeach
            </div>  
        </div>
        @endif

        @if( $collegeProfileDataObj )
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-4">
                <h5>Approved By : </h5>
            </div>
            <div class="col-md-8">
				@foreach(  $collegeProfileDataObj as  $collegeData )
	                @if($collegeData->approvedBy)
						<h5>{{ $collegeData->approvedBy }}</h5>
					@endif
				@endforeach
			</div>	
		</div>
        @endif

        @if( $collegeProfileDataObj )
        <div class="row padding-top5 padding-bottom5">
	        <div class="col-md-4">
                <h5>College Code : </h5>
            </div>
            <div class="col-md-8">
				@foreach(  $collegeProfileDataObj as  $collegeData )
					@if($collegeData->collegecode)
						<h5>{{ $collegeData->collegecode }}</h5>
					@endif
				@endforeach
	        </div>
	    </div>
        @endif

        @if( $collegeProfileDataObj )
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-4">
                <h5>Contact Person / Administrator Officer Name : </h5>
            </div>
            <div class="col-md-8">
                @foreach(  $collegeProfileDataObj as  $collegeData )
                    @if($collegeData->contactpersonname)
                        <h5>{{ $collegeData->contactpersonname }}</h5>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        @if( $collegeProfileDataObj )
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-4">
                <h5>Contact Person / Administrator Officer Email : </h5>
            </div>
            <div class="col-md-8">
                @foreach(  $collegeProfileDataObj as  $collegeData )
                    @if($collegeData->contactpersonemail)
                        <h5>{{ $collegeData->contactpersonemail }}</h5>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        @if( $collegeProfileDataObj )
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-4">
                <h5>Contact Person / Administrator Officer Phone : </h5>
            </div>
            <div class="col-md-8">
                @foreach(  $collegeProfileDataObj as  $collegeData )
                    @if($collegeData->contactpersonnumber)
                        <h5>{{ $collegeData->contactpersonnumber }}</h5>
                    @endif
                @endforeach
            </div>
        </div>
        @endif
	</div>

	<div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="headline"><h4 class="h4">College Address </h4></div>
            </div>
        </div>

        @foreach( $getRegisteredCollegeAddress as $getRegistered )
            <div class="row">
                <div class="col-md-4">
                    <h5>Registered College Address : </h5>
                </div>
                <div class="col-md-8">
                    <h5>
                        <span class="font-bold">{{ $getRegistered->name }}</span><br> 
                        {{ $getRegistered->address1 }}, {{ $getRegistered->address2 }}, {{ $getRegistered->landmark }}<br>
                        {{ $getRegistered->cityName }}, {{ $getRegistered->stateName }}, {{ $getRegistered->countryName }}<br> {{ $getRegistered->postalcode }}
                    </h5>
                </div>
            </div>
        @endforeach
        @foreach( $getCampusCollegeAddress as $getRegistered )
            <div class="row">
                <div class="col-md-4">
                    <h5>Campus College Address : </h5>
                </div>
                <div class="col-md-8">
                    <h5>
                        <span class="font-bold">{{ $getRegistered->name }}</span><br> 
                        {{ $getRegistered->address1 }}, {{ $getRegistered->address2 }}, {{ $getRegistered->landmark }}<br>
                        {{ $getRegistered->cityName }}, {{ $getRegistered->stateName }}, {{ $getRegistered->countryName }}<br> {{ $getRegistered->postalcode }}
                    </h5>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script type="text/javascript">
	var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 350) return;
        
        $(this).html(
            t.slice(0,350)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(350,t.length)+' <a href="#" class="less">Less</a></span>'
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
</script>