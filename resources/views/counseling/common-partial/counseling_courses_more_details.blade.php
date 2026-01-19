@foreach($degreeObj as $item)
{{--*/ $flag2 = '0' /*--}}
<div class="row">
    <div class="col-lg-12 margin-top20">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="fa fa-edit"></i> About {{$item->name}} course details
            </div>
            <hr>
            <input type="hidden" class="form-control" value="{{$item->id}}" name="degree_id[]">
            @foreach( $counselingCoursesMoreDetailObj as $key)                                    
                @if( $key->degree_id == $item->id )
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Title</label>
                                <input type="text" name="title[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid title"  id="title" placeholder="Please enter title" value="{{$key->title}}" > 
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Popular Cities</label>
                                <input type="text" name="popularCities[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid popular cities"  id="popularCities" placeholder="Please enter popular cities" value="{{$key->popularCities}}" > 
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Specialisations</label>
                                <input type="text" name="specialisations[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid specialisations"  id="specialisations" placeholder="Please enter specialisations" value="{{$key->specialisations}}" > 
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Entrance Exams Name</label>
                                <input type="text" name="entranceExamsName[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid entrance exams name"  id="entranceExamsName" placeholder="Please enter entrance exams name" value="{{$key->entranceExamsName}}" > 
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Description</label>
                                <textarea class="form-control summernote description" id="description"  placeholder="Enter description" name="description[]">@if($key->description) {{ $key->description or ''}} @endif</textarea>
                            </div>
                        </div>
                        
                        <hr>
                    </div>
                    {{--*/ $flag2 = '1' /*--}}
                @endif
            @endforeach
            @if( $flag2 == '0' )
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Title</label>
                            <input type="text" name="title[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid title"  id="title" placeholder="Please enter title" value="{{$item->name}}"> 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Popular Cities</label>
                            <input type="text" name="popularCities[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid popular cities"  id="popularCities" placeholder="Please enter popular cities" value="" > 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Specialisations</label>
                            <input type="text" name="specialisations[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid specialisations"  id="specialisations" placeholder="Please enter specialisations" value="" > 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Entrance Exams Name</label>
                            <input type="text" name="entranceExamsName[]"  class="form-control" data-parsley-trigger="change" data-parsley-error-message="Please enter valid entrance exams name"  id="entranceExamsName" placeholder="Please enter entrance exams name" value="" > 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea class="form-control summernote description" id="description"  placeholder="Enter description" name="description[]"></textarea>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endforeach