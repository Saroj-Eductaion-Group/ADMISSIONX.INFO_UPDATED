<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<!-- <h2 class="heading-md text-center text-green"><a class="hover-effect" href="">Manage your document description details</a></h2> -->
		<form method="POST" action="/college-document-caption-update" data-parsley-validate>
			<input type="hidden" name="documentId" value="{{ $documentId }}">
			<input type="hidden" name="slugUrl" value="{{ $slugUrl }}">
			<div class="row padding-top5 padding-bottom5">
		    	<div class="col-md-12">
		            <textarea class="form-control" name="description" rows="8" maxlength="700" data-parsley-error-message = "Please enter the  description not more than 700 characters" data-parsley-trigger="change" id="counttextarea">{{ $description }}</textarea>
		            <div class="text-danger">
						<span name="countchars" id="countchars"></span> Characters Remaining. <span name="percent" id="percent"></span>
					</div> 
		        </div>
		    </div>

			<div class="row padding-top5 padding-bottom5">
				<div class="col-md-12 col-lg-12 text-right">
					<a href="javascript:void(0);" id="clearNow" class="btn-u btn-u-red">Clear</a>
					<button class="btn-u" type="submit">Submit</button>
				</div>
			</div>
	    </form>
	</div>
</div>


<script type="text/javascript">
	$('#clearNow').on('click', function(){
		$('textarea').val(' ');

	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		var totalChars 		= 700; //Total characters allowed in textarea
		var countTextBox 	= $('#counttextarea') // Textarea input box
		var charsCountEl 	= $('#countchars'); // Remaining chars count will be displayed here
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