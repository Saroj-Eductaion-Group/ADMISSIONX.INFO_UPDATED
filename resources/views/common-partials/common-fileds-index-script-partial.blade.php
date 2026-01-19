<script type="text/javascript">
    $('.isShowOnHomeSearch').on('change',function(){
        $('#isShowOnHomeStatus').removeClass('hide');
    });
    $('#isShowOnHomeStatus').on('click',function(e){
        $('.isShowOnHomeSearch').val('').trigger('chosen:updated');
        $('#isShowOnHomeStatus').addClass('hide');
    });

    $('.isShowOnTopSearch').on('change',function(){
        $('#isShowOnTopStatus').removeClass('hide');
    });
    $('#isShowOnTopStatus').on('click',function(e){
        $('.isShowOnTopSearch').val('').trigger('chosen:updated');
        $('#isShowOnTopStatus').addClass('hide');
    });
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('.tbody tr td div .isShowOnHome').on('click', function(){
        var id              = $(this).attr('id');
        var tablename              = $(this).attr('tablename');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }

        if (currentStatus == 1) {
            $('.isShowOnHomeEnabled'+id).addClass('hide');
            $('.isShowOnHomeDisabled'+id).addClass('hide');
            $('.isShowOnHomeEnabled1'+id).removeClass('hide');
            $('.isShowOnHomeDisabled1'+id).addClass('hide');
        }else if(currentStatus == 0){
            $('.isShowOnHomeEnabled'+id).addClass('hide');
            $('.isShowOnHomeDisabled'+id).addClass('hide');
            $('.isShowOnHomeDisabled1'+id).removeClass('hide');
            $('.isShowOnHomeEnabled1'+id).addClass('hide');
        }

        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/isShowOnHome') }}",
            data: {id: id,currentStatus:currentStatus, tablename:tablename},
            success: function(data){
                if(data.code == 200){
                    toastr.success(tablename +" is show on home status updated successfully.");
                }
            }
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('.tbody tr td div .isShowOnTop').on('click', function(){
        var id              = $(this).attr('id');
        var tablename              = $(this).attr('tablename');
        var currentStatus   = 0;
        if($(this).prop("checked") == true){
            currentStatus   = 1;
        }

        if (currentStatus == 1) {
            $('.isShowOnTopEnabled'+id).addClass('hide');
            $('.isShowOnTopDisabled'+id).addClass('hide');
            $('.isShowOnTopEnabled1'+id).removeClass('hide');
            $('.isShowOnTopDisabled1'+id).addClass('hide');
        }else if(currentStatus == 0){
            $('.isShowOnTopEnabled'+id).addClass('hide');
            $('.isShowOnTopDisabled'+id).addClass('hide');
            $('.isShowOnTopDisabled1'+id).removeClass('hide');
            $('.isShowOnTopEnabled1'+id).addClass('hide');
        }

        $.ajax({
            type: "POST",
            url: "{{ URL::to('administrator/isShowOnTop') }}",
            data: {id: id,currentStatus:currentStatus, tablename:tablename},
            success: function(data){
                if(data.code == 200){
                    toastr.success(tablename+ " is show on top status updated successfully.");
                }
            }
        });
    });
});
</script>