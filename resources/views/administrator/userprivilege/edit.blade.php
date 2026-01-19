@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update User Privilege <!-- <a href="{{ url('administrator/userprivilege') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row margin-top10">
    <div class="col-md-6 col-md-offset-3">
        @if(Session::has('alradyRoleWithPermission'))
            <div class="alert alert-danger alert-dismissable text-center">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                {{ Session::get('alradyRoleWithPermission') }}                        
            </div>
        @endif
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update user privilege details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($userprivilege, ['method' => 'PATCH','url' => ['administrator/userprivilege', $userprivilege->id],             'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}

                <div class="form-group">
                    <label class="col-sm-3 control-label" >Table Name : </label>
                    <div class="col-sm-9">
                        <select name="allTableInformation_id" class="form-control chosen-select" data-parsley-error-message=" Please select table name " data-parsley-trigger="change" required="">
                            <option disabled="" selected="">Select Table</option>
                            @foreach($allTableInfoObj as $item)
                                @if( $item->id == $userprivilege->allTableInformation_id )
                                    <option value="{{ $item->id }}" selected="">{{ $item->name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endif
                            @endforeach
                        </select>                         
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-3 control-label" >Employee Name  : </label>
                    <div class="col-sm-9">
                        <select name="users_id" class="form-control chosen-select" data-parsley-error-message=" Please select employee name " data-parsley-trigger="change" required="">
                            <option disabled="" selected="">Select Employee</option>
                            @foreach($allUsersObj as $item)
                                @if( $item->id == $userprivilege->users_id )
                                    <option value="{{ $item->id }}" selected="">{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->firstname }} {{ $item->middlename }} {{ $item->lastname }}</option>
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
                            @if( $userprivilege->create == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $userprivilege->create == '0')
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
                            @if( $userprivilege->edit == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $userprivilege->edit == '0')
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
                            @if( $userprivilege->index == '1')
                                <option selected="" value="1">Yes</option>
                                <option value="0">No </option>
                            @else( $userprivilege->index == '0')
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
                                @if( $userprivilege->metrics1 == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $userprivilege->metrics1 == '0')
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
                                @if( $userprivilege->metrics2 == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $userprivilege->metrics2 == '0')
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
                                @if( $userprivilege->metrics3 == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $userprivilege->metrics3 == '0')
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
                                @if( $userprivilege->metrics4 == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $userprivilege->metrics4 == '0')
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
                                @if( $userprivilege->metrics5 == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $userprivilege->metrics5 == '0')
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
                                @if( $userprivilege->metrics6 == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $userprivilege->metrics6 == '0')
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
                                @if( $userprivilege->queries == '1')
                                    <option selected="" value="1">Yes</option>
                                    <option value="0">No </option>
                                @else( $userprivilege->queries == '0')
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