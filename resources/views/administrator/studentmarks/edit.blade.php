@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Student Marks <!-- <a href="{{ url('administrator/studentmarks') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update student profile details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($studentmark, [
                'method' => 'PATCH',
                'url' => ['administrator/studentmarks', $studentmark->id],
                'class' => 'form-horizontal','data-parsley-validate' => '', 'enctype' => 'multipart/form-data'
            ]) !!}

            <div class="form-group">
                <label class="col-sm-2 control-label" >Marks : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="marks" value="{{ $studentmark->marks }}" placeholder="Enter marks here" data-parsley-trigger="change" data-parsley-error-message="Please enter your marks" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >Marks Type </label>
                <div class="col-md-10">
                    <select name="studentMarkType" class="form-control" value="{{ $studentmark->studentMarkType }}" data-parsley-error-message=" Please select mark type " data-parsley-trigger="change" required="">
                        <option value=""  selected disabled>Select mark type</option>
                            @if( $studentmark->studentMarkType == 'PCB')
                                <option selected="" value="PCB">PCB</option>
                                <option value="PCM">PCM</option>
                                <option value="BEST 4">BEST 4</option>
                                <option value="BEST 5">BEST 5</option>
                                <option value="BEST 6">BEST 6</option>
                            @elseif( $studentmark->studentMarkType == 'PCM')
                                <option value="PCB">PCB</option>
                                <option selected="" value="PCM">PCM</option>
                                <option value="BEST 4">BEST 4</option>
                                <option value="BEST 5">BEST 5</option>
                                <option value="BEST 6">BEST 6</option>
                            @elseif( $studentmark->studentMarkType == 'BEST 4')
                                <option value="PCB">PCB</option>
                                <option value="PCM">PCM</option>
                                <option selected="" value="BEST 4">BEST 4</option>
                                <option value="BEST 5">BEST 5</option>
                                <option value="BEST 6">BEST 6</option>
                            @elseif( $studentmark->studentMarkType == 'BEST 5')
                                <option value="PCB">PCB</option>
                                <option value="PCM">PCM</option>
                                <option value="BEST 4">BEST 4</option>
                                <option selected="" value="BEST 5">BEST 5</option>
                                <option value="BEST 6">BEST 6</option>
                            @elseif( $studentmark->studentMarkType == 'BEST 6')
                                <option value="PCB">PCB</option>
                                <option value="PCM">PCM</option>
                                <option value="BEST 4">BEST 4</option>
                                <option value="BEST 5">BEST 5</option>
                                <option selected="" value="BEST 6">BEST 6</option>
                            @else( $studentmark->studentMarkType == '')
                                <option value="" disabled ></option>
                                <option value="PCB">PCB</option>
                                <option value="PCM">PCM</option>
                                <option value="BEST 4">BEST 4</option>
                                <option value="BEST 5">BEST 5</option>
                                <option value="BEST 6">BEST 6</option>
                            @endif        
                    </select>
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >Percentage : </label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="percentage"  value="{{ $studentmark->percentage }}" placeholder="Enter percentage here" data-parsley-trigger="change" data-parsley-error-message="Please enter your percentage" required="">
                </div>
            </div>
            <!-- <div class="form-group">
                <label class="col-sm-2 control-label" >Category : </label>
                <div class="col-sm-10">
                    <select name="categoryName" class="form-control chosen-select " data-placeholder="Choose category name..."  data-parsley-error-message=" Please select category name" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Category Name</option>  
                        @foreach ($category as $catName)
                            @if( $studentmark->category_id == $catName->id )
                                <option value="{{ $catName->id }}" selected="">{{ $catName->name }}</option>
                            @else
                                <option value="{{ $catName->id }}">{{ $catName->name }}</option>
                            @endif
                        @endforeach    
                    </select>     
                </div>
            </div> -->
            <div class="form-group hide">
                <label class="col-sm-2 control-label" >Category : </label>
                <div class="col-sm-10">
                    <input type="hidden" name="categoryName" value="3">                    
                </div>
            </div>
                

             <div class="form-group">
                <label class="col-sm-2 control-label" >Student Profile : </label>
                <div class="col-sm-10">
                    <select name="studentProfileName" class="form-control chosen-select " data-placeholder="Choose student profile..."  data-parsley-error-message=" Please select student profile" data-parsley-trigger="change" required="">
                        <option value="" selected disabled>Select Student Profile</option>
                        @foreach ($studentProfile as $stuProfile)
                            @if( $studentmark->studentprofile_id == $stuProfile->id )
                                <option value="{{ $stuProfile->id }}" selected="">{{ $stuProfile->firstname }} {{ $stuProfile->middlename }} {{ $stuProfile->lastname }}</option>
                            @else
                                <option value="{{ $stuProfile->id }}">{{ $stuProfile->firstname }} {{ $stuProfile->middlename }} {{ $stuProfile->lastname }}</option>
                            @endif
                        @endforeach    
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