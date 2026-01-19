{!! Html::style('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.css') !!}
{!! Html::style('home-layout/assets/css/pages/blog_masonry_3col.css') !!}


<div class="profile-edit tab-pane fade in active tag-box tag-box-v7">
    <div class="row detail-page-signup margin-bottom40">
        @if( $getOldUploadedDescription )
        <div class="col-md-12">
            <div class="headline"><h4>Project Description</h4></div>
            @foreach( $getOldUploadedDescription as $item )
                <h5><span class="minimizeDesc">{{ $item->description }} </span></h5>
                <hr class="margin0">
            @endforeach
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