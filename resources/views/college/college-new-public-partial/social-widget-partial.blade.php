<div class="school-info section margin-bottom30">
    @if( sizeof($getCollegeDetailObj) > 0 )
        @foreach( $getCollegeDetailObj as $getCollegeName )
        <div class="col-md-12 clientContactDetails">
            <div id="fb-root"></div>
            <div class="fb-page" data-href="{{ $getCollegeName->facebookurl }}" data-tabs="timeline" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="{{ $getCollegeName->facebookurl }}"><a href="{{ $getCollegeName->facebookurl }}">{{ $getCollegeName->firstname }}</a></blockquote></div></div>            
        </div>
        @endforeach
    @else
        <div class="col-md-12">
            <div class="headline text-center">
                <h4>College hasn't added their cut offs.</h4>
            </div>
        </div>
    @endif
</div>
<hr class="hr-gap">