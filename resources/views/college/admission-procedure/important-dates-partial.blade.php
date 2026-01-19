<hr>
<div class="col-md-12">
    <div class="white-bg">
        <div id="collapseImportantDates{{$item->id}}" class="panel-collapse collapse" aria-expanded="flase" style="">
            <div class="panel-body">
                <h4 class=""><strong>Important Dates</strong></h4>
                @if(sizeof($item->importantDatedObj) > 0)
                <div class="ibox-content table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Form Date</th>
                                <th>To Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item->importantDatedObj as $key1 => $item2)
                            <tr>
                                <td>{{ $item2->eventName }}</td>
                                <td width="10%">{{ $item2->fromdate }}</td>
                                <td width="10%">{{ $item2->todate }}</td>
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
                                <h2 class="">No Important Dates Added...</h2>
                            </div>
                        </div>                          
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>