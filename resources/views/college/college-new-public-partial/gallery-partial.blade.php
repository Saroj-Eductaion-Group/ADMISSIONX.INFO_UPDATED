<div class="school-info section">
    <div class="section-title">
        <h3>College Gallery</h3>
    </div>
    <div class="section-content">
        <div class="row">
            @if($collegeGalleryImagesObj)
                @foreach( $collegeGalleryImagesObj as $item )
                    @if(file_exists(public_path().'/gallery/'.$slugUrl.'/'.$item->fullimage))
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 margin-top10">
                        <div class="blockOnGalleryImg" style="background-image: url('{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->fullimage }}');">
                            <a href="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->fullimage }}" rel="gallery" class="fancybox img-hover-v1" title="{{ $item->caption }}">
                                <span><img class="visibilityHiddenBlock" src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->galleryName }}" alt="" ></span>
                            </a>    
                        </div>                  
                    </div>
                    @endif
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="headline text-center">
                        <h4>College hasn't uploaded their images.</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="school-info section">
    <div class="section-title">
        <h3>College Videos</h3>
    </div>
    <div class="section-content">
        <div class="row">
            @if($getOldUploadedVideos)
                <div class="col-md-12">
                    @foreach( $getOldUploadedVideos as $item )
                        <div class="col-md-4 margin-top20">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/{{ $item->galleryName }}" border="1"></iframe>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-md-12">
                    <div class="headline text-center">
                        <h4>College hasn't uploaded their videos.</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="school-info section">
    <div class="section-title">
        <h3>College Awards &amp; Achivements Description</h3>
    </div>
    <div class="section-content">
        <div class="row">
            @if( $getOldUploadedDescription )
                <div class="col-md-12">
                    @foreach( $getOldUploadedDescription as $item )
                        <h5 class="clientContactDetails"><span class="minimizeDesc">{{ $item->description }} </span></h5>
                        <hr class="margin0">
                    @endforeach
                </div>        
            @else
                <div class="col-md-12">
                    <div class="headline text-center">
                        <h4>College hasn't uploaded their awards &amp; achivements description.</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="school-info section">
    <div class="section-title">
        <h3>College Awards &amp; Achivements Photos</h3>
    </div>
    <div class="section-content">
        <div class="row">
            @if( $getOldUploadedImagesAtt )
                @foreach( $getOldUploadedImagesAtt as $item )
                    @if(file_exists(public_path().'/document/'.$slugUrl.'/'.$item['documentsName']))
                        @if( $item['documentsName'] )
                            @if( $item['documentsName'] != 'no-image-upload' )
                                @if( $item['ext'] != 'pdf' )
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 margin-top10">
                                        <div class="blockOnAttachmentImg" style="background-image: url('{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}');">
                                            <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" rel="gallery" class="fancybox img-hover-v1" title="">
                                                <span><img class="visibilityHiddenBlock" src="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" alt="{{ $item['documentsName'] }}" ></span>
                                            </a>    
                                        </div>                  
                                    </div>
                                @else
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 margin-top10">
                                        <div class="blockOnAttachmentImg" style="background-image: url('{{asset('assets/images/pdf.png') }}');">
                                            <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" target="_blank" title="Click to view">
                                                <img class="visibilityHiddenBlock" src="{{asset('assets/images/pdf.png') }}" alt="{{ $item['documentsName'] }}" width="160" height="160">    
                                            </a> 
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endif
                @endforeach    
            @else
                <div class="col-md-12">
                    <div class="headline text-center">
                        <h4>College hasn't uploaded their documents yet.</h4>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>