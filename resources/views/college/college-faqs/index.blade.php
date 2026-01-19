@extends('website/new-design-layouts.master')

@section('page-title-name')
Manage Your Faculty
@endsection

@section('styles')
	{!! Html::style('home-layout/assets/css/pages/profile.css') !!}
	<style type="text/css">
	.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
	.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
	.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
	.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
	</style>
@endsection

@section('content')
<div class="wrapper">
	<div class="container content profile">
		<div class="row">
			<div class="col-md-12 text-right"><a href="{{ URL::to('college/dashboard/edit', $slug) }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a></div>
			<div class="col-md-12">
				<div class="profile-body">					
					<div class="profile-bio">
						<div class="row">
							<div class="col-md-9">
								<h2>{!! App\Models\CollegeProfile::getCollegeName($slug) !!}</h2>
								<span><strong>Faqs Details</strong></span>
							</div>				
							<div class="col-md-3">
								<h2 class="text-right"><a class="btn btn-u" href="{{ URL::to('college/faqs/'.$slug.'/create') }}" style="left: unset;bottom: unset;margin-left: unset;text-align: unset;position: unset;"><i class="fa fa-plus"></i> Create</a></h2>
							</div>
						</div>
					</div>
						<hr class="hr-gap">
						<div class="row">
							<div class="col-md-12">
								<div class="table-search-v1 margin-bottom-20">
									@if(sizeof($getCollegeFaqsObj) > 0)
									<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
									    <div class="row padding-top5 padding-bottom5">
									        <div class="col-md-12">
									            <div class="headline"><h2>Faqs List</h2></div>
									        </div>
									    </div>
									    @foreach( $getCollegeFaqsObj as $key => $item )
									    <div class="rating_reviews_info padding-top20 padding-bottom20 padding-left20 padding-right20">
									    	<div>
						                        <label class="font-noraml"><i class="fa-fw fa  fa-question"></i> Question : 
						                        @if($item->question)
													{{ $item->question }}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
												<span class="pull-right">
													<a class="btn btn-warning text-white btn-xs border-radius15" href="{{ URL::to('college/faqs/'.$slug.'/edit/'.$item->id) }}"><i class="fa fa-pencil"></i> Edit</a>
													<form method="POST" action="{{ URL::to('college/faqs/'.$slug.'/remove/'.$item->id) }}">
														<button type="submit" class="btn btn-danger text-white btn-xs border-radius15" onclick="return confirm('Are you sure to delete this faqs?')"><i class="fa fa-trash"></i> Delete</button>
													</form>
												</span>
						                    </div>
						                    <div>
						                        <label class="font-noraml"><i class="fa-fw fa  fa-sticky-note"></i> Answer :</label> 
						                        <br>
						                        @if($item->answer)
													{!! $item->answer !!}
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                    </div>
						                    <div>
						                        <label class="font-noraml"><i class="fa-fw fa  fa-link"></i> Reference Link : 
						                        @if($item->refLinks)
													<a href="{{$item->refLinks}}">{{$item->refLinks}}</a>
												@else
													<span class="label label-warning">Not updated yet</span>
												@endif
						                        </label>
						                    </div>
									    </div>
									    @endforeach
									</div>
									<div class="row indexPagination">
	                    				<div class="col-md-12 text-center">
		                                <div class="custom-pagination">{!! $getCollegeFaqsObj->render() !!}</div>
			                            </div>
			                        </div>
			                        @else
			                        <div class="profile-bio">
										<div class="row">
											<div class="col-md-12">
												<div class="headline text-center">
													<h2 class="">No Faqs Added...</h2>
												</div>
											</div>							
										</div>
									</div>
			                        @endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>		
@endsection