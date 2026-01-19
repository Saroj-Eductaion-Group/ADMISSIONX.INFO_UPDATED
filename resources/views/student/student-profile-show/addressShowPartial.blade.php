<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="">
		<div class="row margin-bottom-30">
			<div class="col-md-12">
				<div class="headline"><h4> Student Permanent Address </h4></div>
								
				<div class="row">
					<div class="col-md-12">
						<h5>College Address : 
						@if( $getStudentPermanentAddress )
							@foreach( $getStudentPermanentAddress as $getPermanent )
								@if($getPermanent->name)
									<span class="minimize">{{ $getPermanent->name }}</span></p>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Address1 : 
						@if( $getStudentPermanentAddress )
							@foreach( $getStudentPermanentAddress as $getPermanent )
								@if($getPermanent->address1)
									<span class="minimize">{{ $getPermanent->address1 }}</span></p>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Address2 : 
						@if( $getStudentPermanentAddress )
							@foreach( $getStudentPermanentAddress as $getPermanent )
								@if($getPermanent->address2)
									<span class="minimize">{{ $getPermanent->address2 }}</span></p>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Landmark : 
						@if( $getStudentPermanentAddress )
							@foreach( $getStudentPermanentAddress as $getPermanent )
								@if($getPermanent->landmark)
									<span class="minimize">{{ $getPermanent->landmark }}</span></p>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>City : 
						@if( $getStudentPermanentAddress )
							@foreach( $getStudentPermanentAddress as $getPermanent )
								@if($getPermanent->cityName)
									{{ $getPermanent->cityName }}
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>State : 
						@if( $getStudentPermanentAddress )
							@foreach( $getStudentPermanentAddress as $getPermanent )
								@if($getPermanent->stateName)
									{{ $getPermanent->stateName }}
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Country : 
						@if( $getStudentPermanentAddress )
							@foreach( $getStudentPermanentAddress as $getPermanent )
								@if($getPermanent->countryName)
									{{ $getPermanent->countryName }}
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Postal Code : 
						@if( $getStudentPermanentAddress )
							@foreach( $getStudentPermanentAddress as $getPermanent )
								@if($getPermanent->postalcode)
									{{ $getPermanent->postalcode }}
								@else
									<span class="label label-warning">Not updated yet</span>
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
				<div class="headline"><h4> Student Present Address</h4></div>
				<div class="row">
					<div class="col-md-12">
						<h5>College Address : 
						@if( $getStudentPresentAddress )
							@foreach( $getStudentPresentAddress as $getPresentAddress )
								@if($getPresentAddress->name)
									<span class="minimize">{{ $getPresentAddress->name }}</span></p>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Address1 : 
						@if( $getStudentPresentAddress )
							@foreach( $getStudentPresentAddress as $getPresentAddress )
								@if($getPresentAddress->address1)
									<span class="minimize">{{ $getPresentAddress->address1 }}</span></p>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Address2 : 
						@if( $getStudentPresentAddress )
							@foreach( $getStudentPresentAddress as $getPresentAddress )
								@if($getPresentAddress->address2)
									<span class="minimize">{{ $getPresentAddress->address2 }}</span></p>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Landmark : 
						@if( $getStudentPresentAddress )
							@foreach( $getStudentPresentAddress as $getPresentAddress )
								@if($getPresentAddress->landmark)
									<span class="minimize">{{ $getPresentAddress->landmark }}</span></p>
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>City : 
						@if( $getStudentPresentAddress )
							@foreach( $getStudentPresentAddress as $getPresentAddress )
								@if($getPresentAddress->cityName)
									{{ $getPresentAddress->cityName }}
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>State : 
						@if( $getStudentPresentAddress )
							@foreach( $getStudentPresentAddress as $getPresentAddress )
								@if($getPresentAddress->stateName)
									{{ $getPresentAddress->stateName }}
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Country : 
						@if( $getStudentPresentAddress )
							@foreach( $getStudentPresentAddress as $getPresentAddress )
								@if($getPresentAddress->countryName)
									{{ $getPresentAddress->countryName }}
								@else
									<span class="label label-warning">Not updated yet</span>
								@endif
							@endforeach
						@endif
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Postal Code : 
						@if( $getStudentPresentAddress )
							@foreach( $getStudentPresentAddress as $getPresentAddress )
								@if($getPresentAddress->postalcode)
									{{ $getPresentAddress->postalcode }}
								@else
									<span class="label label-warning">Not updated yet</span>
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