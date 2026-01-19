<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="detail-page-signup">
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
	        	<h5>Date of birth : 
	        	@if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
		                @if($studentData->dateofbirth == 0000-00-00)
							<span class="label label-warning">Not updated yet</span>
						@else
							{{ $studentData->dateofbirth }}
						@endif
					@endforeach
				@endif 
				</h5>
			</div>	
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
	        	<h5>Sex : 
	        	@if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
		                @if($studentData->gender)
							{{ $studentData->gender }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					@endforeach
				@endif 
				</h5>
			</div>	
		</div>

		<div class="row padding-top5 padding-bottom5">
	        <div class="col-md-12">
	            <h5>Parents Name : 
	            @if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
						
						@if($studentData->parentsname)
							{{ $studentData->parentsname }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					@endforeach
				@endif
				</h5>
	        </div>
	    </div>

		<div class="row padding-top5 padding-bottom5">
	        <div class="col-md-12">
	            <h5>Phone No : 
	            @if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
						@if($studentData->parentsnumber)
							{{ $studentData->parentsnumber }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					@endforeach
				@endif
				</h5>
	        </div>
	    </div>

	    <div class="row padding-top5 padding-bottom5">
	        <div class="col-md-12">
	            <h5>Hobbies : 
	            @if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
						@if($studentData->hobbies)
							{{ $studentData->hobbies }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					@endforeach
				@endif
				</h5>
	        </div>
	    </div>
		
		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<h5>Interests : 
				@if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
						@if($studentData->interests)
							{{ $studentData->interests }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					@endforeach
				@endif
				</h5>
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<h5>Entrance Exam Name : 
				@if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
						@if($studentData->entranceexamName)
							{{ $studentData->entranceexamName }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					@endforeach
				@endif
				</h5>
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<h5>Entrance Exam Number : 
				@if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
						@if($studentData->entranceexamnumber)
							{{ $studentData->entranceexamnumber }}
						@else
							<span class="label label-warning">Not updated yet</span>
						@endif
					@endforeach
				@endif
				</h5>
			</div>
		</div>

		<div class="row padding-top5 padding-bottom5">
			<div class="col-md-12">
				<h5>Achievements Awards : 
				@if( $studentProfileDataObj )
					@foreach(  $studentProfileDataObj as  $studentData )
						
						@if($studentData->achievementsawards)
							<span class="minimize">{{ $studentData->achievementsawards }}</span></p>
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