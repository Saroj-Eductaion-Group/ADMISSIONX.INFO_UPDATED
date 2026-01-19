@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>User Group Details <!-- <a href="{{ url('administrator/usergroup/addtable') }}" class="btn btn-primary pull-right btn-sm">Add New Table</a> -->
        <a class="btn btn-primary pull-right btn-sm"  data-toggle="modal" data-target="#userGroupAddTableModal" data-whatever="" href="">Add New Table</a>
        </h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Here are the details</h5>                            
            </div>
            <div class="ibox-content table-responsive">
                <div class="row">
                   <!-- <div class=""><a href="{{ url('administrator/usergroup') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a></div> -->
                </div>
                <br />
               <div class="row">
                    <div class="col-md-7 col-md-offset-3">
                        @if(Session::has('userGroupUpdate'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{ Session::get('userGroupUpdate') }}</strong>
                            </div>                        
                        @endif
                    </div>    
                </div>
                <div class="row">
               	 @foreach($userGroupNameObj as $item)
                    <div class="col-md-6">
                       <h3>User Group Name : {{ $item->userGroupName }}</h3>
                    </div> 
                   <div class="col-md-6">
                       <h3>User Name : {{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</h3>
                   </div>
                  @endforeach
                </div>
                

                <div class="ibox float-e-margins">
		            <div class="ibox-content">
		               <table class="table table-hover">
		                    <thead>
		                        <tr>
		                            <th>S.No</th>
		                            <th>Table Name</th>
		                            <th>Last Updated By</th>
		                            <th>Actions</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        @foreach($usergroupdetails as $item)
		                        <tr>
		                            <td><a href="{{ url('administrator/usergroup', $item->id) }}">{{ $item->id }}</a></td>
		                            <td><a href="{{ url('administrator/usergroup', $item->id) }}">{{ $item->tableName }}</a></td>
		                            <td>
		                                @if($item->eUserId)
		                                <a href="{{ url('administrator/users', $item->eUserId) }}">{{ $item->employeeFirstname }} {{ $item->employeeMiddlename}} {{ $item->employeeLastname}} (ID:- {{ $item->eUserId}}) Date & Time:-  {{ $item->updated_at}}</a>
		                                @else
		                                    <span class="label label-warning">Not Updated Yet</span>
		                                @endif
		                            </td>
		                            <td>
		                            	<button class="btn btn-xs rounded btn-info" id="updateTableInfoID" data-effect="mfp-zoom-in">Update</button>
										<input type="hidden" name="tableInfoId" class="tableInfoId" value="{{ $item->id }}">
										<input type="hidden" name="slugUrl" class="slugUrl" value="{{ $item->slugUrl }}"> / 
		                                {!! Form::open([
		                                    'method'=>'DELETE',
		                                    'url' => ['administrator/usergroup', $item->id],
		                                    'style' => 'display:inline'
		                                ]) !!}
		                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
		                                {!! Form::close() !!}
		                            </td>                          
		                        </tr>

		                        <div class="modal fade" id="userGroupAddTableModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
								    <div class="modal-dialog" role="document">
								        <div class="modal-content">
								            <form method="POST" action="/administrator/usergroup-add-table" data-parsley-validate>
								                <div class="modal-header modal-header-design" style="background: #18BA98;">
								                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								                    <h4 class="modal-title" id="exampleModalLabel" style="color: #fff;">Update Group Name</h4>
								                </div>
								                <div class="modal-body">
								                    <div class="row padding-top5 padding-bottom5">
								                        <input type="hidden" name="groupName" value="{{ $item->userGroupName }}">
								                        <input type="hidden" name="slugUrlName" value="{{ $item->slugUrl }}">
								                        <div class="col-md-12">
								                            <label>Group Name : {{ $item->userGroupName }}</label>
								                        </div>
								                        <div class="form-group">        
										                    <label class="col-sm-3 control-label" >Table Name : </label>
										                    <div class="col-sm-9">
										                        <select class="form-control " name="allTableInformation_id[]" multiple="" placeholder ="Select table name here" data-parsley-error-message="Please select table name" data-parsley-trigger="change" required="">
										                            @foreach($allTableInfoObj as $item)
										                                <option value="{{ $item->id }}">{{ $item->name }}</option>
										                            @endforeach
										                        </select>                            
										                    </div>
										                </div>
								                    </div>
								                    <div class="row padding-top5 padding-bottom5">
                                                        <div class="col-sm-offset-10 col-sm-2 text-right">
                                                            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                                                        </div>
                                                    </div>
								                </div>
								            </form>
								        </div>
								    </div>
								</div>
		                        @endforeach
		                    </tbody>
		                </table>
		            </div>
		        </div>
               
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('table > tbody tr > td > #updateTableInfoID').click(function(){
   		var tableInfoId = $(this).next('.tableInfoId').val();
   		var slugUrl = "{!! $slugUrl !!}";
	    $.ajax({
	        type: "GET",
	        url: '/updateTableInfo',
	        data: {
	            tableInfoId: tableInfoId,
	            slugUrl: slugUrl,
	        },

	        success: function(data){
	            $.magnificPopup.open({
	                type: 'inline',
	                items: {
	                    src: data
	                },
	                closeOnContentClick : false, 
			        closeOnBgClick :false, 
			        showCloseBtn : false, 
			        enableEscapeKey : true,
			        closeMarkup: '<button class="mfp-close mfp-new-close" type="button" title="Close (Esc)"> { costume button with close icon image } </button>'
	            })
	        }
	    });
	});
}); 
	
</script>


@endsection
