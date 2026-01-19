@extends('employee/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Update City <!-- <a href="{{ url('employee/city') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Update City details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::model($city, [ 'method' => 'PATCH','url' => ['employee/city', $city->id], 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
            <div class="row padding-top5 padding-bottom5">
                <label class="col-md-2 control-label">Select Country :</label>
                <div class="col-md-10">
                    @foreach(  $cityDataObj as  $countryData )
                        @if( $countryData->countryId )
                          <label> {{ $countryData->countryName }}</label>
                        @endif 
                    @endforeach
                    <select name="countryName" class="form-control chosen-select countryName" id="countryId" data-parsley-trigger="change" data-parsley-error-message="Please select your country" >
                        <option value="" selected disabled>Select country</option> 
                        @foreach(  $cityDataObj as  $countryData )
                            @foreach ($countryObj as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach 
                        @endforeach          
                    </select>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="row padding-top5 padding-bottom5">
                <label class="col-md-2 control-label">State Name </label>
                <div class="col-md-10">
                    <select name="state_id" class="form-control chosen-select state_id" id="stateId" data-parsley-trigger="change" data-parsley-error-message="Please select your state" >
                        <option value="" selected disabled>Select state</option> 
                        @foreach(  $cityDataObj as  $cityData )
                            @if( $cityData->stateId )
                                <option value="{{ $cityData->stateId }}" selected="">{{ $cityData->stateName }}</option>
                            @endif 
                          
                            @foreach ($stateObj as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach 
                        @endforeach          
                    </select>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >City Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter city name here', 'data-parsley-error-message' => 'Please enter city name here', 'data-parsley-trigger'=>'change', 'required' => '']) !!}
                    <!-- ,'data-parsley-pattern'=>'^[a-zA-Z\s ]*$' -->
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >City Status : </label>
                <div class="col-sm-10">
                    <select name="cityStatus" class="form-control"  data-parsley-error-message=" Please select city status " data-parsley-trigger="change" >
                       <option value=""  selected disabled>Select city status</option>
                            @if( $city->cityStatus == '1')
                                <option selected="" value="1">Active</option>
                                <option value="0">Inactive</option>
                            @else( $city->cityStatus == '0')
                                <option value="1">Active</option>
                                 <option selected="" value="0">Inactive</option>
                            @endif     
                    </select>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            @include('common-partials.common-fileds-update-partial')
            <hr>
            <div class="row">
               <div class="col-md-12">
                   <div class="headline"><h2>SEO Content</h2></div>
                    <input type="hidden" name="seopagename" value="citypage">
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
    $(document).ready(function(){   
        var stateId = $('.stateId').val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { stateId: stateId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllCityNameData') }}",
                success: function(data) {
                    $.each(data.cityData, function(key, value) {
                        HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
                    });
                    $('.cityName').html(HTML);
                    $('.cityName').trigger("chosen:updated");
                }
            });   

        $('.state_id').on('change', function(){
            var stateId = $(this).val();
            var HTML = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { stateId: stateId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllCityNameData') }}",
                success: function(data) {
                    $.each(data.cityData, function(key, value) {
                        HTML += '<option value='+data.cityData[key].id+'>'+data.cityData[key].name+'</option>';
                    });
                    $('.cityName').html(HTML);
                    $('.cityName').trigger("chosen:updated");
                }
            });
        });

        var countryId = $('.countryId').val();
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { countryId: countryId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllStateNameData') }}",
                success: function(data) {
                    $.each(data.stateData, function(key, value) {
                        HTML += '<option value='+data.stateData[key].id+'>'+data.stateData[key].name+'</option>';
                    });
                    $('.state_id').html(HTML);
                    $('.state_id').trigger("chosen:updated");
                }
            });   

        $('.countryName').on('change', function(){
            var countryId = $(this).val();
            var HTML = '';
            $.ajax({
                headers: {
                  'X-CSRF-Token': $('input[name="_token"]').val()
                },
                method: "GET",
                data: { countryId: countryId },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                url: "{{ URL::to('/getAllStateNameData') }}",
                success: function(data) {
                    $.each(data.stateData, function(key, value) {
                        HTML += '<option value='+data.stateData[key].id+'>'+data.stateData[key].name+'</option>';
                    });
                    $('.state_id').html(HTML);
                    $('.state_id').trigger("chosen:updated");
                }
            });
        });
    });
</script>

@endsection