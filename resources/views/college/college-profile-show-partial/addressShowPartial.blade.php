<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="">
		<div class="row margin-bottom-30">
			<div class="col-md-12">
				<div class="headline"><h4> Registered College Address </h4></div>
								
				<div class="row">
					<div class="col-md-12">
						<h5>College Address : 
						@if( $getRegisteredCollegeAddress )
							@foreach( $getRegisteredCollegeAddress as $getRegistered )
								@if($getRegistered->name)
									<span class="minimize">{{ $getRegistered->name }}</span></p>
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Address1 : 
						@if( $getRegisteredCollegeAddress )
							@foreach( $getRegisteredCollegeAddress as $getRegistered )
								@if($getRegistered->address1)
									<span class="minimize">{{ $getRegistered->address1 }}</span></p>
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Address2 : 
						@if( $getRegisteredCollegeAddress )
							@foreach( $getRegisteredCollegeAddress as $getRegistered )
								@if($getRegistered->address2)
									<span class="minimize">{{ $getRegistered->address2 }}</span></p>
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Landmark : 
						@if( $getRegisteredCollegeAddress )
							@foreach( $getRegisteredCollegeAddress as $getRegistered )
								@if($getRegistered->landmark)
									<span class="minimize">{{ $getRegistered->landmark }}</span></p>
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>City : 
						@if( $getRegisteredCollegeAddress )
							@foreach( $getRegisteredCollegeAddress as $getRegistered )
								@if($getRegistered->cityName)
									{{ $getRegistered->cityName }}
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>State : 
						@if( $getRegisteredCollegeAddress )
							@foreach( $getRegisteredCollegeAddress as $getRegistered )
								@if($getRegistered->stateName)
									{{ $getRegistered->stateName }}
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Country : 
						@if( $getRegisteredCollegeAddress )
							@foreach( $getRegisteredCollegeAddress as $getRegistered )
								@if($getRegistered->countryName)
									{{ $getRegistered->countryName }}
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Postal Code : 
						@if( $getRegisteredCollegeAddress )
							@foreach( $getRegisteredCollegeAddress as $getRegistered )
								@if($getRegistered->postalcode)
									{{ $getRegistered->postalcode }}
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
			</div>			
		</div>
	</div>

	<div class="">
		<div class="row margin-bottom-30">
			<div class="col-md-12">
				<div class="headline"><h4> Campus College Address</h4></div>
				<div class="row">
					<div class="col-md-12">
						<h5>College Address : 
						@if( $getCampusCollegeAddress )
							@foreach( $getCampusCollegeAddress as $getCampus )
								@if($getCampus->name)
									<span class="minimize">{{ $getCampus->name }}</span></p>
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Address1 : 
						@if( $getCampusCollegeAddress )
							@foreach( $getCampusCollegeAddress as $getCampus )
								@if($getCampus->address1)
									<span class="minimize">{{ $getCampus->address1 }}</span></p>
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Address2 : 
						@if( $getCampusCollegeAddress )
							@foreach( $getCampusCollegeAddress as $getCampus )
								@if($getCampus->address2)
									<span class="minimize">{{ $getCampus->address2 }}</span></p>
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Landmark : 
						@if( $getCampusCollegeAddress )
							@foreach( $getCampusCollegeAddress as $getCampus )
								@if($getCampus->landmark)
									<span class="minimize">{{ $getCampus->landmark }}</span></p>
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>City : 
						@if( $getCampusCollegeAddress )
							@foreach( $getCampusCollegeAddress as $getCampus )
								@if($getCampus->cityName)
									{{ $getCampus->cityName }}
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>State : 
						@if( $getCampusCollegeAddress )
							@foreach( $getCampusCollegeAddress as $getCampus )
								@if($getCampus->stateName)
									{{ $getCampus->stateName }}
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Country : 
						@if( $getCampusCollegeAddress )
							@foreach( $getCampusCollegeAddress as $getCampus )
								@if($getCampus->countryName)
									{{ $getCampus->countryName }}
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Postal Code : 
						@if( $getCampusCollegeAddress )
							@foreach( $getCampusCollegeAddress as $getCampus )
								@if($getCampus->postalcode)
									{{ $getCampus->postalcode }}
								@else
									--<!-- <span class="label label-warning">Not updated yet</span> -->
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
			</div>
				
	
			</div>
		</div>
	</div>
	
</div>
<script type="text/javascript">
    var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(100,t.length)+' <a href="#" class="less">Less</a></span>'
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