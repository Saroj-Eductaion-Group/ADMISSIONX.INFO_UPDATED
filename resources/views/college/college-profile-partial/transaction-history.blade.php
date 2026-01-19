<div class="col-md-12">
    <div class="white-bg">
        <div id="collapseTransactionHistory{{$item->id}}" class="panel-collapse collapse" aria-expanded="flase" style="">
            <div class="panel-body">
                <h4 class=""><strong>Transaction History</strong></h4>
                @if(sizeof($item->getCollegeTransactionObj) > 0)
                <div class="ibox-content table-responsive">
					<table class="table table-hover table-bordered table-striped">
						<thead>
							<tr>
								<th>Transaction Id</th>
                                <th>Application Id</th>
                                <th>Student Name </th>
                                <th>Total Fee</th>
                                <th>Paid Amount</th>
                                <th>Rest Amount</th>
                                <th>Payment Status</th>
                                <th>Transaction Date</th>
							</tr>
						</thead>
						<tbody>
						@foreach($item->getCollegeTransactionObj as $item1)
						<tr>
							<td>{{$item1->id}}</td>
                            <td><a  class="text-lightblue" href="{{ URL::to('college/application-detail', [$slug, $item1->applicationID]) }}" title="View">{{ $item1->applicationID }}</a></td>
                            <td><a href="{{ URL::to('college/application-detail', [$slug, $item1->applicationID]) }}">{{ $item1->firstname }} {{ $item1->middlename }} {{ $item1->lastname }}</a></td>
                            <td style="width: 90px;"><i class="fa fa-rupee"></i> {{ $item1->totalfees }}</td>
                            <td style="width: 90px;"><i class="fa fa-rupee"></i> {{ $item1->byafees }}</td>
                            <td style="width: 90px;"><i class="fa fa-rupee"></i> {{ $item1->restfees }}</td>
                            <td>{{ $item1->paymentstatusName }}</td>
                            <td>{{ $item1->updated_at }}</td>
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
                                <h2 class="">No Transaction History...</h2>
                            </div>
                        </div>                          
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>