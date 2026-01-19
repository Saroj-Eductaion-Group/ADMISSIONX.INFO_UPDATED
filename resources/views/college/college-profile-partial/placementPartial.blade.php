<style type="text/css">
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
@if( sizeof($collegePlacementDataObj) > 0 )
<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <div class="headline"><h2>Placement Records</h2></div>
        </div>
    </div>
    @foreach( $collegePlacementDataObj as $item )
        <div class="row margin-bottom20 gray-bg padding-top10 padding-bottom20 rating_reviews_info">
            <div class="col-md-6">
                <div class=" padding-top10 padding-left10 padding-right10">
                    <div>
                        <label class="font-noraml"><i class="fa-fw fa  fa-calendar-o"></i> Placement Information : </label>
                        <br>
                        @if($item->placementinfo)
                            <span class="minimize2">{!! $item->placementinfo !!}</span>
                        @else
                            <span class="label label-warning">Not updated yet</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class=" padding-top10 padding-left10 padding-right10">
                    <div>
                        <label class="font-noraml"><i class="fa-fw fa  fa-list"></i> Number Of Recruiting Companies : 
                        @if($item->numberofrecruitingcompany )
                            {{ $item->numberofrecruitingcompany }}
                        @else
                            <span class="label label-warning">Not updated yet</span>
                        @endif
                        </label>
                    </div>
                    <div class="">
                        <label class="font-noraml"><i class="fa-fw fa  fa-calendar"></i> Number Of Placements & Year : 
                        @if($item->numberofplacementlastyear)
                            {{ $item->numberofplacementlastyear }}
                        @else
                            <span class="label label-warning">Not updated yet</span>
                        @endif
                        </label>
                    </div>
                    <div class="">
                        <label class="font-noraml"><i class="fa-fw fa  fa-money"></i> CTC Highest : 
                        @if($item->ctchighest)
                            {{ $item->ctchighest }}
                        @else
                            <span class="label label-warning">Not updated yet</span>
                        @endif
                        </label>
                    </div>
                    <div class="">
                        <label class="font-noraml"><i class="fa-fw fa  fa-money"></i> CTC Lowest : 
                        @if($item->ctclowest)
                            {{ $item->ctclowest }}
                        @else
                            <span class="label label-warning">Not updated yet</span>
                        @endif
                        </label>
                    </div>
                    <div class="">
                        <label class="font-noraml"><i class="fa-fw fa  fa-money"></i> CTC Average : 
                        @if($item->ctcaverage)
                            {{ $item->ctcaverage }}
                        @else
                            <span class="label label-warning">Not updated yet</span>
                        @endif
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                             <button class="btn btn-xs btn-block rounded btn-info updatePlacementID" id="updatePlacementID" data-effect="mfp-zoom-in">Update</button> 
                            <input type="hidden" name="placementId" class="placementId" value="{{ $item->placementId }}">
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-xs btn-block rounded btn-danger" href="{{ url('college/delete-placement/') }}/{{ $item->placementId }}/{{ $slugUrl }}">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </div>
@else
    <h5>No placement listed.</h5>
@endif

<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewPlacement"><i class="fa fa-plus"></i>Add New Placement Record</button></div>

{!! Form::open(['url' => '/college-placement-created', 'class' => 'form-horizontal placementForm', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!} <!-- , 'style' => 'visibility: hidden' -->
    <input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
    <div class="row">
        <div class="col-md-12">
            <h4 class="headline">Placement Information</h4>
        </div>
    </div>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <label>Placement Description </label>
            {!! Form::textarea('placementinfo', null, ['class' => 'form-control', 'placeholder' => 'Please enter placement info here' ]) !!}
        </div>
    </div>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-6">
            <label>Number Of Recruiting Companies</label>
            {!! Form::text('numberofrecruitingcompany', null, ['class' => 'form-control', 'placeholder' => 'Please enter number of recruiting companies here',  'data-parsley-type'=>'number','data-parsley-error-message' => 'Please enter number of recruiting companies here', 'data-parsley-trigger'=>'change']) !!}
        </div>
        <div class="col-md-6">
            <label>Number Of Placements & Year</label>
            {!! Form::text('numberofplacementlastyear', null, ['class' => 'form-control', 'placeholder' => 'Please enter number of placements & year here','data-parsley-error-message' => 'Please enter number of placements & Year here', 'data-parsley-trigger'=>'change']) !!}
        </div>
    </div>
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-4">
            <label>CTC Highest </label>
            {!! Form::text('ctchighest', null, ['class' => 'form-control', 'placeholder' => 'Please enter CTC highest here', 'data-parsley-pattern'=> '^[0-9a-zA-Z\s .,]*$','data-parsley-error-message' => 'Please enter CTC highest here', 'data-parsley-trigger'=>'change']) !!}
        </div>
        <div class="col-md-4">
            <label>CTC Lowest </label>
            {!! Form::text('ctclowest', null, ['class' => 'form-control', 'placeholder' => 'Please enter CTC lowest here', 'data-parsley-pattern'=> '^[0-9a-zA-Z\s,.]*$','data-parsley-error-message' => 'Please enter CTC lowest here', 'data-parsley-trigger'=>'change']) !!}
        </div>
        <div class="col-md-4">
            <label>CTC Average </label>
            {!! Form::text('ctcaverage', null, ['class' => 'form-control', 'placeholder' => 'Please enter CTC average here', 'data-parsley-pattern'=> '^[0-9a-zA-Z\s.,]*$','data-parsley-error-message' => 'Please enter CTC average here', 'data-parsley-trigger'=>'change']) !!}
        </div>
    </div>
    <hr>
    <div class="row padding-top15 padding-bottom5">
        <div class="col-md-12 col-lg-12 text-center">
            <button class="btn-u" id="btnSubmit" type="submit">Submit</button>
        </div>
    </div>
{!! Form::close() !!}


{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
  $('form').parsley();
</script>
<script type="text/javascript">
    //---------------- Ajax Call for Scholarship modal-------------------------------------------------------//
    $('.updatePlacementID').click(function(){
        var placementId = $(this).next('.placementId').val();
        var slugUrl = "{!! $slugUrl !!}";
        $.ajax({
            type: "GET",
            url: '/placementUpdatePartial',
            data: {
                placementId: placementId,
                slugUrl: slugUrl,
            },
            success: function(data){
                $.magnificPopup.open({
                    type: 'inline',
                    items: {
                        src: data
                    },
                    closeOnContentClick : false, 
                    closeOnBgClick :true, 
                    showCloseBtn : false, 
                    enableEscapeKey : false,
                    closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)">   </button>'
                })
            }
        });
    });
    //---------------- Ajax Call for Scholarship modal-------------------------------------------------------//
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
<script type="text/javascript">
    var minimized_elements = $('span.minimize2');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 350) return;
        
        $(this).html(
            t.slice(0,350)+'<span>... </span><a href="#" class="more">More</a>'+
            '<span style="display:none;">'+ t.slice(350,t.length)+' <a href="#" class="less">Less</a></span>'
        );
        
    }); 
    
    $('a.more', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).hide().prev().hide();
        $(this).next().show();        
    });
    
    $('a.less', minimized_elements).click(function(event){
        event.preventDefault();
        $(this).parent().hide().prev().show().prev().show();    
    });
</script>