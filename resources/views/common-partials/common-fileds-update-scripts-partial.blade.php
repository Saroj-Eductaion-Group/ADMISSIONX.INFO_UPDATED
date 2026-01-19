<script type="text/javascript">
    $('form').parsley();
</script>
<script type="text/javascript">
    $(document).ready(function(){ 
        $('.logoimage').on('change',function(){
            $('#logoimage').removeClass('hide');
        });
        $('#logoimage').on('click',function(e){
            $('.logoimage').val('').trigger('chosen:updated');
            $('#logoimage').addClass('hide');
        });

        $('input[name=logoimage]').change(function (e)
        {   
            var ext = $('input[name=logoimage]').val().split('.').pop().toLowerCase();
            if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
                $("input[name=logoimage]").parsley().reset();
            }else{
                $('input[name=logoimage]').val('');
                $("input[name=logoimage]").parsley().reset();
                return false;
            }
            //Disable input file
        });
    });
</script>
<script type="text/javascript">
    $('.bannerimage').on('change',function(){
        $('#bannerimage').removeClass('hide');
    });
    $('#bannerimage').on('click',function(e){
        $('.bannerimage').val('').trigger('chosen:updated');
        $('#bannerimage').addClass('hide');
    });

    $('input[name=bannerimage]').change(function (e)
    {   
        var ext = $('input[name=bannerimage]').val().split('.').pop().toLowerCase();
        if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
            $("input[name=bannerimage]").parsley().reset();
        }else{
            $('input[name=bannerimage]').val('');
            $("input[name=bannerimage]").parsley().reset();
            return false;
        }
        //Disable input file
    });

    $("form").submit( function( e ) {
    var form = this;
    e.preventDefault(); //Stop the submit for now
                                //Replace with your selector to find the file input in your form
    var fileInput = $(this).find("input[name=bannerimage]")[0],
        file = fileInput.files && fileInput.files[0];
    if( file ) {
        var img = new Image();

        img.src = window.URL.createObjectURL( file );

        img.onload = function() {
            var width = img.naturalWidth,
                height = img.naturalHeight;

            window.URL.revokeObjectURL( img.src );

            if((width >= 1200 && width <= 1400)  && (height >= 300 && height <= 400) ) {
                form.submit();
            }else {
                alert("Sorry, this image doesn\'t look like the size we wanted. It\'s  width ("+width+") height ("+height+") but we require weight (1200 to 1400) x  height (300 to 400) size image.");
            }
        };
    }
    else { //No file was input or browser doesn't support client side reading
        form.submit();
    }
});
</script>