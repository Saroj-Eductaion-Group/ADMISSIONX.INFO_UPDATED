@inject('fetchDataServiceController', 'App\Http\Controllers\Helper\FetchDataServiceController')
@extends($fetchDataServiceController->layoutCall())
@section('page-title-name')
Home - Admissionx
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage Template</h2>        
    </div>    
    <div class="col-lg-1">
        <a href="{{ url($fetchDataServiceController->routeCall().'/template/') }}" class="btn btn-warning btn-sm" title="Edit User"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    <div class="col-lg-1">
        <a href="{{ url($fetchDataServiceController->routeCall().'/template/' . $template->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit User"><i class="fa fa-pencil"></i> Edit</a>
    </div>
   <!--  <div class="col-lg-1">
        {!! Form::open([
            'method'=>'DELETE',
            'url' => [$fetchDataServiceController->routeCall().'/template', $template->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete User',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </div> -->
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12 padding-bottom30">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::model($template, [
                            'method' => 'PATCH',
                            'url' => [$fetchDataServiceController->routeCall().'/template', $template->id],
                            'class' => '',
                            'files' => true,
                            'data-parsley-validate' => ''
                        ]) !!}

                        <table class="table table-hover table-responsive">
                            <tr>
                                <th>Name</th>
                                <th>
                                    <input type="text" name="name" value="{{ $template->name }}" class="form-control" required="" data-parsley-error-message="Please enter name">
                                </th>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <th>
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter description of template here', 'data-parsley-error-message' => 'Please enter description of template here','data-parsley-trigger'=>'change']) !!}
                                </th>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <th>
                                    <select class="form-control" name="status" >
                                        <option disabled="" selected="">Please select an option</option>
                                        @if( $template->status == '1' )
                                            <option value="1" selected="">Active</option>
                                            <option value="0" >Inactive</option>
                                        @else
                                            <option value="0" selected="">Inactive</option>   
                                            <option value="1">Active</option>                    
                                        @endif    
                                    </select>
                                </th>
                            </tr>
                        </table>
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm">Update</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection