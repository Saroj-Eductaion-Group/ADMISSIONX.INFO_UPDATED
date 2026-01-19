 <div class="profile-edit tab-pane fade in active">
    <!-- <h2 class="heading-md text-center">Manage your placement info details</h2> -->
    <br>
    {!! Form::model($collegePlacementDataObj , ['url' => 'college-placement-partial', 'method' => 'POST','class' => 'sky-form detail-page-signup ajaxplacementInfo','role'=>'form', 'id'=>'', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

   <input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
   <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <label>Placement Information </label>
            {!! Form::textarea('placementinfo', null, ['class' => 'form-control', 'placeholder' => 'Please enter placement info here' ]) !!}
        </div>
    </div>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <label>Number Of Recruiting Companies</label>
            {!! Form::text('numberofrecruitingcompany', null, ['class' => 'form-control', 'placeholder' => 'Please enter number of recruiting companies here',  'data-parsley-type'=>'number','data-parsley-error-message' => 'Please enter number of recruiting companies here', 'data-parsley-trigger'=>'change']) !!}
        </div>
    </div>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <label>Number Of Placements Last Year</label>
            {!! Form::text('numberofplacementlastyear', null, ['class' => 'form-control', 'placeholder' => 'Please enter number of placements last year here',  'data-parsley-type'=>'number','data-parsley-error-message' => 'Please enter number of placements last Year here', 'data-parsley-trigger'=>'change']) !!}
        </div>
    </div>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <label>CTC Highest </label>
            {!! Form::text('ctchighest', null, ['class' => 'form-control', 'placeholder' => 'Please enter CTC highest here', 'data-parsley-pattern'=> '^[0-9a-zA-Z\s .,]*$','data-parsley-error-message' => 'Please enter CTC highest here', 'data-parsley-trigger'=>'change']) !!}
        </div>
    </div>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <label>CTC Lowest </label>
            {!! Form::text('ctclowest', null, ['class' => 'form-control', 'placeholder' => 'Please enter CTC lowest here', 'data-parsley-pattern'=> '^[0-9a-zA-Z\s,.]*$','data-parsley-error-message' => 'Please enter CTC lowest here', 'data-parsley-trigger'=>'change']) !!}
        </div>
    </div>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <label>CTC Average </label>
            {!! Form::text('ctcaverage', null, ['class' => 'form-control', 'placeholder' => 'Please enter CTC average here', 'data-parsley-pattern'=> '^[0-9a-zA-Z\s.,]*$','data-parsley-error-message' => 'Please enter CTC average here', 'data-parsley-trigger'=>'change']) !!}
        </div>
    </div>
    <hr>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12 col-lg-12 text-right">
            <button class="btn-u" type="submit">Update</button>
        </div>
    </div>
    {!! Form::close() !!}
    <!-- <button type="button" class="btn-u btn-u-default">Cancel</button>
    <button type="button" class="btn-u">Save Changes</button> -->
</div>


{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
  $('form').parsley();
</script>


<script type="text/javascript">
    //AJAX
    $( '.ajaxplacementInfo' ).submit(function(e) {
        $('.updateProfileBlock').addClass('hide');
        e.preventDefault();
        var form = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '{{ URL::to("college-placement-partial") }}',
            data: form,
            success: function(data){
                if( data.code =='200' ){
                   // window.location.reload();
                    $('.updateProfileBlock').removeClass('hide');
                    $('.updateProfileBlock .profileUpdateMessage').html(data.message);
                    $('#profileUpdate').modal({show: 'true'}); 
                }
            }
        }); 
    });
</script>