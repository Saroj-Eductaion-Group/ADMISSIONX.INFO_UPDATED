<script type="text/javascript">
    $(document).ready(function(){
        $('.validateEmailAddress').on('change', function (){
            var emailaddress = $(this).val();
            if(emailaddress != ''){
	            $.ajax({
	                headers: {
	                  'X-CSRF-Token': $('input[name="_token"]').val()
	                },
	                method: "GET",
	                data: { emailaddress: emailaddress},
	                contentType: "application/json; charset=utf-8",
	                dataType: "json",
	                url: "{{ URL::to('/validateEmailAddress') }}",
	                success: function(data) {
	                    if( data.code == '200' ){
	                        $('.validateEmailAddressMsg').addClass('hide');
	                        $('.btn').removeAttr('disabled');
	                    }else{
	                        $('.validateEmailAddressMsg').removeClass('hide');
	                        $('.validateEmailAddress').val('');
	                        $('.btn').attr('disabled','disabled');
	                    }
	                }
	            });
	        }
        });
    });
</script>

