@extends('website/new-design-layouts.master')

@section('content')

<div class="container  content-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12 md-margin-bottom-50">
				@foreach($getPageContentDataObj as $item)
					<div class="overflow-h">
						<h4 class="text-center"><strong>{{ $item->title }}</strong></h4>
						{!! $item->description !!}
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
			
@endsection


