<script type="text/javascript">
    $('.searchByEmployeeId').on('change',function(){
        $('#searchByEmployeeId').removeClass('hide');
    });
    $('#searchByEmployeeId').on('click',function(e){
        $('.searchByEmployeeId').val('').trigger('chosen:updated');
        $('#searchByEmployeeId').addClass('hide');
    });
</script>