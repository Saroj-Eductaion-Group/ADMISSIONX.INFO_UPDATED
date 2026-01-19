{!! Html::style('assets/plugins/magnific-popup/magnific-popup.css') !!}
{!! Html::style('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.css') !!}
<style type="text/css">
    /* text-based popup styling */
    .white-popup {
      position: relative;
      background: #FFF;
      padding: 25px;
      width: auto;
      max-width: 800px;
      margin: 0 auto;
    }

    /* 

    ====== Zoom effect ======

    */
    .mfp-zoom-in {
      /* start state */
      /* animate in */
      /* animate out */
    }
    .mfp-zoom-in .mfp-with-anim {
      opacity: 0;
      transition: all 0.2s ease-in-out;
      transform: scale(0.8);
    }
    .mfp-zoom-in.mfp-bg {
      opacity: 0;
      transition: all 0.3s ease-out;
    }
    .mfp-zoom-in.mfp-ready .mfp-with-anim {
      opacity: 1;
      transform: scale(1);
    }
    .mfp-zoom-in.mfp-ready.mfp-bg {
      opacity: 0.8;
    }
    .mfp-zoom-in.mfp-removing .mfp-with-anim {
      transform: scale(0.8);
      opacity: 0;
    }
    .mfp-zoom-in.mfp-removing.mfp-bg {
      opacity: 0;
    }
</style>

<div class="profile-edit tab-pane fade in active">
    <!-- <h2 class="heading-md text-center">Manage your awards &amp; achivements details</h2> -->
    <br>
    
    <div class="row detail-page-signup margin-bottom40">
        <div class="col-md-12">
            <div class="headline"><h4>Project Description</h4></div>
            @if( $getOldUploadedDescription )
                @foreach( $getOldUploadedDescription as $item )
                    <h5>
                    	<span class="minimizeDesc">{{ $item->description }} </span> 
                    	<span class="pull-right"> 
                    		<a class="hover-effect" id="addACaptionDocument" href="javascript:void(0);">
	                    		@if( $item->description )
	                    			<i class="fa fa-pencil"></i>  
	                    		@else 
	                    			<i class="fa fa-plus"></i> 
	                    		@endif 
	                    	</a> 
	                    	<input type="hidden" name="documentId" id="documentId" value="{{ $item->documentsId }}">
	                    	<input type="hidden" name="description" id="description" value="{{ $item->description }}">/ <a class="btn-more hover-effect" href="{{ url('student/delete-project-description/') }}/{{ $item->documentsId }}/{{ $slugUrl }}"><i class="fa fa-trash-o"></i></a>
	                    </span>
                    </h5>
                    <hr class="margin0">
                @endforeach
            @else
                <h5>Not updated yet</h5>
            @endif
        </div>
    </div>

    <div class="row detail-page-signup">
       
        <div class="col-md-12">         
            <div class="row">
                <div class="col-md-12">
                    <div class="heading heading-v4 margin-bottom-40">
                        <small>Update small description about your project's.</small>
                        {!! Form::open(['url' => 'student/updatecollege-project-desc', 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                        <input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
                        {!! Form::textarea('description', null, ['class' => 'form-control fromDesc', 'placeholder' => 'Enter project description here', 'data-parsley-error-message' => 'Please enter project description here', 'required' => '', 'maxlength' => '1000','id'=>'counttextarea']) !!}
                       <!--  <p class="text-danger">(Maximum character limit 1000)</p> -->
                        <div class="text-danger">
                            <p class="text-danger">(Maximum character limit 1000)</p><span name="countchars" id="countchars"></span> Characters Remaining. <span name="percent" id="percent"></span>
                        </div> 
                        <p class="text-center"><button class="btn btn-sm btn-u margin-top10"><i class="fa fa-check"></i> Submit</button></p>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

{!! Html::script('assets/administrator/js/jquery-2.1.1.js') !!}
{!! Html::script('assets/plugins/magnific-popup/jquery.magnific-popup.js') !!}
{!! Html::script('home-layout/assets/css/plugins/fancybox/source/jquery.fancybox.pack.js') !!}
{!! Html::script('home-layout/assets/js/plugins/fancy-box.js') !!}

<script type="text/javascript">
    jQuery(document).ready(function() {
        FancyBox.initFancybox();
    });
</script>


<script type="text/javascript">
    $('input[type="file"]').change(function () {
      $('#uploadFile').val($(this)[0].files.length+' file(s) selected');
    });
</script>


<script type="text/javascript">
    $('.thumbnails > .caption > h6 > #addACaptionDocument').on('click', function(){
        var documentId = $(this).next().val();
        var slugUrl = "{!! $slugUrl !!}";
        var description = $(this).next().next().val();
        $.ajax({
            type: "GET",
            url: '/documentPartialLoad',
            data: {
                documentId: documentId,
                slugUrl : slugUrl,
                description: description,
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
                    closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)"> { costume button with close icon image } </button>'
                })
            }
        });
    });

    $('h5 > span >  #addACaptionDocument').on('click', function(){
        var documentId = $(this).next().val();
        var slugUrl = "{!! $slugUrl !!}";
        var description = $(this).next().next().val();
        $.ajax({
            type: "GET",
            url: '/projectPartialLoad',
            data: {
                documentId: documentId,
                slugUrl : slugUrl,
                description: description,
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
                    closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)"> { costume button with close icon image } </button>'
                })
            }
        });
    });
</script>
{!! Html::script('assets/js/parsley.min.js') !!}
<script type="text/javascript">
  $('.fromDesc').parsley();
</script>

<script type="text/javascript">
    var minimized_elements = $('span.minimizeDesc');
    
    minimized_elements.each(function(){    
        var t = $(this).text();        
        if(t.length < 90) return;
        
        $(this).html(
            t.slice(0,90)+'<span></span> <a href="#" class="more">View</a>'+
            '<span style="display:none;word-break: break-all !important;">'+ t.slice(90,t.length)+' <br><a href="#" class="less">Hide</a></span>'
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
    $('#clearNow').on('click', function(){
        $('input[name=description]').val('');
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var totalChars      = 1000; //Total characters allowed in textarea
        var countTextBox    = $('#counttextarea') // Textarea input box
        var charsCountEl    = $('#countchars'); // Remaining chars count will be displayed here
        charsCountEl.text(totalChars); //initial value of countchars element
        countTextBox.keyup(function() { //user releases a key on the keyboard
            var thisChars = this.value.replace(/{.*}/g, '').length; //get chars count in textarea
            var per = thisChars*100; 
            var value= (per / totalChars); // total percent complete
            value = value.toFixed(2);
            if(thisChars > totalChars) //if we have more chars than it should be
            {
                var CharsToDel = (thisChars-totalChars); // total extra chars to delete
                this.value = this.value.substring(0,this.value.length-CharsToDel); //remove excess chars from textarea
            }else{
                charsCountEl.text( totalChars - thisChars ); //count remaining chars
                $('#percent').text(value +'%');
            }
        }); 
    });
</script>