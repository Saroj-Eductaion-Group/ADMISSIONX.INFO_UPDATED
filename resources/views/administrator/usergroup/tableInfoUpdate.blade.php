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
</style>
<div class="profile-edit tab-pane fade in active margin-top30 white-popup">
	<div class="detail-page-signup">
		<div>
			<form method="POST" action="/user-group-table-update" data-parsley-validate>
				<input type="hidden" name="usergroupsId" value="{{ $getTableInfoData->usergroupsId }}">
				<input type="hidden" name="slugUrl" value="{{ $getTableInfoData->slug }}">
				<div class="row padding-top5 padding-bottom5">
			     	<div class="col-md-2 col-sm-offset-10"><a href="{{ URL::to('/administrator/usergroup-table-info/'.$slugUrl) }}" class="close">X</a></div>
		     	</div>
		     	
		     	<div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >User Group Name : </label>
                    <div class="col-sm-9">
                        <h4>{{ $getTableInfoData->userGroupName }}</h4>
                    </div>
                </div>
                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Table Name : </label>
                    <div class="col-sm-9">
                        <h4>{{ $getTableInfoData->tableName }}</h4>
                    </div>
                </div>

                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Create Action : </label>
                    <div class="col-sm-9">
                        <select name="create" class="form-control" data-placeholder="Choose create option ..."  data-parsley-error-message=" Please select create " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->create_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->create_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif                            
                        </select>
                    </div>
                </div>

                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Update Action : </label>
                    <div class="col-sm-9">
                        <select name="edit" class="form-control" data-placeholder="Choose update option ..."  data-parsley-error-message=" Please select update " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->edit_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->edit_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif                            
                        </select>
                    </div>
                </div>

                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >List / Show Action : </label>
                    <div class="col-sm-9">
                        <select name="listOtherAction" class="form-control" data-placeholder="Choose create option ..."  data-parsley-error-message=" Please select index " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->index_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->index_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif                            
                        </select>
                    </div>
                </div>  

                 
                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Metrics 1 : </label>
                    <div class="col-sm-9">
                        <select name="metrics1" class="form-control" data-placeholder="Choose metrics 1 ..."  data-parsley-error-message=" Please select metrics 1 " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->metrics1_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->metrics1_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif
                        </select>
                    </div>
                </div>  
                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Metrics 2 : </label>
                    <div class="col-sm-9">
                        <select name="metrics2" class="form-control" data-placeholder="Choose metrics 2 ..."  data-parsley-error-message=" Please select metrics 2 " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->metrics2_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->metrics2_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif
                        </select>
                    </div>
                </div> 
                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Metrics 3 : </label>
                    <div class="col-sm-9">
                        <select name="metrics3" class="form-control" data-placeholder="Choose metrics 3 ..."  data-parsley-error-message=" Please select metrics 3 " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->metrics3_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->metrics3_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif
                        </select>
                    </div>
                </div> 
                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Metrics 4 : </label>
                    <div class="col-sm-9">
                        <select name="metrics4" class="form-control" data-placeholder="Choose metrics 4 ..."  data-parsley-error-message=" Please select metrics 4 " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->metrics4_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->metrics4_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif
                        </select>
                    </div>
                </div>     
                    
                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Metrics 5 : </label>
                    <div class="col-sm-9">
                        <select name="metrics5" class="form-control" data-placeholder="Choose metrics 5 ..."  data-parsley-error-message=" Please select metrics 5 " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->metrics5_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->metrics5_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Metrics 6 : </label>
                    <div class="col-sm-9">
                        <select name="metrics6" class="form-control" data-placeholder="Choose metrics 6 ..."  data-parsley-error-message=" Please select metrics 6 " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->metrics6_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->metrics6_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif
                        </select>
                    </div>
                </div>             
                <div class="row padding-top5 padding-bottom5">
                    <label class="col-sm-3 control-label" >Queries : </label>
                    <div class="col-sm-9">
                        <select name="queries" class="form-control" data-placeholder="Choose Queries ..."  data-parsley-error-message=" Please select Queries " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $getTableInfoData->queries_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $getTableInfoData->queries_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif
                        </select>
                    </div>
                </div>  
			    <div class="row padding-top5 padding-bottom5">
                    <div class="col-sm-offset-8 col-sm-2 text-right">
                        <a href="{{ URL::to('/administrator/usergroup-table-info/'.$slugUrl) }}" class="btn btn-default btn-sm form-control">Close</a>
                    </div>
                    <div class="col-sm-2">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </div>
			</form>			
		</div>
	</div>
</div>

