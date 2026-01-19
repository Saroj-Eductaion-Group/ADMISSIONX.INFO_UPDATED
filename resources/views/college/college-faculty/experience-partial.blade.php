<hr>
<div class="col-md-12">
    <div class="white-bg">
        <div id="collapseExperience{{$item->id}}" class="panel-collapse collapse" aria-expanded="flase" style="">
            <div class="panel-body">
                <h4 class=""><strong>Experience Details</strong></h4>
                @if(sizeof($item->experienceObj) > 0)
                <div class="ibox-content table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Organization Name</th>
                                <th>Role</th>
                                <th>Form Year</th>
                                <th>To Year</th>
                                <th>City</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->experienceObj as $key1 => $item2)
                            <tr>
                                <td>{{ $item2->organisation }}</td>
                                <td>{{ $item2->role }}</td>
                                <td>{{ $item2->fromyear }}</td>
                                <td>{{ $item2->toyear }}</td>
                                <td>{{ $item2->city }}</td>
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
                                <h2 class="">No Faculty Experience Added...</h2>
                            </div>
                        </div>                          
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>