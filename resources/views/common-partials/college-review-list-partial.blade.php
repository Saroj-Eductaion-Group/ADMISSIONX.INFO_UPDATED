<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="detail-page-signup">
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-12">
                <div class="headline">
                	<h2>Rating & Reviews
                		@if($collegeRatingObj[0]->totalLikes > 0)
						  	<span class="label label-success rounded"><i class="fa fa-thumbs-up"></i> {{$collegeRatingObj[0]->totalLikes}}</span>
						@endif
						@if($collegeRatingObj[0]->totalDislike > 0)
						  	<span class="label label-danger rounded"><i class="fa fa-thumbs-down"></i> {{$collegeRatingObj[0]->totalDislike}}</span>
						@endif
	                </h2>
	            </div>
            </div>
        </div>
        <div class="row bg-color-green1">
            <div class="col-md-8">
                <h4 class="h4">Based On {{ $collegeRatingObj[0]->totalCount}} Student Ratings Claim This College</h4>
            </div>
            <div class="col-md-4">
            	<h4 class="h4 text-right"> {{ $collegeRatingObj[0]->totlaUserRating }}/5</h4>
            </div>
        </div>

        <div class="row">
        	<div class="col-md-2">
        		<div class="rating_reviews_block">
        			<h5>Academic</h5>
        			<h3>{{ round(($collegeRatingObj[0]->totalAcademicStar), 2)}} / 5</h3>
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="rating_reviews_block">
        			<h5>Accommodation</h5>
        			<h3>{{ round(($collegeRatingObj[0]->totalAccommodationStar), 2)}} / 5</h3>
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="rating_reviews_block">
        			<h5>Faculty</h5>
        			<h3>{{ round(($collegeRatingObj[0]->totalFacultyStar), 2)}} / 5</h3>
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="rating_reviews_block">
        			<h5>Infrastructure</h5>
        			<h3>{{ round(($collegeRatingObj[0]->totalInfrastructureStar), 2)}} / 5</h3>
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="rating_reviews_block">
        			<h5>Placement</h5>
        			<h3>{{ round(($collegeRatingObj[0]->totalPlacementStar), 2)}} / 5</h3>
        		</div>
        	</div>
        	<div class="col-md-2">
        		<div class="rating_reviews_block">
        			<h5>Social</h5>
        			<h3>{{ round(($collegeRatingObj[0]->totalSocialStar), 2)}} / 5</h3>
        		</div>
        	</div>
        </div>
    </div>
</div>
<div class="headline"><h2>Here is the list of reviews</h2></div>

@foreach( $listOfSubmitReviews as $item )
	<div class="row margin-bottom20 rating_reviews_info">
	    <div class="col-md-6">
	        <div class="padding-top10 padding-left10 padding-right10">
	            <div>
	                <label class="font-noraml"><i class="fa-fw fa fa-user"></i>Student Name : 
	                @if( $item->collegeUserFirstName )
						<a href="{{ URL::to('/student/'.$item->studentSlug) }}" target="_blank"> {{ $item->studentUserFirstName }} {{ $item->studentUserLastName }}</a>
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
	                </label>
	            </div>
	            <div>
	                <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Review Title : 
					@if($item->title )
						{{ $item->title }}
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
	                </label>
	            </div>
	            <div>
	                <label class="font-noraml"><i class="fa-fw fa fa-calendar"></i> Review Date : 
	                @if($item->created_at)
						{{ date('d F Y', strtotime($item->created_at)) }}
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
	                </label>
	            </div>
	            <div>
		            <label class="font-noraml"><i class="fa-fw fa fa-thumbs-up"></i> Vote : 
		            @if( $item->votes )
						@if($item->votes == 1)<span class="label label-success rounded">Liked</span> @elseif($item->votes == 2)<span class="label label-danger rounded">Disliked</span> @endif
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
		            </label>
		        </div>
	        </div>
	    </div>
	    <div class="col-md-3">
	        <div class=" padding-top10 padding-left10 padding-right10">
	            <div>
		            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Academic : 
		            @if( $item->academic )
						{{ $item->academic }}/5
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
		            </label>
		        </div>
		        <div>
		            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Accommodation : 
		            @if( $item->accommodation )
						{{ $item->accommodation }}/5
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
		            </label>
		        </div>
		        <div>
		            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Faculty : 
		            @if( $item->faculty )
						{{ $item->faculty }}/5
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
		            </label>
		        </div>
	        </div>
	    </div>
	    <div class="col-md-3">
	        <div class=" padding-top10 padding-left10 padding-right10">
		        <div>
		            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Infrastructure : 
		            @if( $item->infrastructure )
						{{ $item->infrastructure }}/5
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
		            </label>
		        </div>
		        <div>
		            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Placement : 
		            @if( $item->placement )
						{{ $item->placement }}/5
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
		            </label>
		        </div>
		        <div>
		            <label class="font-noraml"><i class="fa-fw fa fa-star"></i> Social : 
		            @if( $item->social )
						{{ $item->social }}/5
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
		            </label>
		        </div>
	        </div>
	    </div>
	    <div class="col-md-12">
	        <div class=" padding-bottom10 padding-left10 padding-right10">
	            <div>
	                <label class="font-noraml"><i class="fa-fw fa fa-pencil"></i> Review Description : 
	                @if( $item->description )
						{!! $item->description !!}
					@else
						<span class="label label-warning">Not updated yet</span>
					@endif
	                </label>
	            </div>
	        </div>
	    </div>
	</div>
@endforeach
<div class="row indexPagination">
	<div class="col-md-12 text-center">
    <div class="custom-pagination">{!! $listOfSubmitReviews->render() !!}</div>
    </div>
</div>