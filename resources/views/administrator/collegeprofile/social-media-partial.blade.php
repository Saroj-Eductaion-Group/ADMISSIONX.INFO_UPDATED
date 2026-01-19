<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
    <div class="row padding-top5 padding-bottom5">
        <div class="col-md-12">
            <div class="headline"><h2>Social Link Management</h2></div>
        </div>
    </div>
    <div class="row margin-bottom10">
        <div class="col-md-12">
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
        </div>
    </div>
</div>