@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Template</h2>        
    </div>    
    <div class="col-lg-2">
        <a href="{{ url($fetchDataServiceController->routeCall().'/template/') }}" class="btn btn-warning btn-sm" title="Edit template"><i class="fa fa-arrow-left"></i> Back</a>
    </div>        
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::open(['url' => $fetchDataServiceController->routeCall().'/template', 'class' => '', 'files' => true, 'data-parsley-validate' => '']) !!}

                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>
                                        <input type="text" name="name" value="" class="form-control" required="" data-parsley-error-message="Please enter name">
                                    </th>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <th>
                                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description of template here', 'data-parsley-error-message' => 'Please enter description of template here', 'data-parsley-trigger'=>'change']) !!}
                                    </th>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th>
                                        <select class="form-control" name="status" >
                                            <option disabled="" selected="">Please select an option</option>
                                                <option value="1" selected="">Active</option>
                                                <option value="0" >Inactive</option>
                                        </select>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="text-center">
                            <button class="btn btn-primary btn-md">Create</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection