<hr>
<div class="col-md-12">
    <div class="white-bg">
        <div id="collapseAssociateDepartment{{$item->id}}" class="panel-collapse collapse" aria-expanded="flase" style="">
            <div class="panel-body">
                <h4 class=""><strong>List of all the departments with which you are connected</strong></h4>
                @if(sizeof($item->facultyDepartmentObj) > 0)
                <div class="ibox-content table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Stream</th>
                                <th>Degree</th>
                                <th>Course</th>
                                <th>Degree Level</th>
                                <th>Course Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->facultyDepartmentObj as $key1 => $item3)
                            <tr>
                                <td>{{ $item3->functionalareaName }}</td>
                                <td>{{ $item3->degreeName }}</td>
                                <td>{{ $item3->courseName }}</td>
                                <td>{{ $item3->educationlevelName }}</td>
                                <td>{{ $item3->coursetypeName }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="profile-bio">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="headline text-center">
                                <h2 class="">No Faculty Associate Department Added...</h2>
                            </div>
                        </div>                          
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>