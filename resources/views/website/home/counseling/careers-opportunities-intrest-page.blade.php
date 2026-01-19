@extends('website/new-design-layouts.master')

@section('content')

<!-- choose stream start -->
<div class="chooseStreamMain">
	<div class="container">
		<div class="chooseStreamTop">
			<div class="row">
				<div class="col-md-12">
					<div class="choosestreamScience">
						<h2>Your stream:
							<span>{{ ucfirst($stream) }}</span>
							&nbsp;&nbsp;
							<a href="{{ URL::to('/careers/opportunities/') }}" style="color: blue;">Change Stream click here</a>
						</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="chooseWhatNext">
						<h2>What's Next</h2>
						<!-- <p>What are your career interests? Max 2 choices:</p> -->
						<p style="line-height: 20px;">Thinking? Which is the best career for you after 12 completion? Then select from below minimum 1 and maximum 2 careers interest, to find the best career options for you.</p>					
					</div>
				</div>
			</div>
			<div class="row padding-top30">
				<div class="col-md-8">
					<div class="chooseStreamMech">
						@foreach($counselingcareerinterests as $key => $item)
						<div class="row">
							<div class="col-md-4">
								@if(!empty($item->image))
	      							<img class="" src="/counselingimages/{{ $item->image }}" alt="{{ $item->title }}" style="width:100%;">
	      						@else
									<img src="/assets/images/no-college-logo.jpg" style="width:100%;" alt="{{ $item->title }}">
	          					@endif
							</div>
							{{--*/   
									$orientation = 'max-height: 145px; width: 233px;';
									if(!empty($item->image)){
		      							$imagePath = "/counselingimages/".$item->image;
		      							$filename = public_path().'/counselingimages/'.$item->image;
										if (file_exists($filename)) {
											list($width, $height) = getimagesize($filename);
											//echo "width:-".$width; echo "<br>"; echo "height:- ".$height; echo "<br>";
											if ($width > $height) {
								                //echo "landscape mode";
											 	$orientation  = 'max-height: 145px; width: 233px;';
								            } else if ($width < $height) {
								                //echo "portrait mode";
												$orientation  = 'max-height: 145px; width: 233px; object-fit: contain !important; background: #dcdcdc !important;';
								            } else {
								                $orientation = 'max-height: 145px; width: 233px;';
								            }
			                            }
									}else{
										$imagePath = "/assets/images/no-college-logo.jpg";
									}

			                	/*--}}
							<div class="col-md-8">
								<div class="mechBusiness  padding-left20">
									<div class="chiller_cb">
									    <input class="ads_Checkbox" streamslug="{{$item->slug}}" stream="{{$item->title}}" checkBoxCountVal="{{$item->id}}" image="{{ $imagePath }}" orientation="{{$orientation}}" data-parsley-maxcheck="2" data-parsley-mincheck="1" name="sample[]" value="{{$item->id}}" id="myCheckboxone{{$key}}" type="checkbox">
									    <label for="myCheckboxone{{$key}}" class="selectmyCheckboxOne">

									    {{$item->title}}</label>
									    <span></span>
									</div>
									<p class="padding-top10">{{ str_limit(strip_tags($item->description), 200) }}</p>
								</div>
							</div>
						</div>
						<hr>
						@endforeach
					</div>
				</div>
				<div class="col-md-4">
					<div class="yourSelectionRight">
						<div class="yourSelectionTop">
							<h2>Your Selection</h2>
							<div class="chooseStreamSection"></div>
							<div class="selectionBox1 yourSelectionChoice padding-bottom30">
								<h3>1st Choice</h3>
								<div class="yourSelectionbox">
									<img class="prevImg" id="imgview1" style="max-height: 145px; width: 233px;" src="/assets/images/no-college-logo.jpg" alt="first image">
								</div>
							</div>
							<div class="selectionBox2 yourSelectionChoice padding-bottom30">
								<h3>2nd Choice (Optional)</h3>
								<div class="yourSelectionbox">
									<img class="prevImg" id="imgview2" style="max-height: 145px; width: 233px;" src="/assets/images/no-college-logo.jpg" alt="second image">
								</div>
							</div>
							<div class="yourSelectioncontinue">
								<a href="javascript:void(0);" id="selectMultipleProduct" >Continue</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end choose stream -->
@endsection

@section('scripts')
	<script type="text/javascript">
		var count = 0;
    	/*$('.ads_Checkbox').on('change', function() {
		   	if ($(this).is(':checked') && $('.ads_Checkbox:checked').length <= 2) {
	            count++;
	            var checkBoxCountVal = $(this).attr('checkBoxCountVal');
	            var imageUrl = $(this).attr('image');
	            var orientation = $(this).attr('orientation');
    			$('#imgview'+count).attr('class', 'prevImg'+count);
	            $('#imgview'+count).attr('style', orientation);
	            $('.ads_Checkbox:checked').attr('checkBoxCountVal', count);
    			$('#imgview'+count).attr('src', imageUrl);
	        }else if ($(this).is(':unchecked') && $('.ads_Checkbox:checked').length < 2) {
	        	var checkBoxCountVal = $(this).attr('checkBoxCountVal');
	            $('.prevImg'+checkBoxCountVal).attr('style', '');
    			$('.prevImg'+checkBoxCountVal).attr('src', '');
	            count--;
	        }
			
			if($('.ads_Checkbox:checked').length > 2) {
				this.checked = false;
			}
	        alert(count);
		});*/

		$('.ads_Checkbox').on('change', function() {
		   	if ($(this).is(':checked') && $('.ads_Checkbox:checked').length <= 2) {
	            count++;
	            var checkBoxCountVal = $(this).attr('checkBoxCountVal');
	            var imageUrl = $(this).attr('image');
	            var orientation = $(this).attr('orientation');
	            var stream = $(this).attr('stream');
    			var HTML = ''+
    					'<div class="yourSelectionChoice choiceBox'+checkBoxCountVal+' padding-bottom30">'+
							'<h3>Careers in '+stream+'</h3>'+
							'<div class="yourSelectionbox">'+
								'<img style="'+orientation+'" src="'+imageUrl+'">'+
							'</div>'+
						'</div>'
               // $('.selectionBox1').addClass('hide');
        		$('.chooseStreamSection').append(HTML);
	        }else if ($(this).is(':unchecked') && $('.ads_Checkbox:checked').length < 2) {
	         	var checkBoxCountVal = $(this).attr('checkBoxCountVal');
	      		$('.choiceBox'+checkBoxCountVal).remove();
	      		count--;
	        }

	        if (count == 0) {
	        	$('.selectionBox1').removeClass('hide');
	        	$('.selectionBox2').removeClass('hide');
	        }

	        if (count == 1) {
	        	$('.selectionBox1').addClass('hide');
	        	$('.selectionBox2').removeClass('hide');
	        }

	        if (count == 2) {
	        	$('.selectionBox2').addClass('hide');
	        }
			if($('.ads_Checkbox:checked').length > 2) {
				this.checked = false;
			}
		});

		$(document).ready(function(){
	        $('#selectMultipleProduct').on('click', function(){
	            var userListId = $('.ads_Checkbox:checked').map(function () {
	                 return $(this).attr('streamslug');
	            }).get();
	            if (userListId == '') {
	            	toastr.error("Not any career choice selected! Please select after submit.");
	            }else{
		            var stream =  "{!! $stream !!}";
		            window.location.href="/careers-opportunities/"+stream+"/?interests="+userListId;
	            }
	        });
	    });
	</script>
@endsection