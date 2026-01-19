@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update Course <!-- <a href="{{ url('administrator/course') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update course details</h5>                            
            </div>
            <div class="ibox-content">
                {!! Form::model($course, [ 'method' => 'PATCH',  'url' => ['administrator/course', $course->id],        'class' => 'form-horizontal', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label" >Stream : </label>
                    <div class="col-sm-10">
                        <select name="functionalarea_id" class="form-control chosen-select " data-placeholder="Choose stream..."  data-parsley-error-message=" Please select stream" data-parsley-trigger="change" >
                            <option value="" selected disabled>Select Stream</option>  
                            @foreach ($functionalAreaObj as $functional)
                                @if( $course->functionalarea_id == $functional->id )
                                    <option value="{{ $functional->id }}" selected="">{{ $functional->name }} </option>
                                @else
                                    <option value="{{ $functional->id }}">{{ $functional->name }}</option>
                                @endif
                            @endforeach    
                        </select>     
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" >Degree : </label>
                    <div class="col-sm-10">
                        <select name="degree_id" class="form-control chosen-select " data-placeholder="Choose degree name..."  data-parsley-error-message=" Please select degree name" data-parsley-trigger="change" >
                            <option value="" selected disabled>Select Degree</option>  
                            @foreach ($degreeObj as $degree)
                                @if( $course->degree_id == $degree->id )
                                    <option value="{{ $degree->id }}" selected="">{{ $degree->name }} </option>
                                @else
                                    <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                @endif
                            @endforeach     
                        </select>     
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Course Name : </label>
                    <div class="col-sm-10">
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter course name here', 'data-parsley-error-message' => 'Please enter course name here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                    </div>
                </div>
                @include('common-partials.common-fileds-update-partial')
                <hr>
                <div class="row">
                   <div class="col-md-12">
                       <div class="headline"><h2>SEO Content</h2></div>
                        <input type="hidden" name="seopagename" value="topcoursepage">
                        @if(isset($seocontent) && (sizeof($seocontent) > 0))
                            @if(!empty($seocontent[0]->seoContentId))
                                <input type="hidden" name="seoContentId" value="{{ $seocontent[0]->seoContentId }}">
                            @endif
                            @include ('administrator.seo-content.seo-update-partial')
                        @else
                            @include ('administrator.seo-content.seo-create-partial')
                        @endif
                   </div> 
                </div>
                <div class="hr-line-dashed"></div>
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
@section('script')
@include('common-partials.common-fileds-update-scripts-partial')
<script type="text/javascript">
    $('select[name=functionalarea_id]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllDegreeName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">Select degree</option>';
                if( data.code == '200' ){
                    $.each(data.degreeObj, function(i, item) {
                        HTML += '<option value="'+data.degreeObj[i].degreeId+'">'+data.degreeObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No degree available for this stream</option>';
                }

                $('select[name="degree_id"]').empty();
                $('select[name="degree_id"]').html(HTML);
                $('select[name="degree_id"]').trigger('chosen:updated');
            }
        });
    });
</script>
@endsection