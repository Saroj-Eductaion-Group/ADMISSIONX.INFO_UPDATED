@extends('website/new-design-layouts.master')

@section('content')
<div class="container">
	<div class="col-md-12">
		<div class="container content">
			<div class="row-fluid privacy">
				@foreach($getPageContentDataObj as $item)
					<div class="overflow-h">
						<h3>{{ $item->title }}</h3>
						{!! $item->description !!}
					</div>
				@endforeach
			</div><!--/row-fluid-->
		</div><!--/container-->
	</div>
</div>		
@endsection


