<script type="text/javascript">
	var selectedPageId = '';
	var methodType = '';
    $(document).ready(function(){   
        $('select[name=method_type]').on('change', function(){
            methodType = $(this).val();
            getAllDropdownOptions(methodType, 0);
        });

        $('select[name=page_name_id]').on('change', function(){
            $('.college-section').removeClass('hide');
            selectedPageId = $(this).val();
        });
    });

    @if(isset($adstopcollegelist) && !empty($adstopcollegelist->method_type))
        $(document).ready(function(){
	       	if("{!! $adstopcollegelist->method_type !!}" == "Functional Area"){
	            getAllDropdownOptions("{!! $adstopcollegelist->method_type !!}", "{{$adstopcollegelist->functionalarea_id}}");
	        }else if("{!! $adstopcollegelist->method_type !!}" == "Degree"){
	            getAllDropdownOptions("{!! $adstopcollegelist->method_type !!}", "{{$adstopcollegelist->degree_id}}");
	        }else if("{!! $adstopcollegelist->method_type !!}" == "Course"){
	            getAllDropdownOptions("{!! $adstopcollegelist->method_type !!}", "{{$adstopcollegelist->course_id}}");
	        }else if("{!! $adstopcollegelist->method_type !!}" == "Education Level"){
	            getAllDropdownOptions("{!! $adstopcollegelist->method_type !!}", "{{$adstopcollegelist->educationlevel_id}}");
	        }else if("{!! $adstopcollegelist->method_type !!}" == "City"){
	            getAllDropdownOptions("{!! $adstopcollegelist->method_type !!}", "{{$adstopcollegelist->city_id}}");
	        }else if("{!! $adstopcollegelist->method_type !!}" == "State"){
	            getAllDropdownOptions("{!! $adstopcollegelist->method_type !!}", "{{$adstopcollegelist->state_id}}");
	        }else if("{!! $adstopcollegelist->method_type !!}" == "Country"){
	            getAllDropdownOptions("{!! $adstopcollegelist->method_type !!}", "{{$adstopcollegelist->country_id}}");
	        }else if("{!! $adstopcollegelist->method_type !!}" == "University"){
	            getAllDropdownOptions("{!! $adstopcollegelist->method_type !!}", "{{$adstopcollegelist->university_id}}");
	        }
	        $('.college-section').removeClass('hide' );
        });
    @endif

    function getAllDropdownOptions(actionType, pageNameId){
    	selectedPageId = pageNameId;
    	methodType = actionType;
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {actionType: actionType},
            url: "{{ URL::to('/getAllDropdownOptions') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">Select option</option>';
                if( data.code == '200' ){
                    $.each(data.dataObj, function(i, item) {
                    	var selectAttr = '';
	                    if(data.dataObj[i].id == pageNameId){
	                        selectAttr = 'selected=""';
	                    }
                        HTML += '<option value="'+data.dataObj[i].id+'" '+selectAttr+' >'+data.dataObj[i].fullname+'</option>';
                    });
                    $('.selected_method_block').removeClass('hide'); 
                }else{
                    HTML += '<option selected="" disabled="">No option available</option>';
                    $('.selected_method_block').addClass('hide');
                }
                $('select[name="page_name_id"]').empty();
                $('select[name="page_name_id"]').html(HTML);
                $('select[name="page_name_id"]').trigger('chosen:updated');
            }
        });
    }
</script>
<script type="text/javascript">
	$('.callPopupForContactSeller').on('click', function(){
		$("input[name=itemId]").val('');
	    $('input[name=itemId]').val($(this).attr('itemId'));
	    $('input[name=methodTypeId]').val(methodType);
	    $('input[name=pageNameId]').val(selectedPageId);
	});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.checkExistingAdsCollegeList').on('change', function (){
            var method_type = $(".method_type").val();
			var page_name_id = $(this).val();
			var routeCall = "{!! $fetchDataServiceController->routeCall() !!}";
            if(method_type != '' && page_name_id != ''){
	            $.ajax({
	                headers: {
	                  'X-CSRF-Token': $('input[name="_token"]').val()
	                },
	                method: "GET",
	                data: { method_type: method_type, page_name_id: page_name_id},
	                contentType: "application/json; charset=utf-8",
	                dataType: "json",
	                url: "{{ URL::to('/checkExistingAdsCollegeList') }}",
	                success: function(data) {
	                    if( data.code == '200' ){
	                        var a = document.getElementById('checkExistingAdsCollegeListBtn'); //or grab it by tagname etc
							a.href = '/'+routeCall+'/ads-top-college-list/'+data.dataObj.id+'/edit';
	                        $('.checkExistingAdsCollegeListMsg').removeClass('hide');
	                        $('.ads-button').attr('disabled','disabled');
	                        $('.college-section').addClass('hide');
	                    }else{
	                        $('.checkExistingAdsCollegeListMsg').addClass('hide');
	                        //$('.checkExistingAdsCollegeList').val('');
	                        $('.ads-button').removeAttr('disabled');
	                        $('.college-section').removeClass('hide');
	                    }
	                }
	            });
	        }
        });
    });
</script>

