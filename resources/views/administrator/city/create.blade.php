@extends('administrator/admin-layouts.master')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Create New City <!-- <a href="{{ url('administrator/city') }}" class="btn btn-warning pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a> --></h2>
    </div>
</div>

<div class="row wrapper border-bottom page-heading margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Add new city details</h5>                            
            </div>
            <div class="ibox-content">
            {!! Form::open(['url' => 'administrator/city', 'class' => 'form-horizontal', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data']) !!}
             <div class="form-group">
                <label class="col-sm-2 control-label" >Country Name : </label>
                <div class="col-sm-10">
                    <select name="country_id" class="form-control chosen-select country_id">
                    <option selected="" disabled="">Country</option>
                    @if( $countryObj )
                        <option value="99">India</option>
                        @foreach( $countryObj as $item )
                            @if( $item->id == '99' )
                                <option value="99">{{ $item->name }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >State Name : </label>
                <div class="col-sm-10">
                    <select name="state_id" class="form-control chosen-select state_id" data-parsley-trigger="change" data-parsley-error-message="Please select state name">
                        <option selected="" disabled="">Select state name</option>
                    </select>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-sm-2 control-label" >City Name : </label>
                <div class="col-sm-10">
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter city name here', 'data-parsley-error-message' => 'Please enter city name here', 'data-parsley-trigger'=>'change','required' => '']) !!}
                </div>
            </div>
             <div class="hr-line-dashed"></div>
             <div class="form-group">
                <label class="col-sm-2 control-label" >City Status : </label>
                <div class="col-sm-10">
                    <select class="form-control chosen-select" name="cityStatus" data-parsley-error-message=" Please select city status" data-parsley-trigger="change" required="">
                        <option value="" selected disabled >Select city status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
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
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
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
    $('select[name=country_id]').on('change', function(){
        var countryID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {countryID: countryID},
            url: "{{ URL::to('getAllStateName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">State</option>';
                if( data.code == '200' ){
                    $.each(data.stateObj, function(i, item) {
                        HTML += '<option value="'+data.stateObj[i].stateId+'">'+data.stateObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No state available</option>';
                }

                $('select[name="state_id"]').empty();
                $('select[name="state_id"]').html(HTML);
                $('select[name="state_id"]').trigger('chosen:updated');
            }
        });
    });

    $('select[name=state_id]').on('change', function(){
        var currentID = $(this).val();
        $.ajax({
            headers: {
              'X-CSRF-Token': $('input[name="_token"]').val()
            },
            method: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {currentID: currentID},
            url: "{{ URL::to('getAllCityName') }}",
            success: function(data) {
                var HTML = '';
                HTML += '<option selected="" disabled="">City</option>';
                if( data.code == '200' ){
                    $.each(data.cityObj, function(i, item) {
                        HTML += '<option value="'+data.cityObj[i].cityId+'">'+data.cityObj[i].name+'</option>';
                    }); 
                }else{
                    HTML += '<option selected="" disabled="">No city available</option>';
                }

                $('select[name="city_id"]').empty();
                $('select[name="city_id"]').html(HTML);
                $('select[name="city_id"]').trigger('chosen:updated');
            }
        });
    });
</script>

@endsection