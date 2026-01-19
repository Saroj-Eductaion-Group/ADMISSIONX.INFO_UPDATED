@foreach( $listOfSubmitReviews as $item )
	<div class="row margin-bottom20 rating_reviews_info">
	    <div class="col-md-6">
	        <div class="padding-top10 padding-left10 padding-right10">
	            <div>
	                <label class="font-noraml"><i class="fa-fw fa fa-university"></i>College Name : 
	                @if( $item->collegeUserFirstName )
						<a href="{{ URL::to('/college/'.$item->collegeSlug) }}" target="_blank"> {{ $item->collegeUserFirstName }}</a>
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
		        <ul class="list-inline padding-bottom5">
					<li class="padding0">
						<a class="btn btn-warning text-white btn-xs border-radius15" href="{{ URL::to('student/review-forms/'.$slug.'/edit/'.$item->id) }}"><i class="fa fa-pencil"></i> Edit</a>
					</li>
					<li class="padding0">|</li>
					<li class="padding0">
						<form method="POST" action="{{ URL::to('student/review-forms/'.$slug.'/delete/'.$item->id) }}">
							<button type="submit" class="btn btn-danger text-white btn-xs border-radius15" onclick="return confirm('Are you sure to delete this college review?')"><i class="fa fa-trash"></i> Delete</button>
						</form>
					</li>
				</ul>
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