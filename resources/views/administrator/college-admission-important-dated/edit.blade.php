@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit CollegeAdmissionImportantDated {{ $collegeadmissionimportantdated->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($collegeadmissionimportantdated, [
                            'method' => 'PATCH',
                            'url' => ['/administrator/college-admission-important-dated', $collegeadmissionimportantdated->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('administrator.college-admission-important-dated.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection