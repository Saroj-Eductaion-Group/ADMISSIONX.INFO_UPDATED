<hr>
<div class="col-md-12">
    <div class="white-bg">
        <div id="collapseQualification{{$item->id}}" class="panel-collapse collapse" aria-expanded="flase" style="">
            <div class="panel-body">
                <h4 class=""><strong>Qualification Details</strong></h4>
                @if(sizeof($item->qualificationsObj) > 0)
                <div class="ibox-content table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Qualification</th>
                                <th>Course</th>
                                <th>Subject</th>
                                <th>Passing Year</th>
                                <th>College Name</th>
                                <th>Board Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->qualificationsObj as $key1 => $item1)
                            <tr>
                                <td>{{ $item1->qualification }}</td>
                                <td>{{ $item1->course }}</td>
                                <td>{{ $item1->subjects }}</td>
                                <td>{{ $item1->year }}</td>
                                <td>{{ $item1->collegename }}</td>
                                <td>{{ $item1->boardName }}</td>
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
                                <h2 class="">No Faculty Qualification Added...</h2>
                            </div>
                        </div>                          
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>