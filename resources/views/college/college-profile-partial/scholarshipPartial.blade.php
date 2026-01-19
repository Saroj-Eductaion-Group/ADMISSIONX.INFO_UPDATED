<style type="text/css">
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
@if(sizeof($collegeScholarshipsDataObj) > 0 )
<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <div class="headline"><h2>Scholarship</h2></div>
        </div>
    </div>
    @foreach( $collegeScholarshipsDataObj as $key => $item )
    <div class="rating_reviews_info padding-top20 padding-bottom20 padding-left20 padding-right20">
        <div class="row margin-top10">
            <div class="col-md-10">
                <h2>{{$item->title}}</h2>
               <p>{!! $item->description !!}</p>
            </div>
            <div class="col-md-2">
                <button class="btn btn-xs rounded btn-info" id="updatecollegeScholarshipId" data-effect="mfp-zoom-in">Update</button>
                <input type="hidden" name="collegeScholarshipId" class="collegeScholarshipId" value="{{ $item->collegeScholarshipId }}"> <br> <a class="btn btn-xs rounded btn-danger" href="{{ url('college/delete-college-scholarship-details/') }}/{{ $item->collegeScholarshipId }}/{{ $slugUrl }}">Remove</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
    <h5>Scholarship not listed.</h5>
@endif


<div class="col-md-4 col-md-offset-4"><button class="btn btn-u" id="addNewScholarship"><i class="fa fa-plus"></i>Add New Scholarship</button></div>
{!! Form::open(['url' => '/college-scholarship-partial', 'class' => 'form-horizontal scholarshipForm', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!} <!-- , 'style' => 'visibility: hidden' -->
    <input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
    <div class="row">
        <div class="col-md-12">
            <h4 class="headline">Scholarship Information</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>Title</label>
            <input type="text" class="form-control" name="title" placeholder="Enter scholarship title" required="" data-parsley-error-message="Please enter scholarship title" value="">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>Description</label>
            <textarea class="form-control summernote" name="description" rows="8" data-parsley-error-message = "Please enter the scholarship description" data-parsley-trigger="change"></textarea>
        </div>
    </div>
    <div class="row padding-top15 padding-bottom5">
        <div class="col-md-12 col-lg-12 text-center">
            <button class="btn-u" id="btnSubmit" type="submit">Submit</button>
        </div>
    </div>
{!! Form::close() !!}

{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
    $('.picture').on('change',function(){
        $('#picture1').removeClass('hide');
    });
    $('#picture1').on('click',function(e){
        $('.picture').val('').trigger('chosen:updated');
        $('#picture1').addClass('hide');
    });

    $('input[name=picture]').change(function (e)
    {   
        var ext = $('input[name=picture]').val().split('.').pop().toLowerCase();
        if( ext == 'png' || ext == 'jpg' || ext == 'jpeg' ){
            $("input[name=picture]").parsley().reset();
        }else{
            $('input[name=picture]').val('');
            $("input[name=picture]").parsley().reset();
            return false;
        }
        //Disable input file
    });
</script>

<script type="text/javascript">
    //---------------- Ajax Call for Scholarship modal-------------------------------------------------------//
    $('#updatecollegeScholarshipId').click(function(){
        var collegeScholarshipId = $(this).next('.collegeScholarshipId').val();
        var slugUrl = "{!! $slugUrl !!}";
        $.ajax({
            type: "GET",
            url: '/scholarshipPartial',
            data: {
                collegeScholarshipId: collegeScholarshipId,
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