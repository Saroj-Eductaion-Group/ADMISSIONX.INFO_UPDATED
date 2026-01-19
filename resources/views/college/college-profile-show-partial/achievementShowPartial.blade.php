{!! Html::style('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.css') !!}
{!! Html::style('home-layout/assets/css/pages/blog_masonry_3col.css') !!}


<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
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
        @if( $getOldUploadedImages )
        <div class="col-md-12">
            <div class="headline"><h4>Awards &amp; Achivements Photos</h4></div>
            <div class="row">
                @foreach( $getOldUploadedImages as $item )
                    @if( $item['documentsName'] )
                        @if( $item['documentsName'] != 'no-image-upload' )
                            @if( $item['ext'] != 'pdf' )
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blockOnGalleryImg" style="background-image: url('{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}');">
                                        <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" rel="gallery" class="fancybox img-hover-v1" title="">
                                            <span><img class="visibilityHiddenBlock" src="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" alt="" ></span>
                                        </a>    
                                    </div>                  
                                </div>
                            @else
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blockOnGalleryImg" style="background-image: url('{{asset('assets/images/pdf.png') }}');">
                                        <a href="{{asset('document/')}}/{{ $slugUrl }}/{{ $item['documentsName'] }}" target="_blank" title="Click to view">
                                            <img class="" src="{{asset('assets/images/pdf.png') }}" alt="{{ $item['documentsName'] }}" width="160" height="160">    
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
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(0,t.length)+'<br> <a href="#" class="less">Hide</a></span>'
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

<script type="text/javascript">
    var minimized_elements = $('span.minimizeDesc');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 100) return;
        
        $(this).html(
            t.slice(0,100)+'<span></span> <a href="#" class="more">View</a>'+
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(100,t.length)+' <br><a href="#" class="less">Hide</a></span>'
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