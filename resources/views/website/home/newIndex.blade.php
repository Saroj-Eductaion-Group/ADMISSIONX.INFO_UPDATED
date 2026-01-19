@extends('website/new-design-layouts.master')
@section('styles')
<!-- CSS Page Style -->
{!! Html::style('assets/css/pages/page_search.css') !!}
{!! Html::style('home-layout/assets/css/jquery-ui.css') !!}

@endsection

@section('content')
<!--=== Search Block ===-->
		<div class="search-block parallaxBg">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1>Discover <span class="color-green">new</span> things</h1>
					</div>	
				</div>				

				<form method="POST" action="filter/college">
				<div class="row">
					<div class="col-md-2 col-md-offset-1 form-filter-design">
						<select name="functionalarea_id" class="form-control">
							<option selected="" disabled="">Stream</option>
							@if( $functionalAreaObj )
								@foreach( $functionalAreaObj as $item )
									<option value="{{ $item->id }}">{{ $item->name }}</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="col-md-2 form-filter-design">
						<select name="degree_id" class="form-control">
							<option selected="" disabled="">Degree</option>
						</select>
					</div>
					<div class="col-md-2 form-filter-design">
						<select name="course_id" class="form-control">
							<option selected="" disabled="">Branch</option>
						</select>
					</div>
					<div class="col-md-2 form-filter-design">
						<select name="state_id" class="form-control">
							<option selected="" disabled="">State</option>
							@if( $stateObj )
								@foreach( $stateObj as $item )
									<option value="{{ $item->id }}">{{ $item->name }}</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="col-md-2 form-filter-design">
						<select name="city_id" class="form-control">
							<option selected="" disabled="">City</option>
						</select>
					</div>
				</div>
				<div class="row margin-top20">
					<div class="col-md-6 col-md-offset-3  form-filter-design">
						<input id="field_id" name="field_id" type="hidden">
						<input type="text" class="form-control" name="collegeName" id="field" placeholder="Enter College Name">
						<span id="results_count"></span>
                        <span id="empty-message"></span>
					</div>
				</div>
				<div class="row margin-top20">
					<div class="col-md-4 col-md-offset-4">
						<button class="btn btn-block btn-u">Browse College</button>
					</div>
				</div>
				</form>
				

				
			</div>
		</div><!--/container-->
		<!--=== End Search Block ===-->
@endsection

@section('scripts')


<script type="text/javascript">
	$('select[name=functionalarea_id]').on('change', function(){
		var currentID = $(this).val();
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllDegreeName') }}",
            success: function(data) {
            	var HTML = '';
            	HTML += '<option selected="" disabled="">Degree</option>';
            	if( data.code == '200' ){
            		$.each(data.degreeObj, function(i, item) {
            			HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No degree available for this stream</option>';
            	}

            	$('select[name="degree_id"]').empty();
            	$('select[name="degree_id"]').html(HTML);
            	$('select[name="degree_id"]').trigger('chosen:updated');
            }
        });
	});

	$('select[name=degree_id]').on('change', function(){
		var currentID = $(this).val();
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCourseName') }}",
            success: function(data) {
            	var HTML = '';
            	HTML += '<option selected="" disabled="">Branch</option>';
            	if( data.code == '200' ){
            		$.each(data.courseObj, function(i, item) {
            			HTML += '<option value="'+data.courseObj[i].courseId+'">'+data.courseObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No course available for this degree</option>';
            	}

            	$('select[name="course_id"]').empty();
            	$('select[name="course_id"]').html(HTML);
            	$('select[name="course_id"]').trigger('chosen:updated');
            }
        });
	});

	$('select[name=state_id]').on('change', function(){
		var currentID = $(this).val();
		$.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCityName') }}",
            success: function(data) {
            	var HTML = '';
            	HTML += '<option selected="" disabled="">City</option>';
            	if( data.code == '200' ){
            		$.each(data.cityObj, function(i, item) {
            			HTML += '<option value="'+data.cityObj[i].cityId+'">'+data.cityObj[i].name+'</option>';
	            	});	
            	}else{
            		HTML += '<option selected="" disabled="">No city available</option>';
            	}

            	$('select[name="city_id"]').empty();
            	$('select[name="city_id"]').html(HTML);
            	$('select[name="city_id"]').trigger('chosen:updated');
            }
        });
	});
</script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
	$(function() {
    
    $("#field").autocomplete({
        source: 'autocomplete/getCollegeFullName',
        minLength: 3,
        select: function(event, ui) {
            // feed hidden id field
            $("#field_id").val(ui.item.id);
            // update number of returned rows
            $('#results_count').html('');

        },
        open: function(event, ui) {
            // update number of returned rows
            var len = $('.ui-autocomplete > li').length;
            //$('#results_count').html('(#' + len + ')');
        },
        close: function(event, ui) {
            // update number of returned rows
            $('#results_count').html('');
        },
        // mustMatch implementation
        change: function (event, ui) {
            if (ui.item === null) {
                $(this).val('');
                $('#field_id').val('');
            }
        }
    });

    // mustMatch (no value) implementation
    $("#field").focusout(function() {
        if ($("#field").val() === '') {
            $('#field_id').val('');
        }
    });
});
</script>
@endsection