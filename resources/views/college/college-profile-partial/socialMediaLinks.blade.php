<style type="text/css">
.rating_reviews_info{background-color: #fbfbfb; border: 1px solid #e4e4e4;border-radius: 10px;box-shadow: 2px 1px 2px 0px #eaeaea; margin: 20px 0;}
.rating_reviews_info h2{font-size: 22px;color: #f34a4e;font-weight: 600;letter-spacing: 2px;margin: 0px;padding: 0;font-family: 'Open Sans';}
.rating_reviews_info h3{color: #000;font-size: 16px;font-weight: 400;margin: 0;}
.rating_reviews_info p{color: #333;font-weight: 400;text-align: justify;font-family: 'Open Sans';}
</style>
<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <div class="headline"><h2>Social Link Management</h2><span class="pull-right"><a href="javascript:void(0);" class="btn btn-xs btn-danger closePartialBlade"><i class="fa fa-close"></i> Close</a></span></div>
        </div>
    </div>
    <div class="row margin-bottom10">
        <form method="POST" class="profileUpdateNow1" action="/update-social-link-management-partials" data-parsley-validate  enctype="multipart/form-data">
            <div class="col-md-12">
                <input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="tableSocialSection">
                        @if(sizeof($socialMediaLinksDataObj) > 0)
                            @foreach($socialMediaLinksDataObj as $key => $item1)
                            <input type="hidden" name="collegeSocialMediaLinkId[]" value="{{$item1->collegeSocialMediaLinkId}}">
                                <tr>
                                    <td>
                                        <input class="form-control" type="hidden" name="socialId[]" value="{{$key}}">
                                        @if($key == 0)
                                            <label>Facebook</label>
                                            <input type="hidden" name="title[]" value="{{ $item1->title }}">
                                        @elseif($key == 1)
                                            <label>Twitter</label>
                                            <input type="hidden" name="title[]" value="{{ $item1->title }}">
                                        @elseif($key == 2)
                                            <label>Instagram</label>
                                            <input type="hidden" name="title[]" value="{{ $item1->title }}">
                                        @elseif($key == 3)
                                            <label>Pinterest</label>
                                            <input type="hidden" name="title[]" value="{{ $item1->title }}">
                                        @elseif($key == 4)
                                            <label>Linkedin</label>
                                            <input type="hidden" name="title[]" value="{{ $item1->title }}">
                                        @elseif($key == 5)
                                            <label>Youtube</label>
                                            <input type="hidden" name="title[]" value="{{ $item1->title }}">
                                        @endif
                                    </td>
                                    <td width="60%">
                                        <input class="form-control url" type="url" name="url[]" placeholder="Enter url here"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid url" value="{{ $item1->url }}">
                                    </td>
                                    <td>
                                        <div class="radio radio-primary radio-inline">
                                            <input type="radio" id="isActive1{{$key}}" value="1" name="isActive{{$key}}" required="" data-parsley-error-message="Please select an option" @if($item1->isActive == 1) checked="" @endif>
                                            <label for="isActive1{{$key}}"> Active </label>
                                        </div>        
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="isActive2{{$key}}" value="0" name="isActive{{$key}}" required="" data-parsley-error-message="Please select an option" @if($item1->isActive == 0) checked="" @endif>
                                            <label for="isActive2{{$key}}"> Inactive </label>
                                        </div>
                                    </td>
                                </tr>    
                            @endforeach
                        @else
                            {{--*/ for($counter=0; $counter <=5; $counter++) { /*--}}
                            <tr>
                                <td>
                                    <input class="form-control" type="hidden" name="socialId[]" value="{{$counter}}">
                                    @if($counter == 0)
                                        <label>Facebook</label>
                                        <input type="hidden" name="title[]" value="Facebook">
                                    @elseif($counter == 1)
                                        <label>Twitter</label>
                                        <input type="hidden" name="title[]" value="Twitter">
                                    @elseif($counter == 2)
                                        <label>Instagram</label>
                                        <input type="hidden" name="title[]" value="Instagram">
                                    @elseif($counter == 3)
                                        <label>Pinterest</label>
                                        <input type="hidden" name="title[]" value="Pinterest">
                                    @elseif($counter == 4)
                                        <label>Linkedin</label>
                                        <input type="hidden" name="title[]" value="Linkedin">
                                    @elseif($counter == 5)
                                        <label>Youtube</label>
                                        <input type="hidden" name="title[]" value="Youtube">
                                    @endif
                                </td>
                                <td width="60%">
                                    <input class="form-control url" type="url" name="url[]" placeholder="Enter url here"  data-parsley-trigger="change" data-parsley-error-message="Please enter valid url">
                                </td>
                                <td>
                                    <div>
                                        <div class="radio radio-primary radio-inline">
                                            <input type="radio" id="isActive1{{$counter}}" value="1" name="isActive{{$counter}}" required="" data-parsley-error-message="Please select an option" checked="">
                                            <label for="isActive1{{$counter}}"> Active</label>
                                        </div>        
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="isActive2{{$counter}}" value="0" name="isActive{{$counter}}" required="" data-parsley-error-message="Please select an option">
                                            <label for="isActive2{{$counter}}"> Inactive</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>    
                            {{--*/ } /*--}}
                        @endif
                    </tbody>
                </table>
                <div class="row padding-top5 padding-bottom5">
                    <div class="col-md-12 col-lg-12 text-center">
                        <button class="btn-u submitButton" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    //AJAX
    $( '.profileUpdateNow1' ).submit(function(e) {
        $('.updateProfileBlock').addClass('hide');
        e.preventDefault();
        var form = $(this).serialize();
        $.ajax({
            type: "POST",
            url: '{{ URL::to("/update-social-link-management-partials") }}',
            data: form,
            success: function(data){
                if( data.code =='200' ){
                    //window.location.reload();
                    $('.updateProfileBlock').removeClass('hide');
                    $('.updateProfileBlock .profileUpdateMessage').html(data.message);
                    $('#profileUpdate').modal({show: 'true'}); 
                }else{
                    $('.errorFacebookMsg').removeClass('hide');
                }
            }
        }); 
    });
</script>