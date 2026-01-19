{!! Html::style('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.css') !!}
{!! Html::style('home-layout/assets/css/pages/blog_masonry_3col.css') !!}
<style type="text/css">
    .blockOnGalleryImg{  height: 180px;   max-height: 180px;    background-repeat: no-repeat;   background-size: cover;   background-position: center;    border-radius: 4px 4px 0 0;    border: 1px solid #dfdfdf;    margin: 5px;     }
    .visibilityHiddenBlock{visibility: hidden !important;}
    .blockOnAttachmentImg{height: 60px;width: 60px;background-size: contain;background-position: center;background-color: #f9f9f9;border-radius: 10px;}
</style>
<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
	<div class="detail-page-signup">
        <div class="row padding-top5 padding-bottom5">
            <div class="col-md-12">
                <div class="headline"><h2>Gallery</h2></div>
            </div>
        </div>
        <div class="row  parent-container-images">
    		@if( $getOldUploadedImages )
    			@foreach( $getOldUploadedImages as $item )
    				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 margin-top10">
    					<a class="" href="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->fullimage }}">
                            <div class="blockOnGalleryImg" style="background-image: url('{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->fullimage }}');">
        						<!-- <a href="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->fullimage }}" rel="gallery" class="fancybox img-hover-v1" title="{{ $item->caption }}">
        							<span><img class="visibilityHiddenBlock" src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->galleryName }}" alt="" ></span>
        						</a>	 -->

                                <img class="visibilityHiddenBlock" src="{{asset('gallery/')}}/{{ $slugUrl }}/{{ $item->galleryName }}">
        					</div>
                        </a>			
    				</div>
    			@endforeach
    		@else
    		<div class="row">
    			<div class="col-md-12">
    				<div class="headline text-center">
    					<h4>College hasn't uploaded their images.</h4>
    				</div>
    			</div>
    		</div>
    		@endif


    		@if( $getOldUploadedVideos )
    		<div class="row">
    			<hr>
    			<div class="col-md-12">
    				<div class="headline">
    					<h4>Manage your videos</h4>
    				</div>
    				@foreach( $getOldUploadedVideos as $item )
    					<div class="col-md-4 margin-top20">
    						<div class="embed-responsive embed-responsive-16by9">
    						    <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/{{ $item->galleryName }}" border="1"></iframe>
    					    </div>
    					</div>
    				@endforeach
    			</div>
    		</div>
    		@endif
    	</div>	
    </div>
	<!-- ATTACHMENTS -->
	@if( $getOldUploadedDescription )
    <div class="row detail-page-signup margin-bottom40">        
        <div class="col-md-12">
            <div class="headline"><h4>Awards &amp; Achivements Description</h4></div>
            @foreach( $getOldUploadedDescription as $item )
                    <h5><span class="minimizeDesc">{{ $item->description }} </span></h5>
                    <hr class="margin0">
                @endforeach
        </div>        
    </div>
    @endif

    <div class="row detail-page-signup">
        @if( $getOldUploadedImagesAtt )
        <div class="col-md-12">
            <div class="headline"><h4>Awards &amp; Achivements Photos</h4></div>
            <div class="row">
                @foreach( $getOldUploadedImagesAtt as $item )
                    @if( $item['documentsName'] )
                        @if( $item['documentsName'] != 'no-image-upload' )
                            @if( $item['ext'] != 'pdf' )
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blockOnAttachmentImg" style="background-image: url('{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}');">
                                        <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" rel="gallery" class="fancybox img-hover-v1" title="">
                                            <span><img class="visibilityHiddenBlock" src="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" alt="" ></span>
                                        </a>    
                                    </div>                  
                                </div>
                            @else
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blockOnAttachmentImg" style="background-image: url('{{asset('assets/images/pdf.png') }}');">
                                        <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" target="_blank" title="Click to view">
                                            <img class="visibilityHiddenBlock" src="{{asset('assets/images/pdf.png') }}" alt="{{ $item['documentsName'] }}" width="160" height="160">    
                                        </a> 
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-12">
                <div class="headline text-center">
                    <h4>College hasn't uploaded their documents yet.</h4>
                </div>
            </div>
        </div>  
        @endif
    </div>
</div>

{!! Html::script('assets/administrator/js/jquery-2.1.1.js') !!}
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
{!! Html::script('home-layout/assets/js/plugins/fancy-box.js') !!}

{!! Html::script('home-layout/assets/plugins/masonry/jquery.masonry.min.js') !!}
{!! Html::script('home-layout/assets/js/pages/blog-masonry.js') !!}


<script type="text/javascript">
	jQuery(document).ready(function() {
		FancyBox.initFancybox();
	});
</script>

<script type="text/javascript">
    var minimized_elements = $('span.minimize');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 0) return;
        
        $(this).html(
            t.slice(0,0)+'<span></span><a href="#" class="more">View</a>'+
            '<span style="display:none; word-break: break-all !important;">'+ t.slice(0,t.length)+'<br><a href="#" class="less">Hide</a></span>'
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
    $('.parent-container-images').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
            // options for gallery
            enabled: true
        },
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it
            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
</script>