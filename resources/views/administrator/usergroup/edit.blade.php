@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update User Group <!-- <a href="{{ url('administrator/usergroup') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update user group details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($usergroup, ['method' => 'PATCH','url' => ['administrator/usergroup', $usergroup->id],'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    <label class="col-sm-3 control-label" >User Group Name : </label>
                    <div class="col-sm-9">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter user group name here', 'data-parsley-error-message' => 'Please enter user group here','data-parsley-trigger'=>'change', 'required' => '']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" >All Table Info Name : </label>
                    <div class="col-sm-9">
                        <select name="allTableInformation_id" class="form-control chosen-select" data-parsley-error-message=" Please select table name " data-parsley-trigger="change" required="">
                            <option disabled="" selected="">Select Table</option>
                            @foreach($allTableInfoObj as $item)
                                @if( $item->id == $usergroup->allTableInformation_id )
                                    <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>                         
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" >Create : </label>
                    <div class="col-sm-9">
                        <select name="create" class="form-control" data-placeholder="Choose create option ..."  data-parsley-error-message=" Please select create " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Create</option>
                            @if( $usergroup->create_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $usergroup->create_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif     
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" >Update Action : </label>
                    <div class="col-sm-9">
                        <select name="edit" class="form-control" data-placeholder="Choose update option ..."  data-parsley-error-message=" Please select update " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $usergroup->edit_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $usergroup->edit_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif                            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label" >List / Show Action : </label>
                    <div class="col-sm-9">
                        <select name="listOtherAction" class="form-control" data-placeholder="Choose create option ..."  data-parsley-error-message=" Please select index " data-parsley-trigger="change">
                            <option value="" selected disabled >Select Yes/No</option>
                            @if( $usergroup->index_action == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $usergroup->index_action == '0')
                                <option value="1">Yes</option>
                                 <option selected="" value="0">No</option>
                            @endif                            
                        </select>
                    </div>
                </div>  

                 
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Metrics 1 : </label>
                        <div class="col-sm-9">
                            <select name="metrics1" class="form-control" data-placeholder="Choose metrics 1 ..."  data-parsley-error-message=" Please select metrics 1 " data-parsley-trigger="change">
                                <option value="" selected disabled >Select Yes/No</option>
                                @if( $usergroup->metrics1_action == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $usergroup->metrics1_action == '0')
                                    <option value="1">Yes</option>
                                     <option selected="" value="0">No</option>
                                @endif
                            </select>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Metrics 2 : </label>
                        <div class="col-sm-9">
                            <select name="metrics2" class="form-control" data-placeholder="Choose metrics 2 ..."  data-parsley-error-message=" Please select metrics 2 " data-parsley-trigger="change">
                                <option value="" selected disabled >Select Yes/No</option>
                                @if( $usergroup->metrics2_action == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $usergroup->metrics2_action == '0')
                                    <option value="1">Yes</option>
                                     <option selected="" value="0">No</option>
                                @endif
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Metrics 3 : </label>
                        <div class="col-sm-9">
                            <select name="metrics3" class="form-control" data-placeholder="Choose metrics 3 ..."  data-parsley-error-message=" Please select metrics 3 " data-parsley-trigger="change">
                                <option value="" selected disabled >Select Yes/No</option>
                                @if( $usergroup->metrics3_action == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $usergroup->metrics3_action == '0')
                                    <option value="1">Yes</option>
                                     <option selected="" value="0">No</option>
                                @endif
                            </select>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Metrics 4 : </label>
                        <div class="col-sm-9">
                            <select name="metrics4" class="form-control" data-placeholder="Choose metrics 4 ..."  data-parsley-error-message=" Please select metrics 4 " data-parsley-trigger="change">
                                <option value="" selected disabled >Select Yes/No</option>
                                @if( $usergroup->metrics4_action == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $usergroup->metrics4_action == '0')
                                    <option value="1">Yes</option>
                                     <option selected="" value="0">No</option>
                                @endif
                            </select>
                        </div>
                    </div>     
                        
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Metrics 5 : </label>
                        <div class="col-sm-9">
                            <select name="metrics5" class="form-control" data-placeholder="Choose metrics 5 ..."  data-parsley-error-message=" Please select metrics 5 " data-parsley-trigger="change">
                                <option value="" selected disabled >Select Yes/No</option>
                                @if( $usergroup->metrics5_action == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $usergroup->metrics5_action == '0')
                                    <option value="1">Yes</option>
                                     <option selected="" value="0">No</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Metrics 6 : </label>
                        <div class="col-sm-9">
                            <select name="metrics6" class="form-control" data-placeholder="Choose metrics 6 ..."  data-parsley-error-message=" Please select metrics 6 " data-parsley-trigger="change">
                                <option value="" selected disabled >Select Yes/No</option>
                                @if( $usergroup->metrics6_action == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $usergroup->metrics6_action == '0')
                                    <option value="1">Yes</option>
                                     <option selected="" value="0">No</option>
                                @endif
                            </select>
                        </div>
                    </div>             
                    <div class="form-group">
                        <label class="col-sm-3 control-label" >Queries : </label>
                        <div class="col-sm-9">
                            <select name="queries" class="form-control" data-placeholder="Choose Queries ..."  data-parsley-error-message=" Please select Queries " data-parsley-trigger="change">
                                <option value="" selected disabled >Select Yes/No</option>
                                @if( $usergroup->queries_action == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $usergroup->queries_action == '0')
                                    <option value="1">Yes</option>
                                     <option selected="" value="0">No</option>
                                @endif
                            </select>
                        </div>
                    </div>   


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>      

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection